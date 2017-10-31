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
class CountHtml extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
//         return '{{%count_html}}';
    	return 'log.count_html';
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
            [['name', 'module','submod','ip'], 'string'],
        ];
    }

    public function attributes()
    {
    	return ['d', 'c', 'e'];
    }
    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'name',
            'module' => 'module',
            'submod' => 'submod',
            'ip' => 'IP',
            'created' => '创建时间',
            'updated' => '修改时间',
        ];
    }
    
}
