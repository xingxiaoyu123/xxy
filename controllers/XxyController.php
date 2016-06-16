<?php
namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\XxyForm;
use app\models\xxy;
use yii\data\Pagination;
use yii\db\Query;
header('Content-TYpe:text/html;charset=utf-8');
class XxyController extends Controller{
	public function actionIndex()
    {
    		// echo "test";
        // return $this->render('index');
        $model = new xxyForm();
        $con = new xxy();
        // print_r($model);

        if($model->load(Yii::$app->request->post()) && $model->validate()){
        	// print_r($_POST);exit;
        	// print_r($model->name);
        	// print_r($model->pass);
        	// print_r($model->phone);
        	// if($con->load(Yii::$app->request->post()) && $con->save()){
        	// 	return $this->redirect(['index2','id'=>$con->id]);
        	// }
        	// print_r($model);
        	// $list=Yii::$app->request->post();
        	// print_r($list);
        	// echo $list->post('name');
        	// echo $_POST['pass'];
        	$con->username=$model->username;
        	$con->pass=$model->pass;
        	// $con->phone=$model->phone;
        	$con->save();
            // $con->lastInsertID;
        	return $this->render('index2',['model'=>$model]);
        }else{
        	return $this->render('index',['model'=>$model]);
        }
    }
    public function actionPeo(){
    	$query = xxy::find()->all();
    	// var_dump($query);exit;
    	// $pagination =new Pagination([
    	// 		'defaultPageSize'=>2,
    	// 		'totalCount'=>$query->count(),
    	// 	])
    	// $peo = $query->orderBy('id desc')->offset($pagination->offset)->limit($pagination->limit)->all();
    	return $this->render('chaxun',[
    		'pqa'=>$query,
    		// 'pagination'=>$pagination,
    		]);
    }
    public function actionAdd(){
        $db=\Yii::$app->db;
        $cmd=$db->createCommand()->insert('xxy_table',[
            'username'=>'uuuuu',
            'pass'=>121212121,
        ])->execute();
        //返回最后插入的ID
        return $db->lastInsertID;
    }
    public function actionDadd(){
        return \Yii::$app->db->createCommand()->batchInsert('xxy_table',['username','pass'],[
                ['shabiys',7777777],
                ['erbiyins',888888],
                ['shadiaoys',99999999],
            ])->execute();
    }
    public function actionDel()
    {
        //返回影响行数
        \Yii::$app->db->createCommand()->delete('xxy_table','username="shabiys"')->execute();
    }
    public function actionUp()
    {
        //返回影响行数
        return \Yii::$app->db->createCommand()->update('xxy_table',['username'=>'mayun'],['id'=>7])->execute();
    }
    public function actionCha(){
        $co=\Yii::$app->db->createCommand('select * from xxy_table')->queryAll();
        print_r($co);
    }
    public function actionShiwu(){
        $db=\Yii::$app->db;
        $tr=$db->beginTransaction();
        try
        {
            // $con=$db->createCommand('UPDATE xxy_table SET pass=pass+:ps WHERE id=9');
            // $con->bindValues([':ps'=>500]);
            // $con->execute();
            $con2=$db->createCommand('UPDATE xxy_table SET pass=pass-:ps WHERE id=12');
            $con2->bindValues([':ps'=>500]);
            $con2->execute();
            $tr->commit();
            return true;
        }
        catch(Exception $e)
        {
            $tr->rollBack();
            return false;
        }
    }
    public function actionQu()
    {
        // $res=\Yii::$app->Q->select('username')->from('xxy_table')->where('id=1')->createCommand()->queryOne();
        // print_r($res);
        // echo json_encode($res);



        // $res=(new Query())->select('username')
        // ->distinct(true)
        // ->from('xxy_table')
        // ->createCommand()
        // ->queryAll();
        // print_r($res);
        // echo json_encode($res);


        //返回不同的个数
        // $res=(new Query())->select('pass')
        // ->distinct(true)
        // ->from('xxy_table')
        // ->count('pass');
        // echo json_encode($res);



        //越过两条开始查3条数据  根据id倒叙
        // $res=(new Query())->select('*')
        // ->from('xxy_table')
        // ->limit(3)
        // ->offset(2)
        // ->orderBy('id desc')
        // ->createCommand()
        // ->queryAll();
        // echo json_encode($res);





        $res=(new Query())->select('*')
        ->from('xxy_table')
        ->groupBy('pass')
        ->createCommand()
        ->queryAll();
        echo json_encode($res);
    }
    public function actionZhao()
    {
        // $con=xxy::find()
        // ->where('id>1')
        // ->all();
        // // echo json_encode($con);
        // print_r($con);




        $con=xxy::findAll([1,2,3]);
        foreach ($con as $k => $v) {
            print_r($k);
            echo "::::";
            print_r($v->username);
        }
        // print_r($con);
        // echo json_encode($con[0]);
    }
    //读写分离,自动实现负载均衡
    public function actionSlave()
    {
       $db=\Yii::$app->db;
       $con=$db->createCommand('SELECT * FROM xxy_table')->queryAll();
       $com=$db->createCommand("UPDATE xxy_table SET username='roott' WHERE id=1")->execute();
       echo json_encode($con);
       // print_r($con);    

    } 

    public function actionKan()
    {
        echo __DIR__; 
    }
    public function actionRed()
    {   
        Yii::$app->redis->set('test','111');  //设置redis缓存
        echo Yii::$app->redis->get('test');   //读取redis缓存
        exit;
        return $this->render('index');
    }
}