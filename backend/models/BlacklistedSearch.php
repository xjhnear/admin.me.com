<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Blacklisted;

/**
 * DiamondOrderSearch represents the model behind the search form about `backend\models\DiamondOrder`.
 */
class BlacklistedSearch extends Blacklisted
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
        	[['user_id', 'option'], 'integer'],
            [['reason', 'operator'], 'string'],
            [['blacktime', 'created', 'updated'], 'safe'],
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
    public function usersearch($params)
    {
        $query = Blacklisted::find()->with(['user']);

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
            'option' => $this->option,
            'blacktime' => $this->blacktime,
            'reason' => $this->reason,
        	'operator' => $this->operator,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'user_id', $this->user_id]);

        $query->orderBy('created desc');
        
        return $dataProvider;
    }
    
    public function search($params)
    {
    	$query = Blacklisted::find()->with(['user']);
    
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
    			'option' => $this->option,
    			'blacktime' => $this->blacktime,
    			'reason' => $this->reason,
    			'operator' => $this->operator,
    			'created' => $this->created,
    			'updated' => $this->updated,
    			]);
    
    	$query->andFilterWhere(['like', 'user_id', $this->user_id]);
    
    	$query->orderBy('created desc');
    
    	return $dataProvider;
    }

}
