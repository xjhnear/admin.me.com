<?php

namespace backend\controllers;

use backend\models\UserExtra;

use Yii;
use backend\models\Withdraw;
use backend\models\WithdrawSearch;
use backend\models\Notification;
use backend\models\Diamondhistory;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DiamondOrderController implements the CRUD actions for DiamondOrder model.
 */
class WithdrawController extends Controller
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
     * Lists all DiamondOrder models.
     * @return mixed
     */
    public function actionIndex()
    {
    	if ($_POST) {
    		if (isset($_POST['Withdraw'])) {
    			foreach ($_POST['Withdraw'] as $id) {
    				$model = $this->findModel($id);
    				$model->status = 'success';
    				if($model->save(false)) {
    					$notification = new Notification();
    					$notification->notification($model->user_id, 1, 'withdraw','point',$id);
    				}
    			}
    		}
    	}
    	
        $searchModel = new WithdrawSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DiamondOrder model.
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
     * Creates a new DiamondOrder model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Withdraw();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing DiamondOrder model.
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
     * Deletes an existing DiamondOrder model.
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
     * Finds the DiamondOrder model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DiamondOrder the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Withdraw::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionWithdrawsuccess($id, $uid)
    {
    	$model = $this->findModel($id);
    	$model->status = 'success';
    	if($model->save(false)) {
    		$notification = new Notification();
    		$notification->notification($uid, 1, 'withdraw','point',$id);
    		$this->redirect(['index']);
    	}
    }
    
    public function actionWithdrawfail($id, $uid, $reason=NULL)
    {

    	$model = $this->findModel($id);
    	$model->status = 'failed';
    	$model->is_deleted = 1;
    	if($model->save(false)) {

    		$user_model = UserExtra::findOne($uid);
    		$user_model->diamond += $model->diamond;
    		$user_model->save();
    		
    		$dh_last = Diamondhistory::find()->where(['user_id' => $uid])->orderBy('id DESC')->one();
    		if (isset($dh_last->balance)) {
    			$balance_now = $dh_last->balance;
    		} else {
    			$balance_now = 0;
    		}
    		
    		$dh_model = new Diamondhistory();
    		$dh_model->user_id = $uid;
    		$dh_model->diamond = $model->diamond;
    		$dh_model->type = 'withdraw';
    		$dh_model->status = 'success';
    		$dh_model->created = date('Y-m-d H:i:s');
    		$dh_model->balance = $balance_now + $dh_model->diamond;
    		$dh_model->save();
    		
    		
    		$notification = new Notification();
    		$notification->notification($uid, 0, 'withdraw', 'point', $id, 0, NULL, $reason);
    		$this->redirect(['index']);
    	}
    }
    
}
