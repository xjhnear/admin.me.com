<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%see_join}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $see_id
 * @property integer $is_release
 * @property integer $created
 * @property integer $updated
 * @property integer $status
 * @property integer $is_del
 * @property double $longitude
 * @property double $latitude
 * @property integer $is_arrive
 * @property integer $diamond
 * @property integer $exp
 * @property integer $is_boss
 * @property integer $diamond_id
 */
class SeeJoin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%see_join}}';
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
            [['user_id', 'see_id'], 'required'],
            [['user_id', 'see_id', 'status', 'diamond', 'exp', 'is_boss', 'diamond_id'], 'integer'],
            [['longitude', 'latitude'], 'number']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => '参与者ID',
            'see_id' => 'See ID',
            'is_release' => '是否为发布者',
            'created' => '创建时间',
            'updated' => '更新时间',
            'status' => '约见状态',
            'is_del' => '0正常,1已删除',
            'longitude' => '经度',
            'latitude' => '纬度',
            'is_arrive' => '是否到达0:未到达, 1:已到达',
            'diamond' => '可获取的积分值',
            'exp' => '经验值',
            'is_boss' => '是否为老板 1:老板 0:宝贝',
            'diamond_id' => '交易id',
        ];
    }
    
    public function getUser()
    {
    	return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
