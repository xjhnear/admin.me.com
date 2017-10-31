<?php

namespace backend\controllers;

use backend\models\DiamondOrder;

use Yii;
use backend\models\CountHtml;
use backend\models\User;
use backend\models\AccessLog;
use backend\models\LogReport;
use backend\models\UserReport;
use backend\models\ProdLog;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\PHPExcel;

/**
 * ConfigController implements the CRUD actions for Config model.
 */
require_once dirname(dirname(__FILE__)).'/web/excel/PHPExcel.php';

class CountController extends Controller
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
    	
    	$dist_arr = array(
    			"cxy"=>"程序猿",
    			"tsd"=>"魔都探索队",
    			"csh"=>"上海潮生活",
    			"shq"=>"上海生活圈",
    			"ttbb"=>"上海头条播报",
    			"ygb"=>"文案摇滚帮",
    			"s"=>"S姐",
    			"enjoy"=>"enjoy上海",
    			"ala"=>"阿拉上海",
    			"fx"=>"发现上海",
    			"md"=>"魔都头条",
    			"st"=>"上海事体",
    			"tt"=>"上海头条",
    			"zuimei"=>"最美上海",
    			"yingshi"=>"萤石",
    			"nrz"=>"男人装",
    			"missnow"=>"思念体",
    			"uber"=>"uber",
    			"xy"=>"小野妹子学吐槽",
    			"shf"=>"一起神回复",
    			"stc"=>"一起神吐槽",
    			"tjl"=>"神店通缉令",
    			"xmj"=>"回忆专用小马甲",
    			"bgzy"=>"八哥专用",
    			"zj"=>"Happy张江",
    			"lxhjx"=>"冷笑话精选",
    			"ygbj"=>"英国报姐",
    			"ldgym"=>"镰刀刮腋毛",
    			"lz"=>"龙珠",
    			"bilibili"=>"B站",
    			"panda"=>"熊猫TV",
    			"daddy"=>"叫爸爸",
    			);
    	$names = CountHtml::findBySql("select distinct(name) as c from log.count_html ")->all();
    	$names_arr = array();
    	$data_day = array();
    	$data_time = array();
    	$na = "";
    	foreach ($names as $name) {
    		$names_arr[] = $name->c;
    	}
    	$names_arr = array_reverse($names_arr);
    	
    	if (isset($_POST['name'])) {
    		$na = $_POST['name'];
    	} elseif (isset($names_arr[0])) {
    		$na = $names_arr[0];
    	}
    	
//     	if ($na <> "") {
//     		$data_day = CountHtml::findBySql('select date_format(created,"%Y-%m-%d") AS d, COUNT(id) AS c, module, submod from count_html where name = :name GROUP BY d ORDER BY d DESC ',array(':name'=>$na))->all();
//     		$data_time = CountHtml::findBySql('select date_format(created,"%H") AS d, COUNT(id) AS c, module, submod from count_html where name = :name AND created>= :today GROUP BY d ORDER BY d DESC ',array(':name'=>$na, ':today'=>date('Y-m-d 00:00:00') ))->all();
//     	}

    	$data_all = CountHtml::findBySql('select COUNT(id) AS c, submod AS d, DATE_FORMAT(created,"%Y-%m-%d") AS e from log.count_html where name = :name and module = "show" GROUP BY submod,DATE_FORMAT(created,"%Y-%m-%d") ORDER BY d,e DESC ',array(':name'=>$na))->all();
    	$down_all = CountHtml::findBySql('select COUNT(id) AS c, submod AS d, DATE_FORMAT(created,"%Y-%m-%d") AS e from log.count_html where name = :name and module = "download" GROUP BY submod,DATE_FORMAT(created,"%Y-%m-%d") ORDER BY d,e DESC ',array(':name'=>$na))->all();
    	$diamond_order_all = CountHtml::findBySql('SELECT DATE_FORMAT(created,"%Y-%m-%d") AS c,COUNT(user_id) AS d FROM diamond_order WHERE status ="success" AND created >="2016-01-01 00:00:00" GROUP BY DATE_FORMAT(created,"%Y-%m-%d")')->all();
    	$diamond_order_rmb = CountHtml::findBySql('SELECT DATE_FORMAT(created,"%Y-%m-%d") AS c,SUM(rmb) AS d FROM diamond_order WHERE status ="success" AND created >="2016-01-01 00:00:00" GROUP BY DATE_FORMAT(created,"%Y-%m-%d")')->all();
    	$diamond_order_user = CountHtml::findBySql('SELECT d, COUNT(c) as e FROM (SELECT DATE_FORMAT(created,"%Y-%m-%d") AS d ,user_id,COUNT(user_id) AS c  FROM diamond_order WHERE status ="success" AND created >="2016-01-01 00:00:00" GROUP BY DATE_FORMAT(created,"%Y-%m-%d"),user_id) AS d GROUP BY d ')->all();
    	
    	$diamond_order_diamond_all = CountHtml::findBySql('SELECT DATE_FORMAT(created,"%Y-%m-%d") AS d ,diamond as e,COUNT(user_id) AS c  FROM diamond_order WHERE status ="success" AND created >="2016-01-01 00:00:00" GROUP BY DATE_FORMAT(created,"%Y-%m-%d"),diamond')->all();
    	$diamond_order_diamond_user = CountHtml::findBySql('SELECT d,diamond as c, COUNT(c) as e FROM (SELECT DATE_FORMAT(created,"%Y-%m-%d") AS d ,diamond,COUNT(user_id) AS c  FROM diamond_order WHERE status ="success" AND created >="2016-01-01 00:00:00" GROUP BY DATE_FORMAT(created,"%Y-%m-%d"),diamond,user_id) AS d GROUP BY d,diamond')->all();
    	
        return $this->render('index', [
        	'na' => $na,
            'names' => $names_arr,
//          'data_day' => $data_day,
//         	'data_time' => $data_time,
        	'data_all' => $data_all,
        	'down_all' => $down_all,
        	'dist_arr' => $dist_arr,
        	'diamond_order_all' => $diamond_order_all,
        	'diamond_order_user' => $diamond_order_user,
        	'diamond_order_rmb' => $diamond_order_rmb,
        	'diamond_order_diamond_all' => $diamond_order_diamond_all,
        	'diamond_order_diamond_user' => $diamond_order_diamond_user,
        ]);
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
        if (($model = CountHtml::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionReport()
    {
    	if (isset($_GET['t'])) {
    		$t = explode(' - ', $_GET['t']);
    	} else {
    		$t = array(date("Y-m-d",time()-30*24*60*60),date('Y-m-d'));
    	}

    	//用户情况分析
    	$user_utype = CountHtml::findBySql('SELECT utype AS c,COUNT(*) AS d FROM user GROUP BY utype')->all();
    	$device_os = CountHtml::findBySql('SELECT os AS c,COUNT(*) AS d FROM device GROUP BY os')->all();
    	$data_user = array(
    			'user_utype' => $user_utype,
    			'device_os' => $device_os,
    			);
    	
    	//留存流失分析
    	$data = LogReport::find()->where('daytime>="'.$t[0].'" and daytime<="'.$t[1].'"')->orderBy("daytime desc")->all();
     	//新增用户分时
    	$userdata = UserReport::find()->where('daytime>="'.$t[0].'" and daytime<="'.$t[1].'"')->orderBy("daytime desc")->all();
     	
     	//充值情况分析
     	$diamond_order_all = CountHtml::findBySql('SELECT DATE_FORMAT(created,"%Y-%m-%d") AS c,COUNT(user_id) AS d FROM diamond_order WHERE status ="success" AND created >="'.$t[0].' 00:00:00" and created<="'.$t[1].' 23:59:59" GROUP BY DATE_FORMAT(created,"%Y-%m-%d")')->all();
     	$diamond_order_rmb = CountHtml::findBySql('SELECT DATE_FORMAT(created,"%Y-%m-%d") AS c,SUM(rmb) AS d FROM diamond_order WHERE status ="success" AND created >="'.$t[0].' 00:00:00" and created<="'.$t[1].' 23:59:59" GROUP BY DATE_FORMAT(created,"%Y-%m-%d")')->all();
     	$diamond_order_user = CountHtml::findBySql('SELECT d, COUNT(c) as e FROM (SELECT DATE_FORMAT(created,"%Y-%m-%d") AS d ,user_id,COUNT(user_id) AS c  FROM diamond_order WHERE status ="success" AND created >="'.$t[0].' 00:00:00" and created<="'.$t[1].' 23:59:59" GROUP BY DATE_FORMAT(created,"%Y-%m-%d"),user_id) AS d GROUP BY d ')->all();
     	$diamond_order_diamond_all = CountHtml::findBySql('SELECT DATE_FORMAT(created,"%Y-%m-%d") AS d ,diamond as e,COUNT(user_id) AS c  FROM diamond_order WHERE status ="success" AND created >="'.$t[0].' 00:00:00" and created<="'.$t[1].' 23:59:59" GROUP BY DATE_FORMAT(created,"%Y-%m-%d"),diamond')->all();
     	$diamond_order_diamond_user = CountHtml::findBySql('SELECT d,diamond as c, COUNT(c) as e FROM (SELECT DATE_FORMAT(created,"%Y-%m-%d") AS d ,diamond,COUNT(user_id) AS c  FROM diamond_order WHERE status ="success" AND created >="'.$t[0].' 00:00:00" and created<="'.$t[1].' 23:59:59" GROUP BY DATE_FORMAT(created,"%Y-%m-%d"),diamond,user_id) AS d GROUP BY d,diamond')->all();
     	$data_diamond = array(
     			'diamond_order_all' => $diamond_order_all,
     			'diamond_order_rmb' => $diamond_order_rmb,
     			'diamond_order_user' => $diamond_order_user,
     			'diamond_order_diamond_all' => $diamond_order_diamond_all,
     			'diamond_order_diamond_user' => $diamond_order_diamond_user,
     			);
     	
     	//收益情况分析
     	$diamond_history_type = CountHtml::findBySql('SELECT type AS c,COUNT(user_id) AS d,SUM(diamond) AS e FROM diamond_history AS h INNER JOIN user AS u ON h.user_id=u.id WHERE (`status`="success" OR `status`="unfreeze" OR `status`="invited") AND utype=4 AND h.created >="'.$t[0].' 00:00:00" and h.created<="'.$t[1].' 23:59:59" GROUP BY type')->all();
     	$data_history = array(
     			'diamond_history_type' => $diamond_history_type,
     	);
     	
    	return $this->render('report', [
    			'data' => $data,
    			'userdata' => $userdata,
    			'data_diamond' => $data_diamond,
    			'data_user' => $data_user,
    			'data_history' => $data_history,
    			]);
    	
    }

    
    public function actionDaycount()
    {
    	if (isset($_GET['t'])) {
    		$t = $_GET['t'];
    	} else {
    		$t = date('Y-m-d');
    	}
		$model_LogReport = new LogReport();

    	$checkday = date("Y-m-d",strtotime($t)-24*60*60);
    	$checkday2 = date("Y-m-d",strtotime($t)-2*24*60*60);
    	$checkday7 = date("Y-m-d",strtotime($t)-7*24*60*60);
    	$checkday30 = date("Y-m-d",strtotime($t)-30*24*60*60);
    	
    	$model_LogReport->daytime = $checkday;
    	$model_LogReport->created = date("Y-m-d H:i:s",time());
//     	$user_all = User::find()->count();
    	$model_LogReport->user_today = User::find()->where('created>="'.$checkday.' 00:00:00" and created<="'.$checkday.' 23:59:59"')->count();
    	$model_LogReport->user_2day = User::find()->where('created>="'.$checkday2.' 00:00:00" and created<="'.$checkday2.' 23:59:59"')->count();
    	$model_LogReport->user_7day = User::find()->where('created>="'.$checkday7.' 00:00:00" and created<="'.$checkday7.' 23:59:59"')->count();
    	$model_LogReport->user_30day = User::find()->where('created>="'.$checkday30.' 00:00:00" and created<="'.$checkday30.' 23:59:59"')->count();
    	
    	$model_LogReport->photo_today = ProdLog::find()->join('INNER JOIN', 'user', 'user.id=prod_log.user_id')->where('controller="photo" and user.created>="'.$checkday.' 00:00:00" and user.created<="'.$checkday.' 23:59:59" and prod_log.created>="'.$checkday.' 00:00:00" and prod_log.created<="'.$checkday.' 23:59:59"')->groupby('user_id')->count();
    	
    	$model_LogReport->login_today = ProdLog::find()->where('controller="oapi" and action="config" and user_id>0 and created>="'.$checkday.' 00:00:00" and created<="'.$checkday.' 23:59:59"')->groupby('user_id')->count();
    	$model_LogReport->login_old_today = ProdLog::find()->join('INNER JOIN', 'user', 'user.id=prod_log.user_id')->where('controller="oapi" and action="config" and user_id>0 and prod_log.created>="'.$checkday.' 00:00:00" and prod_log.created<="'.$checkday.' 23:59:59" and user.created<"'.$checkday.' 00:00:00"')->groupby('user_id')->count();
    	
    	$model_LogReport->login_old_2d = ProdLog::find()->join('INNER JOIN', 'user', 'user.id=prod_log.user_id')->where('controller="oapi" and action="config" and user_id>0 and prod_log.created>="'.$checkday.' 00:00:00" and prod_log.created<="'.$checkday.' 23:59:59" and user.created>="'.$checkday2.' 00:00:00" and user.created<="'.$checkday2.' 23:59:59"')->groupby('user_id')->count();    	
//     	$login_old_7d = ProdLog::find()->join('INNER JOIN', 'user', 'user.id=prod_log.user_id')->where('controller="oapi" and action="config" and prod_log.created>="'.$checkday7.' 00:00:00" and prod_log.created<="'.$checkday.' 23:59:59" and user.created>="'.$checkday7.' 00:00:00" and user.created<="'.$checkday7.' 23:59:59"')->groupby('user_id, created')->all();
//     	$login_old_30d = ProdLog::find()->join('INNER JOIN', 'user', 'user.id=prod_log.user_id')->where('controller="oapi" and action="config" and prod_log.created>="'.$checkday30.' 00:00:00" and prod_log.created<="'.$checkday.' 23:59:59" and user.created>="'.$checkday30.' 00:00:00" and user.created<="'.$checkday30.' 23:59:59"')->groupby('user_id, created')->count();
    	$model_LogReport->login_old_7d = ProdLog::findBySql('SELECT user_id, count(*) AS c FROM ( SELECT count(*) ,user_id ,DATE_FORMAT(a.created,"%Y-%m-%d") FROM log.prod_log AS a INNER JOIN `user` AS u ON a.user_id=u.id WHERE controller="oapi" and action="config" and user_id>0 and a.created>="'.$checkday7.' 00:00:00" and a.created<="'.$checkday.' 23:59:59" and u.created>="'.$checkday7.' 00:00:00" and u.created<="'.$checkday7.' 23:59:59" GROUP BY user_id ,DATE_FORMAT(a.created,"%Y-%m-%d") ) as c GROUP BY user_id HAVING c>=3')->count();
    	$model_LogReport->login_old_30d = ProdLog::findBySql('SELECT user_id, count(*) AS c FROM ( SELECT count(*) ,user_id ,DATE_FORMAT(a.created,"%Y-%m-%d") FROM log.prod_log AS a INNER JOIN `user` AS u ON a.user_id=u.id WHERE controller="oapi" and action="config" and user_id>0 and a.created>="'.$checkday30.' 00:00:00" and a.created<="'.$checkday.' 23:59:59" and u.created>="'.$checkday30.' 00:00:00" and u.created<="'.$checkday30.' 23:59:59" GROUP BY user_id ,DATE_FORMAT(a.created,"%Y-%m-%d") ) as c GROUP BY user_id HAVING c>=15')->count();
    	
    	$model_LogReport->start_udid = ProdLog::find()->join('INNER JOIN', 'device', 'device.udid=prod_log.post')->where('controller="oapi" and action="config" and prod_log.created>="'.$checkday.' 00:00:00" and prod_log.created<="'.$checkday.' 23:59:59" and device.created>="'.$checkday.' 00:00:00" and device.created<="'.$checkday.' 23:59:59"')->groupby('post')->count();
    	$model_LogReport->send_udid = ProdLog::find()->join('INNER JOIN', 'user', 'user.mobile=prod_log.post')->where('controller="oapi" and action="signup" and extra="send" and prod_log.created>="'.$checkday.' 00:00:00" and prod_log.created<="'.$checkday.' 23:59:59" and user.created>="'.$checkday.' 00:00:00" and user.created<="'.$checkday.' 23:59:59"')->groupby('post')->count();
    	$model_LogReport->verify_udid = ProdLog::find()->join('INNER JOIN', 'user', 'user.mobile=prod_log.post')->where('controller="oapi" and action="signup" and extra="verify" and prod_log.created>="'.$checkday.' 00:00:00" and prod_log.created<="'.$checkday.' 23:59:59" and user.created>="'.$checkday.' 00:00:00" and user.created<="'.$checkday.' 23:59:59"')->groupby('post')->count();
		
    	$model_LogReport->password_udid = ProdLog::find()->join('INNER JOIN', 'user', 'user.id=prod_log.user_id')->where('controller="userapi" and action="update" and extra="password" and user.created>="'.$checkday.' 00:00:00" and user.created<="'.$checkday.' 23:59:59" and prod_log.created>="'.$checkday.' 00:00:00" and prod_log.created<="'.$checkday.' 23:59:59"')->groupby('user_id')->count();
    	$model_LogReport->utype_udid = ProdLog::find()->join('INNER JOIN', 'user', 'user.id=prod_log.user_id')->where('controller="userapi" and action="update" and extra="utype" and user.created>="'.$checkday.' 00:00:00" and user.created<="'.$checkday.' 23:59:59" and prod_log.created>="'.$checkday.' 00:00:00" and prod_log.created<="'.$checkday.' 23:59:59"')->groupby('user_id')->count();
    	$model_LogReport->nickname_udid = ProdLog::find()->join('INNER JOIN', 'user', 'user.id=prod_log.user_id')->where('controller="userapi" and action="update" and extra="nickname" and user.created>="'.$checkday.' 00:00:00" and user.created<="'.$checkday.' 23:59:59" and prod_log.created>="'.$checkday.' 00:00:00" and prod_log.created<="'.$checkday.' 23:59:59"')->groupby('user_id')->count();
    	$model_LogReport->birthday_udid = ProdLog::find()->join('INNER JOIN', 'user', 'user.id=prod_log.user_id')->where('controller="userapi" and action="update" and extra="birthday" and user.created>="'.$checkday.' 00:00:00" and user.created<="'.$checkday.' 23:59:59" and prod_log.created>="'.$checkday.' 00:00:00" and prod_log.created<="'.$checkday.' 23:59:59"')->groupby('user_id')->count();
    	
    	$model_LogReport->save();
    	
    	$model_UserReport = new UserReport();
    	$model_UserReport->daytime = $checkday;
    	$model_UserReport->created = date("Y-m-d H:i:s",time());
    	
    	$data = User::findBySql('SELECT DATE_FORMAT(created,"%H") AS created, count(*) AS qq FROM `user` WHERE created>="'.$checkday.' 00:00:00" and created<="'.$checkday.' 23:59:59" GROUP BY DATE_FORMAT(created,"%H")')->all();
    	foreach ($data as $item) {
    		$key = 'h'.$item->created;
    		$model_UserReport->$key = $item->qq;
    	}
    	$model_UserReport->save();
    	
    	echo date('Y-m-d H:i:s')."done!";exit;

    }
    
    public function actionUsercount()
    {
    	if (isset($_GET['t'])) {
    		$t = $_GET['t'];
    	} else {
    		$t = date('Y-m-d');
    	}
    
    	$checkday = date("Y-m-d",strtotime($t)-24*60*60);
    	 
    	$model_UserReport = new UserReport();
    	$model_UserReport->daytime = $checkday;
    	$model_UserReport->created = date("Y-m-d H:i:s",time());
    	 
    	$data = User::findBySql('SELECT DATE_FORMAT(created,"%H") AS created, count(*) AS qq FROM `user` WHERE created>="'.$checkday.' 00:00:00" and created<="'.$checkday.' 23:59:59" GROUP BY DATE_FORMAT(created,"%H")')->all();
    	foreach ($data as $item) {
    		$key = 'h'.$item->created;
    		$model_UserReport->$key = $item->qq;
    	}

    	$model_UserReport->save();
    	 
    	echo date('Y-m-d H:i:s')."done!";exit;
    
    }
    
    
    
    public function actionExportreport()
    {
    	if (!isset($_GET['t'])) {
    		return $this->render('com', [
    				'dataProfit' => array(),
    				]);
    	}
    	$t = explode(' - ', $_GET['t']);
    	//用户情况分析
    	$user_utype = CountHtml::findBySql('SELECT utype AS c,COUNT(*) AS d FROM user GROUP BY utype')->all();
    	$device_os = CountHtml::findBySql('SELECT os AS c,COUNT(*) AS d FROM device GROUP BY os')->all();
    	$data_user = array(
    			'user_utype' => $user_utype,
    			'device_os' => $device_os,
    			);
    	
    	//留存流失分析
    	$ldata = LogReport::find()->where('daytime>="'.$t[0].'" and daytime<="'.$t[1].'"')->orderBy("daytime desc")->all();
     	//新增用户分时
    	$userdata = UserReport::find()->where('daytime>="'.$t[0].'" and daytime<="'.$t[1].'"')->orderBy("daytime desc")->all();
     	
     	//充值情况分析
     	$diamond_order_all = CountHtml::findBySql('SELECT DATE_FORMAT(created,"%Y-%m-%d") AS c,COUNT(user_id) AS d FROM diamond_order WHERE status ="success" AND created >="'.$t[0].' 00:00:00" and created<="'.$t[1].' 23:59:59" GROUP BY DATE_FORMAT(created,"%Y-%m-%d")')->all();
     	$diamond_order_rmb = CountHtml::findBySql('SELECT DATE_FORMAT(created,"%Y-%m-%d") AS c,SUM(rmb) AS d FROM diamond_order WHERE status ="success" AND created >="'.$t[0].' 00:00:00" and created<="'.$t[1].' 23:59:59" GROUP BY DATE_FORMAT(created,"%Y-%m-%d")')->all();
     	$diamond_order_user = CountHtml::findBySql('SELECT d, COUNT(c) as e FROM (SELECT DATE_FORMAT(created,"%Y-%m-%d") AS d ,user_id,COUNT(user_id) AS c  FROM diamond_order WHERE status ="success" AND created >="'.$t[0].' 00:00:00" and created<="'.$t[1].' 23:59:59" GROUP BY DATE_FORMAT(created,"%Y-%m-%d"),user_id) AS d GROUP BY d ')->all();
     	$diamond_order_diamond_all = CountHtml::findBySql('SELECT DATE_FORMAT(created,"%Y-%m-%d") AS d ,diamond as e,COUNT(user_id) AS c  FROM diamond_order WHERE status ="success" AND created >="'.$t[0].' 00:00:00" and created<="'.$t[1].' 23:59:59" GROUP BY DATE_FORMAT(created,"%Y-%m-%d"),diamond')->all();
     	$diamond_order_diamond_user = CountHtml::findBySql('SELECT d,diamond as c, COUNT(c) as e FROM (SELECT DATE_FORMAT(created,"%Y-%m-%d") AS d ,diamond,COUNT(user_id) AS c  FROM diamond_order WHERE status ="success" AND created >="'.$t[0].' 00:00:00" and created<="'.$t[1].' 23:59:59" GROUP BY DATE_FORMAT(created,"%Y-%m-%d"),diamond,user_id) AS d GROUP BY d,diamond')->all();
     	$data_diamond = array(
     			'diamond_order_all' => $diamond_order_all,
     			'diamond_order_rmb' => $diamond_order_rmb,
     			'diamond_order_user' => $diamond_order_user,
     			'diamond_order_diamond_all' => $diamond_order_diamond_all,
     			'diamond_order_diamond_user' => $diamond_order_diamond_user,
     			);
     	
     	//收益情况分析
     	$diamond_history_type = CountHtml::findBySql('SELECT type AS c,COUNT(user_id) AS d,SUM(diamond) AS e FROM diamond_history AS h INNER JOIN user AS u ON h.user_id=u.id WHERE (`status`="success" OR `status`="unfreeze" OR `status`="invited") AND utype=4 AND h.created >="'.$t[0].' 00:00:00" and h.created<="'.$t[1].' 23:59:59" GROUP BY type')->all();
     	$data_history = array(
     			'diamond_history_type' => $diamond_history_type,
     	);
     	
    	$objPHPExcel = new \PHPExcel();
    	//设置属性
    	$objPHPExcel->getProperties()->setCreator(Yii::$app->user->identity->username)
    	->setLastModifiedBy(Yii::$app->user->identity->username)
    	->setTitle("Report")
    	->setSubject("")
    	->setDescription("")
    	->setKeywords("")
    	->setCategory("");

    	$objPHPExcel->setActiveSheetIndex(0)
    	->setCellValue('A1', '注册用户性别分布：')
    	->setCellValue('A2', '#')
    	->setCellValue('B2', '性别')
    	->setCellValue('C2', '人数')
    	->setCellValue('F1', '设备用户平台分布：')
    	->setCellValue('F2', '#')
    	->setCellValue('G2', '平台')
    	->setCellValue('H2', '设备数')
    	;
    	$objPHPExcel->getActiveSheet()->mergeCells('A1:C1');
    	$objPHPExcel->getActiveSheet()->mergeCells('F1:H1');
    	$i = 3;
    	foreach ($user_utype as $data){
    		$objPHPExcel->setActiveSheetIndex(0)
    		->setCellValue('A'.$i, $i-1);
    		switch ($data->c) {
    			case 1:
    				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$i, "男");
    				break;
    			case 4:
    				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$i, "女");
    				break;
    			default:
    				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$i, "N/A");
    		}
    		$objPHPExcel->setActiveSheetIndex(0)
    		->setCellValue('C'.$i, $data->d)
    		;
    		$i++;
    	}
    	if ($i>3) {
    		$objPHPExcel->setActiveSheetIndex(0)
    		->setCellValue('A'.$i, '合计')
    		->setCellValue('B'.$i, '')
    		->setCellValue('C'.$i, '=SUM(C3:C'.($i-1).')')
    		;
    	}
    	
    	$i = 3;
    	foreach ($device_os as $data){
    		$objPHPExcel->setActiveSheetIndex(0)
    		->setCellValue('F'.$i, $i-1)
    		->setCellValue('G'.$i, $data->c?:"N/A")
    		->setCellValue('H'.$i, $data->d)
    		;
    		$i++;
    	}
    	if ($i>3) {
    		$objPHPExcel->setActiveSheetIndex(0)
    		->setCellValue('F'.$i, '合计')
    		->setCellValue('G'.$i, '')
    		->setCellValue('H'.$i, '=SUM(H3:H'.($i-1).')')
    		;
    	}
    	
    	$objPHPExcel->getActiveSheet()->setTitle('用户情况分析');
    	 
    	$msgWorkSheet = new \PHPExcel_Worksheet($objPHPExcel, '留存流失分析');
    	$objPHPExcel->addSheet($msgWorkSheet); //插入工作表
    	$objPHPExcel->setActiveSheetIndex(1)
    	->setCellValue('A1', '#')
    	->setCellValue('B1', '日期')
    	->setCellValue('C1', '新增用户')
    	->setCellValue('D1', '登陆用户')
    	->setCellValue('E1', '老用户登陆')
    	->setCellValue('F1', '次日留存')
    	->setCellValue('G1', '七日留存')
    	->setCellValue('H1', '月留存')
    	->setCellValue('I1', '注册成功率')
    	->setCellValue('J1', '启动页流失率')
    	->setCellValue('K1', '手机号界面流失率')
    	->setCellValue('L1', '验证码界面流失率')
    	->setCellValue('M1', '密码界面流失率')
    	->setCellValue('N1', '账号类型界面流失率')
    	->setCellValue('O1', '昵称界面流失率')
    	->setCellValue('P1', '基本信息界面流失率')
    	;
    	$i = 2;
    	foreach ($ldata as $data){
    		$objPHPExcel->setActiveSheetIndex(1)
    		->setCellValue('A'.$i, $i-1)
    		->setCellValue('B'.$i, $data->daytime)
    		->setCellValue('C'.$i, $data->user_today)
    		->setCellValue('D'.$i, ($data->user_today + $data->login_old_today))
    		->setCellValue('E'.$i, $data->login_old_today);
			if ($data->user_2day>0) {
				$objPHPExcel->setActiveSheetIndex(1)->setCellValue('F'.$i, round(($data->login_old_2d/$data->user_2day)*100).'% ('.$data->login_old_2d.'/'.$data->user_2day.')');
			} else {
				$objPHPExcel->setActiveSheetIndex(1)->setCellValue('F'.$i, "N/A");
			}
			if ($data->user_7day>0) {
				$objPHPExcel->setActiveSheetIndex(1)->setCellValue('G'.$i, round(($data->login_old_7d/$data->user_7day)*100).'% ('.$data->login_old_7d.'/'.$data->user_7day.')');
			} else {
				$objPHPExcel->setActiveSheetIndex(1)->setCellValue('G'.$i, "N/A");
			}
			if ($data->user_30day>0) {
				$objPHPExcel->setActiveSheetIndex(1)->setCellValue('H'.$i, round(($data->login_old_30d/$data->user_30day)*100).'% ('.$data->login_old_30d.'/'.$data->user_30day.')');
			} else {
				$objPHPExcel->setActiveSheetIndex(1)->setCellValue('H'.$i, "N/A");
			}
			if ($data->start_udid>0) {
				$objPHPExcel->setActiveSheetIndex(1)
				->setCellValue('I'.$i, round(($data->user_today/$data->start_udid)*100).'% ('.$data->user_today.'/'.$data->start_udid.')')
				->setCellValue('J'.$i, round((($data->start_udid-$data->send_udid)/$data->start_udid)*100).'% ('.$data->start_udid.')')
				->setCellValue('K'.$i, round((($data->send_udid-$data->verify_udid)/$data->start_udid)*100).'% ('.$data->send_udid.')')
				->setCellValue('L'.$i, round((($data->verify_udid-$data->password_udid)/$data->start_udid)*100).'% ('.$data->verify_udid.')')
				->setCellValue('M'.$i, round((($data->password_udid-$data->utype_udid)/$data->start_udid)*100).'% ('.$data->password_udid.')')
				->setCellValue('N'.$i, round((($data->utype_udid-$data->nickname_udid)/$data->start_udid)*100).'% ('.$data->utype_udid.')')
				->setCellValue('O'.$i, round((($data->nickname_udid-$data->birthday_udid)/$data->start_udid)*100).'% ('.$data->nickname_udid.')')
				->setCellValue('P'.$i, round((($data->birthday_udid-$data->photo_today)/$data->start_udid)*100).'% ('.$data->birthday_udid.')')
				;
			} else {
				$objPHPExcel->setActiveSheetIndex(1)
				->setCellValue('I'.$i, "N/A")
				->setCellValue('J'.$i, "N/A")
				->setCellValue('K'.$i, "N/A")
				->setCellValue('L'.$i, "N/A")
				->setCellValue('M'.$i, "N/A")
				->setCellValue('N'.$i, "N/A")
				->setCellValue('O'.$i, "N/A")
				->setCellValue('P'.$i, "N/A")
				;
			}
    		
    		$i++;
    	}
    	
    	$msgWorkSheet = new \PHPExcel_Worksheet($objPHPExcel, '新增用户分时');
    	$objPHPExcel->addSheet($msgWorkSheet); //插入工作表
    	$objPHPExcel->setActiveSheetIndex(2)
    	->setCellValue('A1', '#')
    	->setCellValue('B1', '日期')
    	->setCellValue('C1', '00')
    	->setCellValue('D1', '01')
    	->setCellValue('E1', '02')
    	->setCellValue('F1', '03')
    	->setCellValue('G1', '04')
    	->setCellValue('H1', '05')
    	->setCellValue('I1', '06')
    	->setCellValue('J1', '07')
    	->setCellValue('K1', '08')
    	->setCellValue('L1', '09')
    	->setCellValue('M1', '10')
    	->setCellValue('N1', '11')
    	->setCellValue('O1', '12')
    	->setCellValue('P1', '13')
    	->setCellValue('Q1', '14')
    	->setCellValue('R1', '15')
    	->setCellValue('S1', '16')
    	->setCellValue('T1', '17')
    	->setCellValue('U1', '18')
    	->setCellValue('V1', '19')
    	->setCellValue('W1', '20')
    	->setCellValue('X1', '21')
    	->setCellValue('Y1', '22')
    	->setCellValue('Z1', '23')
    	;
    	$i = 2;
    	foreach ($userdata as $data){
    		$objPHPExcel->setActiveSheetIndex(2)
    		->setCellValue('A'.$i, $i-1)
    		->setCellValue('B'.$i, $data->daytime)
    		->setCellValue('C'.$i, $data->h00)
    		->setCellValue('D'.$i, $data->h01)
    		->setCellValue('E'.$i, $data->h02)
    		->setCellValue('F'.$i, $data->h03)
    		->setCellValue('G'.$i, $data->h04)
    		->setCellValue('H'.$i, $data->h05)
    		->setCellValue('I'.$i, $data->h06)
    		->setCellValue('J'.$i, $data->h07)
    		->setCellValue('K'.$i, $data->h08)
    		->setCellValue('L'.$i, $data->h09)
    		->setCellValue('M'.$i, $data->h10)
    		->setCellValue('N'.$i, $data->h11)
    		->setCellValue('O'.$i, $data->h12)
    		->setCellValue('P'.$i, $data->h13)
    		->setCellValue('Q'.$i, $data->h14)
    		->setCellValue('R'.$i, $data->h15)
    		->setCellValue('S'.$i, $data->h16)
    		->setCellValue('T'.$i, $data->h17)
    		->setCellValue('U'.$i, $data->h18)
    		->setCellValue('V'.$i, $data->h19)
    		->setCellValue('W'.$i, $data->h20)
    		->setCellValue('X'.$i, $data->h21)
    		->setCellValue('Y'.$i, $data->h22)
    		->setCellValue('Z'.$i, $data->h23)
    		;
    		
    		$i++;
    	}
    	
    	$msgWorkSheet = new \PHPExcel_Worksheet($objPHPExcel, '充值情况分析');
    	$objPHPExcel->addSheet($msgWorkSheet); //插入工作表
    	$objPHPExcel->setActiveSheetIndex(3)
    	->setCellValue('A1', '每天充值成功次数：')
    	->setCellValue('A2', '#')
    	->setCellValue('B2', '日期')
    	->setCellValue('C2', '充值成功次数')
    	->setCellValue('F1', '每天充值成功人数：')
    	->setCellValue('F2', '#')
    	->setCellValue('G2', '日期')
    	->setCellValue('H2', '充值成功人数')
    	->setCellValue('K1', '每天充值总金额：')
    	->setCellValue('K2', '#')
    	->setCellValue('L2', '日期')
    	->setCellValue('M2', '充值总金额')
    	->setCellValue('P1', '每天每个档次充值总次数：')
    	->setCellValue('P2', '#')
    	->setCellValue('Q2', '日期')
    	->setCellValue('R2', '充值档次')
    	->setCellValue('S2', '充值总次数')
    	->setCellValue('T2', '充值总金额')
    	->setCellValue('W1', '每天每个档次充值总人数：')
    	->setCellValue('W2', '#')
    	->setCellValue('X2', '日期')
    	->setCellValue('Y2', '充值档次')
    	->setCellValue('Z2', '充值总人数')
    	;
    	$objPHPExcel->getActiveSheet()->mergeCells('A1:C1');
    	$objPHPExcel->getActiveSheet()->mergeCells('F1:H1');
    	$objPHPExcel->getActiveSheet()->mergeCells('K1:M1');
    	$objPHPExcel->getActiveSheet()->mergeCells('P1:T1');
    	$objPHPExcel->getActiveSheet()->mergeCells('W1:Z1');
    	$i = 3;
    	foreach ($diamond_order_all as $data){
    		$objPHPExcel->setActiveSheetIndex(3)
    		->setCellValue('A'.$i, $i-1)
    		->setCellValue('B'.$i, $data->c)
    		->setCellValue('C'.$i, $data->d)
    		;
    		$i++;
    	}
    	$i = 3;
    	foreach ($diamond_order_user as $data){
    		$objPHPExcel->setActiveSheetIndex(3)
    		->setCellValue('F'.$i, $i-1)
    		->setCellValue('G'.$i, $data->d)
    		->setCellValue('H'.$i, $data->e)
    		;
    		$i++;
    	}
    	$i = 3;
    	foreach ($diamond_order_rmb as $data){
    		$objPHPExcel->setActiveSheetIndex(3)
    		->setCellValue('K'.$i, $i-1)
    		->setCellValue('L'.$i, $data->c)
    		->setCellValue('M'.$i, $data->d)
    		;
    		$i++;
    	}
    	$i = 3;
    	foreach ($diamond_order_diamond_all as $data){
    		$objPHPExcel->setActiveSheetIndex(3)
    		->setCellValue('P'.$i, $i-1)
    		->setCellValue('Q'.$i, $data->d)
    		->setCellValue('R'.$i, $data->e)
    		->setCellValue('S'.$i, $data->c)
    		->setCellValue('T'.$i, ($data->e * $data->c)/10)
    		;
    		$i++;
    	}
    	$i = 3;
    	foreach ($diamond_order_diamond_user as $data){
    		$objPHPExcel->setActiveSheetIndex(3)
    		->setCellValue('W'.$i, $i-1)
    		->setCellValue('X'.$i, $data->d)
    		->setCellValue('Y'.$i, $data->c)
    		->setCellValue('Z'.$i, $data->e)
    		;
    		$i++;
    	}
    	
    	$msgWorkSheet = new \PHPExcel_Worksheet($objPHPExcel, '收益情况分析');
    	$objPHPExcel->addSheet($msgWorkSheet); //插入工作表
    	$objPHPExcel->setActiveSheetIndex(4)
    	->setCellValue('A1', '获得收益途径分布：')
    	->setCellValue('A2', '#')
    	->setCellValue('B2', '获得收益途径')
    	->setCellValue('C2', '次数')
    	->setCellValue('D2', '总金额')
    	;
    	$objPHPExcel->getActiveSheet()->mergeCells('A1:D1');
    	$i = 3;
    	foreach ($diamond_history_type as $data){
    		$objPHPExcel->setActiveSheetIndex(4)
    		->setCellValue('A'.$i, $i-1)
    		->setCellValue('B'.$i, Yii::$app->params['diamond_history_type'][$data->c])
    		->setCellValue('C'.$i, $data->d)
    		->setCellValue('D'.$i, $data->e/10)
    		;
    		$i++;
    	}
    	
    	// Set active sheet index to the first sheet, so Excel opens this as the first sheet
    	$objPHPExcel->setActiveSheetIndex(0);
    
    	// Redirect output to a client’s web browser (Excel5)
    	header('Content-Type: application/vnd.ms-excel;charset=utf-8');
    	header('Content-Disposition: attachment;filename="Report.xls"');
    	header('Cache-Control: max-age=0');
    	$objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
    	$objWriter->save('php://output');
    	exit;
    }
    
}
