<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use pjkui\kindeditor\KindEditor;


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

    <?= $form->field($model, 'name')->textInput() ?>
    
    <?= $form->field($model, 'package')->fileInput() ?>
    
    <?= $form->field($model, 'ver')->textInput() ?>
    
	<?= $form->field($model, 'type')->dropDownList([ 'ios' => 'ios', 'android' => 'android', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '创建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

