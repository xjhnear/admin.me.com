<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%see}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $business_id
 * @property integer $obj_sex
 * @property integer $see_time
 * @property integer $release_long
 * @property string $message
 * @property integer $created
 * @property integer $updated
 */
class See extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%see}}';
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
            [['user_id', 'business_id', 'see_time', 'message'], 'required'],
            [['user_id', 'business_id'], 'integer'],
            [['message'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '约见ID',
            'user_id' => 'User ID',
            'business_id' => '约会地点',
            //'obj_sex' => '约会对象0:男,1:女',
            'see_time' => '约会时间',
            'release_long' => '发布有效期',
            'message' => '留言',
            'created' => '创建时间',
            'updated' => '更新时间',
        ];
    }

    public function getDianping()
    {
        return $this->hasOne(Dianping::className(), ['business_id' => 'business_id']);
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getSeeJoin()
    {
        return $this->hasMany(SeeJoin::className(), ['see_id' => 'id'])->andWhere(['!=', 'user_id', $this->user_id]);
    }
}
