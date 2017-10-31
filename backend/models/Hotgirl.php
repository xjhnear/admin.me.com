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
class Hotgirl extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%hotgirl}}';
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
            [['id','ranking','popularity','applier','followee'], 'integer'],
            [['nickname','photo'], 'string'],
            [['id','ranking'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '用户ID',
            'nickname' => '用户昵称',
            'photo' => '图片',
            'ranking' => '排名',
            'popularity' => '人气',
            'applier' => '支持人数',
            'followee' => '关注人数',
        ];
    }

}
