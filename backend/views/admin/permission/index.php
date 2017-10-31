<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel mivan\admin\models\searchs\AuthItem */

$this->title = Yii::t('rbac-admin', 'Permission');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="role-index box">
    <div class="box-header with-border">
        <?= Html::a(Yii::t('rbac-admin', 'Create Permission'), ['create'], ['class' => 'btn btn-primary']) ?>
    </div>

    <div class="box-body">
        <?php
        Pjax::begin([
            'enablePushState'=>false,
        ]);
        echo GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'name',
                    'label' => Yii::t('rbac-admin', 'Name'),
                ],
                [
                    'attribute' => 'description',
                    'label' => Yii::t('rbac-admin', 'Description'),
                ],
                ['class' => 'yii\grid\ActionColumn',],
            ],
        ]);
        Pjax::end();
        ?>
    </div>

</div>
