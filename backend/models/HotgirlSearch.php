<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Hotgirl;

/**
 * FeedbackSearch represents the model behind the search form about `backend\models\Feedback`.
 */
class HotgirlSearch extends Hotgirl
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id','ranking','popularity','applier','followee'], 'integer'],
            [['nickname','photo'], 'string'],
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
        $query = HotgirlSearch::find();

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
    			'nickname' => $this->nickname,
    			'photo' => $this->photo,
    			'ranking' => $this->ranking,
    			'popularity' => $this->popularity,
    			'applier' => $this->applier,
    			'followee' => $this->followee,
        ]);

        $query->andFilterWhere(['like', 'nickname', $this->nickname]);
        
        return $dataProvider;
    }
}
