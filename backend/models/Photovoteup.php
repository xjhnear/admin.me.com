<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%photo_voteup}}".
 *
 * @property integer $id
 * @property integer $photo_id
 * @property integer $user_id
 * @property integer $photo_user_id
 * @property string $created
 * @property string $updated
 *
 * @property mixed $photo
 * @property mixed $user
 * @property mixed $photo_user
 */
class Photovoteup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%photo_voteup}}';
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
        	[['user_id', 'photo_id', 'photo_user_id'], 'integer'],
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
            'user_id' => '用户ID',
            'photo_id' => 'photo_id',
            'photo_user_id' => 'photo_user_id',
            'created' => '创建时间',
            'updated' => 'updated',
        ];
    }

//     /**
//      * 获取用户信息
//      * @return \yii\db\ActiveQuery
//      */
//     public function getPhoto()
//     {
//     	return $this->hasOne(Photo::className(), ['id' => 'photo_id']);
//     }
    
}
