<?php  
use yii\helpers\Html;  
use yii\helpers\HtmlPurifier;  
?>  
<div class="post" style="width:200px;">  
    <div style="width:100%;text-align: center;padding: 10px;height:160px;">
    <a href="<?= $model->path?>" target="_blank">
    <img src="<?= $model->path?>" style="max-width:150px;max-height:150px;" alt="">
    </a>
    <p><a href="/user/view?id=<?= $model->user_id?>" class='label label-warning' target="_blank">ID: <?= $model->user_id?></a></p>
    </div>
    <div style="width:100%;text-align: center;padding: 30px 10px 10px;">
    <a class="btn btn-primary" href="/approve/privatesuccess?id=<?= $model->id ?>&back=private">通过</a>
	<input type="button" class="btn btn-danger" onclick="disp_prompt(<?= $model->id ?>)" value="拒绝" />

	</div>  
</div>
<style>
.mydd_box
{
width:200px;
float: left;
}
.pagination
{
width: 100%;

}
</style>