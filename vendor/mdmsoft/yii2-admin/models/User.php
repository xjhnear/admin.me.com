<?php

namespace mdm\admin\models;

use Yii;
use mdm\admin\components\Configs;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */
class User extends \yii\db\ActiveRecord
{
    public $parent_name;
    
    public $password0;
    
    public $password1;
    
    public $password2;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public static function getDb()
    {
        if (Configs::instance()->db !== null) {
            return Configs::instance()->db;
        } else {
            return parent::getDb();
        }
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username','email'], 'safe'],
            [['username','email'], 'required'],
            [['username', 'password0', 'password1', 'password2'], 'string', 'max' => 255],
            [['password2'], 'compare','compareAttribute'=>'password1','message'=>'两次密码不一致'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
    	return [
    	'id' => 'ID',
    	'username' => '用户名',
    	'auth_key' => 'auth_key',
    	'password_hash' => '密码',
    	'password0' => '原密码',
    	'password1' => '新密码',
    	'password2' => '确认密码',
    	'password_reset_token' => 'password_reset_token',
    	'email' => '邮箱',
    	'created' => '创建时间',
    	'updated' => 'updated',
    	];
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
    	return Yii::$app->security->generatePasswordHash($password);
    }
    
    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
    	return Yii::$app->security->generateRandomString();
    }
    
    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
    	return Yii::$app->security->generateRandomString() . '_' . time();
    }
    
    public function save($runValidation = true, $attributeNames = null, $password = "111111")
    {
    	
    	$this->username = $this->username;
    	$this->email = $this->email;
    	$this->auth_key = $this->generateAuthKey();
    	$this->password_hash = $this->setPassword($password);
    	$this->password_reset_token = $this->generatePasswordResetToken();
    	$this->created_at = date('Y-m-d H:i:s');
    	$this->updated_at = date('Y-m-d H:i:s');
    	
    	return parent::save($runValidation, $attributeNames);
    }

}
