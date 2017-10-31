<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%bot}}".
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
class Bot extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%bot}}';
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
            [['user_id', 'utype'], 'integer'],
            [['province'], 'string'],
            [['created'], 'safe'],
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
            'utype' => '性别',
            'province' => '城市',
            'created' => '创建时间',
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
