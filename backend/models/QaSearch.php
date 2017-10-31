<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Qa;

/**
 * FeedbackSearch represents the model behind the search form about `backend\models\Feedback`.
 */
class QaSearch extends Qa
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['question'], 'safe'],
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
        $query = Qa::find();

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
        	'answer' => $this->answer,
        	'type' => $this->type,
        	'xu' => $this->xu,
        ]);

        $query->andFilterWhere(['like', 'question', $this->question]);
        $query->andFilterWhere(['like', 'category', $this->category]);
        
        $query->orderBy('xu asc');
        
        return $dataProvider;
    }
}
