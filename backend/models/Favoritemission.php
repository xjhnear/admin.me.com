<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%config}}".
 *
 * @property integer $id
 * @property string $config_key
 * @property integer $config_value
 * @property integer $type
 * @property integer $platform
 */
class Favoritemission extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%favorite_mission}}';
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
            [['user_id','conversation','photo','match','see','seepub','friend','reward','money'], 'integer'],
            [['mouth','checkday'], 'string'],
        ];
    }

    public function attributes()
    {
    	return ['c','user_id','conversation','photo','match','see','seepub','friend','reward','money','checkday','mouth','id'];
    }
    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => '用户ID',
            'mouth' => 'mouth',
            'conversation' => 'conversation',
            'photo' => 'photo',
            'match' => 'match',
            'see' => 'see',
            'seepub' => 'seepub',
            'friend' => 'friend',
            'reward' => 'reward',
            'money' => 'money',
            'checkday' => 'checkday',
        ];
    }

}
