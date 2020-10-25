<?php


namespace App\Assets\Packages\Trad3r;

use yii\bootstrap\BootstrapPluginAsset;
use yii\web\AssetBundle;

/**
 * Class ErrorAsset
 * @package App\Assets\Packages\Trad3r
 */
class ErrorAsset extends AssetBundle
{
    /** @var string  */
    public $sourcePath = '@trad3r_resources';

    /** @var array  */
    public $css = [
        'css/error.css',
    ];

    /** @var array  */
    public $depends = [
        BootstrapPluginAsset::class,
    ];
}