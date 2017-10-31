<?php

use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = Yii::t('rbac-admin', '新增用户');
$this->params['breadcrumbs'][] = ['label' => Yii::t('rbac-admin', '用户管理'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-create">

    <div class="box">
        <div class="box-body">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>

</div>
