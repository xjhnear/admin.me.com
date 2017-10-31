<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%access_log}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $girl_id
 * @property integer $diamond
 * @property string $type
 * @property string $created
 *
 * @property mixed $user
 * @property mixed $girl
 */
class Diamondhistory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%diamond_history}}';
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
        	[['user_id', 'diamond'], 'integer'],
            [['type'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => '用户ID',
            'from_user' => '对方ID',
            'diamond' => '钻石',
            'type' => '消费类型',
            'created' => '消费时间',
            'status' => '交易状态',
        ];
    }

    /**
     * 获取用户信息
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
    	return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
    
}
