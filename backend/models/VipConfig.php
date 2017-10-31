<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use backend\models\Config;

/**
 * This is the model class for table "{{%vip_config}}".
 *
 * @property integer $id
 * @property integer $vip
 * @property integer $vip_grade
 * @property string $grade_name
 * @property integer $credit_rating
 * @property integer $diamond_total
 * @property integer $voteup_credit
 * @property integer $dating_credit
 * @property integer $open_photo
 * @property integer $private_photo
 * @property string $match_credit
 * @property integer $match_daily
 * @property integer $friend_max_credit
 * @property integer $dating
 * @property integer $basic_filter
 * @property integer $mid_filter
 * @property integer $advanced_filter
 * @property integer $gift_level
 * @property string $description
 */
class VipConfig extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%vip_config}}';
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
            [['grade_name', 'match_credit','description','descriptiondeta'], 'string'],
            [['vip','vip_grade','credit_rating','experience','voteup_credit','dating_credit','open_photo','private_photo','match_daily','friend_max_credit','dating','basic_filter','mid_filter','advanced_filter','gift_level'], 'integer'],
            [['credit_rating','match_daily','friend_max_credit','basic_filter','mid_filter','advanced_filter','gift_level','grade_name'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'vip' => 'vip等级',
            'vip_grade' => 'vip等级区间',
            'grade_name' => '用户等级：较为信任',
            'credit_rating' => '对应的信用等级',
            'experience' => '累积的消费情况',
            'voteup_credit' => '点赞信用数',
            'dating_credit' => '约见信用点数',
            'open_photo' => '查看公开照',
            'private_photo' => '查看私房照',
            'match_credit' => '匹配区间',
            'match_daily' => '每日匹配次数',
            'friend_max_credit' => '好友添加限制等级',
            'dating' => '是否开发约见功能',
            'basic_filter' => '初级筛选',
            'mid_filter' => '中级筛选',
            'advanced_filter' => '高级筛选',
            'gift_level' => '可收礼物等级',
            'description' => '文字信息',
            'descriptiondeta' => '文字信息(下一级)',
           
        ];
    }
    
    public function findByExperience($n)
    {
    	$model = VipConfig::find()->where('experience<='.$n)->orderBy('id desc')->one();
    	return $model;
    }
    
    public function getLevel()
    {
        return $this->vip;
    }
    
    public function findByNo($n)
    {
    	$model = VipConfig::find()->where('vip='.$n)->one();
    	return $model;
    }
    
    public function getCredit_grade()
    {
    	return $this->vip_grade;
    }
    
    public function beforeSave($insert)
    {
    	$config = Config::find()->where('type="vip_config"')->all();
    	foreach($config as $model){
    		$tmp = $model->attributes;
    		$config_arr[$tmp['config_key']]=$tmp['config_value'];
    	}
    	 
    	//当前文字信息
    	$description = "";
//     	$description = $config_arr['vip_match']."\n";
    	if ($this->open_photo == 1) {
    		$description .= $config_arr['vip_open_photo']."\n";
    	}
    	if ($this->private_photo == 1) {
    		$description .= $config_arr['vip_private_photo']."\n";
    	}
//     	if ($this->voteup_credit > 0) {
//     		$description .= sprintf($config_arr['vip_voteup_credit'], $this->voteup_credit)."\n";
//     	}
//     	if ($this->match_daily > 0) {
//     		$description .= sprintf($config_arr['vip_match_daily'], $this->match_daily)."\n";
//     	}
    	if ($this->dating_credit > 0) {
    		$description .= sprintf($config_arr['vip_dating_credit'], $this->dating_credit)."\n";
    	}
//     	if ($this->match_credit > 0) {
//     		$description .= sprintf($config_arr['vip_match_credit'], $this->match_credit)."\n";
//     	}
//     	if ($this->friend_max_credit > 0) {
//     		$description .= sprintf($config_arr['vip_friend_max_credit'], $this->friend_max_credit)."\n";
//     	}
    	if ($this->dating == 1) {
    		$description .= $config_arr['vip_dating']."\n";
    	}
    	if ($this->advanced_filter == 1) {
    		$description .= $config_arr['vip_advanced_filter']."\n";
    	} elseif ($this->mid_filter == 1) {
    		$description .= $config_arr['vip_mid_filter']."\n";
    	} elseif ($this->basic_filter == 1) {
    		$description .= $config_arr['vip_basic_filter']."\n";
    	}
    	$this->description = $description;
    	 
    	//下一级文字信息
    	$next_id = $this->id + 1;
    	$next = VipConfig::find()->where('id='.$next_id)->one();
    	if ($next) {
    		$description_next = "";
    		if ($this->open_photo == 0 && $next->open_photo == 1) {
    			$description_next .= $config_arr['vip_open_photo']."\n";
    		}
    		if ($this->private_photo == 0 && $next->private_photo == 1) {
    			$description_next .= $config_arr['vip_private_photo']."\n";
    		}
//     		if ($this->voteup_credit <> $next->voteup_credit) {
//     			$description_next .= sprintf($config_arr['vip_voteup_credit'], $next->voteup_credit)."\n";
//     		}
//     		if ($this->match_daily <> $next->match_daily) {
//     			$description_next .= sprintf($config_arr['vip_match_daily'], $next->match_daily)."\n";
//     		}
    		if ($this->dating_credit <> $next->dating_credit) {
    			$description_next .= sprintf($config_arr['vip_dating_credit'], $next->dating_credit)."\n";
    		}
//     		if ($this->match_credit <> $next->match_credit) {
//     			$description_next .= sprintf($config_arr['vip_match_credit'], $next->match_credit)."\n";
//     		}
//     		if ($this->friend_max_credit <> $next->friend_max_credit) {
//     			$description_next .= sprintf($config_arr['vip_friend_max_credit'], $next->friend_max_credit)."\n";
//     		}
    		if ($this->dating == 0 && $next->dating == 1) {
    			$description_next .= $config_arr['vip_dating']."\n";
    		}
    		if ($this->advanced_filter == 0 && $next->advanced_filter == 1) {
    			$description_next .= $config_arr['vip_advanced_filter']."\n";
    		} elseif ($this->mid_filter == 0 && $next->mid_filter == 1) {
    			$description_next .= $config_arr['vip_mid_filter']."\n";
    		} elseif ($this->basic_filter == 0 && $next->basic_filter == 1) {
    			$description_next .= $config_arr['vip_basic_filter']."\n";
    		}

    		$this->descriptiondeta = $description_next;
    	}
    
    	return true;
    }
    
}
