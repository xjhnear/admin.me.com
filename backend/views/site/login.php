<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Sign In';

$fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-envelope form-control-feedback'></span>"
];

$fieldOptions2 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
];

$css = <<<CSS
.login-page, .register-page { background: #29292a; }
.login-logo a { color: #FFF;}
CSS;
$this->registerCss($css);
?>

<div class="login-box">
    <div class="login-logo">
        <a href="#"><?= Yii::$app->name ?></a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg"><?= Yii::t('backend', 'Backend management system')?></p>

        <?php $form = ActiveForm::begin(['id' => 'login-form', 'enableClientValidation' => false]); ?>

        <?= $form
            ->field($model, 'username', $fieldOptions1)
            ->label(false)
            ->textInput(['placeholder' => $model->getAttributeLabel('username')]) ?>

        <?= $form
            ->field($model, 'password', $fieldOptions2)
            ->label(false)
            ->passwordInput(['placeholder' => $model->getAttributeLabel('password')]) ?>

        <div class="form-group has-feedback field-loginform-checkcode required" style="padding-bottom:30px;">
			<input id="loginform-checkcode" class="form-control" type="text" placeholder="验证码" name="LoginForm[checkcode]" style="width: 80%;float: left;">
			<img id="checkpic" onclick="changing();" src='/images/checkcode.php' style="width: 20%;float: right;"/>
			<p class="help-block help-block-error"></p>
		</div>

        <div class="row">
            <div class="col-xs-8">
                <?= $form->field($model, 'rememberMe')->checkbox() ?>
            </div>
            <!-- /.col -->
            <div class="col-xs-4">
                <?= Html::submitButton(Yii::t('backend', 'Sign in'), ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'login-button']) ?>
            </div>
            <!-- /.col -->
        </div>


        <?php ActiveForm::end(); ?>

    </div>
    <!-- /.login-box-body -->
</div><!-- /.login-box -->
<script type='text/javascript'>
function changing(){
    document.getElementById('checkpic').src="/images/checkcode.php?"+Math.random();
}
</script>