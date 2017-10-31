<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%access_log}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $girl_id
 * @property integer $diamond
 * @property string $type
 * @property string $created
 *
 * @property mixed $user
 * @property mixed $girl
 */
class DiamondCharge extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%diamond_charge}}';
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
        	[['rmb', 'diamond', 'experience', 'first_experience'], 'integer'],
            [['text', 'first_text'], 'string'],
            [['rmb', 'diamond', 'experience'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'diamond' => '钻石数量',
            'rmb' => 'RMB',
            'experience' => '成长值',
            'text' => '充值描述',
            'first_text' => '首次充值描述',
            'first_experience' => '首次充值的经验值',
        ];
    }

}
