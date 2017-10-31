<?php  
use yii\helpers\Html;  
use yii\helpers\HtmlPurifier;  
?>  
<div class="post" style="width:200px;">  
    <div style="width:100%;text-align: center;padding: 10px;height:160px;">
    <a href="/approve/photoview/?id=<?= $model->id ?>">
    <img src="<?= $model->photo?>" style="max-width:150px;max-height:150px;" alt="">
    </a>
    <p><?php if (isset($model->video_url)) { echo "<b>[视频]</b>";}?><?= $model->text?></p>
    </div>
    <div style="width:100%;text-align: center;padding: 80px 10px 10px;">
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