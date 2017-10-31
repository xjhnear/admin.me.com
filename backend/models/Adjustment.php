<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%adjustment}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $type
 * @property integer $option
 * @property integer $number
 * @property string $reason
 * @property string $operator
 */
class Adjustment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%adjustment}}';
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
            [['reason', 'operator'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
        ];
    }
    
    public function setAdjustment($user_id, $option, $number, $type)
    {
    	$model = new Adjustment();
    	$model->user_id = $user_id;
    	$model->type = $type;
    	$model->option = $option;
    	$model->number = $number;
    	$model->operator = @Yii::$app->user->identity->username;
    	$model->created = date("Y-m-d H:i:s");
    	$model->save();

    	return $model;
    }

}
