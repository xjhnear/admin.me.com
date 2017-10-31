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
class Blacklisted extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%blacklisted}}';
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
        	[['user_id', 'option'], 'integer'],
            [['reason', 'operator'], 'string'],
            [['blacktime', 'created', 'updated'], 'safe'],
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
            'option' => '处罚类型',
            'blacktime' => '处罚时间',
            'reason' => '原因',
            'operator' => '操作人',
            'created' => '创建时间',
            'updated' => '更新时间',
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
    
    public function setBlacklisted($user_id, $option, $blacktime=NULL, $reason=NULL)
    {
    	$model = new Blacklisted();
    	$model->user_id = $user_id;
    	$model->option = $option;
    	$model->blacktime = $blacktime;
    	$model->reason = $reason;
    	$model->operator = @Yii::$app->user->identity->username;
    	$model->created = date("Y-m-d H:i:s");
    	$model->save();
    
    	return $model;
    }
    
}
