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
class Config extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%config}}';
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
            [['title', 'config_key', 'config_value', 'type', 'platform'], 'string'],
            [['config_key', 'config_value'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => '标题',
            'config_key' => '关键字',
            'config_value' => '值',
            'type' => '类型',
            'platform' => '平台',
        ];
    }

    /**
     * 获取用户信息
     * @return \yii\db\ActiveQuery
     */
    public function getConfig($key)
    {
        return $this->findOne(['config_key' => $key]);
    }
    
	public static  function  get_type(){
	    $cat = Config::findBySql('SELECT DISTINCT type FROM config')->all();
	    $cat_arr = array();
	    foreach ($cat as $cat) {
	    	if (isset($cat->type) && $cat->type) {
	    		$cat_arr[$cat->type] = $cat->type;
	    	}
	    }
	    return $cat_arr;
	}
    
}
