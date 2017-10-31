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
 * @property integer $created_at
 * @property integer $updated_at
 */
class Matchhistory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%match_history}}';
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
            [['girl_id', 'man_id', 'man_confirm', 'girl_confirm', 'created', 'updated'], 'integer'],
            [['status'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '匹配ID',
            'girl_id' => '美女ID',
            'man_id' => '老板ID',
            'status' => '匹配状态',
            'man_confirm' => '老板方确定',
            'girl_confirm' => '宝贝方确定',
            'created' => '创建时间',
            'updated' => '更新时间',
        ];
    }

}
