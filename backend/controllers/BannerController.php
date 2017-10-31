<?php

namespace backend\controllers;

use Yii;
use backend\models\Banner;
use backend\models\BannerSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use backend\models\Utils;

/**
 * ConfigController implements the CRUD actions for Config model.
 */
class BannerController extends Controller
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
        $searchModel = new BannerSearch();
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
        $model = new Banner();
        
        if ($model->load(Yii::$app->request->post())) {
        	if ($model->validate()) {
        		$Name = "banner" . time();
        		$model->photo = 'http://p.dantou.net/'.$Name;
        		$Name_S = "start" . time();
        		$model->start_photo = 'http://p.dantou.net/'.$Name_S;

        		$model->created=date('Y-m-d H:i:s');
        		$model->save();
        		return $this->redirect(['view', 'id' => $model->id]);
        	} else {
	            return $this->render('create', [
	                'model' => $model,
	            	'err_msg' => 1,
	            ]);
        	}

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

        	if ($model->validate()) {
        		$model->save();
        		return $this->redirect(['view', 'id' => $model->id]);
        	} else {
	            return $this->render('update', [
	                'model' => $model,
	            ]);
        	}

        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionIos($id)
    {
    	$model = $this->findModel($id);
    	$Utils = new Utils();

    	if (Yii::$app->request->post()) {
    		$rootPath = "../uploads/banner/";
    		$photo2x = UploadedFile::getInstance($model, 'photo2x');
    		$photo3x = UploadedFile::getInstance($model, 'photo3x');
    		 
    		if ($photo2x || $photo3x) {
    			$Name = $model->photo;
    			$Name = str_replace('http://p.dantou.net/', '', $Name);
    			if (!file_exists($rootPath)) {
    				mkdir($rootPath);
    			}
    			if ($photo2x) {
    				$photo2x->saveAs($rootPath . $Name . '@2x.png');
    				// 阿里云存储
    				$file = $rootPath . $Name . '@2x.png';
    				$type = $photo2x->type;
    				$cmd="python /usr/local/bin/osscmd rm oss://msn/".$Name.'@2x.png';
    				$re=exec($cmd, $out);
    				$cmd="python /usr/local/bin/osscmd put $file oss://msn/".$Name.'@2x.png --content_type='.$type;
    				$re=exec($cmd, $out);
    			}
    			if ($photo3x) {
    				$photo3x->saveAs($rootPath . $Name . '@3x.png');
    				$file = $rootPath . $Name . '@3x.png';
    				$type = $photo3x->type;
    				$cmd="python /usr/local/bin/osscmd rm oss://msn/".$Name.'@3x.png';
    				$re=exec($cmd, $out);
    				$cmd="python /usr/local/bin/osscmd put $file oss://msn/".$Name.'@3x.png --content_type='.$type;
    				$re=exec($cmd, $out);
    			}
    		
    			return $this->render('ios', [
    					'model' => $model,
    					]);
    		} else {
    			return $this->render('ios', [
    					'model' => $model,
    					]);
    		}
    	} else {
            return $this->render('ios', [
                'model' => $model,
            ]);
        }

    }
    
    public function actionAndroid($id)
    {
    	$model = $this->findModel($id);
    	$Utils = new Utils();
    
    	if (Yii::$app->request->post()) {
    		$rootPath = "../uploads/banner/";
        	$photo1 = UploadedFile::getInstance($model, 'photo1');
        	$photo2 = UploadedFile::getInstance($model, 'photo2');
        	$photo3 = UploadedFile::getInstance($model, 'photo3');
        	$photo4 = UploadedFile::getInstance($model, 'photo4');
    		 
    		if ($photo1 || $photo2 || $photo3 || $photo4) {
    			$Name = $model->photo;
    			$Name = str_replace('http://p.dantou.net/', '', $Name);
    			if (!file_exists($rootPath)) {
    				mkdir($rootPath);
    			}
    			if ($photo1) {
    				$photo1->saveAs($rootPath . $Name . '@1.png');
    				// 阿里云存储
    				$file = $rootPath . $Name . '@1.png';
    				$type = $photo1->type;
    				$cmd="python /usr/local/bin/osscmd rm oss://msn/".$Name.'@1.png';
    				$re=exec($cmd, $out);
    				$cmd="python /usr/local/bin/osscmd put $file oss://msn/".$Name.'@1.png --content_type='.$type;
    				$re=exec($cmd, $out);
    			}
    			if ($photo2) {
    				$photo2->saveAs($rootPath . $Name . '@2.png');
    				$file = $rootPath . $Name . '@2.png';
    				$type = $photo2->type;
    				$cmd="python /usr/local/bin/osscmd rm oss://msn/".$Name.'@2.png';
    				$re=exec($cmd, $out);
    				$cmd="python /usr/local/bin/osscmd put $file oss://msn/".$Name.'@2.png --content_type='.$type;
    				$re=exec($cmd, $out);
    			}
    			if ($photo3) {
    				$photo3->saveAs($rootPath . $Name . '@3.png');
    				$file = $rootPath . $Name . '@3.png';
    				$type = $photo3->type;
    				$cmd="python /usr/local/bin/osscmd rm oss://msn/".$Name.'@3.png';
    				$re=exec($cmd, $out);
    				$cmd="python /usr/local/bin/osscmd put $file oss://msn/".$Name.'@3.png --content_type='.$type;
    				$re=exec($cmd, $out);
    			}
    			if ($photo4) {
    				$photo4->saveAs($rootPath . $Name . '@4.png');
    				$file = $rootPath . $Name . '@4.png';
    				$type = $photo4->type;
    				$cmd="python /usr/local/bin/osscmd rm oss://msn/".$Name.'@4.png';
    				$re=exec($cmd, $out);
    				$cmd="python /usr/local/bin/osscmd put $file oss://msn/".$Name.'@4.png --content_type='.$type;
    				$re=exec($cmd, $out);
    			}
    
    			return $this->render('android', [
    					'model' => $model,
    					]);
    		} else {
    			return $this->render('android', [
    					'model' => $model,
    					]);
    		}
    	} else {
    		return $this->render('android', [
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
        if (($model = Banner::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    
    public function actionStartios($id)
    {
    	$model = $this->findModel($id);

    	if (Yii::$app->request->post()) {
    		$rootPath = "../uploads/start/";
    		$photo2x = UploadedFile::getInstance($model, 'photo2x');
    		$photo3x = UploadedFile::getInstance($model, 'photo3x');
    		$photo4x = UploadedFile::getInstance($model, 'photo4x');
    		$photo5x = UploadedFile::getInstance($model, 'photo5x');
    		 
    		if ($photo2x || $photo3x) {
    			$Name = $model->start_photo;
    			$Name = str_replace('http://p.dantou.net/', '', $Name);
    			if (!file_exists($rootPath)) {
    				mkdir($rootPath);
    			}
    			if ($photo2x) {
    				$photo2x->saveAs($rootPath . $Name . '_1242x2280.png');
    				// 阿里云存储
    				$file = $rootPath . $Name . '_1242x2280.png';
    				$type = $photo2x->type;
    				$cmd="python /usr/local/bin/osscmd rm oss://msn/".$Name.'_1242x2280.png';
    				$re=exec($cmd, $out);
    				$cmd="python /usr/local/bin/osscmd put $file oss://msn/".$Name.'_1242x2280.png --content_type='.$type;
    				$re=exec($cmd, $out);
    			}
    			if ($photo3x) {
    				$photo3x->saveAs($rootPath . $Name . '_750x1334.png');
    				$file = $rootPath . $Name . '_750x1334.png';
    				$type = $photo3x->type;
    				$cmd="python /usr/local/bin/osscmd rm oss://msn/".$Name.'_750x1334.png';
    				$re=exec($cmd, $out);
    				$cmd="python /usr/local/bin/osscmd put $file oss://msn/".$Name.'_750x1334.png --content_type='.$type;
    				$re=exec($cmd, $out);
    			}
    			if ($photo4x) {
    				$photo4x->saveAs($rootPath . $Name . '_640x960.png');
    				$file = $rootPath . $Name . '_640x960.png';
    				$type = $photo4x->type;
    				$cmd="python /usr/local/bin/osscmd rm oss://msn/".$Name.'_640x960.png';
    				$re=exec($cmd, $out);
    				$cmd="python /usr/local/bin/osscmd put $file oss://msn/".$Name.'_640x960.png --content_type='.$type;
    				$re=exec($cmd, $out);
    			}
    			if ($photo5x) {
    				$photo5x->saveAs($rootPath . $Name . '_640x1136.png');
    				$file = $rootPath . $Name . '_640x1136.png';
    				$type = $photo5x->type;
    				$cmd="python /usr/local/bin/osscmd rm oss://msn/".$Name.'_640x1136.png';
    				$re=exec($cmd, $out);
    				$cmd="python /usr/local/bin/osscmd put $file oss://msn/".$Name.'_640x1136.png --content_type='.$type;
    				$re=exec($cmd, $out);
    			}
    
    			return $this->render('startios', [
    					'model' => $model,
    					]);
    		} else {
    			return $this->render('startios', [
    					'model' => $model,
    					]);
    		}
    	} else {
    		return $this->render('startios', [
    				'model' => $model,
    				]);
    	}
    
    }
    
    public function actionStartandroid($id)
    {
    	$model = $this->findModel($id);
 
    	if (Yii::$app->request->post()) {
    		$rootPath = "../uploads/start/";
    		$photo1 = UploadedFile::getInstance($model, 'photo1');
    		$photo2 = UploadedFile::getInstance($model, 'photo2');
    		$photo3 = UploadedFile::getInstance($model, 'photo3');
    		$photo4 = UploadedFile::getInstance($model, 'photo4');
    		 
    		if ($photo1 || $photo2 || $photo3 || $photo4) {
    			$Name = $model->start_photo;
    			$Name = str_replace('http://p.dantou.net/', '', $Name);
    			if (!file_exists($rootPath)) {
    				mkdir($rootPath);
    			}
    			if ($photo1) {
    				$photo1->saveAs($rootPath . $Name . '@1.png');
    				// 阿里云存储
    				$file = $rootPath . $Name . '@1.png';
    				$type = $photo1->type;
    				$cmd="python /usr/local/bin/osscmd rm oss://msn/".$Name.'@1.png';
    				$re=exec($cmd, $out);
    				$cmd="python /usr/local/bin/osscmd put $file oss://msn/".$Name.'@1.png --content_type='.$type;
    				$re=exec($cmd, $out);
    			}
    			if ($photo2) {
    				$photo2->saveAs($rootPath . $Name . '@2.png');
    				$file = $rootPath . $Name . '@2.png';
    				$type = $photo2->type;
    				$cmd="python /usr/local/bin/osscmd rm oss://msn/".$Name.'@2.png';
    				$re=exec($cmd, $out);
    				$cmd="python /usr/local/bin/osscmd put $file oss://msn/".$Name.'@2.png --content_type='.$type;
    				$re=exec($cmd, $out);
    			}
    			if ($photo3) {
    				$photo3->saveAs($rootPath . $Name . '@3.png');
    				$file = $rootPath . $Name . '@3.png';
    				$type = $photo3->type;
    				$cmd="python /usr/local/bin/osscmd rm oss://msn/".$Name.'@3.png';
    				$re=exec($cmd, $out);
    				$cmd="python /usr/local/bin/osscmd put $file oss://msn/".$Name.'@3.png --content_type='.$type;
    				$re=exec($cmd, $out);
    			}
    			if ($photo4) {
    				$photo4->saveAs($rootPath . $Name . '@4.png');
    				$file = $rootPath . $Name . '@4.png';
    				$type = $photo4->type;
    				$cmd="python /usr/local/bin/osscmd rm oss://msn/".$Name.'@4.png';
    				$re=exec($cmd, $out);
    				$cmd="python /usr/local/bin/osscmd put $file oss://msn/".$Name.'@4.png --content_type='.$type;
    				$re=exec($cmd, $out);
    			}
    
    			return $this->render('startandroid', [
    					'model' => $model,
    					]);
    		} else {
    			return $this->render('startandroid', [
    					'model' => $model,
    					]);
    		}
    	} else {
    		return $this->render('startandroid', [
    				'model' => $model,
    				]);
    	}
    
    }
    
    public function actionSetstargpage($id)
    {
    	Banner::updateAll(array('is_startpage'=>'0'),'is_startpage=:is_startpage',array(':is_startpage'=>'1'));
    	$model = $this->findModel($id);
    	$model->is_startpage = 1;
    	$model->save();

    	return $this->redirect(['view', 'id' => $id]);
    }
    
    public function actionSetactive($id, $value)
    {
    	$model = $this->findModel($id);
    	$model->is_active = $value;
    	$model->save();
    
    	return $this->redirect(['view', 'id' => $id]);
    }
    
}
