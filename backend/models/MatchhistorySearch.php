<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Matchhistory;

/**
 * SeeSearch represents the model behind the search form about `backend\models\See`.
 */
class MatchhistorySearch extends Matchhistory
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['girl_id', 'man_id', 'man_confirm', 'girl_confirm', 'created', 'updated'], 'integer'],
            [['status'], 'string'],
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
    
    public function favoritematchsearch($params, $checkday)
    {
    	$query = Matchhistory::find();
    
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

    	$query->orFilterWhere(['girl_id' => $params]);
    	$query->orFilterWhere(['man_id' => $params]);

    	$query->andFilterWhere([
    			'id' => $this->id,
    			'status' => $this->status,
    			'man_confirm' => "1",
    			'girl_confirm' => "1",
    			'updated' => $this->updated,
    			'girl_id' => $this->girl_id,
    			'man_id' => $this->man_id,
    			]);

    	$query->andFilterWhere(['between', 'created', $checkday." 10:00:00", date('Y-m-d')." 9:59:59"]);
    	 
    	$query->orderBy('created desc');
    
    	return $dataProvider;
    }
}
