<?php  
use yii\helpers\Html;  
use yii\helpers\HtmlPurifier;  
?>  
<div class="post" style="width:200px;">  
    <div style="width:100%;text-align: center;padding: 10px;height:160px;">
    <a href="/approve/reportphotoview/?id=<?= $model->photo->id ?>">
    <img src="<?= $model->photo->photo?>" style="max-width:150px;max-height:150px;" alt="">
    </a>
    <p><?= $model->photo->text?></p>
    </div>
    <div style="width:100%;text-align: center;padding: 80px 10px 10px;">
    <a class="btn btn-primary" href="/approve/photosuccess?id=<?= $model->photo->id ?>&back=reportphoto">通过</a>
	<input type="button" class="btn btn-danger" onclick="disp_prompt(<?= $model->photo->id ?>)" value="拒绝" />
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