<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '会员管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index box">

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
			
    		'province',
    		
    		['label'=>'设备号',  'attribute' => 'udid',  'value' => 'device.udid' ],
    		
            // 'utype',
            // 'sex',
            // 'avatar',
            // 'avatar_lg',
            // 'qq',
            // 'phone',
            // 'wechat',
            // 'province',
            // 'city',
            // 'district',
            // 'homeland',
            // 'height',
            // 'industry',
            // 'post',
            // 'relationship',
            // 'birthday',
            // 'age',
            // 'starsign',
            // 'figure',
            // 'life_level',
            // 'optional_sex',
            // 'optional_love',
            // 'hobby',
            // 'hobby_other',
            // 'is_mobile_open',
            // 'education',
            // 'is_car_certificated',
            // 'car_certification_stage',
            // 'avatar_certification_stage',
            // 'id_certification_stage',
            // 'video_certification_stage',
            // 'unmakeup_certification_stage',
            // 'part_certification_stage',
            // 'is_id_certificated',
            // 'is_video_certificated',
            // 'completion',
            // 'is_active',
            // 'blacklisted',
            // 'is_photo_open',
            // 'level',
            // 'level_name',
            // 'credit_grade',
            // 'grade_name',
            // 'signature',
            // 'created',
            // 'updated',
            // 'month_cancel',
            // 'completion_fields',

            ['class' => 'yii\grid\ActionColumn', 'template' => '{view} ', 'buttons' => [
                'blacklisted' => function($url, $model, $key) {
                    return ($model->blacklisted == 0 || $model->blacklisted == null) ? Html::a('禁用', ['blacklisted', 'id' => $model->id, 'status' => 1]) : Html::a('启用', ['blacklisted', 'id' => $model->id, 'status'=>1]);
                },
                'sort' => function($url, $model, $key) {
                    return Html::a('修改排名', ['sort', 'id' => $model->id]);
                }
            ]],
        ],
    ]); ?>

</div>
