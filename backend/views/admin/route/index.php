<?php

use mdm\admin\AdminAsset;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\Url;

/**
 * @var yii\web\View $this
 */
$this->title = Yii::t('rbac-admin', 'Routes');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box">
    <div class="box-header with-border">
        <?= Html::a(Yii::t('rbac-admin', 'Create route'), ['create'], ['class' => 'btn btn-primary']) ?>
    </div>

        <div class="box-body">
            <div class="col-lg-5">
                <p>
                    <?= Yii::t('rbac-admin', 'Avaliable') ?>:
                    <input id="search-avaliable" class="form-control inline" style="width: 95%">
                    <a href="#" id="btn-refresh"><span class="glyphicon glyphicon-refresh"></span></a>
                </p>
                <select id="list-avaliable" multiple size="20" style="width: 100%" class="form-control">
                </select>
            </div>
            <div class="col-lg-1" style="padding-top: 17%">
                <p><a href="#" id="btn-add" class="btn btn-primary">&gt;&gt;</a></p>
                <p><a href="#" id="btn-remove" class="btn btn-danger">&lt;&lt;</a></p>
            </div>
            <div class="col-lg-5">
                <p>
                    <?= Yii::t('rbac-admin', 'Assigned') ?>:
                    <input id="search-assigned" class="form-control inline">
                </p>
                <select id="list-assigned" multiple size="20" style="width: 100%" class="form-control"></select>
            </div>
        </div>
</div>
<?php
AdminAsset::register($this);

$properties = Json::htmlEncode([
        'assignUrl' => Url::to(['assign']),
        'searchUrl' => Url::to(['search']),
    ]);
$js = <<<JS
yii.admin.initProperties({$properties});

$('#search-avaliable').keydown(function () {
    yii.admin.searchRoute('avaliable');
});
$('#search-assigned').keydown(function () {
    yii.admin.searchRoute('assigned');
});
$('#btn-add').click(function () {
    yii.admin.assignRoute('assign');
    return false;
});
$('#btn-remove').click(function () {
    yii.admin.assignRoute('remove');
    return false;
});
$('#btn-refresh').click(function () {
    yii.admin.searchRoute('avaliable',1);
    return false;
});

yii.admin.searchRoute('avaliable', 0, true);
yii.admin.searchRoute('assigned', 0, true);
JS;
$this->registerJs($js);

