<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\See */

$this->title = '更新约见: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => '约见管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="see-update">
    <div class="box">
        <div class="box-body">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
</div>
