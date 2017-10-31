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
class MyFriend extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%my_friend}}';
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
            [['user_id', 'to_user', 'is_blocked', 'is_followee'], 'integer'],
            [['alias'], 'string'],
            [['created', 'updated'], 'safe'],
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
            'to_user' => '朋友ID',
            'alias' => '备注名称',
            'is_followee' => '是否是互粉',
            'is_blocked' => '是否拉黑',
            'created' => '创建时间',
            'updated' => '更新时间',
            'User.nickname' => '好友昵称',
        ];
    }

    /**
     * 获取用户信息
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'to_user']);
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
