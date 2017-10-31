<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%photo_voteup}}".
 *
 * @property integer $id
 * @property integer $photo_id
 * @property integer $user_id
 * @property integer $photo_user_id
 * @property string $created
 * @property string $updated
 *
 * @property mixed $photo
 * @property mixed $user
 * @property mixed $photo_user
 */
class PhotoHot extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%photo_hot}}';
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
        	[['user_id', 'photo_id', 'utype', 'credit_grade', 'car_certification_stage', 'part_certification_stage', 'unmakeup_certification_stage', 'hot_ranking'], 'integer'],
        	[['nickname', 'avatar', 'level_name', 'level', 'grade_name'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User_id',
            'photo_id' => 'Photo_id',
            'utype' => 'Utype',
            'nickname' => 'Nickname',
            'avatar' => 'Avatar',
            'level' => 'Level',
            'grade_name' => 'Ggrade_name',
            'credit_grade' => 'Credit_grade',
            'car_certification_stage' => 'Car_certification_stage',
            'part_certification_stage' => 'Part_certification_stage',
            'unmakeup_certification_stage' => 'Unmakeup_certification_stage',
            'hot_ranking' => 'Hot_ranking',
        ];
    }

    
}
