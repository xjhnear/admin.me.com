<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\SeeReport */

$this->title = '更新约见投诉: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => '约见投诉', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="see-report-update">
    <div class="box">
        <div class="box-body">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
</div>
