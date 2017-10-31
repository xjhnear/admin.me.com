<?php

namespace mdm\admin\controllers;

use Yii;
use mdm\admin\models\User;
use mdm\admin\models\searchs\User as UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use mdm\admin\components\MenuHelper;

/**
 * MenuController implements the CRUD actions for Menu model.
 *
 * @author Misbahul D Munir <misbahuldmunir@gmail.com>
 * @since 1.0
 */
class UserController extends Controller
{

    /**
     * @inheritdoc
     */
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
     * Lists all Menu models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

        return $this->render('index', [
                'dataProvider' => $dataProvider,
                'searchModel' => $searchModel,
        ]);
    }

    /**
     * Displays a single Menu model.
     * @param  integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
                'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Menu model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            MenuHelper::invalidate();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                    'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Menu model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param  integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            MenuHelper::invalidate();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                    'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Menu model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param  integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        MenuHelper::invalidate();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Menu model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param  integer $id
     * @return Menu the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionPassword()
    {
    	if (!Yii::$app->user->getId()) {
    		return $this->goHome();
    	}

    	$model = $this->findModel(Yii::$app->user->getId());

    	if (Yii::$app->request->post()) {
    		$pa = Yii::$app->request->post();
    		if ($pa['User']['password0'] == '' || $pa['User']['password1'] == '' || $pa['User']['password2'] == '') {
    			return $this->render('password', [
    					'model' => $model,
    					'errmsg' => '密码不能为空',
    					]);
    		}
    		if (!Yii::$app->security->validatePassword($pa['User']['password0'], $model->password_hash)) {
	    		return $this->render('password', [
	    				'model' => $model,
	    				'errmsg' => '原密码不正确',
	    				]);
    		}
    		$model->save(true,null,$pa['User']['password2']);
//     		MenuHelper::invalidate();
    		return $this->goHome();
    	} else {
    		return $this->render('password', [
    				'model' => $model,
    				'errmsg' => '',
    				]);
    	}
    }
    
}
