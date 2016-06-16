<?php
namespace app\controllers;
use Yii;
use yii\web\Controller;
use app\models\UpfileForm;
use yii\web\UploadedFile;
use app\models\UploadForm;
use app\models\ip;
use app\models\IpForm;
use yii\data\Pagination;
header('Content-TYpe:text/html;charset=utf-8');
class CipController extends Controller{
	// public function actionIndex()
	// {

	// } 
	//最开始使用的上传
	public function actionIndex()
    {
        $model = new UpfileForm();

        if (Yii::$app->request->isPost) {
            $model->file = UploadedFile::getInstance($model, 'file');

            if ($model->file && $model->validate()) { 
            	// $base_path='uploads/';               
            	// if(!is_dir($base_path)) {
             //        mkdir($base_path , 0777);
             //    }  
                $model->file->saveAs('uploads/'.$model->file->baseName.'.'.$model->file->extension);
            }
        }

        return $this->render('index', ['model' => $model]);
    }


    //文件上传
    public function actionUpload()
    {
        $model = new UploadForm();

        if (Yii::$app->request->isPost) {
            $model->file = UploadedFile::getInstance($model, 'file');
            if ($model->upload()) {
                // 文件上传成功
                // return;
                // echo $this->file;
                // var_dump($model->file->name);
                if(file_exists('uploads/'.$model->file->name)) {
		    		$wenjian=file_get_contents('uploads/'.$model->file->name);
		    		// $arr=[];
		    		// $tihuan=preg_replace('/\n+/','#_#',$wenjian);
		    		// $tihuan2=preg_replace('/\s+/','@',$tihuan);
		    		// $arr=explode('#_#',$tihuan2);
		    		$con=\Yii::$app->db;
		    		$com=$con->createCommand('INSERT INTO `xxy_ip` (`sip`,`scip`,`eip`,`ecip`,`address`,`isp`) VALUES (:sip,:scip,:eip,:ecip,:address,:isp)');
		    		$com->bindParam(':sip',$sip);// ,':scip'=>$cip,':eip'=>$eip,':ecip'=>$ecip,':address'=>$address,':isp'=>$isp);
		    		$com->bindParam(':scip',$scip);
		    		$com->bindParam(':eip',$eip);
		    		$com->bindParam(':ecip',$ecip);
		    		$com->bindParam(':address',$address);
		    		$com->bindParam(':isp',$isp);

		    		$file = fopen('uploads/1.txt', "r");
					while(!feof($file))
					{
						// echo fgets($file). "<br />";
						$wenjian=fgets($file);
						$th=preg_split('/\s+/', $wenjian,4);
						// print_r($tihuan);
		    			$sip=$th[0];
		    			$scip=ip2long($th[0]);
		    			$eip=$th[1];
		    			$ecip=ip2long($th[1]);
		    			$address=$th[2];
		    			$isp=$th[3];
		    			$com->execute();
					}
					fclose($file);
		    		// foreach ($arr as $key => $value) {
		    		// 	$zhi=explode('@',$value);
		    		// 	$sip=$zhi[0];
		    		// 	$scip=ip2long($zhi[0]);
		    		// 	$eip=$zhi[1];
		    		// 	$ecip=ip2long($zhi[1]);
		    		// 	$address=$zhi[2];
		    		// 	$isp=$zhi[3];
		    		// 	$com->execute();
		    		// }
	    		}
            }
        }

        return $this->render('index', ['model' => $model]);
    }
    

    public function actionNewup(){
    	ini_set('memory_limit', '1024m');
    	if(file_exists('uploads/linshi.txt')) {
    		unlink('uploads/linshi.txt');
    	}
    	$model = new UploadForm();
    	if(Yii::$app->request->isAjax){
    		$jin=\Yii::$app->db;
    		$command=$jin->createCommand('SELECT COUNT(id) FROM xxy_ip');
    		$postCount = $command->queryScalar();
    		
    		echo $postCount;exit;
    	}
        if (Yii::$app->request->isPost) {
            $model->file = UploadedFile::getInstance($model, 'file');
            if ($model->upload()) {
                // 文件上传成功
                // return;
                echo "上传成功";
                // var_dump($model->file->name);
                if(file_exists('uploads/'.$model->file->name)) {
		    		$wenjian=file_get_contents('uploads/'.$model->file->name);
		    		$arr=[];
		    		$tihuan=preg_replace('/\n+/','#_#',$wenjian);
		    		$arr2=explode('#_#',$tihuan);
		    		$arr=array_chunk($arr2,8000);
		    		$tot=count($arr2);
		    		$i=8000;
		    		$con=\Yii::$app->db;
		    		foreach ($arr as $k => $v) {
		    			$data=[];
		    			foreach($v as $key =>$val){
		    				$th=mb_split('\s+',$val,4);
		    				$cip1=bindec(decbin(ip2long($th[0])));
		    				$cip2=bindec(decbin(ip2long($th[1])));;	
		    				$data[] = [$th[0],$cip1,$th[1],$cip2,$th[2],$th[3]];
		    			}
		    			if($i>$tot){
		    				$i=$tot;
		    			}
		    			$con->createCommand()->batchInsert('xxy_ip',['sip','scip','eip','ecip','address','isp'],$data)->execute();
		    			file_put_contents('uploads/linshi.txt',$tot.'^_^'.$i);
		    			$i=$i+8000;
		    		}
		    		
		    	}
		    	return $this->render('index2');
            }
        }

        return $this->render('index', ['model' => $model]);
    }



    public function actionJindu()
    {
    	if(file_exists('uploads/linshi.txt')) {
			$du=file_get_contents('uploads/linshi.txt');
	    	$shujv=explode('^_^',$du);
	    	echo json_encode($shujv);
		}else{
			$arr=[100,0];
			echo json_encode($arr);
		}
    }


    public function actionCha()
    {

    	// $con=fopen('uploads/1.txt','r');
    	// $red=fread()
    	// print_r($con);
    	if(file_exists('uploads/1.txt')) {
    		// echo file_get_contents('uploads/1.txt');
    		$wenjian=file_get_contents('uploads/1.txt');
    		$arr=[];
    		$tihuan=preg_replace('/\n+/','#_#',$wenjian);
    		// $tihuan2=preg_replace('/\s+/','@',$tihuan);
    		$arr2=explode('#_#',$tihuan);
    		$arr=array_chunk($arr2,4000);
    		// echo $tihuan
    		// print_r($arr);exit;
    		$con=\Yii::$app->db;



    		foreach ($arr as $k => $v) {
    			// print_r($v);exit;
    			$data=[];
    			foreach($v as $key =>$val){
    				// $zhi=explode('@',$vfprintf(handle, format, args)																				al);
    				$th=preg_split('/\s+/', $val,4);
    				// print_r($th);
    				$cip1=ip2long($th[0]);
    				$cip2=ip2long($th[1]);	
    				$data[] = [$th[0],$cip1,$th[1],$cip2,$th[2],$th[3]];
    			}
    			$con->createCommand()->batchInsert('xxy_ip',['sip','scip','eip','ecip','address','isp'],$data)->execute();
    			// print_r($k);
    			// print_r(count($data));
    			// echo '<br>';
    		}
    		exit;





    		// $tr=$con->beginTransaction();
    		// try{
    				
	    		$com=$con->createCommand('INSERT INTO `xxy_ip` (`sip`,`scip`,`eip`,`ecip`,`address`,`isp`) VALUES (:sip,:scip,:eip,:ecip,:address,:isp)');
	    		$com->bindParam(':sip',$sip);// ,':scip'=>$cip,':eip'=>$eip,':ecip'=>$ecip,':address'=>$address,':isp'=>$isp);
	    		$com->bindParam(':scip',$scip);
	    		$com->bindParam(':eip',$eip);
	    		$com->bindParam(':ecip',$ecip);
	    		$com->bindParam(':address',$address);
	    		$com->bindParam(':isp',$isp);
	    		// $i=1;

    	// 		$data=[];
    	// 		foreach ($arr as $key => $value) {
					// $zhi=explode('@',$value);
	    // 			// [$zhi[0],ip2long($zhi[0]),$zhi[1],ip2long($zhi[1]),$zhi[2],$zhi[3]],	
	    // 			$data[]=$zhi[0];
	    // 			$data[]=ip2long($zhi[0]);
	    // 			$data[]=$zhi[1];
	    // 			$data[]=ip2long($zhi[1]);
	    // 			$data[]=$zhi[2];
	    			// $data[]=$zhi[3];
	    			// if(isset($zhi[2])){
	    			// 	// echo 1;
	    			// }else{
	    			// 	echo 'wo';
	    			// 	// var_dump($zhi);
	    			// 	echo '<hr>';
	    			// 	echo '<h1>'.$i.'</h1>';
	    			// }
	    			// echo '<h1>'.$i.'</h1>';
	    			// $i++;
	    			// var_dump($zhi[0]);
	    			// var_dump($zhi[1]);
	    			// var_dump($zhi[2]);
	    			// var_dump($zhi[3]);
	    			// echo '<br>';


    			}	
    			// echo $data;
    			// $con->createCommand()->batchInsert('xxy_ip',['sip','scip','eip','ecip','address','isp'],$data)->execute();




	    		foreach ($arr as $key => $value) {
	    			$zhi=explode('@',$value);
	    			$sip=$zhi[0];
	    			$scip=ip2long($zhi[0]);
	    			$eip=$zhi[1];
	    			$ecip=ip2long($zhi[1]);
	    			$address=$zhi[2];
	    			$isp=$zhi[3];
	    			$com->execute();
	    			// if(isset($zhi[2])){
	    			// 	echo 1;
	    			// }else{
	    			// 	echo 'wo';
	    			// 	// var_dump($zhi);
	    			// 	echo '<hr>';
	    			// }
	    			// echo '<h1>'.$i.'</h1>';
	    			// $i++;
	    			// var_dump($zhi[0]);
	    			// var_dump($zhi[1]);
	    			// var_dump($zhi[2]);
	    			// var_dump($zhi[3]);
	    			// echo '<br>';

	    		}
	    	// 	return true;

    		// }
  //   		catch(Exception $e)
	 //        {
	 //            $tr->rollBack();
	 //            return false;
	 //        }
    		
		// }
			// $ip=new ip();
			// foreach ($arr as $key => $value) {
			// 	$zhi=explode('@',$value);
			// 	$ip->sip=$zhi[0];
			// 	$ip->scip=ip2long($zhi[0]);
	  //   		$ip->eip=$zhi[1];
	  //   		$ip->ecip=ip2long($zhi[1]);
	  //   		$ip->address=$zhi[2];
	  //   		$ip->isp=$zhi[3];
	  //   		$ip->save();
			// };
		
    }
    public function actionChakan()
    {
  //   	$file = fopen('uploads/1.txt', "r");
		// while(!feof($file))
		// {
		// 	// echo fgets($file). "<br />";
		// 	$wenjian=fgets($file);
		// 	$tihuan2=preg_split('/\s+/', $wenjian,4);
		// 	print_r($tihuan2);
		// }
		// fclose($file);
		$jin=\Yii::$app->db;
		$command=$jin->createCommand('SELECT COUNT(id) FROM xxy_ip');
		$postCount = $command->queryScalar();
		echo $postCount;
    }
    public function actionLook()
    {
    	$model=new ipForm();
    	// $con=new ip();	
    	$con=\Yii::$app->db;

    	if($model->load(Yii::$app->request->post()) && $model->validate()){
    		if(($model->fangfa)=='a'){
    		$ip=$model->ip;	
    		$sip=ip2long($ip);
    		// $res = ip::find()
		    // ->where('scip'>$sip)
		    // ->andwhere('ecip'<$sip)
		    // ->orderBy('id')
		    // ->all();
		    $sql='SELECT * FROM xxy_ip where scip<'.$sip.' and ecip>'.$sip;
		    // $res=ip::findBySql($sql)->all();
		    $res=$con->createCommand($sql)->queryAll();
		    print_r($res);
			}else{
				$ip=$model->ip;	
				$sql='SELECT * FROM xxy_ip where address LIKE "%'.$ip.'%"';
				$res=$con->createCommand($sql)->queryAll();
		    	// print_r($res);
			}
		   	return $this->render('jieguo',['res'=>$res]); 
    	}else{
    		return $this->render('select', ['model' => $model]);

    	}

    }






    //带分页的查询功能。
    public function actionFenye()
    {
    	$model=new ipForm();
    	$con=new ip();	
    	// $model->load(Yii::$app->request->get());
    	// $run=$_GET['IpForm'];
    	// print_r($_GET['IpForm']);exit;
    	// print_r($run);
    	// print_r($_POST['IpForm']);exit;
    	// $con=\Yii::$app->db
    	// if($model->load(Yii::$app->request->post()) && $model->validate()){
    	if(isset($_GET['IpForm'])){
    		$run=$_GET['IpForm'];
    		if($run['fangfa']=='a'){
    		$ip=$run['ip'];	
    		$sip=ip2long($ip);
    		$sql='SELECT * FROM xxy_ip where scip<='.$sip.' and ecip>='.$sip;
    		$query = ip::findBySql($sql);
		    $cou = clone $query;
		    $pages = new Pagination([
			    	'totalCount' => $cou->count(),
			    	'defaultPageSize' => 8
			    	]); 
		    $res = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
            return $this->render('jieguo',[
		   		'res'=>$res,
		   		'pages' => $pages,
		   		]); 
		    // $res=ip::findBySql($sql)->all();
		    // $res=$con->createCommand($sql)->queryAll();
		 //    print_r($res);
			}elseif($run['fangfa']=='b'){

				$ip=$run['address'];	
				$sql='SELECT * FROM xxy_ip where address LIKE "%'.$ip.'%"';
				// $query = ip::findBySql($sql);
				$query=ip::find()
				->where("address LIKE '%{$ip}%'");
			    $cou = clone $query;
			    $pages = new Pagination([
			    	'defaultPageSize' => 8,
			    	'totalCount' => $cou->count()
			    	]); 
			    // var_dump($pages);exit;
			    $res = $query->offset($pages->offset)
	            ->limit($pages->limit)
	            ->all();
	            // var_dump($pages);exit;
			// 	$res=$con->createCommand($sql)->queryAll();
		 //    	// print_r($res);
	            return $this->render('jieguo',[
		   		'res'=>$res,
		   		'pages' => $pages,
		   		]); 
			// }
		   	// return $this->render('jieguo',[
		   	// 	'res'=>$res,
		   	// 	'pages' => $pages,
		   	// 	]); 
    		}elseif ($run['fangfa']=='c') {
    			$ip=$run['isp'];	
				$sql='SELECT * FROM xxy_ip where isp LIKE "%'.$ip.'%"';
				// $query = ip::findBySql($sql);
				$query=ip::find()
				->where("isp LIKE '%{$ip}%'");
			    $cou = clone $query;
			    $pages = new Pagination([
			    	'defaultPageSize' => 8,
			    	'totalCount' => $cou->count()
			    	]); 
			    // var_dump($pages);exit;
			    $res = $query->offset($pages->offset)
	            ->limit($pages->limit)
	            ->all();
	            // var_dump($pages);exit;
			// 	$res=$con->createCommand($sql)->queryAll();
		 //    	// print_r($res);
	            return $this->render('jieguo',[
		   		'res'=>$res,
		   		'pages' => $pages,
		   		]); 
    		}
    	}else{
    		return $this->render('select', ['model' => $model]);

    	}

    }
} 
?>