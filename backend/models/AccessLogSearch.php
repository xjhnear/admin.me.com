<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\AccessLog;

/**
 * DiamondOrderSearch represents the model behind the search form about `backend\models\DiamondOrder`.
 */
class AccessLogSearch extends AccessLog
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
        	[['user_id', 'object_id', 'code'], 'integer'],
            [['controller', 'action', 'ip', 'url'], 'string'],
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
        $query = AccessLog::find()->with(['user']);

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
            'controller' => $this->controller,
            'action' => $this->action,
            'ip' => $this->ip,
            'url' => $this->url,
            'created' => $this->created,
        ]);

        $query->andFilterWhere(['like', 'ip', $this->ip])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'created', $this->created]);

        $query->orderBy('created desc');
        
        return $dataProvider;
    }
}
