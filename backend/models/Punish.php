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
class Punish extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%punish}}';
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
            [['reason', 'operator'], 'string'],
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
            'reason' => '原因',
            'operator' => '操作人',
            'created' => 'Created',
            'updated' => 'Updated',
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
    
    public function setPunish($id, $reason)
    {
    	$model = new Punish();
    	$model->user_id = $id;
    	$model->reason = $reason;
    	$model->operator = @Yii::$app->user->identity->username;
    	$model->created = date("Y-m-d H:i:s");
    	$model->save();
    
    	return $model;
    }
    
}
