<?PHP
namespace backend\models;

use Yii;
use yii\base\Model;

/**
 * Class Facepp - Face++ PHP SDK
 *
 * @author Tianye
 * @author Rick de Graaff <rick@lemon-internet.nl>
 * @since  2013-12-11
 * @version  1.1
 * @modified 16-01-2014
 * @copyright 2013 - 2015 Tianye
 **/
class LeanCloud
{
    ######################################################
    ### If you choose Amazon(US) server,please use the ###
    ### http://apius.faceplusplus.com/v2               ###
    ### or                                             ###
    ### https://apius.faceplusplus.com/v2              ###
    ######################################################
    public $add_msg_url          = 'https://leancloud.cn/1.1/rtm/messages';
    #public $server         = 'https://apicn.faceplusplus.com/v2';
    #public $server         = 'http://apius.faceplusplus.com/v2';
    #public $server         = 'https://apius.faceplusplus.com/v2';


    public $api_id;        //'gvjh0sv7hkxfdyj4nrb7pjrv1b5fymi1xln7xkpmrq6i8ldh' set your API KEY or set the key static in the property
    public $api_key;        //'fn3ijhq7pcwlfw32ozoukulj23sqwdvpji7jha9dbtmbll0p' set your API SECRET or set the secret static in the property
    public $dev;
    
    private $useragent      = 'Leancloud PHP SDK/1.1';
    private $from_user;
    private $nickname;
    private $avatar;

    public function __construct()
    {
    	$this->api_id = Yii::$app->params['LeanCloud_api_id'];
    	$this->api_key = Yii::$app->params['LeanCloud_api_key'];
    	if (isset(Yii::$app->params['LeanCloud_dev'])) {
    		$this->dev = Yii::$app->params['LeanCloud_dev'];
    	}
    }
    /**
     * @param $method - The Face++ API
     * @param array $params - Request Parameters
     * @return array - {'http_code':'Http Status Code', 'request_url':'Http Request URL','body':' JSON Response'}
     * @throws Exception
     */
    public function execute($method, array $params)
    {
       

        return $this->request($method, $params);
    }

    private function request($request_url, $request_body)
    {
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, $request_url);
        curl_setopt($curl_handle, CURLOPT_FRESH_CONNECT, false);
        curl_setopt($curl_handle, CURLOPT_CLOSEPOLICY, CURLCLOSEPOLICY_LEAST_RECENTLY_USED);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl_handle, CURLOPT_TIMEOUT, 3600);
        curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 120);
        curl_setopt($curl_handle, CURLOPT_NOSIGNAL, true);
        curl_setopt($curl_handle, CURLOPT_USERAGENT, $this->useragent);
        curl_setopt($curl_handle,CURLOPT_HTTPHEADER,array('X-AVOSCloud-Application-Id: '.$this->api_id,'X-AVOSCloud-Master-Key: '.$this->api_key,'Content-Type: application/json'));

     
        curl_setopt($curl_handle, CURLOPT_POST, true);

        $request_body=json_encode($request_body);
        curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $request_body);

        $response_text      = curl_exec($curl_handle);
        $response_header    = curl_getinfo($curl_handle);
        curl_close($curl_handle);

        return array (
            'http_code'     => $response_header['http_code'],
            'request_url'   => $request_url,
            'body'          => $response_text
        );
    }

    /**
     *参数名 	含义
     *from_peer 	消息的发件人 id
     *conv_id 	发送到对话 id
     *transient 	是否为暂态消息（可选，由于向后兼容的考虑，默认为 true，请注意设置这个值）
     *message 	消息内容（这里的消息内容的本质是字符串，但是我们对字符串内部的格式没有做限定，理论上开发者可以随意发送任意格式，只要大小不超过 5KB 限制即可）
     *no_sync 	可选，默认情况下消息会被同步给在线的 from_peer 用户的客户端，设置为 true 禁用此功能
     **/
    public function addMessage($from, $conv_id, $type='addfriend',$text="")
    {
        // -d '{"from_peer": "1a", "message": "helloworld", "conv_id": "...", "transient": false}' \
        $message=array("_lctype"=>-1,'_lctext'=>$text,'_lcattrs'=>array('action'=>$type));
        $param=array('from_peer'=>(string)$from, 'conv_id'=>$conv_id,'message'=>json_encode($message));
        return $this->executeAsync($this->add_msg_url, $param);

    }

    public function setUser($from_user,$nickname,$level_name,$avatar)
    {
        $this->from_user=$from_user;
        $this->nickname=$nickname;
        $this->level_name=$level_name;
        $this->avatar=$avatar;
    }
    public function push($id,$user_id, $title='新消息来自好友',$type='activity', $module='friend', $submod=null, $object_id=null, $url=null,$subtitle=null)
    {
        $param=array('where'=>array('userId'=>(string)$user_id),
            'data'=>array('alert'=>$title,'module'=>$module,'submod'=>$submod,'objectId'=>$object_id,'id'=>$id,'type'=>$type, 'url'=>$url,'created'=>date('Y-m-d H:i:s'),'action'=>'net.dantou.cdr.action.push'));
        if ($this->dev=='1') {
        	$param['prod']='dev';
        }
        if ($this->from_user) {
            $param['data']['from_user_id']=$this->from_user;
            $param['data']['nickname']=$this->nickname;
            $param['data']['avatar']=$this->avatar;
            $param['data']['level_name']=$this->level_name;
        }
        if ($subtitle) {
            $param['data']['title']=$subtitle;
        }
        return $this->executeAsync($this->add_msg_url, $param, 'push');
    }

    public function executeAsync($url, $param, $path='rtm/messages')
    {
        $params=json_encode($param);
        $curl="curl -X POST -H 'X-AVOSCloud-Application-Id: $this->api_id' -H 'X-AVOSCloud-Master-Key: $this->api_key' -H 'Content-Type: application/json' -d '$params' 'https://leancloud.cn/1.1/$path' &";
//        echo $curl;
        file_put_contents('leadcloud.log', $curl."\n", FILE_APPEND);
        exec($curl);
    }
    
    public function getconversationtody($uid, $checkday="2015-11-01")
    {
    	$go_on = true;
    	$msgid = "";
    	$out = array();
    	$t_start = strtotime($checkday." 10:00:00") * 1000;
    	$t_end = strtotime(date("Y-m-d")." 9:59:59") * 1000;
//     	do {
    		$data = $this->getconversation($uid, $msgid);
    		if (!isset($data[0])) {
    			return $out;
    		}
    		$data = json_decode($data[0], true);
    		foreach ($data as $item) {
    			if ($item['timestamp'] >= $t_start && $item['timestamp'] <= $t_end) {
    				$out[$item['conv-id']]['conv-id'] = $item['conv-id'];
    				$out[$item['conv-id']]['to'] = $item['to'];
    				$tmp_arr = array();
    				$tmp_arr['msg-id'] = $item['msg-id'];
    				$tmp_arr['timestamp'] = date("Y-m-d H:i:s", floor($item['timestamp']/1000));
    				$msgdata = json_decode($item['data'],true);

    				if (isset($msgdata['_lctext']) || isset($msgdata['_lcattrs']['action'])) {
    					if (isset($msgdata['_lctext'])) {
    						$tmp_arr['lctext'] = $msgdata['_lctext'];
    					} else {
    						$tmp_arr['lctext'] = "";
    					}
    					if (isset($msgdata['_lcattrs']['action'])) {
    						$tmp_arr['action'] = $msgdata['_lcattrs']['action'];
    					} else {
    						$tmp_arr['action'] = "";
    					}
    					$out[$item['conv-id']]['data'][] = $tmp_arr;
    				}
    				
    			}
    			if ($item['timestamp'] < $t_start) {
    				$go_on = false;
    			}
    			$msgid = $item['msg-id'];
    		}
//     	} while ($go_on == true);
		
    	return $out;
    }
    
    private function getconversation($uid, $msgid)
    {
    	$curl="curl -X GET -H 'X-LC-Id: $this->api_id' -H 'X-LC-Key: $this->api_key,master' https://leancloud.cn/1.1/rtm/messages/logs?from=$uid&msgid=$msgid&limit=1000 ";
//     	echo $curl;exit;
    	exec($curl, $out);
    	return $out;
    }
    
}
