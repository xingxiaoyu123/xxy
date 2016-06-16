<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<script src="<?php echo Yii::$app->request->baseUrl; ?>/js/jquery-1.9.1.min.js" type="text/javascript"></script>

<!-- <?php //$form = ActiveForm::begin();?> -->
<?php $form = ActiveForm::begin([ 'action' => ['cip/fenye'],'method'=>'get','options'=>['enctype'=>'multipart/form-data']]);?>
	<?=$form->field($model,'fangfa')->radioList(['a'=>'输入ip','b'=>'输入地址','c'=>'按ISP查'])?>
	<?=$form->field($model,'ip')->textInput(['style'=>'width:200px;'])?>
	<?=$form->field($model,'address')->textInput(['style'=>'width:200px;'])?>
	<?=$form->field($model,'isp')->textInput(['style'=>'width:200px;'])?>
	<div>
		<?=Html::submitButton('查询',['class'=>'btn btn-primary'])?>
	</div>
<?php $form = ActiveForm::end();?>
<script type="text/javascript">
	$(function(){
		$('.field-ipform-ip').css("display","none");	
		$('.field-ipform-address').css("display","none");
		$('.field-ipform-isp').css("display","none");
		$('input[type="radio"]').click(function(){
			a=$('input[type="radio"]:checked').val();
			switch(a)
			{
				case 'a':
					$('.field-ipform-ip').css("display","block");	
					$('.field-ipform-address').css("display","none");
					$('.field-ipform-isp').css("display","none");
					break;
				case 'b':
					$('.field-ipform-ip').css("display","none");	
					$('.field-ipform-address').css("display","block");
					$('.field-ipform-isp').css("display","none");
					break;
				case 'c':
					$('.field-ipform-ip').css("display","none");	
					$('.field-ipform-address').css("display","none");
					$('.field-ipform-isp').css("display","block");
					break;
			}
		})
			
	})
</script>