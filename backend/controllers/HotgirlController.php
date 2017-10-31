<?php

namespace backend\controllers;

use Yii;
use backend\models\Hotgirl;
use backend\models\HotgirlSearch;
use backend\models\HotgirlApply;
use backend\models\HotgirlApplySearch;
use backend\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use backend\models\Utils;

/**
 * FeedbackController implements the CRUD actions for Feedback model.
 */
class HotgirlController extends Controller
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
     * Lists all Feedback models.
     * @return mixed
     */
    public function actionIndex()
    {
    	$user_all = HotgirlApply::find()->groupby('user_id')->count();
    	$count_all = HotgirlApply::find()->count();
    	
        $searchModel = new HotgirlSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        	'user_all' => $user_all,
        	'count_all' => $count_all,
        ]);
    }

    /**
     * Displays a single Feedback model.
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
     * Creates a new Feedback model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Hotgirl();

        if ($model->load(Yii::$app->request->post())) {
        	$rootPath = "../uploads/photo/";
        	$photo = UploadedFile::getInstance($model, 'photo');
        	if ($photo && $model->validate()) {
        		$Name = $model->id . time(). "." . $photo->extension;
        		if (!file_exists($rootPath)) {
        			mkdir($rootPath);
        		}
        		$photo->saveAs($rootPath . $Name);

        		// 阿里云存储
        		$file = $rootPath . $Name;
        		$type = $photo->type;
        		$cmd="python /usr/local/bin/osscmd put $file oss://msn/".$Name.' --content_type='.$type;
        		$re=exec($cmd, $out);
        		
        		$model->photo = 'http://p.dantou.net/'.$Name;
        	}
        	
        	$usermodel = User::findOne($model->id);
        	$model->nickname = $usermodel->nickname;
        	$model->save();
        	return $this->redirect(['view', 'id' => $model->id]);
        } else {
        	return $this->render('create', [
        			'model' => $model,
        			]);
        }
    }

    /**
     * Updates an existing Feedback model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $photo_old = $model->photo;

            if ($model->load(Yii::$app->request->post())) {
        	$rootPath = "../uploads/photo/";
        	$photo = UploadedFile::getInstance($model, 'photo');
        	if ($photo && $model->validate()) {
        		$Name = $id . time(). "." . $photo->extension;
        		if (!file_exists($rootPath)) {
        			mkdir($rootPath);
        		}
        		$photo->saveAs($rootPath . $Name);

        		// 阿里云存储
        		$file = $rootPath . $Name;
        		$type = $photo->type;
        		$cmd="python /usr/local/bin/osscmd put $file oss://msn/".$Name.' --content_type='.$type;
        		$re=exec($cmd, $out);
        		
        		$model->photo = 'http://p.dantou.net/'.$Name;
        	} else {
        		$model->photo = $photo_old;
        	}
        	
        	$usermodel = User::findOne($model->id);
        	$model->nickname = $usermodel->nickname;
        	$model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Feedback model.
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
     * Finds the Feedback model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Feedback the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Hotgirl::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionApply()
    {
    	$searchModel = new HotgirlApplySearch();
    	$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
    
    	return $this->render('apply', [
    			'searchModel' => $searchModel,
    			'dataProvider' => $dataProvider,
    			]);
    }
    
}
