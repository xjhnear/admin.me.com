<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\UserSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'mobile') ?>

    <?= $form->field($model, 'nickname') ?>

    <?= $form->field($model, 'password') ?>

    <?= $form->field($model, 'utype') ?>

    <?php // echo $form->field($model, 'sex') ?>

    <?php // echo $form->field($model, 'avatar') ?>

    <?php // echo $form->field($model, 'avatar_lg') ?>

    <?php // echo $form->field($model, 'qq') ?>

    <?php // echo $form->field($model, 'phone') ?>

    <?php // echo $form->field($model, 'wechat') ?>

    <?php // echo $form->field($model, 'province') ?>

    <?php // echo $form->field($model, 'city') ?>

    <?php // echo $form->field($model, 'district') ?>

    <?php // echo $form->field($model, 'homeland') ?>

    <?php // echo $form->field($model, 'height') ?>

    <?php // echo $form->field($model, 'industry') ?>

    <?php // echo $form->field($model, 'post') ?>

    <?php // echo $form->field($model, 'relationship') ?>

    <?php // echo $form->field($model, 'birthday') ?>

    <?php // echo $form->field($model, 'age') ?>

    <?php // echo $form->field($model, 'starsign') ?>

    <?php // echo $form->field($model, 'figure') ?>

    <?php // echo $form->field($model, 'life_level') ?>

    <?php // echo $form->field($model, 'optional_sex') ?>

    <?php // echo $form->field($model, 'optional_love') ?>

    <?php // echo $form->field($model, 'hobby') ?>

    <?php // echo $form->field($model, 'hobby_other') ?>

    <?php // echo $form->field($model, 'is_mobile_open') ?>

    <?php // echo $form->field($model, 'education') ?>

    <?php // echo $form->field($model, 'is_car_certificated') ?>

    <?php // echo $form->field($model, 'car_certification_stage') ?>

    <?php // echo $form->field($model, 'avatar_certification_stage') ?>

    <?php // echo $form->field($model, 'id_certification_stage') ?>

    <?php // echo $form->field($model, 'video_certification_stage') ?>

    <?php // echo $form->field($model, 'unmakeup_certification_stage') ?>

    <?php // echo $form->field($model, 'part_certification_stage') ?>

    <?php // echo $form->field($model, 'is_id_certificated') ?>

    <?php // echo $form->field($model, 'is_video_certificated') ?>

    <?php // echo $form->field($model, 'completion') ?>

    <?php // echo $form->field($model, 'is_active') ?>

    <?php // echo $form->field($model, 'blacklisted') ?>

    <?php // echo $form->field($model, 'is_photo_open') ?>

    <?php // echo $form->field($model, 'level') ?>

    <?php // echo $form->field($model, 'level_name') ?>

    <?php // echo $form->field($model, 'credit_grade') ?>

    <?php // echo $form->field($model, 'grade_name') ?>

    <?php // echo $form->field($model, 'signature') ?>

    <?php // echo $form->field($model, 'created') ?>

    <?php // echo $form->field($model, 'updated') ?>

    <?php // echo $form->field($model, 'month_cancel') ?>

    <?php // echo $form->field($model, 'completion_fields') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
