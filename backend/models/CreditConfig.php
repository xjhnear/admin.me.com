<?php

namespace backend\models;

use yii\rest\CreateAction;

use Yii;
use yii\base\Model;
use backend\models\Config;

/**
 * This is the model class for table "{{%credit_config}}".
 *
 * @property integer $id
 * @property integer $credit_rating
 * @property integer $vip
 * @property integer $credit_total
 * @property integer $credit_grade
 * @property string $grade_name
 * @property integer $unmakup_certification
 * @property integer $part_certification
 * @property string $match_vip
 * @property integer $friend_max_vip
 * @property integer $dating
 * @property integer $dating_monthly
 * @property integer $concurrent_dating
 * @property integer $basic_filter
 * @property integer $mid_filter
 * @property integer $advanced_filter
 * @property integer $gift_level
 * @property string $description
 */
class CreditConfig extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%credit_config}}';
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
            [['grade_name','match_vip','description','descriptiondeta'], 'string'],
            [['credit_rating','vip','credit_total','credit_grade','unmakup_certification','part_certification','friend_max_credit','dating','dating_monthly','dating_diamond','dating_credit','concurrent_dating','basic_filter','mid_filter','advanced_filter','gift_level'], 'integer'],
            [['credit_rating','vip','credit_grade','friend_max_credit','dating_monthly','dating_credit','concurrent_dating','basic_filter','mid_filter','advanced_filter','gift_level','grade_name'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'credit_rating' => '信用等级',
            'vip' => '对应的vip',
            'credit_total' => '累积的信用数',
            'credit_grade' => '用户等级：较为信任',
            'grade_name' => '用户等级：较为信任',
            'unmakup_certification' => '素颜认证',
            'part_certification' => '身材认证',
            'match_vip' => '匹配区间',
            'friend_max_credit' => '好友添加限制等级',
            'dating' => '是否开发约见功能',
            'dating_monthly' => '每月有效约见次数',
            'dating_diamond' => '信用身价',
            'dating_credit' => '固有约见信用点数',
            'concurrent_dating' => '同时约见数量',
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
    	$model = CreditConfig::find()->where('credit_total<='.$n)->orderBy('id desc')->one();
    	return $model;
    }
    
    public function getLevel()
    {
    	return $this->credit_rating;
    }
    
    public function findByNo($n)
    {
    	$model = CreditConfig::find()->where('credit_rating='.$n)->one();
    	return $model;
    }
    
    public function beforeSave($insert)
    {
    	$config = Config::find()->where('type="credit_config"')->all();
    	foreach($config as $model){
    		$tmp = $model->attributes;
    		$config_arr[$tmp['config_key']]=$tmp['config_value'];
    	}
    	
    	//当前文字信息
    	$description = "";
//     	$description = $config_arr['credit_match']."\n";
    	$description .= $config_arr['credit_video_certification']."\n";
    	if ($this->unmakup_certification == 1) {
    		$description .= $config_arr['credit_unmakup_certification']."\n";
    	}
    	if ($this->part_certification == 1) {
    		$description .= $config_arr['credit_part_certification']."\n";
    	}
//     	$description .= sprintf($config_arr['credit_match_vip'], $this->match_vip)."\n";
//     	if ($this->friend_max_credit > 0) {
//     		$description .= sprintf($config_arr['credit_friend_max_credit'], $this->friend_max_credit)."\n";
//     	}
    	if ($this->dating == 1) {
    		$description .= $config_arr['credit_dating']."\n";
    	}
//     	if ($this->dating_monthly > 0) {
//     		$description .= sprintf($config_arr['credit_dating_monthly'], $this->dating_monthly)."\n";
//     	}
//     	if ($this->concurrent_dating > 0) {
//     		$description .= sprintf($config_arr['credit_concurrent_dating'], $this->concurrent_dating)."\n";
//     	}
    	if ($this->advanced_filter == 1) {
    		$description .= $config_arr['credit_advanced_filter']."\n";
    	} elseif ($this->mid_filter == 1) {
    		$description .= $config_arr['credit_mid_filter']."\n";
    	} elseif ($this->basic_filter == 1) {
    		$description .= $config_arr['credit_basic_filter']."\n";
    	}
    	if ($this->dating_diamond > 0) {
    		$description .= sprintf($config_arr['credit_dating_diamond'], $this->dating_diamond)."\n";
    	}
    	$this->description = $description;
    	
    	//下一级文字信息
    	$next_id = $this->id + 1;
    	$next = CreditConfig::find()->where('id='.$next_id)->one();
    	if ($next) {
    		$description_next = "";
    		if ($this->unmakup_certification == 0 && $next->unmakup_certification == 1) {
    			$description_next .= $config_arr['credit_unmakup_certification']."\n";
    		}
    		if ($this->part_certification == 0 && $next->part_certification == 1) {
    			$description_next .= $config_arr['credit_part_certification']."\n";
    		}
//     		if ($this->match_vip <> $next->match_vip) {
//     			$description_next .= sprintf($config_arr['credit_match_vip'], $next->match_vip)."\n";
//     		}
//     		if ($this->friend_max_credit <> $next->friend_max_credit) {
//     			$description_next .= sprintf($config_arr['credit_friend_max_credit'], $next->friend_max_credit)."\n";
//     		}
    		if ($this->dating == 0 && $next->dating == 1) {
    			$description_next .= $config_arr['credit_dating']."\n";
    		}
//     		if ($this->dating_monthly <> $next->dating_monthly) {
//     			$description_next .= sprintf($config_arr['credit_dating_monthly'], $next->dating_monthly)."\n";
//     		}
//     		if ($this->concurrent_dating <> $next->concurrent_dating) {
//     			$description_next .= sprintf($config_arr['credit_concurrent_dating'], $next->concurrent_dating)."\n";
//     		}
    		if ($this->advanced_filter == 0 && $next->advanced_filter == 1) {
    			$description_next .= $config_arr['credit_advanced_filter']."\n";
    		} elseif ($this->mid_filter == 0 && $next->mid_filter == 1) {
    			$description_next .= $config_arr['credit_mid_filter']."\n";
    		} elseif ($this->basic_filter == 0 && $next->basic_filter == 1) {
    			$description_next .= $config_arr['credit_basic_filter']."\n";
    		}
    		if ($this->dating_diamond <> $next->dating_diamond) {
    			$description_next .= sprintf($config_arr['credit_dating_diamond'], $next->dating_diamond)."\n";
    		}
    		$this->descriptiondeta = $description_next;
    	}

    	return true;
    }
    
}
