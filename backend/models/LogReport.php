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
class LogReport extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'log.log_report';
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
        	[['user_today', 'user_2day', 'user_7day', 'user_30day', 'photo_today', 'login_today', 'login_old_today', 'login_old_2d', 'login_old_7d', 'login_old_30d', 'start_udid', 'send_udid', 'verify_udid', 'password_udid', 'utype_udid', 'nickname_udid', 'birthday_udid'], 'integer'],
            [['daytime'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'daytime' => '时间',
            'user_today' => 'user_today',
            'user_2day' => 'user_2day',
            'user_7day' => 'user_7day',
            'user_30day' => 'user_30day',
            'photo_today' => 'photo_today',
            'login_today' => 'login_today',
            'login_old_today' => 'login_old_today',
            'login_old_2d' => 'login_old_2d',
            'login_old_7d' => 'login_old_7d',
            'login_old_30d' => 'login_old_30d',
            'start_udid' => 'start_udid',
            'send_udid' => 'send_udid',
            'verify_udid' => 'verify_udid',
            'password_udid' => 'password_udid',
            'utype_udid' => 'utype_udid',
            'nickname_udid' => 'nickname_udid',
            'birthday_udid' => 'birthday_udid',
            'created' => 'created',
        ];
    }

}
