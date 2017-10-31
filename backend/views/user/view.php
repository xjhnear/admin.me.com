<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Tabs;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = $model->nickname;
$this->params['breadcrumbs'][] = ['label' => '会员管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view box">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nickname',
        ],
    ]) ?>
    

<?= Tabs::widget([
    'items' => [
        [
            'label' => '基本信息',
			'content' => $this->render('baseinfo',['model'=>$model]),
			'headerOptions' => ["id" => 'tab1'],
			'options' => ['id' => 'topic1'],
			'active' => true
        ],
        [
            'label' => '个人资料',
			'content' => $this->render('identification',['model'=>$model]),
			'headerOptions' => ["id" => 'tab2'],
			'options' => ['id' => 'topic2'],
        ],
        [
            'label' => '认证信息',
			'content' => $this->render('approve',['model'=>$model]),
			'headerOptions' => ["id" => 'tab3'],
			'options' => ['id' => 'topic3'],
        ],
//         [
//             'label' => '登陆记录',
//             'url' => ['user/accesslog','id'=>$model->id],
// 			'linkOptions' => ['target' => '_blank'],
//         ],
        [
            'label' => '充值记录',
            'url' => ['user/rechargehistory','id'=>$model->id],
			'linkOptions' => ['target' => '_blank'],
        ],
        [
            'label' => '消费/收入记录',
            'url' => ['user/pointhistory','id'=>$model->id],
			'linkOptions' => ['target' => '_blank'],
        ],
        [
            'label' => '提现记录',
            'url' => ['user/withdraw','id'=>$model->id],
			'linkOptions' => ['target' => '_blank'],
        ],
        [
            'label' => '宣言记录',
            'url' => ['user/photo','id'=>$model->id],
			'linkOptions' => ['target' => '_blank'],
        ],
		[
			'label' => '公开照片',
			'url' => ['user/open','id'=>$model->id],
			'linkOptions' => ['target' => '_blank'],
		],
		[
			'label' => '私密照片',
			'url' => ['user/private','id'=>$model->id],
			'linkOptions' => ['target' => '_blank'],
		],
        [
            'label' => '聊天记录',
			'content' => $this->render('conversation',['dataProvider'=>$dataConversation]),
			'headerOptions' => ["id" => 'tab4'],
			'options' => ['id' => 'topic4'],
        ],

    ],
]);

?>


    <div class="box-header">
        <?= Html::a('修改排名', ['hot', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
		<?= Html::a('等级调整', ['level', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
		<?= Html::a('钻石调整', ['diamond', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
		<?= Html::a('账号封停', ['blacklisted', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
		<?= Html::a('宣言下架', ['photodown', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
		<?= Html::a('宣言上架', ['photoup', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
		<?= Html::a('点赞调整', ['voteup', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
		<?= Html::a('清除签名', ['signature', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
		<?= Html::a('系统回复', ['notice', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </div>

</div>
