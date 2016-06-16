<?php
namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $file;

    public function rules()
    {
        return [
            // [['file'], 'file', 'skipOnEmpty' => false, 'extensions' => 'txt'],
        [['file'], 'file','extensions' => 'txt','checkExtensionByMimeType'=>false],
        ];
    }
    
    public function upload()
    {
        if ($this->validate()) {
            $this->file->saveAs('uploads/' . $this->file->baseName . '.' . $this->file->extension);
            return true;
        } else {
            return false;
        }
    }
    public function attributeLabels(){
        return [
            'file'=>'文件',
        ];
    }
}
