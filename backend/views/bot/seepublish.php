<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = '发布约见: ' . ' ' . $model->user_id;
$this->params['breadcrumbs'][] = ['label' => '机器人管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->user_id, 'url' => ['user/view', 'id' => $model->user_id]];
$this->params['breadcrumbs'][] = '发布';
?>
<div class="user-update">
    <div class="box">
        <div class="box-body">
            <?php $form = ActiveForm::begin(); ?>

            <div class="form-group field-Bot-id">
				<label class="control-label" for="Bot-id">当前ID：<?=$model->user_id?></label>
				<input type="hidden" id="Bot-id" class="form-control" name="Bot[id]" value="<?=$model->user_id?>">
				<div class="help-block"></div>
			</div>
			
            <div class="form-group field-bot-time">
				<label class="control-label" for="bot-time">时间</label>
				<select id="bot-time" class="form-control" name="Bot[time]">
					<option>请选择</option>
					<?php 
					for ($i = 10; $i < 24; $i++) {
						if (date('H')<$i) {
							echo '<option value="'.date('Y-m-d ').$i.':00:00">'.$i.':00</option>';
						}
					}
					?>
					<option value="<?=date('Y-m-d ')?>23:59:00">23:59</option>
				</select>
				<div class="help-block"></div>
			</div>
			
            <div class="form-group field-bot-city">
				<label class="control-label" for="bot-city">城市</label>
				<select id="bot-city" class="form-control" name="Bot[city]">
					<option>请选择</option>
					<option value="上海">上海</option>
					<option value="北京">北京</option>
				</select>
				<div class="help-block"></div>
			</div>
			
            <div class="form-group field-bot-business">
				<label class="control-label" for="bot-business">地点</label>
				<select id="bot-business" class="form-control" name="Bot[business]">
					<option>请选择</option>
					<?php 
					foreach ($business as $k=>$v) {
						echo '<option value="'.$k.'">'.$v.'</option>';
					}
					?>
				</select>
				<div class="help-block"></div>
			</div>

			<div class="form-group field-bot-diamond">
				<label class="control-label" for="bot-diamond">钻石</label>
				<input type="text" id="bot-diamond" class="form-control" name="Bot[diamond]" value="0">
				<div class="help-block"></div>
			</div>
			
			<div class="form-group field-Bot-message">
				<label class="control-label" for="Bot-message">内容</label>
				<input type="text" id="Bot-message" class="form-control" name="Bot[message]" >
				<div class="help-block"></div>
			</div>
			
            <div class="form-group">
                <?= Html::submitButton('发布', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
