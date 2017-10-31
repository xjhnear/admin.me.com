<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%withdraw}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $diamond
 * @property double $rmb
 * @property string $account_no
 * @property string $account_name
 * @property string $operator
 * @property string $title
 * @property string $status
 * @property string $created
 * @property string $remark
 * @property string $paid_time
 * @property string $updated
 *
 * @property mixed $user
 */
class Withdraw extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%withdraw}}';
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
        	[['user_id', 'diamond', 'rmb', 'is_deleted'], 'integer'],
            [['account_no', 'account_name', 'operator', 'title', 'status'], 'string'],
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
            'diamond' => '钻石',
            'rmb' => 'RMB',
            'account_no' => '支付宝账号',
            'account_name' => '姓名',
            'operator' => '客服',
            'title' => 'title',
            'status' => '状态',
            'remark' => 'remark',
            'paid_time' => 'paid_time',
            'is_deleted' => 'is_deleted',
            'created' => '创建时间',
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
