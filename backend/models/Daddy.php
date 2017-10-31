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
class Daddy extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%daddy}}';
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
        	[['id', 'ranking', 'popularity', 'applier', 'followee', 'is_approve','is_deleted'], 'integer'],
            [['nickname', 'photo'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nickname' => '用户昵称',
            'photo' => '图片',
            'ranking' => 'ranking',
            'popularity' => 'popularity',
            'applier' => 'applier',
            'followee' => 'followee',
            'is_deleted' => '删除状态',
            'is_approve' => '审核状态',
        ];
    }

    /**
     * 获取用户信息
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
    	return $this->hasOne(User::className(), ['id' => 'id']);
    }

    
}
