<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = $model->nickname;
$this->params['breadcrumbs'][] = ['label' => '审核验证'];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="diamond-order-view">

        <div class="box">
            <div class="box-header">
                <h3 class="box-title">验证</h3>
            </div><!-- /.box-header -->
            <div class="box-body no-padding">
                <table class="table table-condensed">
                    <tbody><tr>
                        <th>验证类型</th>
                        <th>验证内容</th>
                        <th>操作</th>
                    </tr>


        <?php
            if($type=='car') {
                $file = $model->carCertification;
                echo '<tr><td style="vertical-align: middle">汽车认证</td><td>';
                if(is_array($file) && !is_object($file)) {
                    foreach($file as $k => $v) {
                        echo Html::a(Html::img($v->path, ['height' => 200]), $v->path, ['target' => '_blank']);
                    }
                } else {
                    echo Html::a(Html::img($file->path, ['height' => 200]), $file->path, ['target' => '_blank']);
                }
                echo '</td><td style="vertical-align: middle"><input type="button" class="btn btn-danger" onclick=\'disp_prompt('.$model->id.', "car_certification_stage", "'.$type.'")\' value="拒绝" /></td></tr>';
            }

            if($type=='part') {
                $file = $model->partCertification;
                echo '<tr><td style="vertical-align: middle">身材认证</td><td>';
                if(is_array($file) && !is_object($file)) {
                    foreach($file as $k => $v) {
                        echo Html::a(Html::img($v->path, ['height' => 200]), $v->path, ['target' => '_blank']);
                    }
                } else {
                    echo Html::a(Html::img($file->path, ['height' => 200]), $file->path, ['target' => '_blank']);
                }
                echo '</td><td style="vertical-align: middle"><input type="button" class="btn btn-danger" onclick=\'disp_prompt('.$model->id.', "part_certification_stage", "'.$type.'")\' value="拒绝" /></td></tr>';
            }

            if($type=='unmakeup') {
                $file = $model->unmakeupCertification;
                echo '<tr><td style="vertical-align: middle">素颜认证</td><td>';

                if(is_array($file) && !is_object($file)) {
                    foreach($file as $k => $v) {
                        echo Html::a(Html::img($v->path, ['height' => 200]), $v->path, ['target' => '_blank']);
                    }
                } else {
                    echo Html::a(Html::img($file->path, ['height' => 200]), $file->path, ['target' => '_blank']);
                }
                echo '</td><td style="vertical-align: middle"><input type="button" class="btn btn-danger" onclick=\'disp_prompt('.$model->id.', "unmakeup_certification_stage", "'.$type.'")\' value="拒绝" /></td></tr>';
            }

            if($type=='avatar') {
                $file = $model->avatarCertification;
                echo '<tr><td style="vertical-align: middle">头像认证</td><td>';
                echo Html::a(Html::img($file->path, ['height' => 200]), $file->path, ['target' => '_blank']);
                echo '</td><td style="vertical-align: middle"><input type="button" class="btn btn-danger" onclick=\'disp_prompt('.$model->id.', "avatar_certification_stage", "'.$type.'")\' value="拒绝" /></td></tr>';

            }

            if($type=='id') {
                $file = $model->idCertification;
                echo '<tr><td style="vertical-align: middle">身份证认证</td><td>';
                foreach($file as $k => $v) {
                    echo Html::a(Html::img($v->path, ['height' => 200]), $v->path, ['target' => '_blank']) . ' ';
                }
                echo '</td><td style="vertical-align: middle"><input type="button" class="btn btn-danger" onclick=\'disp_prompt('.$model->id.', "id_certification_stage", "'.$type.'")\' value="拒绝" /></td></tr>';

            }
            if($type=='video') {
                $file = $model->videoCertification;
                echo '<tr><td style="vertical-align: middle">视频认证</td><td>';
                if($file) {
                    foreach($file as $k => $v) {
                        if(preg_match('/(mp4|mov)$/', $v->path)) {
                            echo '<video width="500" height="400" src="'.$v->path.'" controls="controls" autoplay="autoplay"></video> ';
                        } else {
                            echo Html::a(Html::img($v->path, ['height' => 200]), $v->path, ['target' => '_blank']). ' ';
                        }
                    }
                } else {
                    echo '没有文件';
                }
                echo '</td><td style="vertical-align: middle"><input type="button" class="btn btn-danger" onclick=\'disp_prompt('.$model->id.', "video_certification_stage", "'.$type.'")\' value="拒绝" /></td></tr>';

            }

        ?>
                    </tbody>
                </table>
            </div>

    </div>
</div>

<script type="text/javascript">
function disp_prompt(id, type, backview)
  {
  var name=prompt("被拒原因：","")
  if (name!=null && name!="")
  {
	  window.location.href = "/approve/userfail?id="+id+"&type="+type+"&backview="+backview+"&reason="+name;
  }
  else if (name=="")
  {
	  window.location.href = "/approve/userfail?id="+id+"&type="+type+"&backview="+backview;
  }
}
</script>
