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

    <?= $form->field($model, 'xu')->textInput() ?>
    
    <?= $form->field($model, 'question')->textInput() ?>
    
    <?= $form->field($model, 'answer')->widget('pjkui\kindeditor\KindEditor',['clientOptions'=>['allowFileManager'=>'true','allowUpload'=>'true']]) ?>
    
    <?= $form->field($model, 'type')->dropDownList([ '0' => '全部', '1' => '老板', '2' => '宝贝', ], ['prompt' => '']) ?>
    
    <?= $form->field($model, 'category')->dropDownList([ 'see' => '约见', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '创建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

