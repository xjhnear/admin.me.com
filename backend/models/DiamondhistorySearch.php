<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Diamondhistory;

/**
 * DiamondOrderSearch represents the model behind the search form about `backend\models\DiamondOrder`.
 */
class DiamondhistorySearch extends Diamondhistory
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
        	[['user_id'], 'integer'],
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
        $query = Diamondhistory::find()->with(['user']);

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
            'from_user' => $this->from_user,
            'diamond' => $this->diamond,
            'type' => $this->type,
            'created' => $this->created,
        	'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'diamond', $this->diamond])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'created', $this->created]);

        $query->orderBy('created desc');
        
        return $dataProvider;
    }
    
    public function usersearch($params, $t = NULL)
    {
    	$query = Diamondhistory::find()->with(['user']);
    
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
    			'from_user' => $this->from_user,
    			'diamond' => $this->diamond,
    			'type' => $this->type,
    			'created' => $this->created,
    			'status' => $this->status,
    			]);
    
    	$query->andFilterWhere(['like', 'diamond', $this->diamond])
    	->andFilterWhere(['like', 'type', $this->type])
    	->andFilterWhere(['like', 'created', $this->created]);
    
    	if (isset($t)) {
    		$query->andFilterWhere(['between', 'created', $t[0]." 00:00:00", $t[1]." 23:59:59"]);
    	}

    	$query->orderBy('created desc');
    
    	return $dataProvider;
    }
    
}
