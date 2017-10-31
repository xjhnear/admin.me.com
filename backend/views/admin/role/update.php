<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var mivan\admin\models\AuthItem $model
 */
$this->title = Yii::t('rbac-admin', 'Update Role').': ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Roles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->name]];
$this->params['breadcrumbs'][] = Yii::t('rbac-admin', 'Update');
?>
<div class="auth-item-update">
    <div class="box">
        <div class="box-body">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
</div>
