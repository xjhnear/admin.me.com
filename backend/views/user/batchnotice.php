<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = '批量消息推送';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-update">
    <div class="box">
        <div class="box-body">
            <?php $form = ActiveForm::begin(); ?>
            
            <div class="form-group field-diamond-option">
				<label class="control-label" for="diamond-option">发送范围</label>
				<select id="diamond-option" class="form-control" name="Notice[option]">
					<option value="1">30天内活跃用户</option>
				</select>
				<div class="help-block"></div>
			</div>

			<div class="form-group field-notice-title">
				<label class="control-label" for="notice-title">标题</label>
				<input type="text" id="notice-title" class="form-control" name="Notice[title]" >
				<div class="help-block"></div>
			</div>
			
		    <div class="form-group field-notice-context">
			<label class="control-label" for="notice-context">内容</label>
			<textarea id="notice-context" class="form-control" name="Notice[context]" rows="6"></textarea>

<?php if(isset($msg)) {?>
<div class="help-block" style="color:red;"><?=$msg?></div>
</div> 
<?php }?>

<div class="help-block"></div>
</div> 
			
            <div class="form-group">
                <?= Html::submitButton('发送', ['class' => 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
