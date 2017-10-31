<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use backend\models\LeanCloud;
use backend\models\User;
use backend\models\ExperienceHistory;

class Notification extends BaseNotification
{
    static $subtitles=array(
        'level'=>'等级提升',
        'cert'=>'等级提升',
        'point'=>'等级提升',
        'diamond'=>'等级提升',
    );
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}


    public function relations()
    {
        return array(
        'user'=>array(self::BELONGS_TO,'User','from_user')
        );
    }

    public function readByModule($type)
    {
        $user_id=Yii::app()->user->id;
        return $this->updateAll(array('status'=>'read'),"module='$type' and user_id=$user_id and status='unread'");
    }
    public function clearByModule($type)
    {
        $user_id=Yii::app()->user->id;
        return $this->deleteAllByAttributes(array('module'=>$type,'user_id'=>$user_id,'status'=>'read'));
    }


    public function readByType($type)
    {
        $user_id=Yii::app()->user->id;
        return $this->updateAll(array('status'=>'read'),"msg_type='$type' and user_id=$user_id and status='unread'");
    }

    public function clearByType($type)
    {
        $user_id=Yii::app()->user->id;
        return $this->deleteAllByAttributes(array('msg_type'=>$type,'user_id'=>$user_id,'status'=>'read'));
    }
    public function getReportMsg()
    {
        if ($this->submod=='report') {
            $text=$this->execute("select msg from see_report where id=".$this->objectId);
            return $text;
        }
    }

    public static function send($data)
    {
        $model=new Notification();
        $model->setAttributes($data);
        if (!$model->submod) {
            $model->submod=$model->channel;
        }
        $model->channel=null;
        $model->is_push=true;
        $model->module='dating';
        $model->save(false);
    }
    
    public function notification($user_id, $is_success, $key, $module='cert', $submod=NULL, $isChange_credit_grade=0, $level=NULL, $reason=NULL)
    {
    	if ($key == 'level') {
    		$model=new Notification();
    		$model->user_id=$user_id;
    		$model->module=$module;
    		$model->msg_type='notice';
    		$model->is_push=true;
    		$model->url='miss://'.$module;
    		$model->created=date('Y-m-d H:i:s');
    		if ($is_success == 1) {
    			$model->objectId = $level;
    			$user=User::findOne($user_id);
    			if ($user->isboss()) {
    				$model->title=Yii::$app->params['Notice']['Notice_level_title_boss'];
    				if ($isChange_credit_grade == 1) {
    					$model->alert=sprintf(Yii::$app->params['Notice']['Notice_level_grade_boss'], $user->level_name, $user->grade_name);
    				} else {
    					$model->alert=sprintf(Yii::$app->params['Notice']['Notice_level_boss'], $user->level_name);
    				}
    			} else {
    				$model->title=Yii::$app->params['Notice']['Notice_level_title_baby'];
    				if ($isChange_credit_grade == 1) {
    					$model->alert=sprintf(Yii::$app->params['Notice']['Notice_level_grade_baby'], $user->level_name, $user->grade_name);
    				} else {
    					$model->alert=sprintf(Yii::$app->params['Notice']['Notice_level_baby'], $user->level_name);
    				}
    			}
    			$model->save(false);
    		}
    		return true;
    		
    	} elseif ($key == 'withdraw') {
    		$model=new Notification();
    		$model->user_id=$user_id;
    		$model->module=$module;
    		//$model->submod=$submod;
    		$model->msg_type='notice';
    		$model->is_push=true;
    		$model->url='miss://'.$module;
    		$model->created=date('Y-m-d H:i:s');
    		$withdraw=Withdraw::findOne($submod);
    		if ($is_success == 1) {
    			$key1 = $withdraw->diamond;
    			$key2 = ($withdraw->diamond/10)-$withdraw->rmb;
    			$key3 = $withdraw->rmb;
    			$key4 = $withdraw->created;
    			$model->title=Yii::$app->params['Notice']['Notice_withdraw_success_title'];
    			$model->alert=sprintf(Yii::$app->params['Notice']['Notice_withdraw_pass'], $key4, $key1, $key2, $key3);
    			$model->save(false);
    		} else {
    			$key4 = $withdraw->created;
    			$model->objectId=3;
    			$model->title=Yii::$app->params['Notice']['Notice_withdraw_fail_title'];
    			if ($reason) {
    				$model->alert=sprintf(Yii::$app->params['Notice']['Notice_withdraw_unpass_reason'], $key4, $reason);
    			} else {
    				$model->alert=sprintf(Yii::$app->params['Notice']['Notice_withdraw_unpass'], $key4);
    			}
    			$model->save(false);
    		}
    		return true;
    		
    	} elseif ($key == 'photo' || $key == 'open' || $key == 'private' || $key == 'reportphoto') {
    		$model=new Notification();
    		$model->user_id=$user_id;
    		$model->module=$module;
//     		$model->submod=$submod;
    		$model->msg_type='notice';
    		$model->is_push=true;
    	    $model->url='';
    		$model->created=date('Y-m-d H:i:s');
    	    if ($is_success == 0) {
    			$model->objectId=3;
    			$model->title=Yii::$app->params['Notice']['Notice_cert_fail_title'];
    			if ($reason) {
    				$model->alert=sprintf(Yii::$app->params['Notice']['Notice_cert_unpass_reason'], Yii::$app->params['notification_key'][$key], $reason);
    			} else {
    				$model->alert=sprintf(Yii::$app->params['Notice']['Notice_cert_unpass'], Yii::$app->params['notification_key'][$key]);
    			}
    			$model->save(false);
    		}
    		return true;
    		
    	} elseif ($key == 'blacklisted') {
    		$model=new Notification();
    		$model->user_id=$user_id;
    		$model->module=$module;
//     		$model->submod=$submod;
    		$model->msg_type='notice';
    		$model->is_push=true;
    	    $model->url='';
    		$model->created=date('Y-m-d H:i:s');
    	    if ($is_success == 1) {
    			$model->title=Yii::$app->params['Notice']['Notice_blacklisted_title'];
    			if ($reason) {
    				$model->alert=sprintf(Yii::$app->params['Notice']['Notice_blacklisted_reason'], $reason);
    			} else {
    				$model->alert=sprintf(Yii::$app->params['Notice']['Notice_blacklisted']);
    			}
    			$model->save(false);
    		}
    		return true;
    		
    	} elseif ($key == 'avatar') {
    		return true;
    	} else {
    		$model=new Notification();
    		$model->user_id=$user_id;
    		$model->module=$module;
    		$model->submod=$submod;
    		$model->msg_type='notice';
    		$model->is_push=true;
    	    $model->url='miss://'.$module;
    		if ($submod) {
    			$model->url.='/'.$submod;
    		}
    		$model->created=date('Y-m-d H:i:s');
    		$cofig=new Config();
    		$point=$cofig->getConfig('experience_'.$key)->config_value;
    		if ($is_success == 1) {
    			$model->objectId=2;
    			$model->title=Yii::$app->params['Notice']['Notice_cert_success_title'];

    			$model_ExperienceHistory = ExperienceHistory::find()->where('user_id='.$user_id.' and method="'.$key.'"')->count();
				if ($model_ExperienceHistory == 0) {
					$extra = new UserExtra();
					$r = $extra->addBabyExperience($user_id, $point, $key);
					$user=User::findOne($user_id);
					if ($user->isboss()) {
						$model->alert=sprintf(Yii::$app->params['Notice']['Notice_cert_pass'], Yii::$app->params['notification_key'][$key], $point."成长值");
					} else {
						$model->alert=sprintf(Yii::$app->params['Notice']['Notice_cert_pass'], Yii::$app->params['notification_key'][$key], $point."信用");
					}
				} else {
					$model->alert=sprintf(Yii::$app->params['Notice']['Notice_cert_pass_nopoint'], Yii::$app->params['notification_key'][$key]);
				}
				$model->save(false);

    		} else {
    			$model->objectId=3;
    			$model->title=Yii::$app->params['Notice']['Notice_cert_fail_title'];
    			if ($reason) {
    				$model->alert=sprintf(Yii::$app->params['Notice']['Notice_cert_unpass_reason'], Yii::$app->params['notification_key'][$key], $reason);
    			} else {
    				$model->alert=sprintf(Yii::$app->params['Notice']['Notice_cert_unpass'], Yii::$app->params['notification_key'][$key], $point);
    			}
    			$model->save(false);
    		}
    	}

    	return true;

    }
    
    public function afterSave($insert, $changedAttributes)
    {
    	if ($this->is_push) {
    		$lean=new LeanCloud();
    		if ($this->from_user) {
    			$user=User::model()->findByPk($this->from_user);
    			$lean->setUser($this->from_user,$user->nickname,$user->level_name,$user->avatar);
    		}
    		$lean->push($this->id, $this->user_id,$this->alert,$this->msg_type,$this->module,$this->submod,$this->objectId,$this->url,$this->title);
    	}
    }
    
    
}
