<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\DiamondOrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '提现管理';
$this->params['breadcrumbs'][] = $this->title;

function created($v, $filed) {
	$zero1=strtotime (date("Y-m-d H:i:s"));
	$zero2=strtotime ($v->{$filed});
	$dis=ceil(($zero1-$zero2)/86400);

	if ($v->status == 'pending' && $dis >= 3) {
		return '<span style="background-color:#d73925; color:#ffffff;">'.$v->{$filed}.'</span>';
	} else {
		return '<span>'.$v->{$filed}.'</span>';
	}

}

?>

<?php $form = ActiveForm::begin(); ?>
<div class="box-header">
	<?= Html::submitButton('批量通过', ['class' => 'btn btn-primary']) ?>
</div>

<div class="diamond-order-index box">

    <?= GridView::widget([
        'options' => ['class'=>'box-body'],
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
    		
            ['class' => 'yii\grid\SerialColumn'],
			'user_id',
    		'account_no',
    		'account_name',
    		'diamond',
    		'rmb',
            //'operator',
    		[
    		'attribute' => 'status',
    		'value' => function ($dataProvider) {
    		return Yii::$app->params['withdraw_status'][$dataProvider->status];
    		}
    		],

            [
                'attribute' => 'created',
                'value' => function($v) {return created($v, 'created');},
                'format' => 'html'
            ],
            //'paid_time',

    		[
    		'class' => 'yii\grid\ActionColumn', 'template' => '{success} {fail}',
    		'buttons' => [
    		'success' => function($url, $dataProvider, $key) {
    		if ($dataProvider->status == 'pending') {
    			return Html::a('通过', ['withdrawsuccess', 'id' => $key, 'uid' => $dataProvider->user_id], ['class' => 'btn btn-primary',
    					'data' => [
    					'confirm' => '确认通过此提现?',
    					'method' => 'post',
    					],
    					]);
    		}
    		},
    		'fail' => function($url, $dataProvider, $key) {
    			return '<input type="button" class="btn btn-danger" onclick=\'disp_prompt('.$key.', '.$dataProvider->user_id.')\' value="拒绝" />';

    		},
    		]
    		],
    		
            ['class' => 'yii\grid\ActionColumn', 'template' => '{add}', 'buttons' => [
                'add' => function($url, $model, $key) {
                	return '<input name="Withdraw[]" type="checkbox" value="'.$model->id.'" style="width:20px;height:20px;"/>';
                }
            ]],
    		
        ],
    ]); ?>

</div>

<?php ActiveForm::end(); ?>

<script type="text/javascript">
function disp_prompt(id, backview)
  {
  var name=prompt("被拒原因：","")
  if (name!=null && name!="")
  {
	  window.location.href = "/withdraw/withdrawfail?id="+id+"&uid="+backview+"&reason="+name;
  }
  else if (name=="")
  {
	  window.location.href = "/withdraw/withdrawfail?id="+id+"&uid="+backview;
  }
}
</script>
