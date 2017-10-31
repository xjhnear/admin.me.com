<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\DiamondOrder */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="diamond-order-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'order_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'diamond')->textInput() ?>

    <?= $form->field($model, 'experience')->textInput() ?>

    <?= $form->field($model, 'rmb')->textInput() ?>

    <?= $form->field($model, 'status')->dropDownList([ 'success' => 'Success', 'pending' => 'Pending', 'failed' => 'Failed', 'refund' => 'Refund', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'trade_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'payment_method')->dropDownList([ 'alipay' => 'Alipay', 'wechat' => 'Wechat', 'apple' => 'Apple', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'paid_time')->textInput() ?>

    <?= $form->field($model, 'created')->textInput() ?>

    <?= $form->field($model, 'updated')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
