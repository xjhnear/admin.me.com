<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Tabs;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = '登陆记录';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index box">

    <?= GridView::widget([
        'options' => ['class'=>'box-body'],
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ip',
            'controller',
    		'action',
            'created',
//            'password',

        ],
    ]); ?>
    
</div>
