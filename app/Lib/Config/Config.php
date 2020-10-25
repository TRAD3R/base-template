<?php


namespace App\Config;


use App\App;
use App\Assets\AdminAsset;
use App\Assets\AssetHelper;
use App\Assets\Packages\HTML5EditorAsset;
use App\Assets\Packages\JuiAsset;

abstract class Config
{
    /**
     * @return string
     */
    public function getFaceDomain()
    {
        return App::i()->getApp()->params['domains']['main'];
    }

    /**
     * @return array
     */
    abstract public function getAdminMenuItems();

    /**
     * @return string
     */
    abstract public function getAdminBaseUrl();

    /**
     * @return string
     */
    abstract public function getProjectLanguage();

    /**
     * @return string
     */
    abstract public function getDefaultTimeZone();

    /**
     * @return string
     */
    abstract public function getCookieKey();

    /**
     * @return array
     */
    abstract public function getClientScriptConfig();

    /**
     * @return string
     */
    public function getPublicDir()
    {
        return 'out';
    }

    /**
     * @return string
     */
    public function getConfig1Dir()
    {
        return 'configurator1' . DIRECTORY_SEPARATOR . 'docs';
    }

    /**
     * @return string
     */
    public function getConfig2Dir()
    {
        return 'configurator2' . DIRECTORY_SEPARATOR . 'docs';
    }

    /**
     * @return string
     */
    abstract public function getPathToPublicStatic();

    protected function getAdminClientScriptConfig()
    {
        return [
            App::CONFIG_MODULE_ADMIN      => [
                AssetHelper::BUNDLES     => [
                    AdminAsset::class,
                ],
                AssetHelper::CONTROLLERS => [
                    'user' => [
                        AssetHelper::CONTROLLER_ALL => [
                            AssetHelper::BUNDLES => [
                                JuiAsset::class,
                            ]
                        ],
                    ],
                    'ppk' => [
                        AssetHelper::CONTROLLER_ALL => [
                            [
                                AssetHelper::BUNDLES => [
//                                    BootstrapFileInputAsset::class,
                                    HTML5EditorAsset::class,
                                ]
                            ]
                        ]
                    ],
                ],
            ],
        ];
    }

    public function getAdminCookiePrefix()
    {
        return 'admin_cookie';
    }

}