<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use pjkui\kindeditor\KindEditor;

/* @var $this yii\web\View */
/* @var $model backend\models\Feedback */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="feedback-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'level_range')->textInput() ?>
    
    <?= $form->field($model, 'description')->textArea(['rows' => '6']) ?>
   
    <?= $form->field($model, 'grade_name')->textInput() ?>

    <?= $form->field($model, 'grade_text')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '创建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
