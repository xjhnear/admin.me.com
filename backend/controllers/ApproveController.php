<?php

namespace backend\controllers;

use backend\models\UserExtra;

use backend\models\User;
use backend\models\UserSearch;
use backend\models\Photo;
use backend\models\PhotoHot;
use backend\models\PhotoComment;
use backend\models\PhotoCommentSearch;
use backend\models\PhotoSearch;
use backend\models\Daddy;
use backend\models\DaddySearch;
use backend\models\ReportSearch;
use backend\models\UserUpload;
use backend\models\UserUploadSearch;
use backend\models\Notification;
use backend\models\Photovoteup;
use backend\models\Config;
use backend\models\Report;
use backend\models\BlacklistedSearch;
use Curl\Curl;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class ApproveController extends Controller
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

    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->approve(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

    }

    /**
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView($id,$type)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        	'type' => $type,
        ]);
    }
    
    public function actionUserview($id,$type)
    {
    	return $this->render('userview', [
    			'model' => $this->findModel($id),
    			'type' => $type,
    			]);
    }

    public function actionSuccess($id, $type, $backview)
    {
        $model = $this->findModel($id);
        $model->{$type} = 2;
        if($model->save(false)) {
        	$count= UserUpload::deleteAll('user_id=:user_id and module=:module and is_approve=:is_approve',array(':user_id'=>$id,':module'=>$backview,':is_approve'=>1));
            $model = UserUpload::findAll(array('user_id'=>$id, 'module'=>$backview, 'is_approve'=>0));
	    	foreach ($model as $item) {
	    		$item->is_approve = 1;
	    		if ($item->position >= 5) {
	    			$item->position -=5;
	    		}
	    		$item->save();
	    	}
        	$notification = new Notification();
        	$notification->notification($id, 1, $backview, 'cert', $backview);
            $this->redirect([$backview]);
        }
    }

    public function actionFail($id, $type, $backview, $reason=NULL)
    {
        $model = $this->findModel($id);
        if ($model->{$type} == 1) {
        	$model->{$type} = 3;
        }
        if($model->save(false)) {
//         	$count= UserUpload::deleteAll('user_id=:user_id and module=:module and is_approve=:is_approve',array(':user_id'=>$id,':module'=>$backview,':is_approve'=>0));
        	$count= UserUpload::find()->where('user_id='.$id.' and module="'.$backview.'" and is_approve=0')->all();
        	foreach ($count as $item) {
				$Name = $item->path;
				// 阿里云存储
				$Name = str_replace('http://p.dantou.net/', '', $Name);
				$cmd="python /usr/local/bin/osscmd rm oss://msn/".$Name;
				$re=exec($cmd, $out);
				$item->delete();
        	}
        	
        	$notification = new Notification();
        	$notification->notification($id, 0, $backview, 'cert', $backview, 0, NULL, $reason);
            $this->redirect([$backview]);
        }
    }
    
    public function actionUserfail($id, $type, $backview, $reason=NULL)
    {
    	$model = $this->findModel($id);
    	$model->{$type} = 3;
    	if($model->save(false)) {
    		//$count= UserUpload::deleteAll('user_id=:user_id and module=:module and is_approve=:is_approve',array(':user_id'=>$id,':module'=>$backview,':is_approve'=>1));
        	$count= UserUpload::find()->where('user_id='.$id.' and module="'.$backview.'" and is_approve=0')->all();
        	foreach ($count as $item) {
				$Name = $item->path;
				// 阿里云存储
				$Name = str_replace('http://p.dantou.net/', '', $Name);
				$cmd="python /usr/local/bin/osscmd rm oss://msn/".$Name;
				$re=exec($cmd, $out);
				$item->delete();
        	}
    		 
    		$notification = new Notification();
    		$notification->notification($id, 0, $backview, 'cert', $backview, 0, NULL, $reason);
    		$this->redirect([$backview]);
    	}
    }

    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function notification($user_id, $alert, $key)
    {
        $curl = new Curl();
        $curl->get('http://cdr.dantou.net/oapi/push', [
            'module' => 'cert',
            'user_id' => $user_id,
            'title' => $alert
        ]);
    }
    
    public function actionAvatar()
    {
    	$searchModel = new UserUploadSearch();
    	$dataProvider = $searchModel->approve(Yii::$app->request->queryParams, 'avatar');
    
    	return $this->render('avatar', [
    			'searchModel' => $searchModel,
    			'dataProvider' => $dataProvider,
    			]);
    
    }
    
    public function actionCar()
    {
    	$searchModel = new UserUploadSearch();
    	$dataProvider = $searchModel->approve(Yii::$app->request->queryParams, 'car');
    
    	return $this->render('car', [
    			'searchModel' => $searchModel,
    			'dataProvider' => $dataProvider,
    			]);
    
    }
    
    public function actionUnmakeup()
    {
    	$searchModel = new UserUploadSearch();
    	$dataProvider = $searchModel->approve(Yii::$app->request->queryParams, 'unmakeup');
    
    	return $this->render('unmakeup', [
    			'searchModel' => $searchModel,
    			'dataProvider' => $dataProvider,
    			]);
    
    }
    
    public function actionVideo()
    {
    	$searchModel = new UserUploadSearch();
    	$dataProvider = $searchModel->approve(Yii::$app->request->queryParams, 'video');
    
    	return $this->render('video', [
    			'searchModel' => $searchModel,
    			'dataProvider' => $dataProvider,
    			]);
    
    }
    
    public function actionId()
    {
    	$searchModel = new UserUploadSearch();
    	$dataProvider = $searchModel->approve(Yii::$app->request->queryParams, 'id');
    
    	return $this->render('id', [
    			'searchModel' => $searchModel,
    			'dataProvider' => $dataProvider,
    			]);
    
    }
    
    public function actionPart()
    {
    	$searchModel = new UserUploadSearch();
    	$dataProvider = $searchModel->approve(Yii::$app->request->queryParams, 'part');
    
    	return $this->render('part', [
    			'searchModel' => $searchModel,
    			'dataProvider' => $dataProvider,
    			]);
    
    }

    public function actionPhoto()
    {
    	$PhotosearchModel = new PhotoSearch();
    	if (isset($_POST['PhotoSearch']['user_id'])) {
    		$dataAll = $PhotosearchModel->userphotosearch($_POST['PhotoSearch']['user_id']);
    	} else {
    		$dataAll = $PhotosearchModel->search(Yii::$app->request->queryParams);
    	}
    
    	return $this->render('photo', [
    			'dataAll' => $dataAll,
    			]);
    
    }
    
    public function actionPhotopass()
    {
    	$PhotosearchModel = new PhotoSearch();
    	if (isset($_POST['PhotoSearch']['user_id'])) {
    		$dataAll = $PhotosearchModel->userphotopasssearch($_POST['PhotoSearch']['user_id']);
    	} else {
    		$dataAll = $PhotosearchModel->searchpass(Yii::$app->request->queryParams);
    	}
    	
    	return $this->render('photopass', [
    			'dataAll' => $dataAll,
    			]);
    
    }
    
    public function actionReportphoto()
    {
    	$ReportsearchModel = new ReportSearch();
    	$dataReprot = $ReportsearchModel->search(Yii::$app->request->queryParams);
    
    	return $this->render('reportphoto', [
    			'dataReprot' => $dataReprot,
    			]);
    
    }
    
    public function actionReportcomment()
    {
    	$ReportsearchModel = new ReportSearch();
    	$dataReprot = $ReportsearchModel->photocommentsearch(Yii::$app->request->queryParams);
    
    	return $this->render('reportcomment', [
    			'dataReprot' => $dataReprot,
    			]);
    
    }
    
    public function actionPhotoview($id)
    {
    	return $this->render('photoview', [
    			'model' => $this->findPhotoModel($id),
    			]);
    }
    

    public function actionVideoindex($id)
    {
    	return $this->render('videoindex', [
    			'model' => $this->findPhotoModel($id),
    			]);
    }
    
    public function actionVideoindexset($id, $back)
    {
    	$model = $this->findPhotoModel($back);
    	$photo_url = $model->photo;
    	$photo_url = preg_replace("/\/offset\/.+\/rotate\/auto/is", "/offset/".$id."/rotate/auto", $photo_url);
    	Photo::updateAll(array('photo'=>$photo_url),'id=:id',array(':id'=>$back));
    	
    	return $this->render('photoview', [
    			'model' => $this->findPhotoModel($back),
    			]);
    }
    
    public function actionReportphotoview($id)
    {
    	return $this->render('reportphotoview', [
    			'model' => $this->findPhotoModel($id),
    			]);
    }
    
    public function actionComment()
    {
    	$searchModel = new PhotoCommentSearch();
    	$dataComment = $searchModel->search(Yii::$app->request->queryParams);
    
    	return $this->render('comment', [
    			'searchModel' => $searchModel,
    			'dataComment' => $dataComment,
    			]);
    
    }
    
    public function actionCommentview($id)
    {
    	return $this->render('commentview', [
    			'model' => $this->findPhotoCommentModel($id),
    			]);
    }
    
    protected function findPhotoModel($id)
    {
    	if (($model = Photo::findOne($id)) !== null) {
    		return $model;
    	} else {
    		throw new NotFoundHttpException('The requested page does not exist.');
    	}
    }
    
    protected function findPhotoCommentModel($id)
    {
    	if (($model = PhotoComment::findOne($id)) !== null) {
    		return $model;
    	} else {
    		throw new NotFoundHttpException('The requested page does not exist.');
    	}
    }
    
    public function actionPhotosuccess($id, $back='photo')
    {
    	$model = $this->findPhotoModel($id);
    	$model->is_approve = 1;
    	if($model->save(false)) {
    		if (isset($model->report->from_user)) {
    			$report = Report::find()->where('status="waiting" and module="photo" and objectId='.$model->id)->all();
    			foreach ($report as $item) {
    				$item->status = 'success';
    				$item->save();
    			}
    		}
    		$this->redirect($back);
    	}
    }
    
    public function actionPhotofail($id, $back='photo', $reason=NULL)
    {
    	$model = $this->findPhotoModel($id);
    	$model->is_deleted = 1;
    	$model->is_approve = 2;
    	if ($model->video_url) {
    		$Name = $model->video_url;
    	} else {
    		$Name = $model->photo;
    	}
    	if($model->save(false)) {
    		// 阿里云存储
    		$Name = str_replace('http://p.dantou.net/', '', $Name);
    		$cmd="python /usr/local/bin/osscmd rm oss://msn/".$Name;
    		$re=exec($cmd, $out);
    		
    		Photovoteup::deleteAll('photo_id=:photo_id',array(':photo_id'=>$id));
    		$report = Report::find()->where('status="waiting" and module="photo" and objectId='.$model->id)->all();
    		foreach ($report as $item) {
    			$item->status = 'success';
    			$item->save();
    		}
    		$user_extra = UserExtra::find()->where('id='.$model->user_id)->one();
    		if ($user_extra->photo_number>0) {
    			$user_extra->photo_number -= 1;
    			$user_extra->save();
    		}
    		
	    	$maxid=Photo::findBySql("select max(id) as id from photo where photo.user_id=$model->user_id and is_deleted=0")->one();
	    	if (!$maxid['id']) {
	    		PhotoHot::deleteAll('user_id=:user_id',array(':user_id'=>$model->user_id));
	    	}elseif ($maxid['id']<$id) {
	    		$photo_hot = PhotoHot::find()->where('user_id='.$model->user_id)->one();
	    		if ($photo_hot) {
	    			$photo_hot->photo_id = $maxid['id'];
	    			$photo_hot->save();
	    		}
	    	}

    		$notification = new Notification();
    		$notification->notification($model->user_id, 0, $back, 'cert', $back, 0, NULL, $reason);
    		$this->redirect($back);
    	}
    }
    
    public function actionCommentsuccess($id, $back='reportcomment')
    {
    	$model = $this->findPhotoCommentModel($id);
    		if (isset($model->report->from_user)) {
    			$report = Report::find()->where('status="waiting" and module="comment" and objectId='.$model->id)->all();
    			foreach ($report as $item) {
    				$item->status = 'success';
    				$item->save();
    			}
    		}
    		$this->redirect($back);
    }
    
    public function actionCommentfail($id, $back='reportcomment', $reason=NULL)
    {
    	$model = $this->findPhotoCommentModel($id);
    	$model->is_deleted = 1;
    	if($model->save(false)) {
    		Photovoteup::deleteAll('photo_id=:photo_id',array(':photo_id'=>$id));
    		$report = Report::find()->where('status="waiting" and module="comment" and objectId='.$model->id)->all();
    		foreach ($report as $item) {
    			$item->status = 'success';
    			$item->save();
    		}
    		$comment_parent = PhotoComment::find()->where('is_deleted=0 and parent_id='.$model->id)->all();
    		foreach ($comment_parent as $item_p) {
    			$item_p->is_deleted = 1;
    			$item_p->save();
    		}
//     		$notification = new Notification();
//     		$notification->notification($model->user_id, 0, $back, 'cert', $back, 0, NULL, $reason);
    		$this->redirect($back);
    	}
    }
    
    public function actionPhotosuccessonekey()
    {
    	$page = isset($_GET['page'])?$_GET['page']:1;
    	$offset = ($page-1) * 30;
    	$model = Photo::find()
	    	->select('id')
	    	->where('is_approve = "0"')
	    	->OrderBy('is_approve asc, created desc')
	    	->Limit(30)
	    	->offset($offset)
	    	->all();

    	foreach ($model as $item) {
    		$item->is_approve = 1;
    		$item->save(false);
    	}
    	
    	$this->redirect('photo');
    }
    
    public function actionAvatarpass()
    {
    	$searchModel = new UserUploadSearch();
    	$dataProvider = $searchModel->approvepass(Yii::$app->request->queryParams, 'avatar');
    
    	return $this->render('avatarpass', [
    			'searchModel' => $searchModel,
    			'dataProvider' => $dataProvider,
    			]);
    
    }
    
    public function actionCarpass()
    {
    	$searchModel = new UserUploadSearch();
    	$dataProvider = $searchModel->approvepass(Yii::$app->request->queryParams, 'car');
    
    	return $this->render('carpass', [
    			'searchModel' => $searchModel,
    			'dataProvider' => $dataProvider,
    			]);
    
    }
    
    public function actionUnmakeuppass()
    {
    	$searchModel = new UserUploadSearch();
    	$dataProvider = $searchModel->approvepass(Yii::$app->request->queryParams, 'unmakeup');
    
    	return $this->render('unmakeuppass', [
    			'searchModel' => $searchModel,
    			'dataProvider' => $dataProvider,
    			]);
    
    }
    
    public function actionVideopass()
    {
    	$searchModel = new UserUploadSearch();
    	$dataProvider = $searchModel->approvepass(Yii::$app->request->queryParams, 'video');
    
    	return $this->render('videopass', [
    			'searchModel' => $searchModel,
    			'dataProvider' => $dataProvider,
    			]);
    
    }
    
    public function actionIdpass()
    {
    	$searchModel = new UserUploadSearch();
    	$dataProvider = $searchModel->approvepass(Yii::$app->request->queryParams, 'id');
    
    	return $this->render('idpass', [
    			'searchModel' => $searchModel,
    			'dataProvider' => $dataProvider,
    			]);
    
    }
    
    public function actionPartpass()
    {
    	$searchModel = new UserUploadSearch();
    	$dataProvider = $searchModel->approvepass(Yii::$app->request->queryParams, 'part');
    
    	return $this->render('partpass', [
    			'searchModel' => $searchModel,
    			'dataProvider' => $dataProvider,
    			]);
    
    }

    public function actionOpen()
    {
    	$UserUploadSearchModel = new UserUploadSearch();
    	if (isset($_POST['UserUploadSearch']['user_id'])) {
    		$dataAll = $UserUploadSearchModel->useropensearch($_POST['UserUploadSearch']['user_id']);
    	} else {
    		$dataAll = $UserUploadSearchModel->opensearch(Yii::$app->request->queryParams);
    	}
    	
    	return $this->render('open', [
    			'dataAll' => $dataAll,
    			]);
    
    }
    
    public function actionOpenpass()
    {
    	$UserUploadSearchModel = new UserUploadSearch();
    	if (isset($_POST['UserUploadSearch']['user_id'])) {
    		$dataAll = $UserUploadSearchModel->useropenpasssearch($_POST['UserUploadSearch']['user_id']);
    	} else {
    		$dataAll = $UserUploadSearchModel->openpasssearch(Yii::$app->request->queryParams);
    	}
    
    	return $this->render('openpass', [
    			'dataAll' => $dataAll,
    			]);
    
    }
    
    public function actionPrivate()
    {
    	$UserUploadSearchModel = new UserUploadSearch();
    	if (isset($_POST['UserUploadSearch']['user_id'])) {
    		$dataAll = $UserUploadSearchModel->userprivatesearch($_POST['UserUploadSearch']['user_id']);
    	} else {
    		$dataAll = $UserUploadSearchModel->privatesearch(Yii::$app->request->queryParams);
    	}
    
    	return $this->render('private', [
    			'dataAll' => $dataAll,
    			]);
    
    }
    
    public function actionPrivatepass()
    {
    	$UserUploadSearchModel = new UserUploadSearch();
    	if (isset($_POST['UserUploadSearch']['user_id'])) {
    		$dataAll = $UserUploadSearchModel->userprivatepasssearch($_POST['UserUploadSearch']['user_id']);
    	} else {
    		$dataAll = $UserUploadSearchModel->privatepasssearch(Yii::$app->request->queryParams);
    	}
    
    	return $this->render('privatepass', [
    			'dataAll' => $dataAll,
    			]);
    
    }
    
    public function actionOpensuccess($id, $back='open')
    {
    	$model = UserUpload::findOne($id);
    	$model->is_approve = 1;
    	if($model->save(false)) {
    		$this->redirect($back);
    	}
    }
    
    public function actionOpenfail($id, $back='open', $reason=NULL)
    {
    	$model = UserUpload::findOne($id);
    	$Name = $model->path;
    	if($model->delete(false)) {
    		// 阿里云存储
    		$Name = str_replace('http://p.dantou.net/', '', $Name);
    		$cmd="python /usr/local/bin/osscmd rm oss://msn/".$Name;
    		$re=exec($cmd, $out);
    		
    		$notification = new Notification();
    		$notification->notification($model->user_id, 0, $back, 'cert', $back, 0, NULL, $reason);
    		$this->redirect($back);
    	}
    }
    
    public function actionOpensuccessonekey()
    {
    	$page = isset($_GET['page'])?$_GET['page']:1;
    	$offset = ($page-1) * 30;
    	$model = UserUpload::find()
    	->select('id')
    	->where('is_approve = "0" AND module = "open"')
    	->OrderBy('is_approve asc, created desc')
    	->Limit(30)
    	->offset($offset)
    	->all();
    
    	foreach ($model as $item) {
    		$item->is_approve = 1;
    		$item->save(false);
    	}
    	 
    	$this->redirect('open');
    }
    
    public function actionPrivatesuccess($id, $back='private')
    {
    	$model = UserUpload::findOne($id);
    	$model->is_approve = 1;
    	if($model->save(false)) {
    		$this->redirect($back);
    	}
    }
    
    public function actionPrivatefail($id, $back='private', $reason=NULL)
    {
    	$model = UserUpload::findOne($id);
    	$Name = $model->path;
    	if($model->delete(false)) {
    		// 阿里云存储
    		$Name = str_replace('http://p.dantou.net/', '', $Name);
    		$cmd="python /usr/local/bin/osscmd rm oss://msn/".$Name;
    		$re=exec($cmd, $out);
    		
    		$notification = new Notification();
    		$notification->notification($model->user_id, 0, $back, 'cert', $back, 0, NULL, $reason);
    		$this->redirect($back);
    	}
    }
    
    public function actionPrivatesuccessonekey()
    {
    	$page = isset($_GET['page'])?$_GET['page']:1;
    	$offset = ($page-1) * 30;
    	$model = UserUpload::find()
    	->select('id')
    	->where('is_approve = "0" AND module = "private"')
    	->OrderBy('is_approve asc, created desc')
    	->Limit(30)
    	->offset($offset)
    	->all();
    
    	foreach ($model as $item) {
    		$item->is_approve = 1;
    		$item->save(false);
    	}
    
    	$this->redirect('private');
    }
    
    public function actionBlacklisted()
    {
    	$searchBlacklisted = new BlacklistedSearch();
    	$dataBlacklisted = $searchBlacklisted->search(Yii::$app->request->queryParams);
    	
    	return $this->render('blacklisted', [
    			'searchModel' => $searchBlacklisted,
    			'dataBlacklisted' => $dataBlacklisted,
    			]);
    }
    
    public function actionFlower()
    {
    	$PhotosearchModel = new DaddySearch();
    	if (isset($_POST['PhotoSearch']['user_id'])) {
    		$dataAll = $PhotosearchModel->userphotosearch($_POST['PhotoSearch']['user_id']);
    	} else {
    		$dataAll = $PhotosearchModel->search(Yii::$app->request->queryParams);
    	}
    
    	return $this->render('flower', [
    			'dataAll' => $dataAll,
    			]);
    
    }
    
    public function actionFlowersuccess($id, $back='flower')
    {
    	$model = Daddy::findOne($id);
    	$model->is_approve = 1;
    	if($model->save(false)) {
    		$this->redirect($back);
    	}
    }
    
    public function actionFlowersuccessonekey()
    {
    	$page = isset($_GET['page'])?$_GET['page']:1;
    	$offset = ($page-1) * 30;
    	$model = Daddy::find()
    	->select('id')
    	->where('is_approve = "0"')
    	->OrderBy('is_approve asc, id asc')
    	->Limit(30)
    	->offset($offset)
    	->all();
    
    	foreach ($model as $item) {
    		$item->is_approve = 1;
    		$item->save(false);
    	}
    	 
    	$this->redirect('photo');
    }
    
    public function actionFlowerfail($id, $back='flower', $reason=NULL)
    {
    	$model = Daddy::findOne($id);
    	$model->is_deleted = 1;
    	$model->is_approve = 2;
    	$Name = $model->photo;
    	if($model->save(false)) {
    		// 阿里云存储
    		$Name = str_replace('http://p.dantou.net/', '', $Name);
    		$cmd="python /usr/local/bin/osscmd rm oss://msn/".$Name;
    		$re=exec($cmd, $out);

    		$this->redirect($back);
    	}
    }
}