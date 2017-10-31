<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Tabs;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = '宣言记录';
$this->params['breadcrumbs'][] = $this->title;


function status_all($v, $filed, $id) {
	switch($v->{$filed}) {
		case 0:
			return '<a href="/approve/photoview?id='.$v->{$id}.'"><span class="label label-warning">待审核</span></a>';
			break;
		case 1:
			return '<span class="label label-success">审核通过</span>';
			break;
		case 2:
			return '<span class="label label-danger">拒绝</span>';
			break;
	}
}

?>
<div class="user-index box">

    <?= GridView::widget([
        'options' => ['class'=>'box-body'],
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
				
    		[
    		'attribute' => 'photo',
    			'value' => function($v) {
    				return Html::img($v->photo, ["width" => 150]);
    			},
    			'format' => 'raw'
    		],
    		'text',
            'voteup',
            [
            'attribute' => 'is_approve',
            'value' => function($v) {
            return status_all($v, 'is_approve', 'id');
            },
            'format' => 'html'
            ],
            'created',
			
            ['class' => 'yii\grid\ActionColumn', 'template' => '{add}', 'buttons' => [
                'add' => function($url, $model, $key) {
                	return Html::a('评论', ['photocomment', 'id' => $model->id], ['class' => 'btn btn-primary']);

                }
            ]],
        ],
    ]); ?>
    
</div>
