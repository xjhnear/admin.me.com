<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('rbac-admin', '用户管理');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <div class="box">
        <div class="box-header with-border">
            <?= Html::a(Yii::t('rbac-admin', '新增用户'), ['create'], ['class' => 'btn btn-primary']) ?>
        </div>
        <?php
        Pjax::begin(['formSelector' => 'form', 'enablePushState' => false]);
        echo GridView::widget([
            'options' => ['class' => 'box-body'],
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                //['class' => 'yii\grid\SerialColumn'],
                'id',
                'username',
                'email',
                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]);
        Pjax::end();
        ?>
    </div>

</div>
