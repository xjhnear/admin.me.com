<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Tabs;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model backend\models\User */


// function status_all($v, $filed, $id) {
// 	switch($v->{$filed}) {
// 		case 0:
// 			return '<a href="/approve/photoview?id='.$v->{$id}.'"><span class="label label-warning">待审核</span></a>';
// 			break;
// 		case 1:
// 			return '<span class="label label-success">审核通过</span>';
// 			break;
// 		case 2:
// 			return '<span class="label label-danger">拒绝</span>';
// 			break;
// 	}
// }

?>
<div class="user-index box">

    <?= GridView::widget([
        'options' => ['class'=>'box-body'],
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            'id',
            'user.nickname',
            'alias',
            // 'release_long',
            // 'message',
            'created',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn', 'template' => '{add}', 'buttons' => [
                'add' => function($url, $model, $key) {
//     				if (is_inarr($model->id)!==false) {
//                 		return '<a class="btn btn-default">已选中</a>';
//                 	} else {
                		return '<input name="FriendTo[]" value="'.$model->to_user.'" type="hidden"/><input name="Friend[]" type="checkbox" value="'.$model->id.'" style="width:20px;height:20px;"/>';
//                 	}
                }
            ]],
        ],
    ]); ?>
    
</div>
