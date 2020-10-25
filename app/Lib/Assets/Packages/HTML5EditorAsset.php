<?php

namespace App\Assets\Packages;

use yii\web\AssetBundle;
use yii\web\View;

class HTML5EditorAsset extends AssetBundle
{

    /** @var string */
    public $sourcePath = '@packages';

    /** @var array */
    public $js = [
//        'https://cdn.ckeditor.com/ckeditor5/22.0.0/classic/ckeditor.js',
        'https://cdn.ckeditor.com/4.15.0/standard-all/ckeditor.js'
    ];

    /** @var array */
    public $css = [
    ];

    public $jsOptions = ['position' => View::POS_HEAD];
}