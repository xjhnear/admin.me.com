<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\UserUpload;

/**
 * DiamondOrderSearch represents the model behind the search form about `backend\models\DiamondOrder`.
 */
class UserUploadSearch extends UserUpload
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['path', 'module'], 'string'],
            [['user_id', 'position', 'is_approve'], 'integer'],
            [['created', 'updated'], 'safe'],
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

    public function useropensearch($params)
    {
    	$query = UserUpload::find()->with(['user']);
    
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
	            'module' => 'open',
	            'position' => $this->position,
	            'path' => $this->path,
	        	'is_approve' => $this->is_approve,
	            'created' => $this->created,
	            'updated' => $this->updated,
    			]);

    	$query->andFilterWhere(['like', 'user_id', $this->user_id]);
    	
    	$query->orderBy('created desc');
    
    	return $dataProvider;
    }
    
    public function useropenpasssearch($params)
    {
    	$query = UserUpload::find()->with(['user']);
    
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
    			'module' => 'open',
    			'position' => $this->position,
    			'path' => $this->path,
    			'is_approve' => 1,
    			'created' => $this->created,
    			'updated' => $this->updated,
    			]);
    
    	$query->andFilterWhere(['like', 'user_id', $this->user_id]);
    	 
    	$query->orderBy('created desc');
    
    	return $dataProvider;
    }
    
    public function userprivatesearch($params)
    {
    	$query = UserUpload::find()->with(['user']);
    
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
    			'module' => 'private',
    			'position' => $this->position,
    			'path' => $this->path,
    			'is_approve' => $this->is_approve,
    			'created' => $this->created,
    			'updated' => $this->updated,
    			]);
    
    	$query->andFilterWhere(['like', 'user_id', $this->user_id]);
    	
    	$query->orderBy('created desc');
    
    	return $dataProvider;
    }

    public function userprivatepasssearch($params)
    {
    	$query = UserUpload::find()->with(['user']);
    
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
    			'module' => 'private',
    			'position' => $this->position,
    			'path' => $this->path,
    			'is_approve' => 1,
    			'created' => $this->created,
    			'updated' => $this->updated,
    			]);
    
    	$query->andFilterWhere(['like', 'user_id', $this->user_id]);
    	 
    	$query->orderBy('created desc');
    
    	return $dataProvider;
    }
    
    public function opensearch($params)
    {
    	$query = UserUpload::find()->with(['user']);
    
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
    
    	$query->andFilterWhere([
    			'id' => $this->id,
    			'user_id' => $this->user_id,
    			'module' => 'open',
    			'position' => $this->position,
    			'path' => $this->path,
    			'is_approve' => 0,
    			'created' => $this->created,
    			'updated' => $this->updated,
    			]);
    
    	$query->andFilterWhere(['like', 'user_id', $this->user_id]);
    	
    	$query->orderBy('is_approve asc, created desc');
    
    	return $dataProvider;
    }
    
    public function openpasssearch($params)
    {
    	$query = UserUpload::find()->with(['user']);
    
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
    
    	$query->andFilterWhere([
    			'id' => $this->id,
    			'user_id' => $this->user_id,
    			'module' => 'open',
    			'position' => $this->position,
    			'path' => $this->path,
    			'is_approve' => 1,
    			'created' => $this->created,
    			'updated' => $this->updated,
    			]);
    
    	$query->andFilterWhere(['like', 'user_id', $this->user_id]);
    	 
    	$query->orderBy('is_approve asc, created desc');
    
    	return $dataProvider;
    }
    
    public function privatesearch($params)
    {
    	$query = UserUpload::find()->with(['user']);
    
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
    
    	$query->andFilterWhere([
    			'id' => $this->id,
    			'user_id' => $this->user_id,
    			'module' => 'private',
    			'position' => $this->position,
    			'path' => $this->path,
    			'is_approve' => 0,
    			'created' => $this->created,
    			'updated' => $this->updated,
    			]);
    
    	$query->andFilterWhere(['like', 'user_id', $this->user_id]);
    	
    	$query->orderBy('is_approve asc, created desc');
    
    	return $dataProvider;
    }
    
    public function privatepasssearch($params)
    {
    	$query = UserUpload::find()->with(['user']);
    
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
    
    	$query->andFilterWhere([
    			'id' => $this->id,
    			'user_id' => $this->user_id,
    			'module' => 'private',
    			'position' => $this->position,
    			'path' => $this->path,
    			'is_approve' => 1,
    			'created' => $this->created,
    			'updated' => $this->updated,
    			]);
    
    	$query->andFilterWhere(['like', 'user_id', $this->user_id]);
    	 
    	$query->orderBy('is_approve asc, created desc');
    
    	return $dataProvider;
    }
    
    public function approve($params, $position = NULL)
    {
    	$query = UserUpload::find()->with(['user']);
    
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
    
    	$this->load($params);
    
    	if (!$this->validate()) {
    	// uncomment the following line if you do not want to return any records when validation fails
    		// $query->where('0=1');
    		return $dataProvider;
    	}
    
    	$query->joinWith('user',true,'INNER JOIN');
    	
    	$query->andFilterWhere([
    	'id' => $this->id,
    	'user_id' => $this->user_id,
    	'module' => $position,
    	'position' => $this->position,
    	'path' => $this->path,
    	'is_approve' => 0,
    	'created' => $this->created,
    	'updated' => $this->updated,
    	]);
    
    	$query->andFilterWhere(['like', 'user_id', $this->user_id]);
    	 
    	$query->groupBy('user_id');
    	
    	$query->orderBy('is_approve asc, created desc');
    
    	return $dataProvider;
    }
    
    public function approvepass($params, $position = NULL)
    {
    	$query = UserUpload::find()->with(['user']);
    
    	$dataProvider = new ActiveDataProvider([
    			'query' => $query,
    			]);
    
    	$this->load($params);
    
    	if (!$this->validate()) {
    		// uncomment the following line if you do not want to return any records when validation fails
    		// $query->where('0=1');
    		return $dataProvider;
    	}
    
    	$query->joinWith('user',true,'INNER JOIN');
    	
    	$query->andFilterWhere([
    			'id' => $this->id,
    			'user_id' => $this->user_id,
    			'module' => $position,
    			'position' => $this->position,
    			'path' => $this->path,
    			'is_approve' => 1,
    			'created' => $this->created,
    			'updated' => $this->updated,
    			]);
    
    	$query->andFilterWhere(['like', 'user_id', $this->user_id]);
    
    	$query->groupBy('user_id');
    	 
    	$query->orderBy('is_approve asc, created desc');
    
    	return $dataProvider;
    }
    
}
