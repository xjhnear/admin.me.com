<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\HotgirlApply;

/**
 * FeedbackSearch represents the model behind the search form about `backend\models\Feedback`.
 */
class HotgirlApplySearch extends HotgirlApply
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id','baby_id'], 'integer'],
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
        $query = HotgirlApply::find()->with(['user']);

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
    			'baby_id' => $params,
    			'created' => $this->created,
    			'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'user_id', $this->user_id]);
        
        $query->orderBy('created desc');
        
        return $dataProvider;
    }
}
