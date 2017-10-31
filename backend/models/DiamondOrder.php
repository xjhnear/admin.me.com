<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%diamond_order}}".
 *
 * @property integer $id
 * @property string $order_no
 * @property integer $user_id
 * @property integer $diamond
 * @property integer $experience
 * @property integer $rmb
 * @property string $status
 * @property string $trade_no
 * @property string $payment_method
 * @property string $paid_time
 * @property string $created
 * @property string $updated
 */
class DiamondOrder extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%diamond_order}}';
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
            [['order_no'], 'required'],
            [['user_id', 'diamond', 'experience', 'rmb'], 'integer'],
            [['status', 'payment_method'], 'string'],
            [['paid_time', 'created', 'updated'], 'safe'],
            [['order_no'], 'string', 'max' => 20],
            [['trade_no'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_no' => '订单号',
            'user_id' => '用户ID',
            'diamond' => '钻石数量',
            'experience' => '成长值',
            'rmb' => '充值人民币',
            'status' => '状态',
            'trade_no' => '支付流水号',
            'payment_method' => '支付方式',
            'paid_time' => '支付时间',
            'created' => '下单时间',
            'updated' => '更新时间',
            'user.nickname' => '充值用户',
            'userextra.diamond' => '帐户余额',
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
    
    /**
     * 获取用户扩展信息
     * @return \yii\db\ActiveQuery
     */
    public function getUserextra()
    {
    	return $this->hasOne(UserExtra::className(), ['id' => 'user_id']);
    }
    
}
