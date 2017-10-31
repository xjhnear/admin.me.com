<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\MyFriend;

/**
 * DiamondOrderSearch represents the model behind the search form about `backend\models\DiamondOrder`.
 */
class MyFriendSearch extends MyFriend
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'to_user', 'is_blocked', 'is_followee'], 'integer'],
            [['alias'], 'string'],
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

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = MyFriend::find()->with(['user']);

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
            'to_user' => $this->to_user,
            'alias' => $this->alias,
            'is_followee' => $this->is_followee,
            'is_blocked' => $this->is_blocked,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->orderBy('created desc');
        
        return $dataProvider;
    }
    
    public function usersearch($params)
    {
    	$query = MyFriend::find()->with(['user']);
    
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
	            'to_user' => $this->to_user,
	            'alias' => $this->alias,
	            'is_followee' => $this->is_followee,
	            'is_blocked' => $this->is_blocked,
	            'created' => $this->created,
	            'updated' => $this->updated,
    			]);

    	$query->orderBy('created desc');
    
    	return $dataProvider;
    }
    
    public function favoritesearch($params, $checkday)
    {
    	$query = MyFriend::find()->with(['user']);
    
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
    			'to_user' => $this->to_user,
    			'alias' => $this->alias,
    			'is_followee' => $this->is_followee,
    			'is_blocked' => $this->is_blocked,
    			'created' => $this->created,
    			'updated' => $this->updated,
    			]);

    	$query->andFilterWhere(['between', 'created', $checkday." 10:00:00", date('Y-m-d')." 9:59:59"]);
    	
    	$query->orderBy('created desc');
    
    	return $dataProvider;
    }
}
