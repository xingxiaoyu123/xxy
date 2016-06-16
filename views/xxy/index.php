<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<?php $form = ActiveForm::begin();?>
	<?=$form->field($model,'username')->textInput(['style'=>'width:200px;'])?>
	<?=$form->field($model,'pass')->passwordInput(['style'=>'width:200px;'])?>
	<?=$form->field($model,'repass')->passwordInput(['style'=>'width:200px;'])?>
	<?//=$form->field($model,'email')->textInput(['style'=>'width:200px;'])?>
	<?//=$form->field($model,'sex')->radioList(['1'=>'男','0'=>'女'])?>
	<?//=$form->field($model,'hobby')->checkboxList(['篮球'=>'篮球','足球'=>'足球','电影'=>'电影','音乐'=>'音乐'])?>
	<?require_once __DIR__ . '/../../commands/class.geetestlib.php';?>	
	<div>
		<?=Html::submitButton('注册',['class'=>'btn btn-primary'])?>
	</div>
<?php $form = ActiveForm::end();?>