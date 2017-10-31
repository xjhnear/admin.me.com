<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Tabs;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => '宣言审核', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="user-index box">
<div id="w1" class="box-body">
<table class="table table-striped table-bordered">
<thead>
<tr><th>#</th><th>图片预览</th><th>操作</th></tr>
</thead>
<tbody>
<?php 
$i = 1;
$photo_url = $model->photo;
?>
<?php while ((@fopen( $photo_url, 'r' )) && ($i<=30)) {?>
<tr data-key="<?=$i?>">
<td><?=$i?></td>
<td><img src="<?=$photo_url?>" width="350" alt=""></td>
<td><a class="btn btn-primary" href="/approve/videoindexset?id=<?=$i?>&back=<?=$model->id?>">设为封面</a></td>
</tr>
<?php
$i++; 
$photo_url = preg_replace("/\/offset\/.+\/rotate\/auto/is", "/offset/".$i."/rotate/auto", $photo_url);
} 
?>
</tbody></table>

</div>
</div>
