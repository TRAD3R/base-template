<?php
namespace Main\Trad3r\Controllers;

use App\Assets\Packages\Trad3r\ErrorAsset;

class ErrorController extends \App\Controller\ErrorController
{
    public function beforeAction($action)
    {
        ErrorAsset::register($this->view);
        return parent::beforeAction($action);
    }
}