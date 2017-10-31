<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Photo;

/**
 * DiamondOrderSearch represents the model behind the search form about `backend\models\DiamondOrder`.
 */
class PhotoSearch extends Photo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
        	[['user_id', 'latitude', 'longitude', 'voteup'], 'integer'],
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
        $query = Photo::find()->with(['user']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
		    'pagination'=>[
		        'pageSize'=>30,
		    ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        
//         $query->joinWith('report',true,'LEFT JOIN');
        
        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'photo' => $this->photo,
            'text' => $this->text,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
        	'voteup' => $this->voteup,
        	'is_approve' => '0',
        	//'is_approve' => $this->is_approve, //显示审核已通过内容
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'user_id', $this->user_id])
            ->andFilterWhere(['like', 'text', $this->text])
            ->andFilterWhere(['like', 'voteup', $this->voteup]);

        $query->orderBy('is_approve asc, created desc');
        
        return $dataProvider;
    }
    
    public function searchpass($params)
    {
    	$query = Photo::find()->with(['user']);
    
    	$dataProvider = new ActiveDataProvider([
    			'query' => $query,
    			'pagination'=>[
    			'pageSize'=>30,
    			],
    			]);
    
    	$this->load($params);
    
    	if (!$this->validate()) {
    	// uncomment the following line if you do not want to return any records when validation fails
    		// $query->where('0=1');
    		return $dataProvider;
    	}
    
    	//         $query->joinWith('report',true,'LEFT JOIN');
    
    	$query->andFilterWhere([
    	'id' => $this->id,
    	'user_id' => $this->user_id,
    	'photo' => $this->photo,
    	'text' => $this->text,
    	'latitude' => $this->latitude,
    	'longitude' => $this->longitude,
    	'voteup' => $this->voteup,
    	'is_approve' => '1',
    	//'is_approve' => $this->is_approve, //显示审核已通过内容
    	'created' => $this->created,
    	'updated' => $this->updated,
    	]);
    
    	$query->andFilterWhere(['like', 'user_id', $this->user_id])
    	->andFilterWhere(['like', 'text', $this->text])
    	->andFilterWhere(['like', 'voteup', $this->voteup]);
    
    	$query->orderBy('is_approve asc, created desc');
    
    	return $dataProvider;
    }

    
    public function userphotosearch($params)
    {
    	$query = Photo::find()->with(['user']);
    
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
	            'id' => $this->id,
	            'user_id' => $params,
	            'photo' => $this->photo,
	            'text' => $this->text,
	            'latitude' => $this->latitude,
	            'longitude' => $this->longitude,
	        	'voteup' => $this->voteup,
	        	'is_approve' => $this->is_approve,
	            'created' => $this->created,
	            'updated' => $this->updated,
    			]);
    
        $query->andFilterWhere(['like', 'user_id', $this->user_id])
            ->andFilterWhere(['like', 'text', $this->text])
            ->andFilterWhere(['like', 'voteup', $this->voteup]);
    
    	$query->orderBy('created desc');
    
    	return $dataProvider;
    }
    
    public function userphotopasssearch($params)
    {
    	$query = Photo::find()->with(['user']);
    
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
    			'id' => $this->id,
    			'user_id' => $params,
    			'photo' => $this->photo,
    			'text' => $this->text,
    			'latitude' => $this->latitude,
    			'longitude' => $this->longitude,
    			'voteup' => $this->voteup,
    			'is_approve' => '1',
    			'created' => $this->created,
    			'updated' => $this->updated,
    			]);
    
    	$query->andFilterWhere(['like', 'user_id', $this->user_id])
    	->andFilterWhere(['like', 'text', $this->text])
    	->andFilterWhere(['like', 'voteup', $this->voteup]);
    
    	$query->orderBy('created desc');
    
    	return $dataProvider;
    }
    
    
    public function favoritephotosearch($params, $checkday)
    {
    	$query = Photo::find()->with(['user']);
    
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
		    'pagination'=>[
		        'pageSize'=>9999,
		    ],
        ]);
    
    	$this->load($params);
    
    	if (!$this->validate()) {
    		// uncomment the following line if you do not want to return any records when validation fails
    		// $query->where('0=1');
    		return $dataProvider;
    	}
    
    	$query->andFilterWhere([
    			'id' => $this->id,
    			'user_id' => $params,
    			'photo' => $this->photo,
    			'text' => $this->text,
    			'latitude' => $this->latitude,
    			'longitude' => $this->longitude,
    			'voteup' => $this->voteup,
    			'is_approve' => $this->is_approve,
    			'created' => $this->created,
    			'updated' => $this->updated,
    			]);
    
    	$query->andFilterWhere(['like', 'user_id', $this->user_id])
    	->andFilterWhere(['like', 'text', $this->text])
    	->andFilterWhere(['like', 'voteup', $this->voteup]);
    
    	$query->andFilterWhere(['between', 'created', $checkday." 10:00:00", date('Y-m-d')." 9:59:59"]);
    	
    	$query->orderBy('created desc');
    
    	return $dataProvider;
    }
    
}
