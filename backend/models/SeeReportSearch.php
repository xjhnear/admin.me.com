<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\SeeReport;

/**
 * SeeReportSearch represents the model behind the search form about `backend\models\SeeReport`.
 */
class SeeReportSearch extends SeeReport
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'from_user', 'to_user', 'module_id', 'created', 'updated'], 'integer'],
            [['category', 'message', 'status'], 'safe'],
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
        $query = SeeReport::find()->with(['informer','beInformer']);

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
            'from_user' => $this->from_user,
            'to_user' => $this->to_user,
            'module_id' => $this->module_id,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'category', $this->category])
            ->andFilterWhere(['like', 'message', $this->message])
            ->andFilterWhere(['like', 'status', $this->status]);

        $query->orderBy('created desc');
        
        return $dataProvider;
    }
}
