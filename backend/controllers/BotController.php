<?php

namespace backend\controllers;

use Yii;
use backend\models\Bot;
use backend\models\User;
use backend\models\UserExtra;
use backend\models\UserTask;
use backend\models\BotSearch;
use backend\models\Adjustment;
use backend\models\See;
use backend\models\SeeJoin;
use backend\models\SeeSearch;
use backend\models\DiamondHistory;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BotController implements the CRUD actions for Bot model.
 */
class BotController extends Controller
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
     * Lists all Bot models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BotSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Bot model.
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
     * Creates a new Bot model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Bot();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Bot model.
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
     * Deletes an existing Bot model.
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
     * Finds the Bot model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Bot the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Bot::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionAutoadd()
    {
    	$post_arr = @Yii::$app->request->post();
    	if ($post_arr) {
    		for ($i = 0; $i < $post_arr['Bot']['number']; $i++) {
    			$user = new User();
    			$user->mobile = "188".rand(10000000,99999999);
    			$user->nickname = Yii::$app->params['bot_nickname1'][array_rand(Yii::$app->params['bot_nickname1'],1)]."的";
    			$user->nickname .= Yii::$app->params['bot_nickname2'][array_rand(Yii::$app->params['bot_nickname2'],1)];
    			$user->password = md5("111111");
    			if ($post_arr['Bot']['utype'] == 2) {
    				$user->utype = 1;
    			} elseif($post_arr['Bot']['utype'] == 3) {
    				$user->utype = 4;
    			} else {
    				$user->utype =Yii::$app->params['bot_utype'][array_rand(Yii::$app->params['bot_utype'],1)];
    			}
    			if ($user->utype == 1) {
    				$user->sex = 1;
    				$user->avatar = "http://c.dantou.net/".Yii::$app->params['bot_botav1'][array_rand(Yii::$app->params['bot_botav1'],1)];
    			} else {
    				$user->sex = 2;
    				$user->avatar = "http://c.dantou.net/".Yii::$app->params['bot_botav4'][array_rand(Yii::$app->params['bot_botav4'],1)];
    			}
    			switch ($post_arr['Bot']['province']) {
    				case 1:
    					$province = Yii::$app->params['bot_province'][array_rand(Yii::$app->params['bot_province'],1)];
    					$user->province = $province;
    					$user->city = $province;
	    				break;
    				case 2:
	    				$user->province = "上海";
	    				$user->city = "上海";
	    				break;
    				case 3:
	    				$user->province = "北京";
	    				$user->city = "北京";
	    				break;
    				case 4:
	    				$user->province = "广州";
	    				$user->city = "广州";
	    				break;
    				default:
    					$province = Yii::$app->params['bot_province'][array_rand(Yii::$app->params['bot_province'],1)];
    					$user->province = $province;
    					$user->city = $province;
    					break;
    			}
    			$user->age = rand(18,35);
    			$user->is_active = 1;
    			$user->avatar_certification_stage = 2;
    			$level = rand(1,12);
    			$user->level = $level;
    			$user->level_name = $user->sex==1?"VIP".$level:"LV".$level;
    			$user->credit_grade = 1;
    			$user->grade_name = "普通会员";
    			$user->created = date('Y-m-d H:i:s');
    			
    			$user->industry = Yii::$app->params['bot_industry'][array_rand(Yii::$app->params['bot_industry'],1)];
    			$user->relationship = Yii::$app->params['bot_relationship'][array_rand(Yii::$app->params['bot_relationship'],1)];
    			$user->starsign = Yii::$app->params['bot_starsign'][array_rand(Yii::$app->params['bot_starsign'],1)];
    			
				if ($user->save()) {
					$bot = new Bot();
					$bot->user_id = $user->id;
					$bot->utype = $user->utype;
					$bot->province = $user->province;
					$bot->created = $user->created;
					$bot->save();
					$ue = new UserExtra();
					$ue->id = $user->id;
					$ue->created = $user->created;
					$ue->save();
					$ut = new UserTask();
					$ut->user_id = $user->id;
					$ut->created = $user->created;
					$ut->save();
				}

    		}
    		$Adjustment = new Adjustment();
    		$Adjustment->setAdjustment(0, 1, $post_arr['Bot']['number'], 'addbot');
    		return $this->redirect(['index']);
    	} else {
    		return $this->render('autoadd');
    	}
    }
    
    public function actionSeepublish($id, $error=NULL)
    {
    	$model_bot = Bot::findOne($id);
    	$business = Yii::$app->params['bot_business_id'];
    	$post_arr = @Yii::$app->request->post();
    	if ($post_arr) {
    		$model = new See();
    		$model->user_id = $model_bot->user_id;
    		$model->business_id = $post_arr['Bot']['business'];
    		$model->city = $post_arr['Bot']['city'];
    		$model->see_time = $post_arr['Bot']['time'];
    		$model->message = $post_arr['Bot']['message'];
    		$model->created = date('Y-m-d H:i:s');
    		if ($model_bot->utype==1) {
    			$model->is_boss = 1;
    			$model_d = new DiamondHistory();
    			$model_d->user_id = $model_bot->user_id;
    			$model_d->diamond = $post_arr['Bot']['diamond'];
    			$model_d->type = "dating";
    			$model_d->status = "freeze";
    			$model_d->created = date('Y-m-d H:i:s');
    			$model_d->save();
    			$model->diamond_id = $model_d->id;
    		} else {
    			$model->is_boss = 0;
    		}
    		$model->diamond = $post_arr['Bot']['diamond'];
    		$model->save();

    		$Adjustment = new Adjustment();
    		$Adjustment->setAdjustment($model_bot->user_id, 1, $model->id, 'seepublish');
    		return $this->redirect(['index']);
    	} else {
    		return $this->render('seepublish', [
    				'model' => $model_bot,
    				'business' => $business,
    				'error' => $error
    				]);
    	}
    }
    
    public function actionSeejoin($id, $error=NULL)
    {
    	$model_bot = Bot::findOne($id);
    	$searchSee = new SeeSearch();
    	$dataSee = $searchSee->botseesearch(Yii::$app->request->queryParams,$model_bot->utype);
    	$post_arr = @Yii::$app->request->post();
    	if ($post_arr) {
    		$model_see = See::findOne($post_arr['Bot']['see_id']);
    		$model = new SeeJoin();
    		$model->user_id = $model_bot->user_id;
    		$model->see_id = $post_arr['Bot']['see_id'];
    		$model->releaser = $model_see->user_id;
    		$model->status = 2;
    		$model->diamond = $model_see->diamond;
    		$model->created = date('Y-m-d H:i:s');
    		if ($model_bot->utype==1) {
    			$model->is_boss = 1;
    			$model_d = new DiamondHistory();
    			$model_d->user_id = $model_bot->user_id;
    			$model_d->diamond = $model_see->diamond;
    			$model_d->type = "dating";
    			$model_d->status = "freeze";
    			$model_d->created = date('Y-m-d H:i:s');
    			$model_d->save();
    			$model->diamond_id = $model_d->id;
    		} else {
    			$model->is_boss = 0;
    		}
    		$model->save();
    
    		$Adjustment = new Adjustment();
    		$Adjustment->setAdjustment($model_bot->user_id, 2, $model->id, 'seejoin');
    		return $this->redirect(['index']);
    	} else {
    		return $this->render('seejoin', [
    				'model' => $model_bot,
    				'dataProvider' => $dataSee,
    				'error' => $error
    				]);
    	}
    }
}
