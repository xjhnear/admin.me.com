<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Feedback */

$this->title = '更新广告: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '广告管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="feedback-update">
    <div class="box">
        <div class="box-body">
            
	    <?php
	        $form = ActiveForm::begin([
	                    'id' => "article-form",
	                    'enableAjaxValidation' => false,
	                    'options' => ['enctype' => 'multipart/form-data'],
	        ]);
	    ?>
    	
		<div class="form-group field-banner-photo">
		<label class="control-label" for="banner-photo">iOS图片2x</label>
		<p><img src="<?= $model->photo?>@2x.png" style="max-width:150px;max-height:150px;" alt=""></p>
		<input type="hidden" name="Banner[photo2x]" value=""><input type="file" id="banner-photo" name="Banner[photo2x]">
		<div class="help-block"></div>
		</div>
		
		<div class="form-group field-banner-photo">
		<label class="control-label" for="banner-photo">iOS图片3x</label>
		<p><img src="<?= $model->photo?>@3x.png" style="max-width:150px;max-height:150px;" alt=""></p>
		<input type="hidden" name="Banner[photo3x]" value=""><input type="file" id="banner-photo" name="Banner[photo3x]">
		<div class="help-block"></div>
		</div>
	
	    <div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? '创建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	
	    <?php ActiveForm::end(); ?>
	    
        </div>
    </div>
</div>
