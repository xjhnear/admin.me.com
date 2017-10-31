<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Feedback */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="feedback-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'diamond')->textInput() ?>
    
    <?= $form->field($model, 'rmb')->textInput() ?>
    
    <?= $form->field($model, 'experience')->textInput() ?>

    <?= $form->field($model, 'text')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'first_text')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'first_experience')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '创建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
