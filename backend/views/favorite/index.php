<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\ActiveForm;
use backend\models\Config;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\FeedbackSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '红人管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="feedback-index box">
    <div class="box-header">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
	    <div class="controls form-group">
	    	<div class="input-prepend input-group">
	    	<?= Html::a('导入配置', ['import'], ['class' => 'btn btn-primary']) ?>
	    	
	    	<select name="mouth" id="mouth" class="add-on input-group-addon" style="width: 110px;margin-right: 10px;margin-left: 30px;">
				<?php foreach ($mouths as $mouth) {?>
					<option value="<?=$mouth?>" <?php if(date("Y-m") == $mouth){ echo 'selected="selected"';}?>><?=$mouth?></option>
				<?php } ?>
			</select>
	    	<a href="javascript:void(0)" class="btn btn-primary export">任务进度导出</a>
	    	</div>
	    </div>
	    
	<?php ActiveForm::end(); ?>
    </div>
    <?= GridView::widget([
        'options' => ['class'=>'box-body'],
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

    		'user_id',
    		'user.nickname',
    		
            'created',

            ['class' => 'yii\grid\ActionColumn', 'template' => '{view} {delete}'],
    		
        ],
    ]); ?>

</div>
<script type="text/javascript">
jQuery(".export").click(function(){
	window.location.pathname = '/favorite/exportmouth?t=' + $('#mouth').val();
});
</script>