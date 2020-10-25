<?php


namespace App\Controller;

use App\AppHelper;
use Yii;
use yii\base\Exception;
use yii\base\UserException;
use yii\web\HttpException;

class ErrorController extends BaseController
{
    public $layout = '/error';

    function getViewPath()
    {
        return AppHelper::getProjectErrorViewPath();
    }

    public function actionError() {
        if (($exception = Yii::$app->getErrorHandler()->exception) === null) {
            // action has been invoked not from error handler, but by direct route, so we display '404 Not Found'
            $exception = new HttpException(404, Yii::t('yii', 'Page not found.'));
        }

        if ($exception instanceof HttpException) {
            $code = $exception->statusCode;
        } else {
            $code = $exception->getCode();
        }

        if ($exception instanceof Exception) {
            $name = $exception->getName();
        } else {
            $name = Yii::t('yii', 'Error');
        }
        if ($code) {
            $name .= " (#$code)";
        }

        if ($exception instanceof UserException) {
            $message = $exception->getMessage();
        } else {
            $message = Yii::t('yii', 'An internal server error occurred.');
        }

        if (!in_array((int)$code, [404, 500])) {
            $code = 500;
        }

        if (!$this->getCurrentUser()) {
            $url = Yii::$app->user->loginUrl;
        } else {
            $url = $this->getCurrentUser()->getUserBaseUrl();
        }

        if (Yii::$app->getRequest()->getIsAjax()) {
            return "$name: $message";
        } else {
            return $this->render($code, [
                'url' => $url,
            ]);
        }

    }
}