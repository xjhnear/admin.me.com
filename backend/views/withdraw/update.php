<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\DiamondOrder */

$this->title = '更新提现: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => '提现管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="diamond-order-update">
    <div class="box">
        <div class="box-body">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
</div>
