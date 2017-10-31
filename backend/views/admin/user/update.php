<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model mivan\admin\models\Menu */

$this->title = Yii::t('rbac-admin', '更新用户') . ': ' . ' ' . $model->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('rbac-admin', '用户管理'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->username, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('rbac-admin', 'Update');
?>
<div class="menu-update box">

        <div class="box-body">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>

</div>
