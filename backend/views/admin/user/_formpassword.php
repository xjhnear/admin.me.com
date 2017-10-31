<?php

use mdm\admin\AutocompleteAsset;
use mdm\admin\models\User;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Json;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="menu-form">

    <?php $form = ActiveForm::begin(); ?>
    
	<?= $form->field($model, 'password0')->passwordInput(['maxlength' => 255]) ?>
	
    <?= $form->field($model, 'password1')->passwordInput(['maxlength' => 255]) ?>
    
    <?= $form->field($model, 'password2')->passwordInput(['maxlength' => 255]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('rbac-admin', 'Update'), ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
