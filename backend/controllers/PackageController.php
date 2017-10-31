<?php

namespace backend\controllers;

use Yii;
use backend\models\Package;
use backend\models\PackageSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use backend\models\Utils;

/**
 * ConfigController implements the CRUD actions for Config model.
 */
class PackageController extends Controller
{
	public $enableCsrfValidation = false;
	
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
    
    public function actions()
    {
    	return [
	    	'Kupload' => [
		    	'class' => 'pjkui\kindeditor\KindEditorAction',
	    	]
    	];
    }
    
    /**
     * Lists all Config models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PackageSearch();
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
        $model = new Package();

        if ($model->load(Yii::$app->request->post())) {
        	$rootPath = "../uploads/package/";
        	$package = UploadedFile::getInstance($model, 'package');
        	if ($package && $model->validate()) {
        		$Name = $package->baseName . time(). "." . $package->extension;
        		if (!file_exists($rootPath)) {
        			mkdir($rootPath);
        		}
        		$package->saveAs($rootPath . $Name);
        		$model->package = $Name;

        		// 阿里云存储
        		$file = $rootPath . $Name;
        		$type = $package->type;
        		$cmd="python /usr/local/bin/osscmd put $file oss://msn/".$Name.' --content_type='.$type;
        		$re=exec($cmd, $out);
        	}
        	$model->created=date('Y-m-d H:i:s');
        	$model->save();
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
        $Utils = new Utils();
        
        if ($model->load(Yii::$app->request->post())) {
        	$rootPath = "../uploads/package/";
        	$package = UploadedFile::getInstance($model, 'package');
        	if ($package && $model->validate()) {
        		$Name = $package->baseName . time(). "." . $package->extension;
        		if (!file_exists($rootPath)) {
        			mkdir($rootPath);
        		}
        		$package->saveAs($rootPath . $Name);
        		$model->package = $Name;
				
        		// 阿里云存储
        		$file = $rootPath . $Name;
        		$type = $package->type;
        		$cmd="python /usr/local/bin/osscmd put $file oss://msn/".$Name.' --content_type='.$type;
        		$re=exec($cmd, $out);
        	}
        	$model->save();
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
        if (($model = Package::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
       
}
