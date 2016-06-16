<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
?>
<h1>test</h1>
<ul>
	<?php foreach($pqa as $v):?>
	<li>
		<?php echo $v->name;?>
	</li>
	<?php endforeach;?>
</ul>