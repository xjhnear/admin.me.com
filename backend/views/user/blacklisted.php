<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = '账号封停: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => '用户管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '封停';
?>
<div class="user-update">
    <div class="box">
        <div class="box-body">
            <?php $form = ActiveForm::begin(); ?>
            
			<div class="form-group field-experience-experience">
				<label class="control-label" for="experience-experience">当前等级：<?=$model->level_name?></label>
				<input type="hidden" id="experience-id" class="form-control" name="Blacklisted[id]" value="<?=$model->id?>">
				<div class="help-block"></div>
			</div>

            <div class="form-group field-experience-option">
				<label class="control-label" for="experience-option">处罚类型</label>
				<select id="experience-option" class="form-control" name="Blacklisted[option]">
					<option value="1">警告</option>
					<option value="2">封停1天</option>
					<option value="3">封停3天</option>
					<option value="4">封停7天</option>
					<option value="5">封停30天</option>
					<option value="6">永久封停</option>
					<option value="7">账号解封</option>
				</select>
				<div class="help-block"></div>
			</div>

			<div class="form-group field-experience-reason">
				<label class="control-label" for="experience-reason">处罚原因</label>
				<input type="text" id="experience-reason" class="form-control" name="Blacklisted[reason]">
				<div class="help-block"></div>
			</div>
			
            <div class="form-group">
                <?= Html::submitButton('提交', ['class' => 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

    <div class="form-group field-config-config_key">
		<label class="control-label" for="config-config_key">处罚记录：</label>
	</div>
    <?= GridView::widget([
        'options' => ['class'=>'box-body'],
        'dataProvider' => $dataBlacklisted,
        //'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            'operator',
    		[
    		'label'=>'处罚类型',
    		'attribute' => 'option',
    		'value' => function ($dataProvider) {
    		return Yii::$app->params['blacklisted_option'][$dataProvider->option];
    		}
    		],
    		'reason',
            'created',

        ],
    ]); ?>
</div>
