<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\FeedbackSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="feedback-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'xu') ?>

    <?= $form->field($model, 'question') ?>

    <?= $form->field($model, 'type') ?>
    
    <?= $form->field($model, 'category') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
