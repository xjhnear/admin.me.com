<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Feedback */

$this->title = 'iOS启动页';
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
		<label class="control-label" for="banner-photo">iOS图片_1242x2280</label>
		<p><img src="<?= $model->start_photo?>_1242x2280.png" style="max-width:150px;max-height:150px;" alt=""></p>
		<input type="hidden" name="Banner[photo2x]" value=""><input type="file" id="banner-photo" name="Banner[photo2x]">
		<div class="help-block"></div>
		</div>
		
		<div class="form-group field-banner-photo">
		<label class="control-label" for="banner-photo">iOS图片_750x1334</label>
		<p><img src="<?= $model->start_photo?>_750x1334.png" style="max-width:150px;max-height:150px;" alt=""></p>
		<input type="hidden" name="Banner[photo3x]" value=""><input type="file" id="banner-photo" name="Banner[photo3x]">
		<div class="help-block"></div>
		</div>
		
		<div class="form-group field-banner-photo">
		<label class="control-label" for="banner-photo">iOS图片_640x960</label>
		<p><img src="<?= $model->start_photo?>_640x960.png" style="max-width:150px;max-height:150px;" alt=""></p>
		<input type="hidden" name="Banner[photo4x]" value=""><input type="file" id="banner-photo" name="Banner[photo4x]">
		<div class="help-block"></div>
		</div>
		
		<div class="form-group field-banner-photo">
		<label class="control-label" for="banner-photo">iOS图片_640x1136</label>
		<p><img src="<?= $model->start_photo?>_640x1136.png" style="max-width:150px;max-height:150px;" alt=""></p>
		<input type="hidden" name="Banner[photo5x]" value=""><input type="file" id="banner-photo" name="Banner[photo5x]">
		<div class="help-block"></div>
		</div>
	
	    <div class="form-group">
	        <?= Html::submitButton('更新', ['class' => 'btn btn-primary']) ?>
	    </div>
	
	    <?php ActiveForm::end(); ?>
	    
        </div>
    </div>
</div>
