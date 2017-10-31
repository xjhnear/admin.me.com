<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('rbac-admin', 'Menus');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <div class="box">
        <div class="box-header with-border">
            <?= Html::a(Yii::t('rbac-admin', 'Create Menu'), ['create'], ['class' => 'btn btn-primary']) ?>
        </div>
        <?php
        Pjax::begin(['formSelector' => 'form', 'enablePushState' => false]);
        echo GridView::widget([
            'options' => ['class' => 'box-body'],
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'name',
                [
                    'attribute' => 'menuParent.name',
                    'filter' => Html::activeTextInput($searchModel, 'parent_name', [
                        'class' => 'form-control', 'id' => null
                    ]),
                    'label' => Yii::t('rbac-admin', 'Parent'),
                ],
                'route',
                'order',
                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]);
        Pjax::end();
        ?>
    </div>

</div>
