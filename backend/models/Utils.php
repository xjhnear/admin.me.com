<?php
namespace backend\models;

class Utils {


    const EARTHRADIU = 6371.004;
    const PI = M_PI;
    public static function Exceltocsv($file) {

        spl_autoload_unregister(array('YiiBase', 'autoload'));
        Yii::import('ext.PHPExcel', true);
        spl_autoload_register(array('YiiBase', 'autoload'));
        // Creating a workbook
        $objPHPExcel = PHPExcel_IOFactory::load($file);

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV')->setDelimiter(',')
                ->setEnclosure('"')
                ->setLineEnding("\r\n")
                ->setSheetIndex(0)
                ->save(str_replace('.xls', '.csv', $file));
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'HTML')->setSheetIndex(0)
                ->save(str_replace('.xls', '.html', $file));
    }

    public static function successMsg() {
        if (Yii::app()->user->getFlash('success', null, false)) {
            return $msg = '<div class="alert alert-success"><button data-dismiss="alert" class="close">×</button>
										<strong>Success!</strong> ' . Yii::app()->user->getFlash('success') . '</div>';
        };
    }
    public static function filterArray($array, $fields)
    {
        if(empty($array)) return;
        foreach ($array as $item) {
            $tmp=array();
            foreach ($item as $key=>$value) {
                if(in_array($key, $fields)){
                    $tmp[$key]=$value;
                }
            }
            $out[]=$tmp;
        }
        return $out;
    }

    public function deleteButton($param) {
        $confirmmation = Yii::t('zii', 'Are you sure you want to delete this item?');
        $click = <<<EOD
function() {
	$confirmation
	var th = this,
	jQuery('#{$this->grid->id}').yiiGridView('update', {
		type: 'POST',
		url: jQuery(this).attr('href'),$csrf
		success: function(data) {
			jQuery('#{$this->grid->id}').yiiGridView('update');
			afterDelete(th, true, data);
		},
		error: function(XHR) {
			return afterDelete(th, false, XHR);
		}
	});
	return false;
}
EOD;
    }

    public static function success($msg) {
        Yii::app()->user->setFlash('success', $msg);
    }

    public static function errorFlash($msg) {
        Yii::app()->user->setFlash('error', $msg);
    }

    public static function errorMsg() {
        if (Yii::app()->user->getFlash('error', null, false)) {
            return $msg = '<div class="alert alert-error"><button data-dismiss="alert" class="close">×</button>
										<strong>Error!</strong> ' . Yii::app()->user->getFlash('error') . '</div>';
        };
    }

    public static function getLastWord($str) {
        if (strstr($str, '_')) {
            $tmp = explode('_', $str);
            return array_pop($tmp);
        }
        if (preg_match('/[A-Z]/', $str)) {
            preg_match('/[A-Z][a-z0-9]+$/', $str, $match);
            return $match[0];
        }
        return $str;
        ;
    }

    public static function error($code, $message, $file, $line) {
        $log = "$message ($file:$line)\nStack trace:\n";
        print_r($log);
        return true;
    }

    public static function ggeocoding($address) {
        $api = "http://maps.googleapis.com/maps/api/geocode/json?address=%s&region=uk&sensor=true";
        $url = sprintf($api, urlencode($address));
        $result = file_get_contents($url);
        $json = json_decode($result);
        //print_r($json);
        if (isset($json->results[0])) {
            return $json->results[0]->geometry->location;
        }
    }

    public static function geocoding($longitude,$latitude)
    {
        $api=sprintf("http://api.map.baidu.com/geocoder/v2/?ak=acHNaEr8eFIIEESKegf70vNG&callback=&location=%f,%f&output=json&pois=1",$latitude,$longitude);
        $result=file_get_contents($api);
        $json=json_decode($result);
        $location=$json->result->addressComponent;
        $province=str_replace(array('自治区', '省','市'),array(),$location->province);
        $city=str_replace('市','',$location->city);
        $district=$location->district;
        if($province) 
            return "$province $city $district";
    }
    public static function shanghaiArea() {

        return array('卢湾区',
            '徐家汇',
            '静安区',
            '长宁区',
            '闵行区',
            '浦东新区',
            '黄浦区',
            '普陀区',
            '闸北区',
            '虹口区',
            '杨浦区',
            '宝山区',
            '松江区',
            '嘉定区',
            '青浦区',);
    }

    public static function isImage($name) {
        $arr = array('picture', 'photo', 'image');
        foreach ($arr as $value) {
            if (stristr($name, $value)) {
                return true;
            }
        }
    }

    public static function isMobile($str) {
        $str = trim($str);
        if (preg_match('/1\d{10}$/', $str))
            return true;
    }

    public static function isEmail($str) {
        $str = trim($str);
        if (preg_match('/^[\w_\-]+@[\w\.]+\.\w{2,3}$/', $str))
            return true;
    }

    public static function mail($title, $msg, $to = '') {
        $mail = new YiiMail();
        $message = new YiiMailMessage;
        $message->setBody($msg);
        $message->subject = $title;
        $message->setFrom('18621635099@163.com','马上帮服务平台');
        $message->to = $to; 
        $r = Yii::app()->mail->send($message);
        ;
    }

    /**
     * send message to mobile
     * @param string $msg
     */
    public static function sendMobile($mobile, $msg) {
        include_once('SendTemplateSMS.php');
        $data=array($msg,'30');
//        return '';
        $re=sendTemplateSMS($mobile, $data, 37803);
        if ($re==null || $re->statusCode!='000000') {

            $msg='发送失败，请您稍后尝试'.$re->statusCode;
        } else {
            $msg='';
        }
        
        return $msg;
    }

    public static function generate_password($length = 8) {
        $str = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ-_?/:(){}[]0123456789';
        $max = strlen($str);
        $length = @round($length);
        if (empty($length)) {
            $length = rand(8, 12);
        }
        $password = '';
        for ($i = 0; $i < $length; $i++) {
            $password.=$str{rand(0, $max - 1)};
        }
        return $password;
    }

    public static function t($param) {
        return Yii::t('app',$param);
    }
    
    public static function dayDiff($from,$to) {
        if(is_string($from))
            $from=  strtotime ($from);
        if (is_string($to)) {
            $to=  strtotime($to);
        }
        return round(($to-$from)/86400);
    }

    /**
     * @param coordinatea array($longitude, $latitude)
     */
    public static function getDistance($coordinatea=array(0, 0), $coordinateb=array(0, 0))
    {
        if(empty($coordinatea) || empty($coordinateb)) return null;
        return 2 * self::EARTHRADIU * asin(sqrt(pow(sin(($coordinatea[1] - $coordinateb[1]) * self::PI / 180 * 0.5), 2) + cos($coordinatea[1] * self::PI / 180) * cos($coordinateb[1] * self::PI / 180) * pow(sin(($coordinatea[0] - $coordinateb[0]) * self::PI / 180 * 0.5), 2)));
    }

    public static function getDistanceInfo($location1=array(0,0),$location2=array(0,0))
    {
        if(!$location1[0] || !$location2[0]){
            return '未知';
        }
        $distance=self::getDistance($location1, $location2);
        if($distance>=1){
            $text=round($distance)."km";
        }else{
            $text=round($distance*1000).'m';
        }
        return $text;
    }

    public static function yesterday()
    {
        return date('Y-m-d H:i:s', time()-86400);
    }

    public static function countdown($from,$to)
    {
        if(is_string($from))
            $from=  strtotime ($from);
        if (is_string($to)) {
            $to=  strtotime($to);
        }
        if(($to-$from)/86400> 1){
            $text=round(($to-$from)/86400).'天';
        }elseif(($to-$from)/3600>1){
            $text=round(($to-$from)/3600).'小时';
        }else{
            $text=round(($to-$from)/60).'分钟';
        }
        return $text;

    }
    public static function timeDistance($from,$to)
    {
        if(is_string($from))
            $from=  strtotime ($from);
        if (is_string($to)) {
            $to=strtotime($to);
        }
        if(($to-$from)/86400> 1){
            $text=round(($to-$from)/86400).'天前';
        }elseif(($to-$from)/3600>1){
            $text=round(($to-$from)/3600).'小时前';
        }else{
            $text=round(($to-$from)/60).'分钟前';
        }
        return $text;

    }

    public static function log($content)
    {
        
        $filename=date('Ymd').'log';
        $info="\nlog start ".date('Y-m-d H:i:s')."\n";
        $info.="URL: ".$_SERVER['REQUEST_URI']."\n";
        $content=$info.$content;
        $rootPath = "../log/";
        if (!file_exists($rootPath)) {
        	mkdir($rootPath);
        }
        $rootPath = "../log/data/";
        if (!file_exists($rootPath)) {
        	mkdir($rootPath);
        }
        file_put_contents($rootPath . $filename, $content,FILE_APPEND);
    }

    public static function syslog()
    {
        // code...
        $info="log start ".date('Y-m-d H:i:s')."\n";
        $info.="user: ".Yii::app()->user->name."\n";
        $info.="ip: ".$_SERVER['REMOTE_ADDR']."\n";
        $info.="URL: ".$_SERVER['REQUEST_URI']."\n";
        if ($_POST) {

            $info.="post: ".var_export($_POST,true)."\n";
        } elseif($GLOBALS['HTTP_RAW_POST_DATA']) {

            $info.="raw post: ".($GLOBALS['HTTP_RAW_POST_DATA'])."\n";
        }
//        if($_FILES){
//            $info.="\nfile: ".json_encode($_FILES);
//            $info.="\nfile content: ".(file_get_contents($_FILES['file']['tmp_name']));
//        }
        
        $filename=date('Ymd').'-sys.log';
        file_put_contents('data/'.$filename, $info,FILE_APPEND);
    }

    public static function calcAge($birth)
    {
        // code...
        $from = new DateTime($birth);
        $to   = new DateTime('today');
        return $from->diff($to)->y;
    }

    /*
     * string get_zodiac_sign(string month, string day)
     * 输入：月份，日期
     * 输出：星座名称或者错误
     */

    public static function get_zodiac_sign($month, $day)
    {
        // 检查参数有效性
        if ($month < 1 || $month > 12 || $day < 1 || $day > 31)
            return (false);

        // 星座名称以及开始日期
        $signs = array(
            array("21" => "水瓶座"),
            array("20" => "双鱼座"),
            array("21" => "白羊座"),
            array("21" => "金牛座"),
            array("22" => "双子座"),
            array("22" => "巨蟹座"),
            array("23" => "狮子座"),
            array("24" => "处女座"),
            array("24" => "天秤座"),
            array("24" => "天蝎座"),
            array("23" => "射手座"),
            array("22" => "摩羯座")
        );
        list($sign_start, $sign_name) = each($signs[(int) $month - 1]);
        if ($day < $sign_start)
            list($sign_start, $sign_name) = each($signs[($month - 2 < 0) ? $month = 11 : $month     -= 2]);
        return $sign_name;
    }

    public static function getLbsNearby($location, $dis=20)
    {
        // code...
        if (!$location || !$location[0]) {
            return null;
        }
        $lng=$location[0];
        $lat=$location[1];
        $lat_dist=($dis/111);
    	$lat_min=$lat-$lat_dist;
    	$lat_max=$lat+$lat_dist;
    	$lng_dist=$dis/(111*cos(deg2rad($lat)));
    	$lng_min=$lng-$lng_dist;
    	$lng_max=$lng+$lng_dist;
        return array(array($lng_min,$lng_max),array($lat_min,$lat_max));
    }

    public static function asyncRequest($query)
    {
        $url="http://".$_SERVER['SERVER_NAME']."/index.php?r=".$query;
        $cmd="curl '$url' 2>&1>/dev/null &";
        exec($cmd);
    }

    public static function strCamelize($string)
    {
        return preg_replace_callback('/_[a-z]/', function($m){return strtoupper(trim($m[0],'_'));}, $string);
    }

    public static function time2string($timestamp)
    {
        $time = time() - $timestamp;
        $days=floor(intval($time / 3600)/24);
        if($days>=1){
            return date('Y-m-d H:i', $timestamp);
        }else if ($time > 3600) {
            return intval($time / 3600) . '小时前';
        } elseif ($time > 1800 ) {
            return '半小时前';
        } elseif ($time > 60) {
            return intval($time / 60) . '分钟前';
        } elseif ($time > 0) {
            return $time . '秒前';
        } elseif ($time == 0) {
            return '刚刚';
        }
    }

    public static function exclude($hay, $needle)
    {
        if (!$hay) {
            return;
        }
        $arr=explode(',',$hay);
        unset($arr[array_search($needle, $arr)]);
        return implode($arr);
    }
    public static function hasIn($hay, $needle)
    {
        // code...
        $hay=','.$hay.',';
        return (bool)strstr($hay,','.$needle.',');
    }

    static function xor_string($text) 
    {
        // Let's define our key here
        $key = Device::Appl_key;
        $outText = '';

        for($i=0;$i<strlen($text);)
        {
            for($j=0;($j<strlen($key) && $i<strlen($text));$j++,$i++)
            {
                $outText .= $text{$i} ^ $key{$j};
            }
        }  
        return $outText;
    }

    static function encrypt($text)
    {
        return base64_encode(self::xor_string($text));
    }

    public static function dencrypt($text)
    {
        return self::xor_string(base64_decode($text));
    }

    public static function upload($file, $name='', $type='image/jpeg')
    {
        if (!$name) {
            $name=time().rand(0,9).'.jpg';
        }
        $cmd="python /usr/local/bin/osscmd put $file oss://msn/".$name.' --content_type='.$type;
        $re=exec($cmd, $out);
//        Utils::log($re);
        if ($re && strstr($re, 'ETag')) {// ETag is "4C6630EF864E977223D58340A49FD65F"
//            echo ($re);exit;
            return 'http://p.dantou.net/'.$name;
        }else{
            Utils::log($re.json_encode($out));
            Utils::syslog();
        }
//        return 'http://p.dantou.net/'.$name;
    }
    public static function extension_name($filename)
    {
        //echo strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        return substr(strrchr($filename,'.'),1);
    }
}
