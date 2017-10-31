<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%experience_history}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $man_id
 * @property string $man_name
 * @property integer $experience
 * @property string $method
 * @property string $created
 * @property string $created_date
 * @property integer $is_deleted
 *
 * @property mixed $user
 * @property mixed $man
 */
class ExperienceHistory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%experience_history}}';
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
        	[['user_id','man_id','experience','is_deleted'], 'integer'],
            [['config_key', 'man_name', 'method', 'avatar'], 'string'],
            [['created','created_date'], 'safe'],
            
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => '关键字',
            'man_id' => '老板ID',
            'man_name' => '老板昵称',
            'experience' => '钻石',
            'method' => '获取途径',
            'created' => 'created time',
            'created_date' => '创建日期',
            'is_deleted' => '是否已经清除',
        ];
    }

    /**
     * 获取用户信息
     * @return \yii\db\ActiveQuery
     */
    public function getConfig($key)
    {
        return $this->findOne(['config_key' => $key]);
    }
    
}
