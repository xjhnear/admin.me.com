<?php

namespace backend\models;

use yii\widgets\Breadcrumbs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\User;

/**
 * UserSearch represents the model behind the search form about `backend\models\User`.
 */
class UserSearch extends User
{
	public $udid;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'height', 'age', 'figure', 'completion', 'is_active', 'blacklisted', 'level', 'credit_grade', 'month_cancel'], 'integer'],
            [['mobile', 'nickname', 'udid', 'password', 'avatar', 'qq', 'wechat', 'province', 'city', 'district', 'homeland', 'industry', 'relationship', 'birthday', 'starsign', 'optional_sex', 'optional_love', 'hobby',  'education', 'level_name', 'grade_name', 'signature', 'created', 'updated', 'completion_fields'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = User::find();
        $query->joinWith(['device']);
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
        	return $dataProvider;
        }

        $query->andFilterWhere([
            'utype' => $this->utype,
            'sex' => $this->sex,
            'height' => $this->height,
            'birthday' => $this->birthday,
            'age' => $this->age,
            'figure' => $this->figure,
            'car_certification_stage' => $this->car_certification_stage,
            'avatar_certification_stage' => $this->avatar_certification_stage,
            'id_certification_stage' => $this->id_certification_stage,
            'video_certification_stage' => $this->video_certification_stage,
            'unmakeup_certification_stage' => $this->unmakeup_certification_stage,
            'part_certification_stage' => $this->part_certification_stage,
            'completion' => $this->completion,
            'is_active' => $this->is_active,
            'blacklisted' => $this->blacklisted,
            'level' => $this->level,
            'credit_grade' => $this->credit_grade,
            'created' => $this->created,
            'updated' => $this->updated,
            'month_cancel' => $this->month_cancel,
        ]);

        $query->andFilterWhere(['like', 'mobile', $this->mobile])
        	->andFilterWhere(['=', 'user.id', $this->id])
            ->andFilterWhere(['like', 'nickname', $this->nickname])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'avatar', $this->avatar])
            ->andFilterWhere(['like', 'qq', $this->qq])
            ->andFilterWhere(['like', 'wechat', $this->wechat])
            ->andFilterWhere(['like', 'province', $this->province])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'district', $this->district])
            ->andFilterWhere(['like', 'homeland', $this->homeland])
            ->andFilterWhere(['like', 'industry', $this->industry])
            ->andFilterWhere(['like', 'relationship', $this->relationship])
            ->andFilterWhere(['like', 'starsign', $this->starsign])
            ->andFilterWhere(['like', 'optional_sex', $this->optional_sex])
            ->andFilterWhere(['like', 'optional_love', $this->optional_love])
            ->andFilterWhere(['like', 'hobby', $this->hobby])
            ->andFilterWhere(['like', 'education', $this->education])
            ->andFilterWhere(['like', 'level_name', $this->level_name])
            ->andFilterWhere(['like', 'grade_name', $this->grade_name])
            ->andFilterWhere(['like', 'signature', $this->signature])
            ->andFilterWhere(['like', 'completion_fields', $this->completion_fields])
        	->andFilterWhere(['like', 'device.udid', $this->udid]);

        return $dataProvider;
    }


    public function approve($params, $position = NULL)
    {
        $query = User::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        switch ($position) {
        	case 'avatar':
        		$query->where(['avatar_certification_stage' => 1]);
        		break;
        	case 'car':
        		$query->where(['car_certification_stage' => 1]);
        		break;
        	case 'unmakeup':
        		$query->where(['unmakeup_certification_stage' => 1]);
        		break;
        	case 'video':
        		$query->where(['video_certification_stage' => 1]);
        		break;
        	case 'id':
        		$query->where(['id_certification_stage' => 1]);
        		break;
        	case 'part':
        		$query->where(['part_certification_stage' => 1]);
        		break;
        	default:
        		$query->where(['car_certification_stage' => 1])
        		->orWhere(['avatar_certification_stage' => 1])
        		->orWhere(['id_certification_stage' => 1])
        		->orWhere(['video_certification_stage' => 1])
        		->orWhere(['unmakeup_certification_stage' => 1])
        		->orWhere(['part_certification_stage' => 1]);
        		break;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'utype' => $this->utype,
            'sex' => $this->sex,
            'height' => $this->height,
            'birthday' => $this->birthday,
            'age' => $this->age,
            'figure' => $this->figure,
            'car_certification_stage' => $this->car_certification_stage,
            'avatar_certification_stage' => $this->avatar_certification_stage,
            'id_certification_stage' => $this->id_certification_stage,
            'video_certification_stage' => $this->video_certification_stage,
            'unmakeup_certification_stage' => $this->unmakeup_certification_stage,
            'part_certification_stage' => $this->part_certification_stage,
            'completion' => $this->completion,
            'is_active' => $this->is_active,
            'blacklisted' => $this->blacklisted,
            'level' => $this->level,
            'credit_grade' => $this->credit_grade,
            'created' => $this->created,
            'updated' => $this->updated,
            'month_cancel' => $this->month_cancel,
        ]);

        $query->andFilterWhere(['like', 'mobile', $this->mobile])
            ->andFilterWhere(['like', 'nickname', $this->nickname])
            ->andFilterWhere(['like', 'avatar', $this->avatar])
            ->andFilterWhere(['like', 'qq', $this->qq])
            ->andFilterWhere(['like', 'wechat', $this->wechat])
            ->andFilterWhere(['like', 'province', $this->province])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'district', $this->district])
            ->andFilterWhere(['like', 'homeland', $this->homeland])
            ->andFilterWhere(['like', 'industry', $this->industry])
            ->andFilterWhere(['like', 'relationship', $this->relationship])
            ->andFilterWhere(['like', 'starsign', $this->starsign])
            ->andFilterWhere(['like', 'optional_sex', $this->optional_sex])
            ->andFilterWhere(['like', 'optional_love', $this->optional_love])
            ->andFilterWhere(['like', 'hobby', $this->hobby])
            ->andFilterWhere(['like', 'education', $this->education])
            ->andFilterWhere(['like', 'level_name', $this->level_name])
            ->andFilterWhere(['like', 'grade_name', $this->grade_name])
            ->andFilterWhere(['like', 'signature', $this->signature])
            ->andFilterWhere(['like', 'completion_fields', $this->completion_fields]);

        $query->orderBy('updated asc');
        return $dataProvider;
    }
    
    public function approvepass($params, $position = NULL)
    {
    	$query = User::find();
    
    	$dataProvider = new ActiveDataProvider([
    			'query' => $query,
    			]);
    
    	$this->load($params);
    
    	if (!$this->validate()) {
    		// uncomment the following line if you do not want to return any records when validation fails
    		// $query->where('0=1');
    		return $dataProvider;
    	}
    
    	switch ($position) {
    		case 'avatar':
    			$query->where(['avatar_certification_stage' => 2]);
    			break;
    		case 'car':
    			$query->where(['car_certification_stage' => 2]);
    			break;
    		case 'unmakeup':
    			$query->where(['unmakeup_certification_stage' => 2]);
    			break;
    		case 'video':
    			$query->where(['video_certification_stage' => 2]);
    			break;
    		case 'id':
    			$query->where(['id_certification_stage' => 2]);
    			break;
    		case 'part':
    			$query->where(['part_certification_stage' => 2]);
    			break;
    		default:
    			$query->where(['car_certification_stage' => 2])
    			->orWhere(['avatar_certification_stage' => 2])
    			->orWhere(['id_certification_stage' => 2])
    			->orWhere(['video_certification_stage' => 2])
    			->orWhere(['unmakeup_certification_stage' => 2])
    			->orWhere(['part_certification_stage' => 2]);
    			break;
    	}
    
    	$query->andFilterWhere([
    			'id' => $this->id,
    			'utype' => $this->utype,
    			'sex' => $this->sex,
    			'height' => $this->height,
    			'birthday' => $this->birthday,
    			'age' => $this->age,
    			'figure' => $this->figure,
    			'car_certification_stage' => $this->car_certification_stage,
    			'avatar_certification_stage' => $this->avatar_certification_stage,
    			'id_certification_stage' => $this->id_certification_stage,
    			'video_certification_stage' => $this->video_certification_stage,
    			'unmakeup_certification_stage' => $this->unmakeup_certification_stage,
    			'part_certification_stage' => $this->part_certification_stage,
    			'completion' => $this->completion,
    			'is_active' => $this->is_active,
    			'blacklisted' => $this->blacklisted,
    			'level' => $this->level,
    			'credit_grade' => $this->credit_grade,
    			'created' => $this->created,
    			'updated' => $this->updated,
    			'month_cancel' => $this->month_cancel,
    			]);
    
    	$query->andFilterWhere(['like', 'mobile', $this->mobile])
    	->andFilterWhere(['like', 'nickname', $this->nickname])
    	->andFilterWhere(['like', 'avatar', $this->avatar])
    	->andFilterWhere(['like', 'qq', $this->qq])
    	->andFilterWhere(['like', 'wechat', $this->wechat])
    	->andFilterWhere(['like', 'province', $this->province])
    	->andFilterWhere(['like', 'city', $this->city])
    	->andFilterWhere(['like', 'district', $this->district])
    	->andFilterWhere(['like', 'homeland', $this->homeland])
    	->andFilterWhere(['like', 'industry', $this->industry])
    	->andFilterWhere(['like', 'relationship', $this->relationship])
    	->andFilterWhere(['like', 'starsign', $this->starsign])
    	->andFilterWhere(['like', 'optional_sex', $this->optional_sex])
    	->andFilterWhere(['like', 'optional_love', $this->optional_love])
    	->andFilterWhere(['like', 'hobby', $this->hobby])
    	->andFilterWhere(['like', 'education', $this->education])
    	->andFilterWhere(['like', 'level_name', $this->level_name])
    	->andFilterWhere(['like', 'grade_name', $this->grade_name])
    	->andFilterWhere(['like', 'signature', $this->signature])
    	->andFilterWhere(['like', 'completion_fields', $this->completion_fields]);
    
    	$query->orderBy('updated asc');
    	return $dataProvider;
    }
    
    public function hot($params)
    {
    	$query = User::find()->joinWith('userextra');
    	
    	//$query = User::find()->joinWith('userextra')->where(['user_extra.hot_ranking > 0'])->all();
    
    	$dataProvider = new ActiveDataProvider([
    			'query' => $query,
    			]);
    
    	$this->load($params);
    
    	if (!$this->validate()) {
    		// uncomment the following line if you do not want to return any records when validation fails
    		// $query->where('0=1');
    		return $dataProvider;
    	}
    
    	$query->andFilterWhere([
    			'utype' => $this->utype,
    			'sex' => $this->sex,
    			'height' => $this->height,
    			'birthday' => $this->birthday,
    			'age' => $this->age,
    			'figure' => $this->figure,
    			'car_certification_stage' => $this->car_certification_stage,
    			'avatar_certification_stage' => $this->avatar_certification_stage,
    			'id_certification_stage' => $this->id_certification_stage,
    			'video_certification_stage' => $this->video_certification_stage,
    			'unmakeup_certification_stage' => $this->unmakeup_certification_stage,
    			'part_certification_stage' => $this->part_certification_stage,
    			'completion' => $this->completion,
    			'is_active' => $this->is_active,
    			'blacklisted' => $this->blacklisted,
    			'level' => $this->level,
    			'credit_grade' => $this->credit_grade,
    			'created' => $this->created,
    			'updated' => $this->updated,
    			'month_cancel' => $this->month_cancel,
    			]);
    
    	$query->andWhere('hot_ranking >= 0');
    	$query->andWhere('utype = 1');
    			
    	$query->andFilterWhere(['like', 'mobile', $this->mobile])
    	->andFilterWhere(['like', 'user_extra.id', $this->id])
    	->andFilterWhere(['like', 'nickname', $this->nickname])
    	->andFilterWhere(['like', 'password', $this->password])
    	->andFilterWhere(['like', 'avatar', $this->avatar])
    	->andFilterWhere(['like', 'qq', $this->qq])
    	->andFilterWhere(['like', 'wechat', $this->wechat])
    	->andFilterWhere(['like', 'province', $this->province])
    	->andFilterWhere(['like', 'city', $this->city])
    	->andFilterWhere(['like', 'district', $this->district])
    	->andFilterWhere(['like', 'homeland', $this->homeland])
    	->andFilterWhere(['like', 'industry', $this->industry])
    	->andFilterWhere(['like', 'relationship', $this->relationship])
    	->andFilterWhere(['like', 'starsign', $this->starsign])
    	->andFilterWhere(['like', 'optional_sex', $this->optional_sex])
    	->andFilterWhere(['like', 'optional_love', $this->optional_love])
    	->andFilterWhere(['like', 'hobby', $this->hobby])
    	->andFilterWhere(['like', 'education', $this->education])
    	->andFilterWhere(['like', 'level_name', $this->level_name])
    	->andFilterWhere(['like', 'grade_name', $this->grade_name])
    	->andFilterWhere(['like', 'signature', $this->signature])
    	->andFilterWhere(['like', 'completion_fields', $this->completion_fields]);
    
    	$query->orderBy('hot_ranking, id asc');
    	
    	return $dataProvider;
    }
    
    public function hotw($params)
    {
    	$query = User::find()->joinWith('userextra');
    	 
    	//$query = User::find()->joinWith('userextra')->where(['user_extra.hot_ranking > 0'])->all();
    
    	$dataProvider = new ActiveDataProvider([
    			'query' => $query,
    			]);
    
    	$this->load($params);
    
    	if (!$this->validate()) {
    		// uncomment the following line if you do not want to return any records when validation fails
    		// $query->where('0=1');
    		return $dataProvider;
    	}
    
    	$query->andFilterWhere([
    			'utype' => $this->utype,
    			'sex' => $this->sex,
    			'height' => $this->height,
    			'birthday' => $this->birthday,
    			'age' => $this->age,
    			'figure' => $this->figure,
    			'car_certification_stage' => $this->car_certification_stage,
    			'avatar_certification_stage' => $this->avatar_certification_stage,
    			'id_certification_stage' => $this->id_certification_stage,
    			'video_certification_stage' => $this->video_certification_stage,
    			'unmakeup_certification_stage' => $this->unmakeup_certification_stage,
    			'part_certification_stage' => $this->part_certification_stage,
    			'completion' => $this->completion,
    			'is_active' => $this->is_active,
    			'blacklisted' => $this->blacklisted,
    			'level' => $this->level,
    			'credit_grade' => $this->credit_grade,
    			'created' => $this->created,
    			'updated' => $this->updated,
    			'month_cancel' => $this->month_cancel,
    			]);
    
    	$query->andWhere('hot_ranking >= 0');
    	$query->andWhere('utype = 4');
    	 
    	$query->andFilterWhere(['like', 'mobile', $this->mobile])
    	->andFilterWhere(['like', 'user_extra.id', $this->id])
    	->andFilterWhere(['like', 'nickname', $this->nickname])
    	->andFilterWhere(['like', 'password', $this->password])
    	->andFilterWhere(['like', 'avatar', $this->avatar])
    	->andFilterWhere(['like', 'qq', $this->qq])
    	->andFilterWhere(['like', 'wechat', $this->wechat])
    	->andFilterWhere(['like', 'province', $this->province])
    	->andFilterWhere(['like', 'city', $this->city])
    	->andFilterWhere(['like', 'district', $this->district])
    	->andFilterWhere(['like', 'homeland', $this->homeland])
    	->andFilterWhere(['like', 'industry', $this->industry])
    	->andFilterWhere(['like', 'relationship', $this->relationship])
    	->andFilterWhere(['like', 'starsign', $this->starsign])
    	->andFilterWhere(['like', 'optional_sex', $this->optional_sex])
    	->andFilterWhere(['like', 'optional_love', $this->optional_love])
    	->andFilterWhere(['like', 'hobby', $this->hobby])
    	->andFilterWhere(['like', 'education', $this->education])
    	->andFilterWhere(['like', 'level_name', $this->level_name])
    	->andFilterWhere(['like', 'grade_name', $this->grade_name])
    	->andFilterWhere(['like', 'signature', $this->signature])
    	->andFilterWhere(['like', 'completion_fields', $this->completion_fields]);
    
    	$query->orderBy('hot_ranking, id asc');
    	 
    	return $dataProvider;
    }
    
    public function hotall($params)
    {
    	$query = User::find()->joinWith('userextra');
    
    	//$query = User::find()->joinWith('userextra')->where(['user_extra.hot_ranking > 0'])->all();
    
    	$dataProvider = new ActiveDataProvider([
    			'query' => $query,
    			]);
    
    	$this->load($params);
    
    	if (!$this->validate()) {
    		// uncomment the following line if you do not want to return any records when validation fails
    		// $query->where('0=1');
    		return $dataProvider;
    	}
    
    	$query->andFilterWhere([
    			'utype' => $this->utype,
    			'sex' => $this->sex,
    			'height' => $this->height,
    			'birthday' => $this->birthday,
    			'age' => $this->age,
    			'figure' => $this->figure,
    			'car_certification_stage' => $this->car_certification_stage,
    			'avatar_certification_stage' => $this->avatar_certification_stage,
    			'id_certification_stage' => $this->id_certification_stage,
    			'video_certification_stage' => $this->video_certification_stage,
    			'unmakeup_certification_stage' => $this->unmakeup_certification_stage,
    			'part_certification_stage' => $this->part_certification_stage,
    			'completion' => $this->completion,
    			'is_active' => $this->is_active,
    			'blacklisted' => $this->blacklisted,
    			'level' => $this->level,
    			'credit_grade' => $this->credit_grade,
    			'created' => $this->created,
    			'updated' => $this->updated,
    			'month_cancel' => $this->month_cancel,
    			]);
    
    	$query->andWhere('hot_ranking > 0');
    
    	$query->andFilterWhere(['like', 'mobile', $this->mobile])
    	->andFilterWhere(['like', 'user_extra.id', $this->id])
    	->andFilterWhere(['like', 'nickname', $this->nickname])
    	->andFilterWhere(['like', 'password', $this->password])
    	->andFilterWhere(['like', 'avatar', $this->avatar])
    	->andFilterWhere(['like', 'qq', $this->qq])
    	->andFilterWhere(['like', 'wechat', $this->wechat])
    	->andFilterWhere(['like', 'province', $this->province])
    	->andFilterWhere(['like', 'city', $this->city])
    	->andFilterWhere(['like', 'district', $this->district])
    	->andFilterWhere(['like', 'homeland', $this->homeland])
    	->andFilterWhere(['like', 'industry', $this->industry])
    	->andFilterWhere(['like', 'relationship', $this->relationship])
    	->andFilterWhere(['like', 'starsign', $this->starsign])
    	->andFilterWhere(['like', 'optional_sex', $this->optional_sex])
    	->andFilterWhere(['like', 'optional_love', $this->optional_love])
    	->andFilterWhere(['like', 'hobby', $this->hobby])
    	->andFilterWhere(['like', 'education', $this->education])
    	->andFilterWhere(['like', 'level_name', $this->level_name])
    	->andFilterWhere(['like', 'grade_name', $this->grade_name])
    	->andFilterWhere(['like', 'signature', $this->signature])
    	->andFilterWhere(['like', 'completion_fields', $this->completion_fields]);
    
    	$query->orderBy('hot_ranking, id asc');
    
    	return $dataProvider;
    }
}
