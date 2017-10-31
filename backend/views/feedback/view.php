<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Feedback */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => '意见反馈', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="feedback-view box">


    <div class="box-body">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'user_id',
    		'user.nickname',
    		'user.mobile',
            'content',
            'created',
        ],
    ]) ?>
    </div>
</div>
