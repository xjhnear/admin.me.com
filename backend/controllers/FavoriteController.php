<?php

namespace backend\controllers;

use Yii;
use backend\models\Favorite;
use backend\models\FavoriteSearch;
use backend\models\Favoritemission;
use backend\models\Favoritepasslog;
use backend\models\PhotoSearch;
use backend\models\SeeSearch;
use backend\models\MatchhistorySearch;
use backend\models\MyFriendSearch;
use backend\models\PhotoCommentSearch;
use backend\models\Csv;
use backend\models\CountHtml;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use backend\models\LeanCloud;
use backend\models\PHPExcel;

/**
 * DiamondOrderController implements the CRUD actions for DiamondOrder model.
 */

require_once dirname(dirname(__FILE__)).'/web/excel/PHPExcel.php';

class FavoriteController extends Controller
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
    	$mouths = Favoritemission::findBySql("select distinct(mouth) as c from favorite_mission ")->all();
    	$mouths_arr = array();
    	foreach ($mouths as $mouth) {
    		$mouths_arr[] = $mouth->c;
    	}
    	$mouths_arr = array_reverse($mouths_arr);
    	
        $searchModel = new FavoriteSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
        	'mouths' => $mouths_arr,
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
    	$model = $this->findModel($id);
    	$userid = $model->user_id;
    	$mission_his_model = Favoritemission::find()->where('user_id = '.$userid)->orderBy('id desc')->all();
    	$mission_model = Favoritemission::find()->where('user_id = '.$userid.' and mouth = "'.date("Y-m").'"')->one();
    	$checkday = date("Y-m").'-01';
    	$can_check = true;
    	if ($mission_model) {
    		if ($mission_model->checkday == date("Y-m-d")) {
    			$can_check = false;
    		}
    		$checkday = $mission_model->checkday;
    	}
    	
    	$searchSeepub = new SeeSearch();
    	$dataSeepub = $searchSeepub->favoriteseepubsearch($userid, $checkday);
    	
    	if ($_POST) {
//     		print_r($_POST);exit;
    		if (!$mission_model) {
    			$mission_model = new Favoritemission();
    			$mission_model->user_id = $userid;
    			$mission_model->mouth = date("Y-m");
    		}
    		if (isset($_POST['Conversation'])) {
    			foreach ($_POST['Conversation'] as $k=>$conversation) {
    				unset($passlog_mouth);
    				$passlog_mouth = Favoritepasslog::find()->where('user_id = '.$userid.' and mouth = "'.date("Y-m").'" and type = "conversation" and toid = "'.$_POST['ConversationTo'][$k].'"')->one();
    				if (!$passlog_mouth) {
    					$passlog_model = new Favoritepasslog();
    					$passlog_model->user_id = $userid;
    					$passlog_model->type = 'conversation';
    					$passlog_model->subid = $conversation;
    					$passlog_model->toid = $_POST['ConversationTo'][$k];
    					$passlog_model->mouth = date("Y-m");
    					$passlog_model->created = date("Y-m-d H:i:s");
    					$passlog_model->save();
    					
    					$mission_model->conversation += 1;
    				}

    			}
    		}
    		if (isset($_POST['Photo'])) {
    			foreach ($_POST['Photo'] as $photo) {
    				$passlog_model = new Favoritepasslog();
    				$passlog_model->user_id = $userid;
    				$passlog_model->type = 'photo';
    				$passlog_model->subid = $photo;
    				$passlog_model->mouth = date("Y-m");
    				$passlog_model->created = date("Y-m-d H:i:s");
    				$passlog_model->save();
    				
    				$mission_model->photo += 1;
    			}
    		}
//     		if (isset($_POST['Match'])) {
//     			foreach ($_POST['Match'] as $k=>$match) {
//     				unset($passlog_mouth);
//     				$passlog_mouth = Favoritepasslog::find()->where('user_id = '.$userid.' and mouth = "'.date("Y-m").'" and type = "match" and toid = "'.$_POST['MatchTo'][$k].'"')->one();
//     				if (!$passlog_mouth) {
//     					$passlog_model = new Favoritepasslog();
//     					$passlog_model->user_id = $userid;
//     					$passlog_model->type = 'match';
//     					$passlog_model->subid = $match;
//     					$passlog_model->toid = $_POST['MatchTo'][$k];
//     					$passlog_model->mouth = date("Y-m");
//     					$passlog_model->created = date("Y-m-d H:i:s");
//     					$passlog_model->save();
    					
//     					$mission_model->match += 1;
//     				}

//     			}
//     		}
    		if (isset($_POST['Friend'])) {
    			foreach ($_POST['Friend'] as $k=>$friend) {
    				unset($passlog_mouth);
    				$passlog_mouth = Favoritepasslog::find()->where('user_id = '.$userid.' and mouth = "'.date("Y-m").'" and type = "friend" and toid = "'.$_POST['FriendTo'][$k].'"')->one();
    				if (!$passlog_mouth) {
    					$passlog_model = new Favoritepasslog();
    					$passlog_model->user_id = $userid;
    					$passlog_model->type = 'friend';
    					$passlog_model->subid = $friend;
    					$passlog_model->toid = $_POST['FriendTo'][$k];
    					$passlog_model->mouth = date("Y-m");
    					$passlog_model->created = date("Y-m-d H:i:s");
    					$passlog_model->save();
    						
    					$mission_model->friend += 1;
    				}
    		
    			}
    		}
    		if (isset($_POST['Reward'])) {
    			foreach ($_POST['Reward'] as $k=>$reward) {
    				unset($passlog_mouth);
    				$passlog_mouth = Favoritepasslog::find()->where('user_id = '.$userid.' and mouth = "'.date("Y-m").'" and type = "reward" and toid = "'.$_POST['RewardTo'][$k].'"')->one();
    				if (!$passlog_mouth) {
    					$passlog_model = new Favoritepasslog();
    					$passlog_model->user_id = $userid;
    					$passlog_model->type = 'reward';
    					$passlog_model->subid = $reward;
    					$passlog_model->toid = $_POST['RewardTo'][$k];
    					$passlog_model->mouth = date("Y-m");
    					$passlog_model->created = date("Y-m-d H:i:s");
    					$passlog_model->save();
    		
    					$mission_model->reward += 1;
    				}
    		
    			}
    		}
    		if (isset($_POST['See'])) {
    			foreach ($_POST['See'] as $k=>$see) {
    				unset($passlog_mouth);
    				$passlog_mouth = Favoritepasslog::find()->where('user_id = '.$userid.' and mouth = "'.date("Y-m").'" and type = "see" and toid = "'.$_POST['SeeTo'][$k].'"')->one();
    				if (!$passlog_mouth) {
    					$passlog_model = new Favoritepasslog();
    					$passlog_model->user_id = $userid;
    					$passlog_model->type = 'see';
    					$passlog_model->subid = $see;
    					$passlog_model->toid = $_POST['SeeTo'][$k];
    					$passlog_model->mouth = date("Y-m");
    					$passlog_model->created = date("Y-m-d H:i:s");
    					$passlog_model->save();
    					
    					$mission_model->see += 1;
    				}

    			}
    		}
    		
//     		$money_seepub = count($dataSeepub) * 50;
    		$mission_model->seepub = count($dataSeepub);
    		$mission_model->money = $this->checkRank($mission_model);
    		$mission_model->checkday = date("Y-m-d");
    		$mission_model->save();
    		$can_check = false;
    	}

    	$searchPhoto = new PhotoSearch();
    	$dataPhoto = $searchPhoto->favoritephotosearch($userid, $checkday);
    	$searchSee = new SeeSearch();
    	$dataSee = $searchSee->favoriteseesearch($userid, $checkday);
    	$searchMatch = new MatchhistorySearch();
    	$dataMatch = $searchMatch->favoritematchsearch($userid, $checkday);
    	$searchFriend = new MyFriendSearch();
    	$dataFriend = $searchFriend->favoritesearch($userid, $checkday);
    	$searchReward = new PhotoCommentSearch();
    	$dataReward = $searchReward->favoritesearch($userid, $checkday);
    	
		$lean = new LeanCloud();
		$dataConversation = $lean->getconversationtody($userid, $checkday);

		$see = CountHtml::findBySql('SELECT DATE_FORMAT(created,"%Y-%m") AS c , COUNT(*) AS d FROM see WHERE status <>-3 AND user_id='.$userid.' AND created >="2015-11-01 00:00:00" GROUP BY DATE_FORMAT(created,"%Y-%m")')->all();
		$see_arr = array();
    	foreach ($see as $item) {
    		$see_arr[$item['c']] = $item['d'];
    	}
		
        return $this->render('view', [
            'model' => $model,
        	'dataPhoto' => $dataPhoto,
        	'dataMatch' => $dataMatch,
        	'dataFriend' => $dataFriend,
        	'dataSee' => $dataSee,
        	'dataReward' => $dataReward,
        	'dataConversation' => $dataConversation,
        	'can_check' => $can_check,
        	'mission_model' => $mission_model,
        	'mission_his_model' => $mission_his_model,
        	'see_arr' => $see_arr,
        	'dataSeepub' => $dataSeepub,
        ]);
    }

    
    /**
     * Creates a new DiamondOrder model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Favorite();

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
        if (($model = Favorite::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionImport()
    {
    
    	$post_arr = @Yii::$app->request->post();
    
    	if ($post_arr) {
    		if (isset($post_arr['importok']) && $post_arr['importok'] == 1) {
    			 
    			$path = dirname(__FILE__);
    			$path .= '\..\uploads\favorite\Favorite_'.date('Ymd').'.csv';
    			$model = new Favorite();
    			$column = 1;
    			$csv = new Csv();
    			$import_ok_arr = $csv->import($path,$column);
    			 
    			$i = 0;
    			foreach ($import_ok_arr as $item) {
    				if($i == 0){
    					$i++;
    					continue;
    				}
    				$config_model = Favorite::find()->where('id='.$item[0])->one();
    				if ($config_model) {
    					$config_model->user_id = $item[0];
    					$config_model->created = date('Y-m-d H:i:s');
    					$config_model->save();
    				} else {
    					$config_model = new Favorite();
    					$config_model->user_id = $item[0];
    					$config_model->created = date('Y-m-d H:i:s');
    					$config_model->save();
    				}
    				$i++;
    			}
    
    			return $this->render('import');
    		}
    
    		$path = dirname(__FILE__);
    		$path .= '\..\uploads\favorite\Favorite_'.date('Ymd').'.csv';
    		copy($_FILES['csv']['tmp_name'],$path);
    
    		$model = new Favorite();
    		$column = 1;
    
    		$csv = new Csv();
    		$import_arr = $csv->import($path,$column);

    		return $this->render('import', [
    				'import_arr' => $import_arr,
    				]);
    	}
    	 
    	return $this->render('import');
    }
    
    private function checkRank($mission_model)
    {
    	$money = 0;
    	$rank_key = 3;
    	$rank_tmp = 0;
    	//conversation
		if ($mission_model->conversation>=18) {
			$money_conversation = 200;
			$rank_tmp = 3;
		} elseif ($mission_model->conversation>=15) {
			$money_conversation = 150;
			$rank_tmp = 2;
		} elseif ($mission_model->conversation>=12) {
			$money_conversation = 100;
			$rank_tmp = 1;
		} else {
			$money_conversation = 0;
			$rank_tmp = 0;
		}
		if ($rank_tmp < $rank_key) {
			$rank_key = $rank_tmp;
		}
		//photo
		if ($mission_model->photo>=18) {
			$money_photo = 200;
			$rank_tmp = 3;
		} elseif ($mission_model->photo>=15) {
			$money_photo = 150;
			$rank_tmp = 2;
		} elseif ($mission_model->photo>=12) {
			$money_photo = 100;
			$rank_tmp = 1;
		} else {
			$money_photo = 0;
			$rank_tmp = 0;
		}
		if ($rank_tmp < $rank_key) {
			$rank_key = $rank_tmp;
		}
		//match
// 		if ($mission_model->match>=18) {
// 			$money_match = 100;
// 			$rank_tmp = 6;
// 		} elseif ($mission_model->match>=15) {
// 			$money_match = 50;
// 			$rank_tmp = 5;
// 		} elseif ($mission_model->match>=12) {
// 			$money_match = 40;
// 			$rank_tmp = 4;
// 		} elseif ($mission_model->match>=9) {
// 			$money_match = 30;
// 			$rank_tmp = 3;
// 		} elseif ($mission_model->match>=6) {
// 			$money_match = 20;
// 			$rank_tmp = 2;
// 		} elseif ($mission_model->match>=3) {
// 			$money_match = 10;
// 			$rank_tmp = 1;
// 		} else {
// 			$money_match = 0;
// 			$rank_tmp = 0;
// 		}
// 		if ($rank_tmp < $rank_key) {
// 			$rank_key = $rank_tmp;
// 		}
		//see
// 		if ($mission_model->see>=20) {
// 			$money_see = 100;
// 			$rank_tmp = 6;
// 		} elseif ($mission_model->see>=10) {
// 			$money_see = 50;
// 			$rank_tmp = 5;
// 		} elseif ($mission_model->see>=8) {
// 			$money_see = 40;
// 			$rank_tmp = 4;
// 		} elseif ($mission_model->see>=6) {
// 			$money_see = 30;
// 			$rank_tmp = 3;
// 		} elseif ($mission_model->see>=4) {
// 			$money_see = 20;
// 			$rank_tmp = 2;
// 		} elseif ($mission_model->see>=2) {
// 			$money_see = 10;
// 			$rank_tmp = 1;
// 		} else {
// 			$money_see = 0;
// 			$rank_tmp = 0;
// 		}
// 		if ($rank_tmp < $rank_key) {
// 			$rank_key = $rank_tmp;
// 		}
		//friend
		if ($mission_model->friend>=30) {
			$money_friend = 200;
			$rank_tmp = 3;
		} elseif ($mission_model->friend>=25) {
			$money_friend = 150;
			$rank_tmp = 2;
		} elseif ($mission_model->friend>=20) {
			$money_friend = 100;
			$rank_tmp = 1;
		} else {
			$money_friend = 0;
			$rank_tmp = 0;
		}
		if ($rank_tmp < $rank_key) {
			$rank_key = $rank_tmp;
		}
		//reward
		if ($mission_model->reward>=20) {
			$money_reward = 200;
			$rank_tmp = 3;
		} elseif ($mission_model->reward>=10) {
			$money_reward = 150;
			$rank_tmp = 2;
		} elseif ($mission_model->reward>=8) {
			$money_reward = 100;
			$rank_tmp = 1;
		} else {
			$money_reward = 0;
			$rank_tmp = 0;
		}
		if ($rank_tmp < $rank_key) {
			$rank_key = $rank_tmp;
		}
		
		switch ($rank_key) {
			case 3:
				$money_rank = 3000;
				break;
			case 2:
				$money_rank = 2000;
				break;
			case 1:
				$money_rank = 1000;
				break;
			case 0:
				$money_rank = 0;
				break;
			default:
				$money_rank = 0;
				break;
		}
		
    	if ($mission_model->see>=20) {
			$money_see = 70000;
		} elseif ($mission_model->see>=10) {
			$money_see = 30000;
		} elseif ($mission_model->see>=7) {
			$money_see = 17500;
		} elseif ($mission_model->see>=5) {
			$money_see = 10000;
		} elseif ($mission_model->see>=2) {
			$money_see = 3000;
		} else {
			$money_see = 0;
		}
		
		$money = $money_conversation + $money_photo + $money_see + $money_friend + $money_reward + $money_rank;
		return $money;
    }
    
    public function actionExportmouth()
    {
    	if (!isset($_GET['t'])) {
    		return $this->redirect(['index']);
    	}
    	$t = $_GET['t'];
    	$dataMouth = Favoritemission::find()->where('mouth = "'.$t.'"')->all();
    	
    	$objPHPExcel = new \PHPExcel();
    	//设置属性
    	$objPHPExcel->getProperties()->setCreator(Yii::$app->user->identity->username)
    	->setLastModifiedBy(Yii::$app->user->identity->username)
    	->setTitle("Report of FavoriteMission")
    	->setSubject("")
    	->setDescription("")
    	->setKeywords("")
    	->setCategory("");
    
    	$objPHPExcel->setActiveSheetIndex(0)
    	->setCellValue('A1', '#')
    	->setCellValue('B1', '月份')
    	->setCellValue('C1', '用户ID')
    	->setCellValue('D1', '聊天')
    	->setCellValue('E1', '关注')
    	->setCellValue('F1', '宣言')
    	->setCellValue('G1', '匹配')
    	->setCellValue('H1', '约见')
    	->setCellValue('I1', '打赏')
    	->setCellValue('J1', '本月收益')
    	;
    	$i = 2;
    	foreach ($dataMouth as $data){
    		$objPHPExcel->setActiveSheetIndex(0)
    		->setCellValue('A'.$i, $i-1)
    		->setCellValue('B'.$i, $data->mouth)
    		->setCellValue('C'.$i, $data->user_id)
    		->setCellValue('D'.$i, $data->conversation)
    		->setCellValue('E'.$i, $data->friend)
    		->setCellValue('F'.$i, $data->photo)
    		->setCellValue('G'.$i, $data->match)
    		->setCellValue('H'.$i, $data->see)
    		->setCellValue('I'.$i, $data->reward)
    		->setCellValue('J'.$i, $data->money)
    		;
    		$i++;
    	}

    	$objPHPExcel->getActiveSheet()->setTitle('FavoriteMission');

    	// Set active sheet index to the first sheet, so Excel opens this as the first sheet
    	$objPHPExcel->setActiveSheetIndex(0);
    
    	// Redirect output to a client’s web browser (Excel5)
    	header('Content-Type: application/vnd.ms-excel;charset=utf-8');
    	header('Content-Disposition: attachment;filename="Report of FavoriteMission.xls"');
    	header('Cache-Control: max-age=0');
    	$objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
    	$objWriter->save('php://output');
    	exit;
    }
    
    public function actionFixbug()
    {
    	$mission_model = Favoritemission::find()->all();
    	foreach ($mission_model as $item) {
    		$item->money = $this->checkRank($item);
    		$item->save();
    	}
    	
    	echo "OK!";
		exit;
    }
}
