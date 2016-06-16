<?php

namespace app\models;
use Yii;
use yii\base\Model;
header('Content-TYpe:text/html;charset=utf-8');
class IpForm extends Model{
	public $ip;
	public $fangfa;
	public $address;
	public $isp;
	public function rules(){
		return [
			['ip','match','pattern'=>'/^(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])$/ ','message'=>'请输入正确ip地址'],
			['fangfa','required','message'=>'请选择你要查询的方式']
		];
	}

	public function attributeLabels(){
		return [
			'ip'=>'请输入ip',
			'fangfa'=>'查询方式',
			'address'=>'请输入地址',
			'isp'=>'请输入ISP',
		];
	}
}
?>