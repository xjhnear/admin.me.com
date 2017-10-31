<?php

use yii\bootstrap\ActiveForm;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = '参与约见: ' . ' ' . $model->user_id;
$this->params['breadcrumbs'][] = ['label' => '机器人管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->user_id, 'url' => ['user/view', 'id' => $model->user_id]];
$this->params['breadcrumbs'][] = '参与';
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
			
			<div class="user-index box">
			
			    <?= GridView::widget([
			        'options' => ['class'=>'box-body'],
			        'dataProvider' => $dataProvider,
			        'columns' => [
			            'id',
			            'user.nickname',
			            'dianping.name',
			    		'see_time',
			    		[
			    		'label'=>'用户种类',
			    		'attribute' => 'utype',
			    		'value' => function ($dataProvider) {
			    		return Yii::$app->params['user_utype'][$dataProvider->user->utype];
			    		}
			    		],
			
			            ['class' => 'yii\grid\ActionColumn', 'template' => '{add}', 'buttons' => [
			                'add' => function($url, $model, $key) {
			                		return '<input name="Bot[see_id]" type="radio" value="'.$model->id.'" style="width:20px;height:20px;"/>';
			                }
			            ]],
			        ],
			    ]); ?>
			    
			</div>
			
			
            <div class="form-group">
                <?= Html::submitButton('参与', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
