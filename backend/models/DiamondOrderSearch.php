<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\DiamondOrder;

/**
 * DiamondOrderSearch represents the model behind the search form about `backend\models\DiamondOrder`.
 */
class DiamondOrderSearch extends DiamondOrder
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id'], 'integer'],
            [['order_no', 'trade_no', 'paid_time'], 'safe'],
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
        $query = DiamondOrder::find()->with(['user']);

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
            'diamond' => $this->diamond,
            'experience' => $this->experience,
            'rmb' => $this->rmb,
            'paid_time' => $this->paid_time,
            'created' => $this->created,
            'updated' => $this->updated,
        	'status' => "success",
        ]);

        $query->andFilterWhere(['like', 'order_no', $this->order_no])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'trade_no', $this->trade_no])
            ->andFilterWhere(['like', 'payment_method', $this->payment_method]);

        $query->orderBy('created desc');
        
        return $dataProvider;
    }
    
    public function usersearch($params)
    {
    	$query = DiamondOrder::find()->with(['user']);
    
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
    			'diamond' => $this->diamond,
    			'experience' => $this->experience,
    			'rmb' => $this->rmb,
    			'paid_time' => $this->paid_time,
    			'created' => $this->created,
    			'updated' => $this->updated,
    			'status' => "success",
    			]);
    
    	$query->andFilterWhere(['like', 'order_no', $this->order_no])
    	->andFilterWhere(['like', 'status', $this->status])
    	->andFilterWhere(['like', 'trade_no', $this->trade_no])
    	->andFilterWhere(['like', 'payment_method', $this->payment_method]);
    
    	$query->orderBy('created desc');
    
    	return $dataProvider;
    }
}
