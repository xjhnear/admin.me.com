<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\SeeReport */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="see-report-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'from_user')->textInput() ?>

    <?= $form->field($model, 'to_user')->textInput() ?>

    <?= $form->field($model, 'module_id')->textInput() ?>

    <?= $form->field($model, 'category')->dropDownList([ 'porn' => 'Porn', 'harass' => 'Harass', 'theft' => 'Theft', 'misinfo' => 'Misinfo', 'see' => 'See', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'message')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'status')->dropDownList([ 'waiting' => 'Waiting', 'success' => 'Success', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
