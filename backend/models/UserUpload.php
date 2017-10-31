<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%user_upload}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $module
 * @property integer $position
 * @property string $content_type
 * @property string $path
 * @property string $thumb
 * @property string $created
 * @property string $updated
 */
class UserUpload extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_upload}}';
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
            [['path', 'module'], 'string'],
            [['user_id', 'position', 'is_approve'], 'integer'],
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
            'module' => '类型',
            'position' => '位置',
            'path' => '图片',
            'is_approve' => '审核状态',
            'created' => '创建时间',
            'updated' => '更新时间',
        ];
    }
    
    public function getUser()
    {
    	return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
    
}
