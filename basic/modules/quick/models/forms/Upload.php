<?php

namespace app\modules\quick\models\forms;

use yii\base\Model;
use yii\web\UploadedFile;
use app\modules\quick\models\Images;

class Upload extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;

    protected $path = '';

    protected $webPath = '';

    public function init()
    {
        /** @var $postModule \app\modules\quick\Module */
        $postModule = \Yii::$app->getModule('quick');
        $this->path = \Yii::getAlias('@webroot/'.$postModule->imagePath.'/');
        $this->webPath = \Yii::getAlias('@web/'.$postModule->imagePath.'/');
    }

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $images = new Images([
                'code' => md5_file($this->imageFile->tempName),
                'url' => $this->webPath.$this->imageFile->baseName . '.' . $this->imageFile->extension,
                'name' => $this->imageFile->baseName,
                'extension' => $this->imageFile->extension,
            ]);
            if($images->save()){
                $this->imageFile->saveAs($this->path . $this->imageFile->baseName . '.' . $this->imageFile->extension);
                return true;
            }else{
                $this->addError('imageFile', json_encode($images->getErrors()));
            }
        }
        return false;
    }
}