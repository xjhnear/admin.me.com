<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%report}}".
 *
 * @property integer $id
 * @property integer $from_user
 * @property integer $to_user
 * @property string $cat
 * @property string $module
 * @property integer $objectId
 * @property string $url
 * @property string $created
 * @property string $updated
 */
class Report extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%report}}';
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
        	[['from_user', 'to_user', 'objectId'], 'integer'],
            [['cat', 'module', 'url'], 'string'],
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
            'from_user' => '举报人',
            'to_user' => '被举报人',
            'cat' => 'cat',
            'module' => 'module',
            'objectId' => 'objectId',
            'url' => 'url',
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
    
    public function getPhoto()
    {
    	return $this->hasOne(Photo::className(), ['id' => 'objectId']);
    }
    
    public function getPhotocomment()
    {
    	return $this->hasOne(PhotoComment::className(), ['id' => 'objectId']);
    }
    
}
