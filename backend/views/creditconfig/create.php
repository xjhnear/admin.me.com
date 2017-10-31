<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Feedback */

$this->title = '创建配置';
$this->params['breadcrumbs'][] = ['label' => '信用等级配置', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="feedback-create box">

    <div class="box-body">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    </div>

</div>
