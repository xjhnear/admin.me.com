<?php 

namespace backend\controllers;

use backend\models\Photovoteup;

use backend\models\UserExtra;
use Yii;
use backend\models\User;
use backend\models\UserSearch;
use backend\models\AccessLogSearch;
use backend\models\DiamondOrderSearch;
use backend\models\DiamondhistorySearch;
use backend\models\Diamondhistory;
use backend\models\Withdraw;
use backend\models\WithdrawSearch;
use backend\models\PhotoSearch;
use backend\models\PhotoCommentSearch;
use backend\models\PhotoHot;
use backend\models\Photo;
use backend\models\UserUploadSearch;
use backend\models\Adjustment;
use backend\models\Blacklisted;
use backend\models\BlacklistedSearch;
use backend\models\Punish;
use backend\models\Notification;
use backend\models\Device;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\VipConfig;
use backend\models\CreditConfig;
use backend\models\LeanCloud;
use backend\models\PHPExcel;
use backend\models\CountHtml;

/**
 * UserController implements the CRUD actions for User model.
 */
require_once dirname(dirname(__FILE__)).'/web/excel/PHPExcel.php';

class UserController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => [ 'post' ],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search( Yii::$app->request->queryParams );

        return $this->render( 'index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ] );
    }

    public function actionSort($id)
    {
        $model = UserExtra::findOne($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('sort', [
                'model' => $model
            ]);
        }
    }
    
    public function actionDiamond($id, $error=NULL)
    {
    	$model = UserExtra::findOne($id);

    	$post_arr = @Yii::$app->request->post();
    	if ($post_arr) {
    		
    		$dh_last = Diamondhistory::find()->where(['user_id' => $id])->orderBy('id DESC')->one();
    		if (isset($dh_last->balance)) {
    			$balance_now = $dh_last->balance;
    		} else {
    			$balance_now = 0;
    		}
    		
    		switch ($post_arr['Diamond']['option']) {
    			case 1:
    				$model->diamond += $post_arr['Diamond']['number'];
    				$model->save();

    				$dh_model = new Diamondhistory();
    				$dh_model->user_id = $id;
    				$dh_model->diamond = $post_arr['Diamond']['number'];
    				$dh_model->type = 'admin';
    				$dh_model->status = 'success';
    				$dh_model->created = date('Y-m-d H:i:s');
    				$dh_model->balance = $balance_now + $dh_model->diamond;
    				$dh_model->save();
    				
    				break;
    			case 2:
    				if ($post_arr['Diamond']['number'] > $model->diamond) {
    					return $this->redirect(['diamond', 'id' => $model->id, 'error' => 1]);
    					break;
    				} else {
    					$model->diamond -= $post_arr['Diamond']['number'];
    					$model->save();
    					
    					$dh_model = new Diamondhistory();
    					$dh_model->user_id = $id;
    					$dh_model->diamond = $post_arr['Diamond']['number'];
    					$dh_model->type = 'admin';
    					$dh_model->status = 'success';
    					$dh_model->created = date('Y-m-d H:i:s');
    					$dh_model->balance = $balance_now - $dh_model->diamond;
    					$dh_model->save();
    					break;
    				}
    		}
    		$Adjustment = new Adjustment();
    		$Adjustment->setAdjustment($id, $post_arr['Diamond']['option'], $post_arr['Diamond']['number'], 'diamond');
    		return $this->redirect(['view', 'id' => $model->id]);
    	} else {
    		return $this->render('diamond', [
    				'model' => $model,
    				'error' => $error
    				]);
    	}
    }
    
    public function actionExperience($id, $error=NULL)
    {
  	
    	$model = UserExtra::findOne($id);

    	$post_arr = @Yii::$app->request->post();
    	if ($post_arr) {
    		switch ($post_arr['Experience']['option']) {
    			case 1:
    				$model->experience += $post_arr['Experience']['number'];
    				break;
    			case 2:
    				if ($post_arr['Experience']['number'] > $model->experience) {
    					return $this->redirect(['experience', 'id' => $model->id, 'error' => 1]);
    					break;
    				} else {
    					$model->experience -= $post_arr['Experience']['number'];
    					break;
    				}
    		}
    		$model->setExperience($model->experience);
    		$model->save();
    		$Adjustment = new Adjustment();
    		$Adjustment->setAdjustment($id, $post_arr['Experience']['option'], $post_arr['Experience']['number'], 'exp');
    		return $this->redirect(['view', 'id' => $model->id]);
    	} else {
    		return $this->render('experience', [
    				'model' => $model,
    				'error' => $error
    				]);
    	}
    }

    public function actionLevel($id, $error=NULL)
    {
    	 
    	$model_user = User::findOne($id);
    
    	$post_arr = @Yii::$app->request->post();
    	if ($post_arr) {
    		if ($model_user->utype == 1) {
    			$VipConfig = new VipConfig();
    			$model_config = $VipConfig->findByNo($post_arr['Experience']['number']);
    			$experience = $model_config->experience;
    		} else {
    			$CreditConfig = new CreditConfig();
    			$model_config = $CreditConfig->findByNo($post_arr['Experience']['number']);
    			$experience = $model_config->credit_total;
    		}
    		$model = UserExtra::findOne($id);
    		$model->setExperience($experience);
    		$model->save();
    		$Adjustment = new Adjustment();
    		$Adjustment->setAdjustment($id, $post_arr['Experience']['option'], $post_arr['Experience']['number'], 'exp');
    		return $this->redirect(['view', 'id' => $model->id]);
    	} else {
    		return $this->render('level', [
    				'model' => $model_user,
    				'error' => $error
    				]);
    	}
    }
    
    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
    	$searchAccessLog = new AccessLogSearch();
    	$dataAccessLog = $searchAccessLog->search($id);
    	$lean = new LeanCloud();
    	$dataConversation = $lean->getconversationtody($id);

        return $this->render('view', [
            'model' => $this->findModel($id),
        	'dataAccessLog' => $dataAccessLog,
        	'dataConversation' => $dataConversation,
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing User model.
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
     * Deletes an existing User model.
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
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
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
    
    
    public function actionAccesslog($id)
    {
    	$searchAccessLog = new AccessLogSearch();
    	$dataAccessLog = $searchAccessLog->search($id);
    
    	return $this->render('accesslog', [
    			'searchModel' => $searchAccessLog,
    			'model' => $this->findModel($id),
    			'dataProvider' => $dataAccessLog,
    			]);
    }
    
    public function actionRechargehistory($id)
    {
    	$searchRechargehistory = new DiamondOrderSearch();
    	$dataRechargehistory = $searchRechargehistory->usersearch($id);
    
    	return $this->render('rechargehistory', [
    			'searchModel' => $searchRechargehistory,
    			'model' => $this->findModel($id),
    			'dataProvider' => $dataRechargehistory,
    			]);
    }
    

    public function actionPointhistory($id)
    {
    	
    	if (!isset($_GET['t'])) {
	    	$searchPointhistory = new DiamondhistorySearch();
	    	$dataPointhistory = $searchPointhistory->usersearch($id);
    	} else {
    		$t = explode(' - ', $_GET['t']);
    		$searchPointhistory = new DiamondhistorySearch();
    		$dataPointhistory = $searchPointhistory->usersearch($id, $t);
    	}

    	return $this->render('pointhistory', [
    			'searchModel' => $searchPointhistory,
    			'model' => $this->findModel($id),
    			'dataProvider' => $dataPointhistory,
    			'uid' => $id
    			]);
    }
    
    public function actionExportpointhistory($id)
    {
    	if (!isset($_GET['t'])) {
	    	$searchPointhistory = new DiamondhistorySearch();
	    	$dataPointhistory = $searchPointhistory->usersearch($id);
	    	return $this->render('pointhistory', [
	    			'searchModel' => $searchPointhistory,
	    			'model' => $this->findModel($id),
	    			'dataProvider' => $dataPointhistory,
	    			'uid' => $id
	    			]);
    	}
    	
    	$t = explode(' - ', $_GET['t']);
//     	$searchPointhistory = new DiamondhistorySearch();
//     	$dataPointhistory = $searchPointhistory->usersearch($id, $t);
    	$dataPointhistory = Diamondhistory::find()->where('user_id='.$id.' and created>="'.$t[0].' 00:00:00" and created<="'.$t[1].' 23:59:59"')->orderby('created desc')->all();

    	$objPHPExcel = new \PHPExcel();
    	//设置属性
    	$objPHPExcel->getProperties()->setCreator(Yii::$app->user->identity->username)
    	->setLastModifiedBy(Yii::$app->user->identity->username)
    	->setTitle("Report of UserDiamondHistory NO.".$id)
    	->setSubject("")
    	->setDescription("")
    	->setKeywords("")
    	->setCategory("");
    	
    	$objPHPExcel->setActiveSheetIndex(0)
    	->setCellValue('A1', '#')
    	->setCellValue('B1', '消费类型')
    	->setCellValue('C1', '对方ID')
    	->setCellValue('D1', '钻石')
    	->setCellValue('E1', '交易状态')
    	->setCellValue('F1', '消费时间')
    	;
    	$i = 2;
    	
    	foreach ($dataPointhistory as $data){
    		$objPHPExcel->setActiveSheetIndex(0)
    		->setCellValue('A'.$i, $i-1)
    		->setCellValue('B'.$i, Yii::$app->params['diamond_history_type'][$data->type])
    		->setCellValue('C'.$i, $data->from_user)
    		->setCellValue('D'.$i, $data->diamond)
    		->setCellValue('E'.$i, Yii::$app->params['diamond_history_status'][$data->status])
    		->setCellValue('F'.$i, $data->created)
    		;
    		$i++;
    	}
    	$objPHPExcel->getActiveSheet()->setTitle('UserDiamondHistory');
    	
    	$objPHPExcel->setActiveSheetIndex(0);
    	
    	// Redirect output to a client’s web browser (Excel5)
    	header('Content-Type: application/vnd.ms-excel;charset=utf-8');
    	header('Content-Disposition: attachment;filename="Report of UserDiamondHistory NO.'.$id.'.xls"');
    	header('Cache-Control: max-age=0');
    	$objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
    	$objWriter->save('php://output');
    	exit;
    }
    
    public function actionWithdraw($id)
    {
    	$searchWithdraw = new WithdrawSearch();
    	$dataWithdraw = $searchWithdraw->usersearch($id);
    
    	return $this->render('withdraw', [
    			'searchModel' => $searchWithdraw,
    			'model' => $this->findModel($id),
    			'dataProvider' => $dataWithdraw,
    			]);
    }
    
    public function actionPhoto($id)
    {
    	$searchPhoto = new PhotoSearch();
    	$dataPhoto = $searchPhoto->userphotosearch($id);
    
    	return $this->render('photo', [
    			'searchModel' => $searchPhoto,
    			'model' => $this->findModel($id),
    			'dataProvider' => $dataPhoto,
    			]);
    }
    
    public function actionPhotocomment($id)
    {
    	$searchPhoto = new PhotoCommentSearch();
    	$dataPhoto = $searchPhoto->userphotosearch($id);
    
    	return $this->render('photocomment', [
    			'searchModel' => $searchPhoto,
    			'dataProvider' => $dataPhoto,
    			'photoid' => $id,
    			]);
    }
    
    public function actionWithdrawsuccess($id, $uid)
    {
    	$model = $this->findWithdrawModel($id);
    	$model->status = 'success';
    	if($model->save(false)) {
    		$notification = new Notification();
    		$notification->notification($uid, 1, 'withdraw','point',$id);
    		$this->redirect(['withdraw', 'id' => $uid]);
    	}
    }
    
    public function actionWithdrawfail($id, $uid)
    {
    	$model = $this->findWithdrawModel($id);
    	$model->status = 'failed';
    	if($model->delete(false)) {
    		$this->redirect(['withdraw', 'id' => $uid]);
    	}
    }
    
    protected function findWithdrawModel($id)
    {
    	if (($model = Withdraw::findOne($id)) !== null) {
    		return $model;
    	} else {
    		throw new NotFoundHttpException('The requested page does not exist.');
    	}
    }
    

    public function actionHot()
    {
    	$searchModel = new UserSearch();
    	$dataProvider = $searchModel->hotall( Yii::$app->request->queryParams );

    	return $this->render( 'hot', [
    			'searchModel' => $searchModel,
    			'dataProvider' => $dataProvider,
    			] );
    	
    }
    
    public function actionHotoperte()
    {
    	$searchModel = new UserSearch();
    	$dataProvider = $searchModel->hot( Yii::$app->request->queryParams );
    	 
    	$post_arr = @Yii::$app->request->post();
    	
    	if ($post_arr && isset($post_arr['id'])) {
    		$id_arr = $post_arr['id'];
    		$id_tmp = array();
    		for ($i=0;$i<count($id_arr);$i++) {
    			$id_tmp[$post_arr['xu'][$i]] = $post_arr['id'][$i];
    		}
    		$id_arr = $id_tmp;

    		$all_user = UserExtra::find()->join('INNER JOIN', 'user', 'user.id = user_extra.id')->where('hot_ranking > 0 and utype = 1')->orderby('hot_ranking')->limit(100)->all();
    				
    		$rank = 1;
    		foreach ($all_user as &$item) {

    			$this->checkInArr($id_arr, $rank);
    			
    			if (!in_array($item->id, $id_tmp)) {
	    			$item->hot_ranking = $rank;
	    			$item->save();
	    			$this->checkPhotoHot($item, $rank);
	    			$rank++;
    			}
    			
    		}
    		if (count($id_arr) > 0) {
    			foreach ($id_arr as $k => $v) {
    				$userex_model = UserExtra::findOne($v);
    				$userex_model->hot_ranking = $rank;
    				$userex_model->save();
    				$this->checkPhotoHot($userex_model, $rank);
    				unset($id_arr[$rank]);
    				$rank++;
    			}
    		}
    		setcookie('added', '', time()-3600*24);
    		$dataProvider = $searchModel->hotall( Yii::$app->request->queryParams );
    		
    		return $this->render( 'hot', [
    				'searchModel' => $searchModel,
    				'dataProvider' => $dataProvider,
    				] );
    		
    	} else {

    		if (isset($_COOKIE['added'])) {
    			$added = explode(',', $_COOKIE['added']);
    			$out = array();
    			foreach ($added as $added) {
    				$user_model = User::findOne($added);
    				$userex_model = UserExtra::findOne($added);
    				if ($user_model && $userex_model) {
    					$temp = array();
    					$temp['id'] = $user_model->id;
    					$temp['nickname'] = $user_model->nickname;
    					$temp['hot_ranking'] = $userex_model->hot_ranking;
    					$out[] = $temp;
    				}
    			}
    			$added = $out;
    		} else {
    			$added = array();
    		}
    		 
    		return $this->render( 'hotoperte', [
    				'searchModel' => $searchModel,
    				'dataProvider' => $dataProvider,
    				'add_arr' => $added,
    				] );
    	}

    }
    
    public function actionHotopertew()
    {
    	$searchModel = new UserSearch();
    	$dataProvider = $searchModel->hotw( Yii::$app->request->queryParams );
    
    	$post_arr = @Yii::$app->request->post();
    	
    	if ($post_arr && isset($post_arr['id'])) {
    		$id_arr = $post_arr['id'];
    		$id_tmp = array();
    		for ($i=0;$i<count($id_arr);$i++) {
    			$id_tmp[$post_arr['xu'][$i]] = $post_arr['id'][$i];
    		}
    		$id_arr = $id_tmp;
    
    		$all_user = UserExtra::find()->join('INNER JOIN', 'user', 'user.id = user_extra.id')->where('hot_ranking > 0 and utype = 4')->orderby('hot_ranking')->limit(100)->all();

    		$rank = 1;
    		foreach ($all_user as &$item) {
    			
				$this->checkInArr($id_arr, $rank);
				
    			if (!in_array($item->id, $id_tmp)) {
	    			$item->hot_ranking = $rank;
	    			$item->save();
	    			$this->checkPhotoHot($item, $rank);
	    			$rank++;
    			}
    		}
    		if (count($id_arr) > 0) {
    			foreach ($id_arr as $k => $v) {
    				$userex_model = UserExtra::findOne($v);
    				$userex_model->hot_ranking = $rank;
    				$userex_model->save();
    				$this->checkPhotoHot($userex_model, $rank);
    				unset($id_arr[$rank]);
    				$rank++;
    			}
    		}
    		setcookie('addedw', '', time()-3600*24);
    		
    		$dataProvider = $searchModel->hotall( Yii::$app->request->queryParams );
    		return $this->render( 'hot', [
    				'searchModel' => $searchModel,
    				'dataProvider' => $dataProvider,
    				] );
    
    	} else {
    
    		if (isset($_COOKIE['addedw'])) {
    			$added = explode(',', $_COOKIE['addedw']);
    			$out = array();
    			foreach ($added as $added) {
    				$user_model = User::findOne($added);
    				$userex_model = UserExtra::findOne($added);
    				if ($user_model && $userex_model) {
    					$temp = array();
    					$temp['id'] = $user_model->id;
    					$temp['nickname'] = $user_model->nickname;
    					$temp['hot_ranking'] = $userex_model->hot_ranking;
    					$out[] = $temp;
    				}
    			}
    			$added = $out;
    		} else {
    			$added = array();
    		}
    		 
    		return $this->render( 'hotopertew', [
    				'searchModel' => $searchModel,
    				'dataProvider' => $dataProvider,
    				'add_arr' => $added,
    				] );
    	}
    
    }
    
    private function checkInArr(&$id_arr, &$rank)
    {
    	if (isset($id_arr[$rank])) {
    		$userex_model = UserExtra::findOne($id_arr[$rank]);
    		$userex_model->hot_ranking = $rank;
    		$userex_model->save();
    		$this->checkPhotoHot($userex_model, $rank);
    		unset($id_arr[$rank]);
    		$rank++;

    		$this->checkInArr($id_arr, $rank);
    		
    	} else {
    		return true;
    	}
    }
    
    private function checkPhotoHot($item, $rank)
    {
    	$hot_model = PhotoHot::findOne($item->id);
    	if ($hot_model) {
    		$hot_model->hot_ranking = $rank;
    		$hot_model->save();
    	} else {
    		$user_model = User::findOne($item->id);
    		$maxid=Photo::findBySql("select max(id) as id from photo where photo.user_id=$item->id and is_deleted=0")->one();
    		if ($maxid['id']) {
    			$hot_new = new PhotoHot();
    			$hot_new->user_id = $item->id;
    			$hot_new->photo_id = $maxid['id'];
    			$hot_new->utype = $user_model->utype;
    			$hot_new->nickname = $user_model->nickname;
    			$hot_new->avatar = $user_model->avatar;
    			$hot_new->level_name = $user_model->level_name;
    			$hot_new->level = $user_model->level;
    			$hot_new->grade_name = $user_model->grade_name;
    			$hot_new->credit_grade = $user_model->credit_grade;
    			$hot_new->car_certification_stage = $user_model->car_certification_stage;
    			$hot_new->part_certification_stage = $user_model->part_certification_stage;
    			$hot_new->unmakeup_certification_stage = $user_model->unmakeup_certification_stage;
    			$hot_new->hot_ranking = $rank;
    			$hot_new->save();
    		}
    	}
		
    }
    
    public function actionPhotodown($id)
    {    	 
    	PhotoHot::deleteAll('user_id=:user_id',array(':user_id'=>$id));
    	$user_extra = UserExtra::find()->where('id='.$id)->one();
    	$user_extra->hot_push = 0;
    	$user_extra->save();
    	
    	$Adjustment = new Adjustment();
    	$Adjustment->setAdjustment($id, 1, '0', 'photodown');
    	return $this->redirect(['view', 'id' => $id]);
    }
    
    public function actionPhotoup($id)
    {
    	$user_extra = UserExtra::find()->where('id='.$id)->one();
    	$user_extra->hot_push = 1;
    	$user_extra->save();
    	 
    	$Adjustment = new Adjustment();
    	$Adjustment->setAdjustment($id, 1, '0', 'photoup');
    	return $this->redirect(['view', 'id' => $id]);
    }
    
    public function actionSignature($id)
    {
    	$user_extra = User::find()->where('id='.$id)->one();
    	$user_extra->signature = NULL;
    	$user_extra->save();
    
    	$Adjustment = new Adjustment();
    	$Adjustment->setAdjustment($id, 1, '0', 'signature');
    	return $this->redirect(['view', 'id' => $id]);
    }
    
    public function actionBlacklisted($id)
    {
    	 
    	$model_user = User::findOne($id);

    	$post_arr = @Yii::$app->request->post();
    	if ($post_arr) {
    		$black_time = NULL;
    		$reason = $post_arr['Blacklisted']['reason'];
    		if ($post_arr['Blacklisted']['option'] == 7) {
    			User::updateAll(array('blacklisted'=>null),'id=:user_id',array(':user_id'=>$id));    			
    		} elseif ($post_arr['Blacklisted']['option'] == 1) {
    			$notification = new Notification();
    			$notification->notification($id, 1, 'blacklisted', 'cert', 'blacklisted', 0, NULL, $reason);
    		} else {
    			switch ($post_arr['Blacklisted']['option']) {
    				case 2:
    					$black_time = date("Y-m-d H:i:s",time()+24*60*60);
    					break;
    				case 3:
    					$black_time = date("Y-m-d H:i:s",time()+24*60*60*3);
    					break;
    				case 4:
    					$black_time = date("Y-m-d H:i:s",time()+24*60*60*7);
    					break;
    				case 5:
    					$black_time = date("Y-m-d H:i:s",time()+24*60*60*30);
    					break;
    				case 6:
    					$black_time = date("Y-m-d H:i:s",time()+24*60*60*356*1000);
    					break;
    				default:
    					$black_time = date("Y-m-d H:i:s",time()+24*60*60);
    					break;
    			}
    			User::updateAll(array('blacklisted'=>$black_time),'id=:user_id',array(':user_id'=>$id));
    			Device::updateAll(array('user_id'=>null),'user_id=:user_id',array(':user_id'=>$id));
    		}
    		$Blacklisted = new Blacklisted();
    		$Blacklisted->setBlacklisted($id, $post_arr['Blacklisted']['option'], $black_time, $reason);
			
    		if ($post_arr['Blacklisted']['option'] != 7 && $post_arr['Blacklisted']['option'] != 1) {
    			$Punish_item = Punish::find()->where('user_id = '.$id)->one();
    			if ($Punish_item) {
    				Punish::updateAll(array('reason'=>$reason,'operator'=>@Yii::$app->user->identity->username),'user_id=:user_id',array(':user_id'=>$id));
    			} else {
    				$Punish = new Punish();
    				$Punish->setPunish($id, $reason);
    			}
    			
    			PhotoHot::deleteAll('user_id=:user_id',array(':user_id'=>$id));
    			$user_extra = UserExtra::find()->where('id='.$id)->one();
    			$user_extra->hot_push = 0;
    			$user_extra->save();
    		} elseif ($post_arr['Blacklisted']['option'] == 7) {
    			$user_extra = UserExtra::find()->where('id='.$id)->one();
    			$user_extra->hot_push = 1;
    			$user_extra->save();
    		}

    		$Adjustment = new Adjustment();
    		$Adjustment->setAdjustment($id, $post_arr['Blacklisted']['option'], '0', 'blacklisted');
    		return $this->redirect(['view', 'id' => $id]);
    	} else {
    		$searchBlacklisted = new BlacklistedSearch();
    		$dataBlacklisted = $searchBlacklisted->usersearch($id);
    		
    		return $this->render('blacklisted', [
    				'model' => $model_user,
    				'dataBlacklisted' => $dataBlacklisted,
    				]);
    	}
    }
    
    public function actionOpen($id)
    {
    	$searchUserUpload = new UserUploadSearch();
    	$dataUserUpload = $searchUserUpload->useropensearch($id);
    
    	return $this->render('open', [
    			'searchModel' => $searchUserUpload,
    			'model' => $this->findModel($id),
    			'dataProvider' => $dataUserUpload,
    			]);
    }
    
    public function actionPrivate($id)
    {
    	$searchUserUpload = new UserUploadSearch();
    	$dataUserUpload = $searchUserUpload->userprivatesearch($id);
    
    	return $this->render('private', [
    			'searchModel' => $searchUserUpload,
    			'model' => $this->findModel($id),
    			'dataProvider' => $dataUserUpload,
    			]);
    }
    
    public function actionBiddingdiamond()
    {
    	//echo "cancel!";exit;
    	
    	$uid_arr = array(
    			"6637"=>"4020",
    			);
    	
    	foreach ($uid_arr as $id=>$v) {
    		$model = UserExtra::findOne($id);
    		
    		$dh_last = Diamondhistory::find()->where(['user_id' => $id])->orderBy('id DESC')->one();
    		if (isset($dh_last->balance)) {
    			$balance_now = $dh_last->balance;
    		} else {
    			$balance_now = 0;
    		}
    		
    		$model->diamond += $v;
    		$model->save();
    		
    		$dh_model = new Diamondhistory();
    		$dh_model->user_id = $id;
    		$dh_model->diamond = $v;
    		$dh_model->type = 'dating';
    		$dh_model->status = 'success';
    		$dh_model->created = date('Y-m-d H:i:s');
    		$dh_model->balance = $balance_now + $dh_model->diamond;
    		$dh_model->save();

    		$model=new Notification();
    		$model->user_id=$id;
    		$model->module="";
    		$model->msg_type='notice';
    		$model->is_push=true;
    		$model->url='miss://';
    		$model->created=date('Y-m-d H:i:s');

    		$model->title="约见成功";
    		$model->alert="阿呜先生已确认支付本次约见费用！获得4020收益，可以在 个人->钻石 界面中进行提现哦";
    		$model->save(false);
    		
    	}
		echo "done!";exit;
    }
    
    public function actionNotice($id)
    {
    
    	$model_user = User::findOne($id);
    
    	$post_arr = @Yii::$app->request->post();
    	if ($post_arr) {
    		$model=new Notification();
    		$model->user_id=$id;
    		$model->module="";
    		$model->msg_type='notice';
    		$model->is_push=true;
    		$model->url='miss://';
    		$model->created=date('Y-m-d H:i:s');
    		$model->title="系统回复";
    		$model->alert=$post_arr['Notice']['context'];
    		$model->save(false);
    		
    		return $this->redirect(['view', 'id' => $id]);
    	} else {
    		return $this->render('notice', [
    				'model' => $model_user,
    				]);
    	}
    }
    
    public function actionBatchnotice()
    {
    	$post_arr = @Yii::$app->request->post();
    	if ($post_arr) {
    		set_time_limit(0);
    		$checkday30 = date("Y-m-d",strtotime(date('Y-m-d'))-30*24*60*60);
			$users = CountHtml::findBySql('SELECT user_id as d FROM device WHERE user_id>0 AND updated>="'.$checkday30.' 00:00:00" GROUP BY user_id')->all();
			foreach ($users as $item) {
				$model=new Notification();
				$model->user_id=$item->d;
				$model->module="";
				$model->msg_type='notice';
				$model->is_push=true;
				$model->url='miss://';
				$model->created=date('Y-m-d H:i:s');
				$model->title=$post_arr['Notice']['title'];
				$model->alert=$post_arr['Notice']['context'];
				$model->save(false);
			}
			$msg = "发送完成！";
    		return $this->render('batchnotice', [
    				'msg' => $msg,
    				]);
    	} else {
    		return $this->render('batchnotice');
    	}
    }

    public function actionVoteup($id, $error=NULL)
    {
    	$model_user = User::findOne($id);
    	$user_id = $id;
        $post_arr = @Yii::$app->request->post();
    	if ($post_arr) {
    		$model = PhotoHot::findOne($user_id);
    		$model->voteup += $post_arr['Experience']['number'];
    		$model->save();
    		
    		$bot_arr = CountHtml::findBySql('SELECT user_id AS c FROM bot order by rand() LIMIT '.$post_arr['Experience']['number'])->all();
    		foreach ($bot_arr as $item) {
    			$photo_voteup = new Photovoteup();
    			$photo_voteup->photo_id = $model->photo_id;
    			$photo_voteup->user_id = $item->c;
    			$photo_voteup->photo_user_id = $user_id;
    			$photo_voteup->created = date('Y-m-d H:i:s');
    			$photo_voteup->save();
    		}
    		
    		$Adjustment = new Adjustment();
    		$Adjustment->setAdjustment($id, $post_arr['Experience']['option'], $post_arr['Experience']['number'], 'voteup');
    		return $this->redirect(['view', 'id' => $id]);
    	} else {
    		return $this->render('voteup', [
    				'model' => $model_user,
    				'error' => $error
    				]);
    	}
    }

}
