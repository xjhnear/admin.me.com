<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use backend\models\VipConfig;
use backend\models\CreditConfig;
use backend\models\Notification;


/**
 * This is the model class for table "{{%user_extra}}".
 *
 * @property integer $id
 * @property integer $hot_ranking
 * @property integer $hot_push
 * @property string $last_online
 * @property string $last_match
 * @property string $latitude
 * @property string $longitude
 * @property string $lbs_city
 * @property string $lbs_province
 * @property string $lbs_district
 * @property string $created
 * @property string $updated
 * @property integer $experience
 * @property integer $voteup
 * @property integer $photo_voteup
 * @property integer $photo_number
 * @property integer $my_photo_voteup
 * @property integer $my_like
 * @property integer $like_me
 * @property integer $credit_rating
 * @property integer $diamond
 * @property integer $available_matches
 */
class UserExtra extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_extra}}';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('apiDb');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['hot_ranking', 'hot_push', 'experience', 'voteup', 'photo_voteup', 'photo_number', 'my_photo_voteup', 'my_like', 'like_me', 'credit_rating', 'diamond', 'available_matches'], 'integer'],
            [['last_online', 'last_match', 'created', 'updated'], 'safe'],
            [['latitude', 'longitude'], 'number'],
            [['lbs_city', 'lbs_province', 'lbs_district'], 'string', 'max' => 10]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'hot_ranking' => '热度排名',
            'hot_push' => '推送次数',
            'last_online' => '上次在线时间',
            'last_match' => '上次匹配时间',
            'latitude' => 'latitude',
            'longitude' => 'longitude',
            'lbs_city' => 'lbs city',
            'lbs_province' => 'lbs province',
            'lbs_district' => 'lbs district',
            'created' => 'created time',
            'updated' => 'Updated',
            'experience' => '经验值',
            'voteup' => '个人点赞',
            'photo_voteup' => '宣言点赞',
            'photo_number' => '宣言总数',
            'my_photo_voteup' => '我赞过的',
            'my_like' => '我喜欢的',
            'like_me' => '喜欢我的',
            'credit_rating' => '信用等级',
            'diamond' => '积分,钻石   宝贝为积分 老板为钻石',
            'available_matches' => '剩余匹配次数',
        ];
    }
    
    public function addBabyExperience($user_id, $point, $method='checkin', $from_user=null)
    {
    	$model=new ExperienceHistory();
    	$model->user_id=$user_id;
    	$model->method=$method;
    	$model->experience=$point;
    	if($from_user){
    		$model->man_id=$from_user->id;
    		$model->man_name=$from_user->nickname;
    	}
    	
    	$model->created=date('Y-m-d H:i:s');
    	$model->created_date=date('Y-m-d');
    	$model->save(false);
    
    	$model_user = User::findOne($user_id);
    	$is_boss = $model_user->isboss();
    	$model_extra = UserExtra::findOne($user_id);
    	if ($model_extra) {
    		$model_extra->experience += $point;
    		$credit_rating = $model_extra->setExperience($model_extra->experience, $is_boss);
    		if($credit_rating){
    			$model_extra->credit_rating = $credit_rating;
    		}
    		$model_extra->save();
    	}
    }
    
    public function setExperience($v, $is_boss=NULL)
    {
    	$this->experience=$v;
    	// code...
    	$model=$this->findConfig($this->experience, $is_boss);
    	
    	if ($model->level!=$this->credit_rating) {
    		$this->availableMatches($model);
    		$this->credit_rating=$model->level;
    		
    		$user=User::findOne($this->id);
    		if ($user->credit_grade!=$model->credit_grade) {
    			$isChange_credit_grade = 1;
    		} else {
    			$isChange_credit_grade = 0;
    		}
    		$user->credit_grade=$model->credit_grade;
    		$user->grade_name=$model->grade_name;
    		$user->level=$this->credit_rating;
    		$user->level_name=$this->getVipPre().$this->credit_rating;
    		$user->save(false);
    		
    		$notification = new Notification();
    		$notification->notification($this->id, 1, 'level', 'level', '', $isChange_credit_grade, $this->credit_rating);
    		
    		return $model->level;
    	}    	
    	return $model->level;
    }
    
    public function findConfig($point, $is_boss=NULL)
    {
    	if ($this->isBoss() || $is_boss) {
    		$VipConfig = new VipConfig();
    		$model=$VipConfig->findByExperience($point);
    	} else {
    		$CreditConfig = new CreditConfig();
    		$model=$CreditConfig->findByExperience($point);
    	}
    	return $model;
    }
    
    public function getVipPre()
    {
    	if ($this->isBoss()) {
    		return 'VIP';
    	}
    	return 'LV';
    }
    
    public function isBoss()
    {
    	return $this->getUser()->isBoss();
    }
    
    public function getUser()
    {
    	return User::findOne($this->id);
    }
    
    public function availableMatches($config)
    {
    	// code...
    	if (!$this->isBoss()) {
    		return;
    	}
    	$this->available_matches = $config->match_daily - abs($this->getAttrConfig()->match_daily - $this->available_matches);
    }
    
    public function getAttrConfig()
    {
    	return $this->getUser()->getAttrConfig();
    }
    
}
