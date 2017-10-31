<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Feedback */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="feedback-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'credit_rating')->textInput() ?>
    
    <?= $form->field($model, 'vip')->textInput() ?>
    
    <?= $form->field($model, 'credit_total')->textInput() ?>
    
    <?= $form->field($model, 'credit_grade')->textInput() ?>
    
    <?= $form->field($model, 'grade_name')->textInput() ?>
    
    <?= $form->field($model, 'unmakup_certification')->textInput() ?>
    
    <?= $form->field($model, 'part_certification')->textInput() ?>
    
    <?= $form->field($model, 'match_vip')->textInput() ?>
    
    <?= $form->field($model, 'friend_max_credit')->textInput() ?>
    
    <?= $form->field($model, 'dating')->textInput() ?>
    
    <?= $form->field($model, 'dating_monthly')->textInput() ?>
    
    <?= $form->field($model, 'dating_diamond')->textInput() ?>
    
    <?= $form->field($model, 'dating_credit')->textInput() ?>
    
    <?= $form->field($model, 'concurrent_dating')->textInput() ?>
    
    <?= $form->field($model, 'basic_filter')->textInput() ?>
    
    <?= $form->field($model, 'mid_filter')->textInput() ?>
    
    <?= $form->field($model, 'advanced_filter')->textInput() ?>
    
    <?= $form->field($model, 'gift_level')->textInput() ?>
    
    <?= $form->field($model, 'description')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '创建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
