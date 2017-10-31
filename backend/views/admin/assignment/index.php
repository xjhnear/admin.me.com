<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('rbac-admin', 'Assignments');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="assignment-index box">

	<?php
    Pjax::begin([
        'enablePushState'=>false,
    ]);
    echo GridView::widget([
        'options' => ['class' => 'box-body'],
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'class' => 'yii\grid\DataColumn',
                'attribute' => $usernameField,
            ],
            'email',
            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{view}'
            ],
        ],
    ]);
    Pjax::end();
    ?>

</div>
