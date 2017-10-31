<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\DiamondOrder */

$this->title = '创建充值记录';
$this->params['breadcrumbs'][] = ['label' => '充值记录', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="diamond-order-create box">

    <div class="box-body">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    </div>

</div>
