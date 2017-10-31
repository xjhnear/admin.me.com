<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Pointhistory;

/**
 * DiamondOrderSearch represents the model behind the search form about `backend\models\DiamondOrder`.
 */
class PointhistorySearch extends Pointhistory
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
        	[['user_id', 'point'], 'integer'],
            [['type'], 'string'],
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
        $query = Pointhistory::find()->with(['user']);

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
            'girl_id' => $this->girl_id,
            'man_id' => $this->man_id,
            'point' => $this->point,
            'type' => $this->type,
            'created' => $this->created,
        ]);

        $query->andFilterWhere(['like', 'point', $this->point])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'created', $this->created]);

        $query->orderBy('created desc');
        
        return $dataProvider;
    }
}
