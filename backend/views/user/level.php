<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = '等级调整: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => '用户管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更改';
?>
<div class="user-update">
    <div class="box">
        <div class="box-body">
            <?php $form = ActiveForm::begin(); ?>
            
			<div class="form-group field-experience-experience">
				<label class="control-label" for="experience-experience">当前等级：<?=$model->level_name?></label>
				<input type="hidden" id="experience-id" class="form-control" name="Experience[id]" value="<?=$model->id?>">
				<div class="help-block"></div>
			</div>

            <div class="form-group field-experience-option">
				<label class="control-label" for="experience-option">操作类型</label>
				<select id="experience-option" class="form-control" name="Experience[option]">
					<option value="1">调整至</option>
				</select>
				<div class="help-block"></div>
			</div>

			<div class="form-group field-experience-number">
				<label class="control-label" for="experience-number">等级</label>
				<input type="text" id="experience-number" class="form-control" name="Experience[number]" maxlength="2">
				<div class="help-block"></div>
			</div>
			
			<?php if ($error == 1) {?>
			<div class="form-group field-experience-error">
				<label class="control-label" for="field-experience-error" style="color: red;">请输入正确的数量！</label>
			</div>
			<?php } ?>
			
            <div class="form-group">
                <?= Html::submitButton('更改', ['class' => 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
