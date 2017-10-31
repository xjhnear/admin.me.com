<?php

use mdm\admin\AdminAsset;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model yii\web\IdentityInterface */

$this->title = Yii::t('rbac-admin', 'Assignments');
$this->params['breadcrumbs'][] = ['label' => Yii::t('rbac-admin', 'Assignments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="assignment-index box">
    <div class="box-header with-border">
        <?= Html::a(Yii::t('rbac-admin', 'Users'), ['index'], ['class' => 'btn btn-success']) ?>
        <?= Yii::t('rbac-admin', 'User') ?>: <?= Html::encode($model->{$usernameField}) ?>
    </div>

    <div class="box-body">
        <div class="col-lg-5">
            <p>
                <?= Yii::t('rbac-admin', 'Avaliable') ?>:
                <input id="search-avaliable" class="form-control">
            </p>
            <select id="list-avaliable" multiple size="20" class="form-control"></select>
        </div>
        <div class="col-lg-1" style="padding-top: 15%">
            <p><a href="#" id="btn-assign" class="btn btn-success">&gt;&gt;</a></p>
            <p><a href="#" id="btn-revoke" class="btn btn-danger">&lt;&lt;</a></p>
        </div>
        <div class="col-lg-5">
            <p>
                <?= Yii::t('rbac-admin', 'Assigned') ?>:
                <input id="search-assigned" class="form-control">
            </p>
            <select id="list-assigned" multiple size="20" class="form-control">
            </select>
        </div>
    </div>
</div>
<?php
AdminAsset::register($this);
$properties = Json::htmlEncode([
        'userId' => $model->{$idField},
        'assignUrl' => Url::to(['assign']),
        'searchUrl' => Url::to(['search']),
    ]);
$js = <<<JS
yii.admin.initProperties({$properties});

$('#search-avaliable').keydown(function () {
    yii.admin.searchAssignmet('avaliable');
});
$('#search-assigned').keydown(function () {
    yii.admin.searchAssignmet('assigned');
});
$('#btn-assign').click(function () {
    yii.admin.assign('assign');
    return false;
});
$('#btn-revoke').click(function () {
    yii.admin.assign('revoke');
    return false;
});

yii.admin.searchAssignmet('avaliable', true);
yii.admin.searchAssignmet('assigned', true);
JS;
$this->registerJs($js);

