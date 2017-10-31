<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\See;

/**
 * SeeSearch represents the model behind the search form about `backend\models\See`.
 */
class SeeSearch extends See
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'business_id', 'see_time', 'release_long', 'created', 'updated'], 'integer'],
            [['message'], 'safe'],
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
        $query = See::find()->with(['dianping']);
        
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
            'business_id' => $this->business_id,
//             'obj_sex' => $this->obj_sex,
            'release_long' => $this->release_long,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'see_time', $this->see_time]);

        $query->orderBy('created desc');
        
        return $dataProvider;
    }
    
    public function favoriteseesearch($params, $checkday)
    {
    	$query = See::find()->with(['dianping']);
    
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
    
    	$query->orFilterWhere(['status' => 4]);
    	$query->orFilterWhere(['status' => 5]);
    	$query->orFilterWhere(['status' => 7]);
    	
    	$query->andFilterWhere([
    			'id' => $this->id,
    			'to_user' => $params,
    			'business_id' => $this->business_id,
    			'release_long' => $this->release_long,
    			'created' => $this->created,
    			'updated' => $this->updated,
    			]);
    
    	$query->andFilterWhere(['like', 'see_time', $this->see_time]);

    	$query->andFilterWhere(['between', 'created', $checkday." 10:00:00", date('Y-m-d')." 9:59:59"]);
    	 
    	$query->orderBy('created desc');
    
    	return $dataProvider;
    }
    
    public function botseesearch($params, $utype)
    {
    	$query = See::find()->with(['dianping']);
    
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

    	if ($utype == 1) {
    		$query->andFilterWhere(['is_boss' => 0,]);
    	} else {
    		$query->andFilterWhere(['is_boss' => 1,]);
    	}
    	$query->andFilterWhere([
    			'id' => $this->id,
    			'user_id' => $this->user_id,
    			'to_user' => $this->to_user,
    			'business_id' => $this->business_id,
    			'release_long' => $this->release_long,
    			'status' => 1,
    			'created' => $this->created,
    			'updated' => $this->updated,
    			]);
    	
    	$query->andFilterWhere(['like', 'see_time', $this->see_time]);

    	$query->orderBy('created desc');
    	
    	return $dataProvider;

    }
    
    public function favoriteseepubsearch($params, $checkday)
    {
    	$query = See::find()->with(['dianping']);
    
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
    					'to_user' => $params,
    					'business_id' => $this->business_id,
    					'release_long' => $this->release_long,
    					'created' => $this->created,
    					'updated' => $this->updated,
    					]);
    
    					$query->andFilterWhere(['like', 'see_time', $this->see_time]);
    
    					$query->andFilterWhere(['between', 'created', $checkday." 10:00:00", date('Y-m-d')." 9:59:59"]);
    
    					$query->orderBy('created desc');
    
    					return $dataProvider;
    }
}
