<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = '系统回复: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => '用户管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '系统回复';
?>
<div class="user-update">
    <div class="box">
        <div class="box-body">
            <?php $form = ActiveForm::begin(); ?>
            
			<div class="form-group field-experience-experience">
				<label class="control-label" for="experience-experience">用户昵称：<?=$model->nickname?></label>
				<input type="hidden" id="experience-id" class="form-control" name="Notice[id]" value="<?=$model->id?>">
				<div class="help-block"></div>
			</div>

			<div class="form-group field-experience-number">
				<label class="control-label" for="experience-number">内容</label>
				<input type="text" id="experience-number" class="form-control" name="Notice[context]" >
				<div class="help-block"></div>
			</div>
			
            <div class="form-group">
                <?= Html::submitButton('提交', ['class' => 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
