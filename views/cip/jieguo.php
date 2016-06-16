<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
?>
<table class="table table-bordered">
	<tr>
		<th>起始IP</th>
		<th>终止IP</th>
		<th>地址</th>
		<th>ISP</th>
	</tr>
	<?foreach($res as $v=>$k){?>
	<tr>
		<th><?echo $k['sip']?></th>
		<th><?echo $k['eip']?></th>
		<th><?echo $k['address']?></th>
		<th><?echo $k['isp']?></th>
	</tr>		
	<?}?>
</table>
<?
echo LinkPager::widget([
    'pagination' => $pages,
     'nextPageLabel' => '下一页', 
    'prevPageLabel' => '上一页',
    'firstPageLabel' => '首页', 
    'lastPageLabel' => '尾页',
    'maxButtonCount' => 8, 
]);
// var_dump($pages);
?>