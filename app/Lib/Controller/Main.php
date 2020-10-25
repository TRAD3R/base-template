<?php


namespace App\Controller;


use App\App;
use App\Assets\AssetHelper;

abstract class Main extends BaseController
{
    public function beforeAction($action)
    {
        if(App::i()->getCurrentUser() && App::i()->getCurrentUser()->isAdmin()) {
            return $this->redirect(['auth/logout']);
        }
        if (!parent::beforeAction($action)) {
            return false;
        }

        if(!$this->getRequest()->isAjax()) {
            AssetHelper::init($this->view);
        }

        return true;
    }
}