<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Feedback */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="feedback-form">

    <?php
        $form = ActiveForm::begin([
                    'id' => "article-form",
                    'enableAjaxValidation' => false,
                    'options' => ['enctype' => 'multipart/form-data'],
        ]);
    ?>

    <?= $form->field($model, 'id')->textInput() ?>
    
    <?= $form->field($model, 'photo')->fileInput() ?>

    <?= $form->field($model, 'ranking')->textInput() ?>

    <?= $form->field($model, 'popularity')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
