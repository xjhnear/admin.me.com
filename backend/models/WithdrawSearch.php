<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Withdraw;

/**
 * DiamondOrderSearch represents the model behind the search form about `backend\models\DiamondOrder`.
 */
class WithdrawSearch extends Withdraw
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
        	[['user_id', 'diamond', 'rmb', 'is_deleted'], 'integer'],
            [['account_no', 'account_name', 'operator', 'title', 'status'], 'string'],
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
        $query = Withdraw::find()->with(['user']);

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
            'rmb' => $this->rmb,
            'account_no' => $this->account_no,
            'account_name' => $this->account_name,
        	'operator' => $this->operator,
        	'title' => $this->title,
        	'status' => $this->status,
        	'remark' => $this->remark,
        	'paid_time' => $this->paid_time,
        	'is_deleted' => 0,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'user_id', $this->user_id])
            ->andFilterWhere(['like', 'account_name', $this->account_name])
            ->andFilterWhere(['like', 'created', $this->created]);

        $query->orderBy('created desc');
        
        return $dataProvider;
    }
    
    public function search($params)
    {
    	$query = Withdraw::find()->with(['user']);
    
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
    			'rmb' => $this->rmb,
    			'account_no' => $this->account_no,
    			'account_name' => $this->account_name,
    			'operator' => $this->operator,
    			'title' => $this->title,
    			'status' => $this->status,
    			'remark' => $this->remark,
    			'paid_time' => $this->paid_time,
    			'is_deleted' => 0,
    			'created' => $this->created,
    			'updated' => $this->updated,
    			]);
    
    	$query->andFilterWhere(['like', 'user_id', $this->user_id])
    	->andFilterWhere(['like', 'account_name', $this->account_name])
    	->andFilterWhere(['like', 'created', $this->created]);
    
    	$query->orderBy('status, created desc');
    
    	return $dataProvider;
    }
}
