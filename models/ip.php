<?php
namespace app\models;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii;
class ip extends ActiveRecord{
	public static function tableName(){
		return "xxy_ip";
	}
}
?>