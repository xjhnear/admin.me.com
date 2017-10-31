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
class Banner extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%banner}}';
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
            [['photo', 'name','url','share_title','share_text','share_url','share_photo','start_photo','user_type'], 'string'],
            [['position', 'is_active', 'is_startpage'], 'integer'],
            [['start_time', 'end_time', 'created', 'updated'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'photo' => '图片',
            'name' => '名字',
            'url' => '链接',
            'share_title' => '分享标题',
            'share_text' => '分享文字',
            'share_url' => '分享链接',
            'share_photo' => '分享小图',
            'start_time' => '开始时间',
            'end_time' => '结束时间',
            'start_photo' => '启动页图片',
            'is_active' => '是否激活',
            'is_startpage' => '是否启动页',
            'position' => '位置',
            'created' => '创建时间',
            'updated' => '修改时间',
            'user_type' => '显示用户类型',
        ];
    }

    
}
