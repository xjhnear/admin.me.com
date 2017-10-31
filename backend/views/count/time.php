<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Tabs;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model backend\models\User */


?>
<div class="user-index box">
<div id="w1" class="box-body">
<div class="summary">共<b><?=count($dataProvider)?></b>条数据.</div>
<table class="table table-striped table-bordered">
<thead>
<tr><th>#</th><th>日期</th><th>00</th><th>01</th><th>02</th><th>03</th><th>04</th><th>05</th><th>06</th><th>07</th><th>08</th><th>09</th><th>10</th><th>11</th><th>12</th><th>13</th><th>14</th><th>15</th><th>16</th><th>17</th><th>18</th><th>19</th><th>20</th><th>21</th><th>22</th><th>23</th></tr>
</thead>
<tbody>
<?php 
$i = 1;
?>
<?php foreach ($dataProvider as $data) {?>
<tr data-key="<?=$data->id?>">
<td><?=$i?></td>
<td>
<?=$data->daytime?>
</td>
<td>
<?=$data->h00?>
</td>
<td>
<?=$data->h01?>
</td>
<td>
<?=$data->h02?>
</td>
<td>
<?=$data->h03?>
</td>
<td>
<?=$data->h04?>
</td>
<td>
<?=$data->h05?>
</td>
<td>
<?=$data->h06?>
</td>
<td>
<?=$data->h07?>
</td>
<td>
<?=$data->h08?>
</td>
<td>
<?=$data->h09?>
</td>
<td>
<?=$data->h10?>
</td>
<td>
<?=$data->h11?>
</td>
<td>
<?=$data->h12?>
</td>
<td>
<?=$data->h13?>
</td>
<td>
<?=$data->h14?>
</td>
<td>
<?=$data->h15?>
</td>
<td>
<?=$data->h16?>
</td>
<td>
<?=$data->h17?>
</td>
<td>
<?=$data->h18?>
</td>
<td>
<?=$data->h19?>
</td>
<td>
<?=$data->h20?>
</td>
<td>
<?=$data->h21?>
</td>
<td>
<?=$data->h22?>
</td>
<td>
<?=$data->h23?>
</td>

</tr>
<?php 
$i++;
} 
?>
</tbody></table>

</div>
</div>
