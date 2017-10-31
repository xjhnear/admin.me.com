<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\LoginForm;
use yii\filters\VerbFilter;
use backend\models\User;
use backend\models\Photo;
use backend\models\Report;
use backend\models\UserUpload;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
//     	$approve_avatar = User::find()->where(['avatar_certification_stage' => '1'])->count();
    	$approve_avatar = UserUpload::find()->join('INNER JOIN', 'user', 'user.id=user_upload.user_id')->where(['is_approve' => '0', 'module' => 'avatar'])->groupby('user_id')->count();
//     	$approve_car = User::find()->where(['car_certification_stage' => '1'])->count();
    	$approve_car = UserUpload::find()->join('INNER JOIN', 'user', 'user.id=user_upload.user_id')->where(['is_approve' => '0', 'module' => 'car'])->groupby('user_id')->count();
//     	$approve_unmakeup = User::find()->where(['unmakeup_certification_stage' => '1'])->count();
    	$approve_unmakeup = UserUpload::find()->join('INNER JOIN', 'user', 'user.id=user_upload.user_id')->where(['is_approve' => '0', 'module' => 'unmakeup'])->groupby('user_id')->count();
//     	$approve_video = User::find()->where(['video_certification_stage' => '1'])->count();
    	$approve_video = UserUpload::find()->join('INNER JOIN', 'user', 'user.id=user_upload.user_id')->where(['is_approve' => '0', 'module' => 'video'])->groupby('user_id')->count();
//     	$approve_id = User::find()->where(['id_certification_stage' => '1'])->count();
    	$approve_id = UserUpload::find()->join('INNER JOIN', 'user', 'user.id=user_upload.user_id')->where(['is_approve' => '0', 'module' => 'id'])->groupby('user_id')->count();
//     	$approve_part = User::find()->where(['part_certification_stage' => '1'])->count();
    	$approve_part = UserUpload::find()->join('INNER JOIN', 'user', 'user.id=user_upload.user_id')->where(['is_approve' => '0', 'module' => 'part'])->groupby('user_id')->count();
    	$approve_photo = Photo::find()->where(['is_approve' => '0'])->count();
    	$approve_reportphoto = Report::findBySql("select * from report as r INNER JOIN photo as p ON r.objectId=p.id where status = :status and module = :module group by objectId",array(':status'=>'waiting',':module'=>'photo'))->all();
    	$approve_reportphoto = count($approve_reportphoto);
    	$approve_reportcomment = Report::findBySql("select * from report as r INNER JOIN photo_comment as p ON r.objectId=p.id where status = :status and module = :module group by objectId",array(':status'=>'waiting',':module'=>'comment'))->all();
    	$approve_reportcomment = count($approve_reportcomment);
    	$approve_open = UserUpload::find()->where(['is_approve' => '0', 'module' => 'open'])->count();
    	$approve_private = UserUpload::find()->where(['is_approve' => '0', 'module' => 'private'])->count();
    	
    	return $this->render('index', [
    			'approve_avatar' => $approve_avatar,
    			'approve_car' => $approve_car,
    			'approve_unmakeup' => $approve_unmakeup,
    			'approve_video' => $approve_video,
    			'approve_id' => $approve_id,
    			'approve_part' => $approve_part,
    			'approve_photo' => $approve_photo,
    			'approve_reportphoto' => $approve_reportphoto,
    			'approve_reportcomment' => $approve_reportcomment,
    			'approve_open' => $approve_open,
    			'approve_private' => $approve_private,
    			]);
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        
        $model = new LoginForm();
        if (isset($_POST['LoginForm']['checkcode'])) {
        	if ($_SESSION["verification"] <> md5($_POST['LoginForm']['checkcode'])) {
        		return $this->render('login', [
        				'model' => $model,
        				]);
        	}
        }
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } elseif (Yii::$app->getUser()->getReturnUrl()=="/count/daycount") {
        	$model->autologin();
        	return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        
        return $this->goHome();
    }
}
