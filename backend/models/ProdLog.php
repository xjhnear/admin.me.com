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
class ProdLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'log.prod_log';
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
        	[['user_id', 'object_id', 'code'], 'integer'],
            [['controller', 'action', 'ip', 'url'], 'string'],
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
            'controller' => 'controller',
            'action' => 'action',
            'ip' => 'ip',
            'object_id' => 'object_id',
            'url' => 'url',
            'post' => 'post',
            'code' => 'code',
            'result' => 'result',
            'msg' => 'msg',
            'created' => 'created',
        ];
    }

    public function attributes()
    {
    	return ['c'];
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
