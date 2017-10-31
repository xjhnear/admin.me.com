<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nickname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'utype')->textInput() ?>

    <?= $form->field($model, 'qq')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'wechat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'province')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'district')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'homeland')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'height')->textInput() ?>

    <?= $form->field($model, 'industry')->dropDownList([ '计算机' => '计算机', '互联网' => '互联网', '通信' => '通信', '电子' => '电子', '会计' => '会计', '金融' => '金融', '银行' => '银行', '保险' => '保险', '贸易' => '贸易', '消费' => '消费', '制造' => '制造', '医疗' => '医疗', '广告' => '广告', '媒体' => '媒体', '房地产' => '房地产', '建筑' => '建筑', '教育' => '教育', '培训' => '培训', '服务业' => '服务业', '物流' => '物流', '运输' => '运输', '能源' => '能源', '原材料' => '原材料', '政府' => '政府', '其他' => '其他', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'relationship')->dropDownList([ '离异' => '离异', '分居' => '分居', '已婚' => '已婚', '恋爱' => '恋爱', '单身' => '单身', '暧昧' => '暧昧', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'birthday')->textInput() ?>

    <?= $form->field($model, 'age')->textInput() ?>

    <?= $form->field($model, 'starsign')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'figure')->textInput() ?>

    <?= $form->field($model, 'life_level')->textInput() ?>

    <?= $form->field($model, 'optional_sex')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'optional_love')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hobby')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_mobile_open')->textInput() ?>

    <?= $form->field($model, 'education')->dropDownList([ '幼儿园' => '幼儿园', '中等' => '中等', '高等' => '高等', ], ['prompt' => '']) ?>


    <?= $form->field($model, 'car_certification_stage')->textInput() ?>

    <?= $form->field($model, 'avatar_certification_stage')->textInput() ?>

    <?= $form->field($model, 'id_certification_stage')->textInput() ?>

    <?= $form->field($model, 'video_certification_stage')->textInput() ?>

    <?= $form->field($model, 'unmakeup_certification_stage')->textInput() ?>

    <?= $form->field($model, 'part_certification_stage')->textInput() ?>


    <?= $form->field($model, 'completion')->textInput() ?>

    <?= $form->field($model, 'is_active')->textInput() ?>

    <?= $form->field($model, 'blacklisted')->textInput() ?>

    <?= $form->field($model, 'is_photo_open')->textInput() ?>


    <?= $form->field($model, 'signature')->textInput(['maxlength' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
