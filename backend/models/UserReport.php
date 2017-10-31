<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%access_log}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $controller
 * @property string $action
 * @property string $ip
 * @property integer $object_id
 * @property string $url
 * @property string $post
 * @property integer $code
 * @property string $result
 * @property string $msg
 * @property string $created
 * @property string $updated
 *
 * @property mixed $user
 * @property mixed $object
 */
class UserReport extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'log.user_report';
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
        	[['h01', 'h02', 'h03', 'h04', 'h05', 'h06', 'h07', 'h08', 'h09', 'h10', 'h11', 'h12', 'h13', 'h14', 'h15', 'h16', 'h17', 'h18', 'h19', 'h20', 'h21', 'h22', 'h23', 'h00'], 'integer'],
            [['daytime'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'daytime' => '时间',
            'h00' => 'h00',
            'h01' => 'h01',
            'h02' => 'h02',
            'h03' => 'h03',
            'h04' => 'h04',
            'h05' => 'h05',
            'h06' => 'h06',
            'h07' => 'h07',
            'h08' => 'h08',
            'h09' => 'h09',
            'h10' => 'h10',
            'h11' => 'h11',
            'h12' => 'h12',
            'h13' => 'h13',
            'h14' => 'h14',
            'h15' => 'h15',
            'h16' => 'h16',
            'h17' => 'h17',
            'h18' => 'h18',
            'h19' => 'h19',
            'h20' => 'h20',
            'h21' => 'h21',
            'h22' => 'h22',
            'h23' => 'h23',
            'created' => 'created',
        ];
    }

    
}
