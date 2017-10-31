<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '红人榜管理';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="user-index box">
    <div class="box-header">
        <?= Html::a('管理排行[大哥]', ['hotoperte'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('管理排行[美女]', ['hotopertew'], ['class' => 'btn btn-primary']) ?>
    </div>
    <div class="footer-container" style="border-top:0px solid #999; height: 40px;"></div>
    <?= GridView::widget([
        'options' => ['class'=>'box-body'],
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'mobile',
            'nickname',
//            'password',
    		[
    		'label'=>'用户种类',
    		'attribute' => 'utype',
    		'value' => function ($dataProvider) {
    				return Yii::$app->params['user_utype'][$dataProvider->utype];
    			}
    		],

    		'userextra.hot_ranking',

        ],
    ]); ?>

</div>
