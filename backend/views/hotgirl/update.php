<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Feedback */

$this->title = '更新圣诞红人: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => '圣诞红人', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="feedback-update">
    <div class="box">
        <div class="box-body">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
</div>
