<?php


namespace App\Assets\Packages\Trad3r;


use yii\web\AssetBundle;
use yii\web\View;

class MainAsset extends AssetBundle
{
    public $sourcePath = '@trad3r_resources';
    public $css = [
        'css/main.min.css',
        'css/custom.css'
    ];

    public $js = [
        'js/scripts.min.js',
        'js/custom.js'
    ];

    public $jsOptions = ['position' => View::POS_HEAD];

    public $depends = [
        CommonTrad3rAssets::class
    ];
}