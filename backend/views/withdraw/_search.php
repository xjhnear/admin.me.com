<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\DiamondOrderSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="diamond-order-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'order_no') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'diamond') ?>

    <?= $form->field($model, 'experience') ?>

    <?php // echo $form->field($model, 'rmb') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'trade_no') ?>

    <?php // echo $form->field($model, 'payment_method') ?>

    <?php // echo $form->field($model, 'paid_time') ?>

    <?php // echo $form->field($model, 'created') ?>

    <?php // echo $form->field($model, 'updated') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
