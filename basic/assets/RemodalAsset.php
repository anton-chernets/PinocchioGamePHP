<?php
namespace app\assets;

use yii\web\AssetBundle;

class RemodalAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/remodal.css',
        'css/remodal-default-theme.css',
    ];
    public $js = [
        '//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js',
        'js/jquery.min.js',
        'js/remodal.js',
    ];
    public $depends = [
    ];
}