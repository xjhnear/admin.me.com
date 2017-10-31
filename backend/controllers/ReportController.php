<?php

namespace backend\controllers;

use Yii;
use backend\models\DiamondOrderSearch;
use backend\models\DiamondhistorySearch;
use backend\models\DiamondOrder;
use backend\models\Diamondhistory;
use backend\models\Withdraw;
use backend\models\PHPExcel;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ConfigController implements the CRUD actions for Config model.
 */
require_once dirname(dirname(__FILE__)).'/web/excel/PHPExcel.php';

class ReportController extends Controller
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
    	$this->redirect('boss');
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
    
    public function actionBoss()
    {
//         $DiamondOrderModel = new DiamondOrderSearch();
//         $dataDiamondOrder = $DiamondOrderModel->search(Yii::$app->request->queryParams);
        
//         $DiamondhistoryModel = new DiamondhistorySearch();
//         $dataDiamondhistory = $DiamondhistoryModel->search(Yii::$app->request->queryParams);

    	if (!isset($_GET['t'])) {
	        return $this->render('boss', [
	            'dataDiamondOrder' => array(),
	        	'dataDiamondhistory' => array(),
	        ]);
    	}
    	$t = explode(' - ', $_GET['t']);
        $dataDiamondOrder = DiamondOrder::find()->join('INNER JOIN', 'user', 'user.id=diamond_order.user_id')->where('(status = "success" or status = "refund") and user.utype=1 and diamond_order.created>="'.$t[0].' 00:00:00" and diamond_order.created<="'.$t[1].' 23:59:59"')->orderby('diamond_order.created desc')->all();
        $dataDiamondhistory = Diamondhistory::find()->join('INNER JOIN', 'user', 'user.id=diamond_history.user_id')->where('(status = "success" or status = "unfreeze") and user.utype=1 and diamond_history.created>="'.$t[0].' 00:00:00" and diamond_history.created<="'.$t[1].' 23:59:59"')->orderby('diamond_history.created desc')->all();
                
        return $this->render('boss', [
            'dataDiamondOrder' => $dataDiamondOrder,
        	'dataDiamondhistory' => $dataDiamondhistory,
        ]);
    }
    
    public function actionLady()
    {
    	if (!isset($_GET['t'])) {
    		return $this->render('lady', [
    				'dataDiamondhistory' => array(),
    				'dataWithdraw' => array(),
    				]);
    	}
    	$t = explode(' - ', $_GET['t']);
    	$dataDiamondhistory = Diamondhistory::find()->join('INNER JOIN', 'user', 'user.id=diamond_history.user_id')->where('(status = "success" or status = "unfreeze" or status = "invited") and user.utype=4 and diamond_history.created>="'.$t[0].' 00:00:00" and diamond_history.created<="'.$t[1].' 23:59:59"')->orderby('diamond_history.created desc')->all();
    	$dataWithdraw = Withdraw::find()->join('INNER JOIN', 'user', 'user.id=withdraw.user_id')->where('(status = "success") and user.utype=4 and withdraw.created>="'.$t[0].' 00:00:00" and withdraw.created<="'.$t[1].' 23:59:59"')->orderby('withdraw.created desc')->all();
    	
    	return $this->render('lady', [
    			'dataDiamondhistory' => $dataDiamondhistory,
    			'dataWithdraw' => $dataWithdraw,
    			]);
    }
    
    public function actionCom()
    {
    	if (!isset($_GET['t'])) {
    		return $this->render('com', [
    				'dataProfit' => array(),
    				'dataWithdraw' => array(),
    				]);
    	}
    	$t = explode(' - ', $_GET['t']);
    	$dataProfit = Diamondhistory::find()->join('INNER JOIN', 'user', 'user.id=diamond_history.user_id')->where('(status = "success" or status = "unfreeze" or status = "invited") and user.utype=4 and diamond_history.created>="'.$t[0].' 00:00:00" and diamond_history.created<="'.$t[1].' 23:59:59"')->orderby('diamond_history.created desc')->all();
    	$dataWithdraw = Withdraw::find()->join('INNER JOIN', 'user', 'user.id=withdraw.user_id')->where('(status = "success") and user.utype=4 and withdraw.created>="'.$t[0].' 00:00:00" and withdraw.created<="'.$t[1].' 23:59:59"')->orderby('withdraw.created desc')->all();
    	 
    	return $this->render('com', [
    			'dataProfit' => $dataProfit,
    			'dataWithdraw' => $dataWithdraw,
    			]);
    }
    
    public function actionExportboss()
    {
    	if (!isset($_GET['t'])) {
    		return $this->render('boss', [
    				'dataDiamondOrder' => array(),
    				'dataDiamondhistory' => array(),
    				]);
    	}
    	$t = explode(' - ', $_GET['t']);
        $dataDiamondOrder = DiamondOrder::find()->join('INNER JOIN', 'user', 'user.id=diamond_order.user_id')->where('(status = "success" or status = "refund") and user.utype=1 and diamond_order.created>="'.$t[0].' 00:00:00" and diamond_order.created<="'.$t[1].' 23:59:59"')->orderby('diamond_order.created desc')->all();
        $dataDiamondhistory = Diamondhistory::find()->join('INNER JOIN', 'user', 'user.id=diamond_history.user_id')->where('(status = "success" or status = "unfreeze") and user.utype=1 and diamond_history.created>="'.$t[0].' 00:00:00" and diamond_history.created<="'.$t[1].' 23:59:59"')->orderby('diamond_history.created desc')->all();
    	
    	$objPHPExcel = new \PHPExcel();
    	//设置属性
    	$objPHPExcel->getProperties()->setCreator(Yii::$app->user->identity->username)
    	->setLastModifiedBy(Yii::$app->user->identity->username)
    	->setTitle("Report of BOSS")
    	->setSubject("")
    	->setDescription("")
    	->setKeywords("")
    	->setCategory("");
    	
    	$objPHPExcel->setActiveSheetIndex(0)
    	->setCellValue('A1', '#')
    	->setCellValue('B1', '用户ID')
    	->setCellValue('C1', '用户昵称')
    	->setCellValue('D1', '支付方式')
    	->setCellValue('E1', '下单时间')
    	->setCellValue('F1', '充值钻石')
    	->setCellValue('G1', '充值人民币')
    	;
    	$i = 2;
    	foreach ($dataDiamondOrder as $data){
    		$objPHPExcel->setActiveSheetIndex(0)
    		->setCellValue('A'.$i, $i-1)
    		->setCellValue('B'.$i, $data->user_id.(in_array($data->user_id, Yii::$app->params['test_user'])?"(测)":""))
    		->setCellValue('C'.$i, $data->user->nickname)
    		->setCellValue('D'.$i, Yii::$app->params['diamond_order_payment_method'][$data->payment_method])
    		->setCellValue('E'.$i, $data->created)
    		->setCellValue('F'.$i, $data->diamond)
    		->setCellValue('G'.$i, $data->rmb)
    		;
    		$i++;
    	}
    	if ($i>2) {
    		$objPHPExcel->setActiveSheetIndex(0)
    		->setCellValue('A'.$i, '合计')
    		->setCellValue('B'.$i, '')
    		->setCellValue('C'.$i, '')
    		->setCellValue('D'.$i, '')
    		->setCellValue('E'.$i, '')
    		->setCellValue('F'.$i, '=SUM(F2:F'.($i-1).')')
    		->setCellValue('G'.$i, '=SUM(G2:G'.($i-1).')')
    		;
    	}
    	$objPHPExcel->getActiveSheet()->setTitle('DiamondOrder');

    	$msgWorkSheet = new \PHPExcel_Worksheet($objPHPExcel, 'Diamondhistory');
    	$objPHPExcel->addSheet($msgWorkSheet); //插入工作表
    	$objPHPExcel->setActiveSheetIndex(1)
    	->setCellValue('A1', '#')
    	->setCellValue('B1', '用户ID')
    	->setCellValue('C1', '用户昵称')
    	->setCellValue('D1', '打赏')
    	->setCellValue('E1', '约见')
    	->setCellValue('F1', '私房照查看')
    	->setCellValue('G1', '素颜认证查看')
    	->setCellValue('H1', '身材认证查看')
    	->setCellValue('I1', '时间')
    	;
    	$i = 2;
    	foreach ($dataDiamondhistory as $data){
    		$objPHPExcel->setActiveSheetIndex(1)
    		->setCellValue('A'.$i, $i-1)
    		->setCellValue('B'.$i, $data->user_id.(in_array($data->user_id, Yii::$app->params['test_user'])?"(测)":""))
    		->setCellValue('C'.$i, $data->user->nickname)
    		->setCellValue('D'.$i, $data->type=="comment"?$data->diamond*0.1:"")
    		->setCellValue('E'.$i, ($data->type=="see" || $data->type=="dating" || $data->type=="dating_timeout" || $data->type=="dating_cancel" || $data->type=="refund")?$data->diamond*0.1:"")
    		->setCellValue('F'.$i, $data->type=="private"?$data->diamond*0.1:"")
    		->setCellValue('G'.$i, $data->type=="unmakeup"?$data->diamond*0.1:"")
    		->setCellValue('H'.$i, $data->type=="part"?$data->diamond*0.1:"")
    		->setCellValue('I'.$i, $data->created)
    		;
    		$i++;
    	}
    	if ($i>2) {
    		$objPHPExcel->setActiveSheetIndex(1)
    		->setCellValue('A'.$i, '合计')
    		->setCellValue('B'.$i, '')
    		->setCellValue('C'.$i, '')
    		->setCellValue('D'.$i, '=SUM(D2:D'.($i-1).')')
    		->setCellValue('E'.$i, '=SUM(E2:E'.($i-1).')')
    		->setCellValue('F'.$i, '=SUM(F2:F'.($i-1).')')
    		->setCellValue('G'.$i, '=SUM(G2:G'.($i-1).')')
    		->setCellValue('H'.$i, '=SUM(H2:H'.($i-1).')')
    		->setCellValue('I'.$i, '')
    		;
    	}
    	// Set active sheet index to the first sheet, so Excel opens this as the first sheet
    	$objPHPExcel->setActiveSheetIndex(0);
    	
    	// Redirect output to a client’s web browser (Excel5)
    	header('Content-Type: application/vnd.ms-excel');
    	header('Content-Disposition: attachment;filename="Report of BOSS.xls"');
    	header('Cache-Control: max-age=0');
    	$objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
    	$objWriter->save('php://output');
    	exit;
    }
    
    public function actionExportlady()
    {
    	if (!isset($_GET['t'])) {
    		return $this->render('lady', [
    				'dataDiamondhistory' => array(),
    				'dataWithdraw' => array(),
    				]);
    	}
    	$t = explode(' - ', $_GET['t']);
    	$dataDiamondhistory = Diamondhistory::find()->join('INNER JOIN', 'user', 'user.id=diamond_history.user_id')->where('(status = "success" or status = "unfreeze" or status = "invited") and user.utype=4 and diamond_history.created>="'.$t[0].' 00:00:00" and diamond_history.created<="'.$t[1].' 23:59:59"')->orderby('diamond_history.created desc')->all();
    	$dataWithdraw = Withdraw::find()->join('INNER JOIN', 'user', 'user.id=withdraw.user_id')->where('(status = "success") and user.utype=4 and withdraw.created>="'.$t[0].' 00:00:00" and withdraw.created<="'.$t[1].' 23:59:59"')->orderby('withdraw.created desc')->all();
    	    	    	    	 
    	$objPHPExcel = new \PHPExcel();
    	//设置属性
    	$objPHPExcel->getProperties()->setCreator(Yii::$app->user->identity->username)
    	->setLastModifiedBy(Yii::$app->user->identity->username)
    	->setTitle("Report of LADY")
    	->setSubject("")
    	->setDescription("")
    	->setKeywords("")
    	->setCategory("");
    	 
    	$objPHPExcel->setActiveSheetIndex(0)
    	->setCellValue('A1', '#')
    	->setCellValue('B1', '用户ID')
    	->setCellValue('C1', '用户昵称')
    	->setCellValue('D1', '打赏')
    	->setCellValue('E1', '约见')
    	->setCellValue('F1', '私房照查看')
    	->setCellValue('G1', '素颜认证查看')
    	->setCellValue('H1', '身材认证查看')
    	->setCellValue('I1', '邀请好友收益')
    	->setCellValue('J1', '邀请百分比')
    	->setCellValue('K1', '来源用户ID')
    	->setCellValue('L1', '时间')
    	;
    	$i = 2;
    	foreach ($dataDiamondhistory as $data){
    		if ($data->created >= "2016-03-01 00:00:00") {
    			$k = 0.8;
    		} else {
    			$k = 0.85;
    		}
    		$objPHPExcel->setActiveSheetIndex(0)
    		->setCellValue('A'.$i, $i-1)
    		->setCellValue('B'.$i, $data->user_id.(in_array($data->user_id, Yii::$app->params['test_user'])?"(测)":""))
    		->setCellValue('C'.$i, $data->user->nickname)
    		->setCellValue('D'.$i, $data->type=="comment"?round($data->diamond*$k*0.1,2):"")
    		->setCellValue('E'.$i, (($data->type=="see" || $data->type=="dating" || $data->type=="dating_timeout" || $data->type=="dating_cancel") && ($data->status!="invited"))?round($data->diamond*$k*0.1,2):"")
    		->setCellValue('F'.$i, $data->type=="private"?round($data->diamond*$k*0.1,2):"")
    		->setCellValue('G'.$i, $data->type=="unmakeup"?round($data->diamond*$k*0.1,2):"")
    		->setCellValue('H'.$i, $data->type=="part"?round($data->diamond*$k*0.1,2):"")
    		->setCellValue('I'.$i, $data->status=="invited"?round($data->diamond*$k*0.1,2):"")
    		->setCellValue('J'.$i, "")
    		->setCellValue('K'.$i, $data->from_user.(in_array($data->from_user, Yii::$app->params['test_user'])?"(测)":""))
    		->setCellValue('L'.$i, $data->created)
    		;
    		$i++;
    	}
    	if ($i>2) {
    		$objPHPExcel->setActiveSheetIndex(0)
    		->setCellValue('A'.$i, '合计')
    		->setCellValue('B'.$i, '')
    		->setCellValue('C'.$i, '')
    		->setCellValue('D'.$i, '=SUM(D2:D'.($i-1).')')
    		->setCellValue('E'.$i, '=SUM(E2:E'.($i-1).')')
    		->setCellValue('F'.$i, '=SUM(F2:F'.($i-1).')')
    		->setCellValue('G'.$i, '=SUM(G2:G'.($i-1).')')
    		->setCellValue('H'.$i, '=SUM(H2:H'.($i-1).')')
    		->setCellValue('I'.$i, '=SUM(I2:I'.($i-1).')')
    		->setCellValue('J'.$i, '')
    		->setCellValue('K'.$i, '')
    		->setCellValue('L'.$i, '')
    		;
    	}
    	$objPHPExcel->getActiveSheet()->setTitle('Diamondhistory');
    
    	$msgWorkSheet = new \PHPExcel_Worksheet($objPHPExcel, 'Withdraw');
    	$objPHPExcel->addSheet($msgWorkSheet); //插入工作表
    	$objPHPExcel->setActiveSheetIndex(1)
    	->setCellValue('A1', '#')
    	->setCellValue('B1', '用户ID')
    	->setCellValue('C1', '用户昵称')
    	->setCellValue('D1', '钻石')
    	->setCellValue('E1', '金额')
    	->setCellValue('F1', '时间')
    	;
    	$i = 2;
    	foreach ($dataWithdraw as $data){
    		$objPHPExcel->setActiveSheetIndex(1)
    		->setCellValue('A'.$i, $i-1)
    		->setCellValue('B'.$i, $data->user_id.(in_array($data->user_id, Yii::$app->params['test_user'])?"(测)":""))
    		->setCellValue('C'.$i, $data->user->nickname)
    		->setCellValue('D'.$i, $data->diamond)
    		->setCellValue('E'.$i, $data->rmb)
    		->setCellValue('F'.$i, $data->created)
    		;
    		$i++;
    	}
    	if ($i>2) {
    		$objPHPExcel->setActiveSheetIndex(1)
    		->setCellValue('A'.$i, '合计')
    		->setCellValue('B'.$i, '')
    		->setCellValue('C'.$i, '')
    		->setCellValue('D'.$i, '=SUM(D2:D'.($i-1).')')
    		->setCellValue('E'.$i, '=SUM(E2:E'.($i-1).')')
    		->setCellValue('F'.$i, '')
    		;
    	}
    	// Set active sheet index to the first sheet, so Excel opens this as the first sheet
    	$objPHPExcel->setActiveSheetIndex(0);
    	 
    	// Redirect output to a client’s web browser (Excel5)
    	header('Content-Type: application/vnd.ms-excel');
    	header('Content-Disposition: attachment;filename="Report of LADY.xls"');
    	header('Cache-Control: max-age=0');
    	$objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
    	$objWriter->save('php://output');
    	exit;
    }

    
    public function actionExportcom()
    {
    	if (!isset($_GET['t'])) {
    		return $this->render('com', [
    				'dataProfit' => array(),
    				]);
    	}
    	$t = explode(' - ', $_GET['t']);
    	$dataProfit = Diamondhistory::find()->join('INNER JOIN', 'user', 'user.id=diamond_history.user_id')->where('(status = "success" or status = "unfreeze" or status = "invited") and user.utype=4 and diamond_history.created>="'.$t[0].' 00:00:00" and diamond_history.created<="'.$t[1].' 23:59:59"')->orderby('diamond_history.created desc')->all();
    	$dataWithdraw = Withdraw::find()->join('INNER JOIN', 'user', 'user.id=withdraw.user_id')->where('(status = "success") and user.utype=4 and withdraw.created>="'.$t[0].' 00:00:00" and withdraw.created<="'.$t[1].' 23:59:59"')->orderby('withdraw.created desc')->all();

    	$objPHPExcel = new \PHPExcel();
    	//设置属性
    	$objPHPExcel->getProperties()->setCreator(Yii::$app->user->identity->username)
    	->setLastModifiedBy(Yii::$app->user->identity->username)
    	->setTitle("Report of COM")
    	->setSubject("")
    	->setDescription("")
    	->setKeywords("")
    	->setCategory("");
    
    	$objPHPExcel->setActiveSheetIndex(0)
    	->setCellValue('A1', '#')
    	->setCellValue('B1', '打赏')
    	->setCellValue('C1', '约见')
    	->setCellValue('D1', '私房照查看')
    	->setCellValue('E1', '素颜认证查看')
    	->setCellValue('F1', '身材认证查看')
    	->setCellValue('G1', '邀请好友收益')
    	->setCellValue('H1', '美女ID')
    	->setCellValue('I1', '老板ID')
    	->setCellValue('J1', '时间')
    	;
    	$i = 2;
    	foreach ($dataProfit as $data){
    		if ($data->created >= "2016-03-01 00:00:00") {
    			$k = 1.2;
    			$k2 = 0.2;
    		} else {
    			$k = 1.15;
    			$k2 = 0.15;
    		}
    		$objPHPExcel->setActiveSheetIndex(0)
    		->setCellValue('A'.$i, $i-1)
    		->setCellValue('B'.$i, $data->type=="comment"?round($data->diamond*$k*0.1,2):"")
    		->setCellValue('C'.$i, (($data->type=="see" || $data->type=="dating" || $data->type=="dating_timeout" || $data->type=="dating_cancel") && ($data->status!="invited"))?round($data->diamond*$k2*0.1,2):"")
    		->setCellValue('D'.$i, $data->type=="private"?round($data->diamond*$k*0.1,2):"")
    		->setCellValue('E'.$i, $data->type=="unmakeup"?round($data->diamond*$k*0.1,2):"")
    		->setCellValue('F'.$i, $data->type=="part"?round($data->diamond*$k*0.1,2):"")
    		->setCellValue('G'.$i, $data->status=="invited"?round($data->diamond*$k2*0.1,2):"")
    		->setCellValue('H'.$i, $data->user_id.(in_array($data->user_id, Yii::$app->params['test_user'])?"(测)":""))
    		->setCellValue('I'.$i, $data->from_user.(in_array($data->from_user, Yii::$app->params['test_user'])?"(测)":""))
    		->setCellValue('J'.$i, $data->created)
    		;
    		$i++;
    	}
    	if ($i>2) {
    		$objPHPExcel->setActiveSheetIndex(0)
    		->setCellValue('A'.$i, '合计')
    		->setCellValue('B'.$i, '=SUM(B2:B'.($i-1).')')
    		->setCellValue('C'.$i, '=SUM(C2:C'.($i-1).')')
    		->setCellValue('D'.$i, '=SUM(D2:D'.($i-1).')')
    		->setCellValue('E'.$i, '=SUM(E2:E'.($i-1).')')
    		->setCellValue('F'.$i, '=SUM(F2:F'.($i-1).')')
    		->setCellValue('G'.$i, '=SUM(G2:G'.($i-1).')')
    		->setCellValue('H'.$i, '')
    		->setCellValue('I'.$i, '')
    		->setCellValue('J'.$i, '')
    		;
    	}
    	$objPHPExcel->getActiveSheet()->setTitle('Profit');
    	
    	$msgWorkSheet = new \PHPExcel_Worksheet($objPHPExcel, 'Withdraw');
    	$objPHPExcel->addSheet($msgWorkSheet); //插入工作表
    	$objPHPExcel->setActiveSheetIndex(1)
    	->setCellValue('A1', '#')
    	->setCellValue('B1', '用户ID')
    	->setCellValue('C1', '用户昵称')
    	->setCellValue('D1', '钻石')
    	->setCellValue('E1', '金额')
    	->setCellValue('F1', '时间')
    	;
    	$i = 2;
    	foreach ($dataWithdraw as $data){
    		$objPHPExcel->setActiveSheetIndex(1)
    		->setCellValue('A'.$i, $i-1)
    		->setCellValue('B'.$i, $data->user_id.(in_array($data->user_id, Yii::$app->params['test_user'])?"(测)":""))
    		->setCellValue('C'.$i, $data->user->nickname)
    		->setCellValue('D'.$i, ($data->diamond - ($data->rmb*10)))
    		->setCellValue('E'.$i, (($data->diamond/10) - $data->rmb))
    		->setCellValue('F'.$i, $data->created)
    		;
    		$i++;
    	}
    	if ($i>2) {
    		$objPHPExcel->setActiveSheetIndex(1)
    		->setCellValue('A'.$i, '合计')
    		->setCellValue('B'.$i, '')
    		->setCellValue('C'.$i, '')
    		->setCellValue('D'.$i, '=SUM(D2:D'.($i-1).')')
    		->setCellValue('E'.$i, '=SUM(E2:E'.($i-1).')')
    		->setCellValue('F'.$i, '')
    		;
    	}
    	// Set active sheet index to the first sheet, so Excel opens this as the first sheet
    	$objPHPExcel->setActiveSheetIndex(0);
    
    	// Redirect output to a client’s web browser (Excel5)
    	header('Content-Type: application/vnd.ms-excel;charset=utf-8');
    	header('Content-Disposition: attachment;filename="Report of COM.xls"');
    	header('Cache-Control: max-age=0');
    	$objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
    	$objWriter->save('php://output');
    	exit;
    }
    
}
