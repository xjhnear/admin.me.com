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
            'birthday',
            'qq',
    		'mobile',
    		'wechat',
    		'signature',
        ],
    ]) ?>
    </div>
</div>
