<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Tabs;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

function status_all($v,$uid,$type) {
	switch($v) {
		case 0:
			return '<span class="label label-default">未认证</span>';
			break;
		case 1:
			return '<a href="/approve/view?id='.$uid.'&type='.$type.'"><span class="label label-warning">正在审核</span></a>';
			break;
		case 2:
			return '<a href="/approve/userview?id='.$uid.'&type='.$type.'"><span class="label label-success">审核通过</span></a>';
			break;
	}
}


?>
<div class="user-view box">

    <div class="box-body">
    
	<table class="table table-striped table-bordered detail-view">
		<tr><th>汽车认证状态</th><td><?=status_all($model->car_certification_stage, $model->id, "car")?></td></tr>
		<?php
            if($model->car_certification_stage > 0 && isset($file)) {
                $file = $model->carCertification;
                echo '<tr><td style="vertical-align: middle"></td><td>';
                if(is_array($file) && !is_object($file)) {
                    foreach($file as $k => $v) {
                        echo Html::a(Html::img($v->path, ['height' => 200]), $v->path, ['target' => '_blank']);
                    }
                } else {
                    echo Html::a(Html::img($file->path, ['height' => 200]), $file->path, ['target' => '_blank']);
                }
                echo '</td><td style="vertical-align: middle"></td></tr>';
        }?>
		<tr><th>头像认证状态</th><td><?=status_all($model->avatar_certification_stage, $model->id, "avatar")?></td></tr>
		<?php
            if($model->avatar_certification_stage > 0 && isset($file)) {
                $file = $model->avatarCertification;
                echo '<tr><td style="vertical-align: middle"></td><td>';
                echo Html::a(Html::img($file->path, ['height' => 200]), $file->path, ['target' => '_blank']);
                echo '</td><td style="vertical-align: middle"></td></tr>';

            }?>
		<tr><th>身份认证状态</th><td><?=status_all($model->id_certification_stage, $model->id, "id")?></td></tr>
		<?php
            if($model->id_certification_stage > 0 && isset($file)) {
                $file = $model->idCertification;
                echo '<tr><td style="vertical-align: middle"></td><td>';
                foreach($file as $k => $v) {
                    echo Html::a(Html::img($v->path, ['height' => 200]), $v->path, ['target' => '_blank']) . ' ';
                }
                echo '</td><td style="vertical-align: middle"></td></tr>';

            }?>
		<tr><th>视频认证状态</th><td><?=status_all($model->video_certification_stage, $model->id, "video")?></td></tr>
		<?php
            if($model->video_certification_stage > 0 && isset($file)) {
                $file = $model->videoCertification;
                if($file) {
                    foreach($file as $k => $v) {
                    	echo '<tr><td style="vertical-align: middle"></td><td>';
                        if(preg_match('/(mp4|mov)$/', $v->path)) {
                            echo '<video width="500" height="400" src="'.$v->path.'" controls="controls" autoplay="autoplay"></video> ';
                        } else {
                            echo Html::a(Html::img($v->path, ['height' => 200]), $v->path, ['target' => '_blank']). ' ';
                        }
                        echo '</td><td style="vertical-align: middle"></td></tr>';
                    }
                } else {
                    echo '<tr><td style="vertical-align: middle"></td><td>没有文件</td><td style="vertical-align: middle"></td></tr>';
                }

            }?>
		<tr><th>素颜认证状态</th><td><?=status_all($model->unmakeup_certification_stage, $model->id, "unmakeup")?></td></tr>
		<?php
			if($model->unmakeup_certification_stage > 0 && isset($file)) {
                $file = $model->unmakeupCertification;
                echo '<tr><td style="vertical-align: middle"></td><td>';

                if(is_array($file) && !is_object($file)) {
                    foreach($file as $k => $v) {
                        echo Html::a(Html::img($v->path, ['height' => 200]), $v->path, ['target' => '_blank']);
                    }
                } else {
                    echo Html::a(Html::img($file->path, ['height' => 200]), $file->path, ['target' => '_blank']);
                }
                echo '</td><td style="vertical-align: middle"></td></tr>';
            }?>
		<tr><th>身材认证状态</th><td><?=status_all($model->part_certification_stage, $model->id, "part")?></td></tr>
		<?php
            if($model->part_certification_stage > 0 && isset($file)) {
                $file = $model->partCertification;
                echo '<tr><td style="vertical-align: middle"></td><td>';
                if(is_array($file) && !is_object($file)) {
                    foreach($file as $k => $v) {
                        echo Html::a(Html::img($v->path, ['height' => 200]), $v->path, ['target' => '_blank']);
                    }
                } else {
                    echo Html::a(Html::img($file->path, ['height' => 200]), $file->path, ['target' => '_blank']);
                }
                echo '</td><td style="vertical-align: middle"></td></tr>';
            }?>
	</table>

    </div>
</div>
