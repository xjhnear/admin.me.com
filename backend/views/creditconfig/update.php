<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Feedback */

$this->title = '修改配置: ' . ' ' . $model->credit_rating;
$this->params['breadcrumbs'][] = ['label' => '信用等级配置', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->credit_rating, 'url' => ['view', 'id' => $model->id]];
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
