<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Feedback */

$this->title = 'Android启动页';
$this->params['breadcrumbs'][] = $this->title;
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
		<label class="control-label" for="banner-photo">Android图片1</label>
		<p><img src="<?= $model->start_photo?>@1.png" style="max-width:150px;max-height:150px;" alt=""></p>
		<input type="hidden" name="Banner[photo1]" value=""><input type="file" id="banner-photo" name="Banner[photo1]">
		<div class="help-block"></div>
		</div>
		
		<div class="form-group field-banner-photo">
		<label class="control-label" for="banner-photo">Android图片2</label>
		<p><img src="<?= $model->start_photo?>@2.png" style="max-width:150px;max-height:150px;" alt=""></p>
		<input type="hidden" name="Banner[photo2]" value=""><input type="file" id="banner-photo" name="Banner[photo2]">
		<div class="help-block"></div>
		</div>
		
		<div class="form-group field-banner-photo">
		<label class="control-label" for="banner-photo">Android图片3</label>
		<p><img src="<?= $model->start_photo?>@3.png" style="max-width:150px;max-height:150px;" alt=""></p>
		<input type="hidden" name="Banner[photo3]" value=""><input type="file" id="banner-photo" name="Banner[photo3]">
		<div class="help-block"></div>
		</div>
		
		<div class="form-group field-banner-photo">
		<label class="control-label" for="banner-photo">Android图片4</label>
		<p><img src="<?= $model->start_photo?>@4.png" style="max-width:150px;max-height:150px;" alt=""></p>
		<input type="hidden" name="Banner[photo4]" value=""><input type="file" id="banner-photo" name="Banner[photo4]">
		<div class="help-block"></div>
		</div>
	
	    <div class="form-group">
	        <?= Html::submitButton('更新', ['class' => 'btn btn-primary']) ?>
	    </div>
	
	    <?php ActiveForm::end(); ?>
	    
        </div>
    </div>
</div>
