<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\DiamondOrder */

$this->title = '创建机器人';
$this->params['breadcrumbs'][] = ['label' => '机器人', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="diamond-order-create box">

    <div class="box-body">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    </div>

</div>
