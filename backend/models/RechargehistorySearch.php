<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Rechargehistory;

/**
 * DiamondOrderSearch represents the model behind the search form about `backend\models\DiamondOrder`.
 */
class RechargehistorySearch extends Rechargehistory
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
        	[['user_id', 'coin', 'amount', 'transaction_no'], 'integer'],
            [['payment_method', 'status'], 'string'],
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
        $query = Rechargehistory::find()->with(['user']);

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
            'coin' => $this->coin,
            'amount' => $this->amount,
            'payment_method' => $this->payment_method,
            'transaction_no' => $this->transaction_no,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'payment_method', $this->payment_method])
            ->andFilterWhere(['like', 'transaction_no', $this->transaction_no])
            ->andFilterWhere(['like', 'created', $this->created]);

        $query->orderBy('created desc');
        
        return $dataProvider;
    }
}
