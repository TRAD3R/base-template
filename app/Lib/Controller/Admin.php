<?php

namespace App\Controller;

use App\App;
use App\Assets\AssetHelper;
use yii\filters\AccessControl;
use yii\web\JqueryAsset;
use yii\web\View;

class Admin extends BaseController
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['login'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function beforeAction($action)
    {
        if(App::i()->getController()->getRoute() !== 'admin/auth/login' && (!App::i()->getCurrentUser() || !App::i()->getCurrentUser()->isAdmin())) {
            return $this->redirect(['auth/login']);
        }
        $this->view->registerMetaTag([
            'name'    => 'robots',
            'content' => 'noindex, nofollow'
        ]);

        if (!parent::beforeAction($action)) {
            return false;
        }

        if (!$this->getRequest()->isAjax()) {
            AssetHelper::init($this->view);
        }

        $this->view->registerAssetBundle(JqueryAsset::class, View::POS_HEAD);

        return true;
    }

    public function afterAction($action, $result)
    {
        $result = parent::afterAction($action, $result);

        return $result;
    }

    public function init()
    {
        parent::init();

        $this->view->params = [
            'module_name'  => 'Admin',
            'layout_color' => 'purple',
            'module_menu'  => [
                'options' => ['class' => 'sidebar-menu'],
                'items'   => App::i()->getConfig()->getAdminMenuItems(),
            ],
        ];
    }

    /**
     * @param $data
     *
     * @return array
     */
    protected function getAjaxSelectResult($data)
    {
        return ['results' => $data];
    }

    protected function getPagination($total_count = 0, $default_page_size = 50)
    {
        $pagination = parent::getPagination($total_count, $default_page_size);

        $pagination->route = '/' . $this->getRoute();

        return $pagination;
    }
}