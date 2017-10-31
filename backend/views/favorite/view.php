<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Tabs;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Feedback */

$this->title = $model->user_id;
$this->params['breadcrumbs'][] = ['label' => '红人管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view box">

<?php $form = ActiveForm::begin(); ?>
<input name="favid" value="<?=$model->user_id?>" type="hidden"/>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
    		'user_id',
    		'user.nickname',
        ],
    ]) ?>
 
 
<table class="table table-striped table-bordered">
<thead>
<tr><th colspan="8">红人历史任务进度</th></tr>
<tr><th>月份</th><th>聊天</th><th>关注</th><th>宣言</th><th>约见</th><th>打赏</th><th>发布约见</th><th>本月收益</th></tr>
</thead>
<tbody>
<?php if (isset($mission_his_model)) {?>
<?php foreach ($mission_his_model as $data) {?>
<tr data-key="<?=$data->id?>">
<td><?=$data->mouth?></td>
<td><?=$data->conversation?></td>
<td><?=$data->friend?></td>
<td><?=$data->photo?></td>
<td><?=$data->see?></td>
<td><?=$data->reward?></td>
<td>
<?php 
if (isset($see_arr[$data->mouth])) {
	echo $see_arr[$data->mouth];
} else {
	echo "0";
}
?>
</td>
<td><?=$data->money?></td>
</tr>
<?php } ?>
<?php }else{ ?>
<tr><td colspan="8"><div class="empty">没有找到数据。</div></td></tr>
<?php } ?>
</tbody></table>


<?= Tabs::widget([
    'items' => [
        [
            'label' => '聊天',
			'content' => $this->render('conversation',['dataProvider'=>$dataConversation]),
			'headerOptions' => ["id" => 'tab1'],
			'options' => ['id' => 'topic1'],
			'active' => true
        ],
        [
            'label' => '关注',
			'content' => $this->render('friend',['dataProvider'=>$dataFriend]),
			'headerOptions' => ["id" => 'tab2'],
			'options' => ['id' => 'topic2'],
        ],
        [
            'label' => '宣言',
			'content' => $this->render('photo',['dataProvider'=>$dataPhoto]),
			'headerOptions' => ["id" => 'tab3'],
			'options' => ['id' => 'topic3'],
        ],
//         [
//             'label' => '匹配',
// 			'content' => $this->render('match',['dataProvider'=>$dataMatch]),
// 			'headerOptions' => ["id" => 'tab4'],
// 			'options' => ['id' => 'topic4'],
//         ],
        [
            'label' => '约见',
			'content' => $this->render('see',['dataProvider'=>$dataSee]),
			'headerOptions' => ["id" => 'tab5'],
			'options' => ['id' => 'topic5'],
        ],
        [
            'label' => '打赏',
			'content' => $this->render('reward',['dataProvider'=>$dataReward]),
			'headerOptions' => ["id" => 'tab6'],
			'options' => ['id' => 'topic6'],
        ],
    ],
]);

?>

    <div class="box-header">
    <?php if($can_check == true) { ?>
        <?= Html::submitButton('审核确定', ['class' => 'btn btn-primary']) ?>
    <?php } else {?>
    	<a class="btn btn-default">已审核</a>
    <?php } ?>
    </div>

    <?php ActiveForm::end(); ?>
    
</div>
