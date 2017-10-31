<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%access_log}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $controller
 * @property string $action
 * @property string $ip
 * @property integer $object_id
 * @property string $url
 * @property string $post
 * @property integer $code
 * @property string $result
 * @property string $msg
 * @property string $created
 * @property string $updated
 *
 * @property mixed $user
 * @property mixed $object
 */
class Rechargehistory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%recharge_history}}';
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
        	[['user_id', 'coin', 'amount', 'transaction_no'], 'integer'],
            [['payment_method', 'status'], 'string'],
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
            'coin' => '钻石',
            'amount' => 'RMB金额',
            'payment_method' => '支付方式',
            'transaction_no' => '交易号',
            'status' => '状态',
            'created' => '充值时间',
            'updated' => 'updated',
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
