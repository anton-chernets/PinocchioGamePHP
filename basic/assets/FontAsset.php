<?php
namespace app\assets;

use yii\web\AssetBundle;

class FontAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        '//fonts.googleapis.com/css?family=Oldenburg',
        '//fonts.googleapis.com/css?family=Lobster',
        '//fonts.googleapis.com/css?family=Indie+Flower',
    ];
    public $cssOptions = [
        'type' => 'text/css',
    ];
}