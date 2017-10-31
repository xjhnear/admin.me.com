<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Bot;

/**
 * BotSearch represents the model behind the search form about `backend\models\Bot`.
 */
class BotSearch extends Bot
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'utype'], 'integer'],
            [['province'], 'string'],
            [['created'], 'safe'],
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
        $query = Bot::find()->with(['user']);

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
            'utype' => $this->utype,
            'province' => $this->province,
            'created' => $this->created,
        ]);

        $query->andFilterWhere(['like', 'user_id', $this->user_id])
            ->andFilterWhere(['like', 'utype', $this->utype])
            ->andFilterWhere(['like', 'province', $this->province]);

        $query->orderBy('id desc');
        
        return $dataProvider;
    }

}
