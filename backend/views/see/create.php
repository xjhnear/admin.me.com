<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\See */

$this->title = '创建约见';
$this->params['breadcrumbs'][] = ['label' => '约见管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="see-create box">

    <div class="box-body">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    </div>

</div>
