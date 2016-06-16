<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Progress;
?>
<script src="<?php echo Yii::$app->request->baseUrl; ?>/js/jquery-1.9.1.min.js" type="text/javascript"></script>
<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

<?= $form->field($model, 'file')->fileInput() ?>

<button>点击上传</button>
<!-- <div class="progress">
  <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
    60%
  </div>
</div> -->
<p>由于上传文件比较大，请耐心等待~</p>
<?
echo Progress::widget([
    'percent' => '0%',
    'barOptions' => ['class' => 'progress-bar-success'],
    'label' => '0%',
    'options' => ['class' => 'active progress-striped']
]);
?>
<?php $form = ActiveForm::end() ?>
<script type="text/javascript">
	$(function(){
		$('p').css('display','none')
		$('#w1').css('display','none');
		$('button').click(function(){
			setInterval(function(){
				$('#w1').css('display','block');
				$('p').css('display','block')
				$.get("index.php?r=cip/jindu",function(data){
					// alert(data[0]);
					b=parseInt(data[1])/parseInt(data[0])*100;
					c=Math.ceil(b);
					$(".progress-bar-success").css('width',c+'%');
					$(".progress-bar-success").html(c+'%');
				},'json')
			},1000);

		})
	})	
</script>