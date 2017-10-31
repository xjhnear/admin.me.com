<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = '导入配置';
$this->params['breadcrumbs'][] = ['label' => '信用等级配置', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-update">
    <div class="box">
        <div class="box-body">
            <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

            <?php if (!isset($import_arr)) {?>
            <div class="form-group field-config-config_key">
				<label class="control-label" for="config-config_key">配置文件(CSV格式)</label>
				<input type="hidden" name="csv" value=""><input type="file" id="config-csv" name="csv">
				<p class="help-block help-block-error"></p>
			</div>
			
            <div class="form-group">
                <?= Html::submitButton('提交', ['class' => 'btn btn-primary']) ?>
            </div>
			<?php } ?>
			
            <?php if (isset($import_arr)) {?>
            <div class="form-group">
                <?= Html::submitButton('确认', ['class' => 'btn btn-primary']) ?>
                <?= Html::a('取消', ['import'], ['class' => 'btn btn-primary']) ?>
            </div>
            <div class="form-group field-config-config_key">
				<label class="control-label" for="config-config_key">预览：</label>
				<input type="hidden" name="importok" value="1">
			</div>

				<table class="table table-striped table-bordered detail-view">
				<?php foreach ($import_arr as $row) {?>
					<tr>
					<?php foreach ($row as $v) {?>
						<td><?=$v?></td>
					<?php } ?>
					</tr>
				<?php } ?>
				</table>
			<?php } ?>
			
            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
