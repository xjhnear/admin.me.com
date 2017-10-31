<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Tabs;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

?>
<div class="user-view box">

    <div class="box-body">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'nickname',
    		['label'=>'性别','value'=>Yii::$app->params['user_sex'][$model->sex]],
    		['label'=>'用户种类','value'=>Yii::$app->params['user_utype'][$model->utype]],
            'created',
    		'updated',
    		'mobile',
    		'device.udid',
    		'level_name',
    		//'credit_grade',
    		'grade_name',
    		'userextra.diamond'
        ],
    ]) ?>
    </div>
</div>
