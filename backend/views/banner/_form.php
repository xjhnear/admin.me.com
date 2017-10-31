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

	<?= $form->field($model, 'url')->textInput() ?>
	
    <?= $form->field($model, 'share_title')->textInput() ?>
    
    <?= $form->field($model, 'share_text')->textInput() ?>
    
    <?= $form->field($model, 'share_url')->textInput() ?>
    
    <?= $form->field($model, 'share_photo')->textInput() ?>
    
    <?= $form->field($model, 'user_type')->dropDownList([ 'boss' => 'boss', 'baby' => 'baby', 'boss,baby' => 'boss,baby', ], ['prompt' => 'boss,baby']) ?>
    
    <div class="form-group field-banner-start_time">
	<label class="control-label" for="banner-start_time">开始时间</label>
	<input type="text" id="banner-start_time" class="form-control" name="Banner[start_time]" onclick="SelectDate(this,'yyyy-MM-dd hh:mm:ss')" value="<?=$model->start_time?>">
	
	<div class="help-block"></div>
	</div>   
	 
	<div class="form-group field-banner-end_time">
	<label class="control-label" for="banner-end_time">结束时间</label>
	<input type="text" id="banner-end_time" class="form-control" name="Banner[end_time]" onclick="SelectDate(this,'yyyy-MM-dd hh:mm:ss')" value="<?=$model->end_time?>">
	
	<div class="help-block"></div>
	</div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '创建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

