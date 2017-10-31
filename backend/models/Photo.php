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
class Photo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%photo}}';
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
        	[['user_id', 'latitude', 'longitude', 'comment_number', 'reward_number', 'voteup', 'is_approve','is_deleted'], 'integer'],
            [['photo', 'video_url', 'text'], 'string'],
            [['created', 'updated'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '宣言ID',
            'user_id' => '用户ID',
            'photo' => '图片',
            'video_url' => '视频',
            'text' => '文字',
            'latitude' => '纬度',
            'longitude' => '经度',
            'comment_number' => '评论数',
            'reward_number' => '打赏数',
            'voteup' => '点赞',
            'is_deleted' => '删除状态',
            'is_approve' => '审核状态',
            'created' => '创建时间',
            'updated' => '更新时间',
            'report.from_user' => '举报人',
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
    
    
    public function getReport()
    {
    	return $this->hasOne(Report::className(), ['objectId' => 'id']);
    }
    
}
