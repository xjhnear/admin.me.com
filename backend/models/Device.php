<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%config}}".
 *
 * @property integer $id
 * @property string $config_key
 * @property integer $config_value
 * @property integer $type
 * @property integer $platform
 */
class Device extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%device}}';
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
        	[['id', 'user_id'], 'integer'],
            [['udid', 'token', 'os', 'os_version', 'model'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'udid' => 'udid',
            'user_id' => 'user_id',
            'token' => 'device token or installionId',
            'os' => 'iPhone OS',
            'os_version' => 'os_version',
            'model' => 'model',
            'brand' => '品牌',
            'version' => 'app version',
            'ip' => 'ip',
            'source' => '渠道号',
            'dist' => '发行版',
            'created' => 'created time',
            'updated' => 'updated',
        ];
    }
 
}
