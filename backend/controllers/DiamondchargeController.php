<?php

namespace backend\controllers;

use yii\web\Cookie;

use Yii;
use backend\models\DiamondCharge;
use backend\models\DiamondChargeSearch;
use backend\models\Csv;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ConfigController implements the CRUD actions for Config model.
 */
class DiamondchargeController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Config models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DiamondChargeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Config model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Config model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new DiamondCharge();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Config model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Config model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Config model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Config the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DiamondCharge::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionExport()
    {
    	
    	$model = new DiamondCharge();
    	$column = count($model->attributeLabels());
    	
    	$config = DiamondCharge::find()->all();
    	$config_arr=array();
    	foreach ($model->attributeLabels() as $k=>$v) {
    		$param_arr['nav'][] = $v;
    	}
    	foreach($config as $model){
    		$config_arr[]=$model->attributes;
    	}
    	$param_arr[] = $config_arr;
    	$path = 'DiamondCharge_'.date('Ymd').'.csv';
    	$csv = new Csv($param_arr, $column, $path);
    	$csv->export();
    }
    
    public function actionImport()
    {

    	$post_arr = @Yii::$app->request->post();

    	if ($post_arr) {
    		if (isset($post_arr['importok']) && $post_arr['importok'] == 1) {
    			
    			$path = dirname(__FILE__);
    			$path .= '\..\uploads\diamondcharge\DiamondCharge_'.date('Ymd').'.csv';
    			$model = new DiamondCharge();
    			$column = count($model->attributeLabels());
    			$csv = new Csv();
    			$import_ok_arr = $csv->import($path,$column);
    			
    			$i = 0;
    			foreach ($import_ok_arr as $item) {
    				if($i == 0){
    					$i++;
    					continue;
    				}
    				$config_model = DiamondCharge::find()->where('id='.$item[0])->one();
    				if ($config_model) {
    					$j = 0;
    					foreach ($config_model->attributes as $field => $v) {
    						if($j == 0){
    							$j++;
    							continue;
    						}
    						if ($item[$j]) {
    							if (preg_match("/^[0-9]+月[0-9]+日?$/i",$item[$j])) {
    								$item[$j] = str_replace("月", "-", $item[$j]);
    								$item[$j] = str_replace("日", "", $item[$j]);
    							}
    							$config_model->$field = $item[$j];
    						}
    						$j++;
    					}
    					$config_model->save();
    				} else {
    					$config_model = new DiamondCharge();
    					$j = 0;
    					foreach ($config_model->attributes as $field => $v) {
//     						if($j == 0){
//     							$j++;
//     							continue;
//     						}
    						if ($item[$j]) {
    						    if (preg_match("/^[0-9]+月[0-9]+日?$/i",$item[$j])) {
    								$item[$j] = str_replace("月", "-", $item[$j]);
    								$item[$j] = str_replace("日", "", $item[$j]);
    							}
    							$config_model->$field = $item[$j];
    						}
    						$j++;
    					}
    					$config_model->save();
    				}
    				$i++;
    			}

    			return $this->render('import');
    		}
    		
    		$path = dirname(__FILE__);
    		$path .= '\..\uploads\diamondcharge\DiamondCharge_'.date('Ymd').'.csv';
    		copy($_FILES['csv']['tmp_name'],$path);

    		$model = new DiamondCharge();
    		$column = count($model->attributeLabels());
    		
    		$csv = new Csv();
    		$import_arr = $csv->import($path,$column);

//     		print_r(json_encode($import_arr));exit;
    		return $this->render('import', [
    				'import_arr' => $import_arr,
    				]);
    	}
    	
    	return $this->render('import');
    }
    
}
