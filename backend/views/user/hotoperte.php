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
	<div class="box-body">
	<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
	    <div class="form-group">
	    	<?= Html::submitButton('确认', ['class' => 'btn btn-primary']) ?>
	    	<?= Html::a('取消', ['hot'], ['class' => 'btn btn-primary']) ?>
	    </div>
        <div class="form-group field-config-config_key">
			<label class="control-label" for="config-config_key">已选中：</label>
			<input type="hidden" name="importok" value="1">
		</div>
		<table class="table table-striped table-bordered detail-view" id="added">
			<tr>
				<td>用户ID</td><td>昵称</td><td>排名</td>
			</tr>
			<?php foreach ($add_arr as $add_arr) {?>
			<tr>
				<td><?=$add_arr['id']?><input type="hidden" name="id[]" value="<?=$add_arr['id']?>"></td><td><?=$add_arr['nickname']?></td><td><input type="text" name="xu[]" value="<?=$add_arr['hot_ranking']?>"></td>
			</tr>
			<?php }?>
		</table>
	<?php ActiveForm::end(); ?>
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
    		
            ['class' => 'yii\grid\ActionColumn', 'template' => '{add}', 'buttons' => [
                'add' => function($url, $model, $key) {
                	//return Html::a('选中', ['javascript:void(0)', 'id' => $model->id, 'nickname' => $model->nickname]);
    				if (is_inarr($model->id)!==false) {
                		return '<a class="btn btn-default">已选中</a>';
                	} else {
                		//return '<a href="javascript:void(0)" onclick=\'add('.$model->id.', "'.urlencode($model->nickname).'")\' class="btn btn-primary add">选中</a>';
                		return '<a href="javascript:void(0)" id="'.$model->id.'" nickname="'.$model->nickname.'" ranking="'.$model->userextra->hot_ranking.'" class="btn btn-primary add">选中</a>';
                	}
                }
            ]],
        ],
    ]); ?>

</div>

<?php 

function is_inarr($id){
	if (isset($_COOKIE['added'])) {
		$added = explode(',', $_COOKIE['added']);
	} else {
		$added = array();
	}
	return array_search($id, $added);
}

?>
<script type="text/javascript">
jQuery(".add").click(function(){
//function add(id, nickname){
	var id = $(this).attr('id');
	var nickname = $(this).attr('nickname');
	var ranking = $(this).attr('ranking');
	var added = $("#added");
	added.append('<tr><td>'+id+'<input type="hidden" name="id[]" value="'+id+'"></td><td>'+decodeURIComponent(nickname)+'</td><td><input type="text" name="xu[]" value="'+ranking+'"></td></tr>');
	if (getCookie("added")) {
		var arr = getCookie("added");
		arr = arr.split(",");
	} else {
		var arr = new Array(0);
	}
	arr.push(id);
	setCookie("added",arr);
	$(this).parent('td').replaceWith('<td><a class="btn btn-default">已选中</a></td>');
});

function getCookie(name)
{
var arr,reg=new RegExp("(^| )"+name+"=([^;]*)(;|$)");
if(arr=document.cookie.match(reg))
return unescape(arr[2]);
else
return null;
}

function setCookie(name,value)
{
var Hour = 1;
var exp = new Date();
exp.setTime(exp.getTime() + Hour*60*60*1000);
document.cookie = name + "="+ escape (value) + ";expires=" + exp.toGMTString();
}

function delCookie(name)
{
var exp = new Date();
exp.setTime(exp.getTime() - 1);
var cval=getCookie(name);
if(cval!=null)
document.cookie= name + "="+cval+";expires="+exp.toGMTString();
}

</script>