<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = '创建机器人';
$this->params['breadcrumbs'][] = ['label' => '机器人', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-update">
    <div class="box">
        <div class="box-body">
            <?php $form = ActiveForm::begin(); ?>

            <div class="form-group field-bot-utype">
				<label class="control-label" for="bot-utype">性别</label>
				<select id="bot-utype" class="form-control" name="Bot[utype]">
					<option value="9">请选择</option>
					<option value="1">随机</option>
					<option value="2">男</option>
					<option value="3">女</option>
				</select>
				<div class="help-block"></div>
			</div>
			
            <div class="form-group field-bot-province">
				<label class="control-label" for="bot-province">地区</label>
				<select id="bot-province" class="form-control" name="Bot[province]">
					<option value="9">请选择</option>
					<option value="1">随机</option>
					<option value="2">上海</option>
					<option value="3">北京</option>
					<option value="4">广州</option>
				</select>
				<div class="help-block"></div>
			</div>

			<div class="form-group field-bot-number">
				<label class="control-label" for="bot-number">数量</label>
				<input type="text" id="bot-number" class="form-control" name="Bot[number]" value="0">
				<div class="help-block"></div>
			</div>
			
            <div class="form-group">
                <?= Html::submitButton('创建', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
