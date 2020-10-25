<?php


namespace App\Config;


use App\App;
use App\Assets\AssetHelper;
use App\Assets\Packages\Trad3r\MainAsset;
use App\RBAC\RbacHelper;
use Yii;

class Trad3rConfig extends Config
{
    public function getAdminBaseUrl()
    {
        return "/admin";
    }

    public function getProjectLanguage()
    {
        return App::PROJECT_LANGUAGE_RU;
    }

    public function getDefaultTimeZone()
    {
        return "Europe/Moscow";
    }

    public function getCookieKey()
    {
        return 'smml_key';
    }

    public function getClientScriptConfig()
    {
        $client_script_confog = [
            // Общие скрипты для всех модулей
            AssetHelper::COMMON_PART => [
//                CommonTrad3rAssets::class
            ],
            App::CONFIG_MODULE_MAIN => [
                AssetHelper::BUNDLES => [
                    MainAsset::class
                ],
                AssetHelper::CONTROLLERS => [
                    'site' => [
                        'index' => []
                    ],
                    'review' => [
                        'index' => []
                    ],
                ]
            ]
        ];

        return array_merge($client_script_confog, $this->getAdminClientScriptConfig());
    }

    public function getAdminMenuItems()
    {
        return [
            [
                'label' => 'Пользователи',
                'icon'  => 'fa fa-users',
                'url'   => '#',
                'items' => [
                    ['label' => 'Посетители', 'icon' => 'fas fa-user-circle', 'url' => ['user/client'],],
                    ['label' => 'Менеджеры', 'icon' => 'fas fa-user-shield', 'url' => ['user/manager'],],
                ]
            ],
        ];
    }

    /**
     * @return string
     */
    public function getPathToPublicStatic()
    {
        return Yii::getAlias('@Web') . DIRECTORY_SEPARATOR . $this->getPublicDir();
    }
}