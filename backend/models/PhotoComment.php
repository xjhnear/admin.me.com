<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%photo}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $photo
 * @property string $text
 * @property double $latitude
 * @property double $longitude
 * @property integer $voteup
 * @property integer $is_approve
 * @property string $created
 * @property string $updated
 *
 * @property mixed $user
 */
class PhotoComment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%photo_comment}}';
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
        	[['user_id', 'photo_id', 'parent_id', 'reward', 'is_deleted'], 'integer'],
            [['text'], 'string'],
            [['created', 'updated'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '评论ID',
            'user_id' => '用户ID',
            'photo_id' => '宣言ID',
            'parent_id' => '父项ID',
            'text' => '文字',
            'reward' => '赏金',
            'is_deleted' => '删除状态',
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

    public function getPhoto()
    {
    	return $this->hasOne(Photo::className(), ['id' => 'photo_id']);
    }
    
    public function getReport()
    {
    	return $this->hasOne(Report::className(), ['objectId' => 'id']);
    }
    
    
}
