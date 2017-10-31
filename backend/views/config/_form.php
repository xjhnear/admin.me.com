<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Feedback */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="feedback-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput() ?>
    
    <?= $form->field($model, 'config_key')->textInput() ?>

    <?= $form->field($model, 'config_value')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->dropDownList([ 'diamond' => 'diamond', 'vip_grade' => 'vip_grade', 'credit_grade' => 'credit_grade', 'point' => 'point', 'experience' => 'experience', 'vip_config' => 'vip_config', 'credit_config' => 'credit_config', ], ['prompt' => '']) ?> 
    
    <?= $form->field($model, 'platform')->dropDownList([ 'ios' => 'ios', 'android' => 'android', 'ios,android' => 'ios,android', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '创建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
