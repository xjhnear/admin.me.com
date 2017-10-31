<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Daddy;

/**
 * DiamondOrderSearch represents the model behind the search form about `backend\models\DiamondOrder`.
 */
class DaddySearch extends Daddy
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
        	[['id', 'nickname', 'photo', 'ranking'], 'integer'],
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
        $query = Daddy::find()->with(['user']);

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
            'nickname' => $this->nickname,
            'photo' => $this->photo,
            'ranking' => $this->ranking,
            'popularity' => $this->popularity,
            'applier' => $this->applier,
        	'followee' => $this->followee,
        	'is_approve' => '0',
        ]);

        $query->andFilterWhere(['like', 'nickname', $this->nickname]);

        $query->orderBy('is_approve asc, id asc');
        
        return $dataProvider;
    }
    
    public function searchpass($params)
    {
    	$query = Daddy::find()->with(['user']);
    
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
            'nickname' => $this->nickname,
            'photo' => $this->photo,
            'ranking' => $this->ranking,
            'popularity' => $this->popularity,
            'applier' => $this->applier,
        	'followee' => $this->followee,
        	'is_approve' => '1',
    	]);
    
        $query->andFilterWhere(['like', 'nickname', $this->nickname]);

        $query->orderBy('is_approve asc, id asc');
    
    	return $dataProvider;
    }

    
    public function userphotosearch($params)
    {
    	$query = Daddy::find()->with(['user']);
    
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
            'id' => $params,
            'nickname' => $this->nickname,
            'photo' => $this->photo,
            'ranking' => $this->ranking,
            'popularity' => $this->popularity,
            'applier' => $this->applier,
        	'followee' => $this->followee,
        	'is_approve' => $this->is_approve,
    			]);
    
        $query->andFilterWhere(['like', 'nickname', $this->nickname]);

        $query->orderBy('is_approve asc, id asc');
    
    	return $dataProvider;
    }
    
    public function userphotopasssearch($params)
    {
    	$query = Daddy::find()->with(['user']);
    
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
            'nickname' => $this->nickname,
            'photo' => $this->photo,
            'ranking' => $this->ranking,
            'popularity' => $this->popularity,
            'applier' => $this->applier,
        	'followee' => $this->followee,
        	'is_approve' => '1',
    			]);
    
        $query->andFilterWhere(['like', 'nickname', $this->nickname]);

        $query->orderBy('is_approve asc, id asc');
    
    	return $dataProvider;
    }

}
