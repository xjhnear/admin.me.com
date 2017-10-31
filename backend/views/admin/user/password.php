<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model mivan\admin\models\Menu */

$this->title = '修改密码';
$this->params['breadcrumbs'][] = '修改密码';
?>
<div class="menu-update box">

        <div class="box-body">
            <?= $this->render('_formpassword', [
                'model' => $model,
            ]) ?>
        <div class="help-block" style="color: #a94442;"><?=$errmsg?></div>
        </div>

</div>
