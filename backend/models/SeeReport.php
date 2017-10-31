<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%see_report}}".
 *
 * @property integer $id
 * @property integer $from_user
 * @property integer $to_user
 * @property integer $module_id
 * @property string $category
 * @property string $message
 * @property integer $created
 * @property integer $updated
 * @property string $status
 */
class SeeReport extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%see_report}}';
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
            [['from_user', 'to_user', 'module_id', 'created', 'updated'], 'integer'],
            [['to_user', 'category'], 'required'],
            [['category', 'status'], 'string'],
            [['message'], 'string', 'max' => 255]
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
            'module_id' => '举报的模块id',
            'category' => '举报类型',
            'message' => '举报信息',
            'created' => '创建时间',
            'updated' => '修改时间',
            'status' => '处理状态',
        ];
    }

    /**
     * 举报者
     */
    public function getInformer()
    {
        return $this->hasOne(User::className(), ['id' => 'from_user']);
    }

    /**
     * 被举报者
     */
    public function getBeInformer()
    {
        return $this->hasOne(User::className(), ['id' => 'to_user']);
    }
}
