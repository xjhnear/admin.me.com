<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\PhotoComment;

/**
 * DiamondOrderSearch represents the model behind the search form about `backend\models\DiamondOrder`.
 */
class PhotoCommentSearch extends PhotoComment
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
        	[['photo_id', 'user_id'], 'integer'],
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
        $query = PhotoComment::find()->with(['user']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
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
            'photo_id' => $this->photo_id,
            'text' => $this->text,
            'parent_id' => $this->parent_id,
            'reward' => $this->reward,
        	'is_deleted' => $this->is_deleted,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'user_id', $this->user_id])
            ->andFilterWhere(['photo_id', 'photo_id', $this->text]);

        $query->orderBy('created desc');
        
        return $dataProvider;
    }
    
    public function usersearch($params)
    {
    	$query = PhotoComment::find();
    	$query->joinWith(['photo']);
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
	            'user_id' => $this->user_id,
	            'photo_id' => $this->photo_id,
	            'text' => $this->text,
	            'parent_id' => $this->parent_id,
	            'reward' => $this->reward,
	        	'is_deleted' => $this->is_deleted,
	            'created' => $this->created,
	            'updated' => $this->updated,
    			]);
    
        $query->andFilterWhere(['like', 'user_id', $this->user_id])
            ->andFilterWhere(['photo_id', 'photo_id', $this->photo_id]);
        
        $query->andFilterWhere(['=', 'photo.user_id', $params]);
    
    	$query->orderBy('created desc');
    
    	return $dataProvider;
    }
    
    public function userphotosearch($params)
    {
    	$query = PhotoComment::find();
    	$query->joinWith(['photo']);
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
    			'user_id' => $this->user_id,
    			'photo_id' => $params,
    			'text' => $this->text,
    			'parent_id' => $this->parent_id,
    			'reward' => $this->reward,
    			'is_deleted' => $this->is_deleted,
    			'created' => $this->created,
    			'updated' => $this->updated,
    			]);
    
    	$query->andFilterWhere(['like', 'user_id', $this->user_id])
    	->andFilterWhere(['photo_id', 'photo_id', $this->photo_id]);
 
    	$query->orderBy('created desc');
    
    	return $dataProvider;
    }
    
    public function favoritesearch($params, $checkday)
    {
    	$query = PhotoComment::find();
    	$query->joinWith(['photo']);
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
	            'user_id' => $this->user_id,
	            'photo_id' => $this->photo_id,
	            'text' => $this->text,
	            'parent_id' => $this->parent_id,
	            'reward' => $this->reward,
	        	'is_deleted' => $this->is_deleted,
	            'created' => $this->created,
	            'updated' => $this->updated,
    			]);
    	
        $query->andFilterWhere(['like', 'user_id', $this->user_id])
            ->andFilterWhere(['photo_id', 'photo_id', $this->photo_id]);
    
    	$query->andFilterWhere(['between', 'photo_comment.created', $checkday." 10:00:00", date('Y-m-d')." 9:59:59"]);
    	$query->andFilterWhere(['>', 'photo_comment.reward', 0]);
    	$query->andFilterWhere(['=', 'photo.user_id', $params]);
    	
    	$query->orderBy('created desc');
    
    	return $dataProvider;
    }
    
}
