<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Tabs;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

?>
<div class="user-index box">


<table class="table table-striped table-bordered"><thead>
<tr><th>对话ID</th><th>对方ID</th><th>聊天内容</th><th>&nbsp;</th></tr>
</thead>
<tbody>
<?php if (count($dataProvider)>0) {?>
<?php foreach ($dataProvider as $item) {?>
<tr>
<td><?=$item['conv-id']?></td>
<td><?=$item['to']?></td>
<td>
<table class="table table-striped table-bordered">
<?php if (isset($item['data'])) {?>
<?php foreach ($item['data'] as $data) {?>
	<tr>
	<td><?=$data['timestamp']?></td>
	<td><?php if($data['action'] <> "") { echo $data['action']; }else{ echo $data['lctext'];}?></td>
	</tr>
<?php }?>
<?php }?>
</table>
</td>
<td>
<input name="ConversationTo[]" value="<?=$item['to']?>" type="hidden"/>
<input name="Conversation[]" type="checkbox" value='<?=addslashes(json_encode($item))?>' style="width:20px;height:20px;"/>
</td>
</tr>
<?php }?>
<?php }else{ ?>
<tr><td colspan="6"><div class="empty">没有找到数据。</div></td></tr>
<?php } ?>
</tbody></table>

</div>
