<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Photo;

/**
 * DiamondOrderSearch represents the model behind the search form about `backend\models\DiamondOrder`.
 */
class ReportSearch extends Report
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
        	[['from_user', 'to_user'], 'integer'],
            [['cat','module'], 'string'],
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
        $query = Report::find()->with(['photo']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
		    'pagination'=>[
		        'pageSize'=>30,
		    ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        
        $query->joinWith('photo');
        
        $query->andFilterWhere([
            'id' => $this->id,
            'from_user' => $this->from_user,
            'to_user' => $this->to_user,
            'cat' => $this->cat,
            'module' => 'photo',
            'objectId' => $this->objectId,
        	'url' => $this->url,
            'created' => $this->created,
            'updated' => $this->updated,
        	'status' => 'waiting',
        ]);
        
        $query->andFilterWhere(['<>', 'photo.id', "null"]);

//         $query->andFilterWhere(['like', 'user_id', $this->user_id])
//             ->andFilterWhere(['like', 'text', $this->text])
//             ->andFilterWhere(['like', 'voteup', $this->voteup]);

        $query->GroupBy('objectId');
        
        $query->orderBy('id asc, created desc');
        
        return $dataProvider;
    }

    public function photocommentsearch($params)
    {
    	$query = Report::find()->with(['photocomment']);
    
    	$dataProvider = new ActiveDataProvider([
    			'query' => $query,
    			'pagination'=>[
    			'pageSize'=>30,
    			],
    			]);
    
    	$this->load($params);
    
    	if (!$this->validate()) {
    	// uncomment the following line if you do not want to return any records when validation fails
    		// $query->where('0=1');
    		return $dataProvider;
    	}
    
    	$query->joinWith('photocomment');
    
    	$query->andFilterWhere([
    	'id' => $this->id,
    	'from_user' => $this->from_user,
    	'to_user' => $this->to_user,
    	'cat' => $this->cat,
    	'module' => 'comment',
    	'objectId' => $this->objectId,
    	'url' => $this->url,
    	'created' => $this->created,
    	'updated' => $this->updated,
    	'status' => 'waiting',
    	]);
    
    	$query->andFilterWhere(['<>', 'photo_comment.id', "null"]);
    
    	//         $query->andFilterWhere(['like', 'user_id', $this->user_id])
    	//             ->andFilterWhere(['like', 'text', $this->text])
    	//             ->andFilterWhere(['like', 'voteup', $this->voteup]);
    
    	$query->GroupBy('objectId');
    
    	$query->orderBy('id asc, created desc');
    
    	return $dataProvider;
    }
}
