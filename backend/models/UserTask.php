<?php

namespace backend\models;

use Yii;
use yii\base\Model;


/**
 * This is the model class for table "{{%user_extra}}".
 *
 * @property integer $id
 * @property integer $hot_ranking
 * @property integer $hot_push
 * @property string $last_online
 * @property string $last_match
 * @property string $latitude
 * @property string $longitude
 * @property string $lbs_city
 * @property string $lbs_province
 * @property string $lbs_district
 * @property string $created
 * @property string $updated
 * @property integer $experience
 * @property integer $voteup
 * @property integer $photo_voteup
 * @property integer $photo_number
 * @property integer $my_photo_voteup
 * @property integer $my_like
 * @property integer $like_me
 * @property integer $credit_rating
 * @property integer $diamond
 * @property integer $available_matches
 */
class UserTask extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_task}}';
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
            [['user_id', 'activity_daily', 'checkin', 'voteup', 'share', 'moment', 'match', 'add_friend', 'match_done', 'share_done', 'moment_done', 'be_voteuped', 'voteup_done', 'be_voteuped_done', 'add_friend_done'], 'integer'],
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
            'user_id' => 'user_id',
            'activity_daily' => 'activity_daily',
            'checkin' => 'checkin',
            'voteup' => 'voteup',
            'share' => 'share',
            'moment' => 'moment',
            'match' => 'match',
            'add_friend' => 'add_friend',
            'match_done' => 'match_done',
            'share_done' => 'share_done',
            'moment_done' => 'moment_done',
            'be_voteuped' => 'be_voteuped',
            'voteup_done' => 'voteup_done',
            'be_voteuped_done' => 'be_voteuped_done',
            'add_friend_done' => 'add_friend_done',
            'created' => 'created time',
            'updated' => 'Updated',
        ];
    }
    
    public function getUser()
    {
    	return User::findOne($this->id);
    }

}
