<?php

namespace app\models;
use Yii;
use yii\base\Model;
header('Content-TYpe:text/html;charset=utf-8');
class XxyForm extends Model{
	public $username;
	public $pass;
	public $repass;
	// public $phone;
	// public $email;
	// public $sex;
	// public $hobby;

	public function rules(){
		return [
			[['username','pass'],'required','message'=>'不能为空'],
			['repass','compare','compareAttribute'=>'pass','message'=>'两次密码必须一致'],
			// ['email','email','message'=>'不是email格式'],
			['username','string','length'=>[4,8]],
			['pass','string','length'=>[7,12]]
		];
	}

	public function attributeLabels(){
		return [
			'username'=>'帐号',
			'pass'=>'密码',
			'repass'=>'再次输入密码'
			// 'phone'=>'手机号码',
		];
	}
}
?>