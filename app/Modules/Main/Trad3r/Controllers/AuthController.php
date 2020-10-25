<?php

namespace Main\Trad3r\Controllers;

use App\App;
use App\Controller\Main;
use App\Forms\Main\User\ChangePasswordForm;
use App\Forms\Main\User\LoginForm;
use App\Forms\Main\User\RecoveryPasswordForm;
use App\Forms\Main\User\RegistrationForm;
use App\Helpers\Url;
use App\Models\User;
use App\Params;
use yii\filters\AccessControl;

class AuthController extends Main
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['login', 'registration', 'recovery', 'change-password'],
                        'allow' => true,
                    ],
                    [
                        'allow' => true,
                        'roles' => ['@']
                    ]
                ]
            ]
        ];
    }

    /**
     * @throws \Exception
     */
    public function actionLogin()
    {
        $this->view->title = 'Вход';
        if(!App::i()->getSession()->get(Params::REFFERER)) {
            $refferer = $this->getRequest()->getReferrer();
            App::i()->getSession()->set(Params::REFFERER, empty($refferer) ? '/' : $refferer);
        }

        $model = new LoginForm();

        if ($this->getRequest()->isPost() && $model->load($this->getRequest()->post())) {
            if ($user = $model->login()) {
                $refferer = App::i()->getSession()->get(Params::REFFERER);
                App::i()->getSession()->remove(Params::REFFERER);
                return $this->redirect($refferer);
            }
        }

        return $this->render('login', ['model' => $model]);
    }

    public function actionLogout()
    {
        App::i()->getApp()->getUser()->logout();

        return $this->redirect('/');
    }

    public function actionRegistration()
    {
        $this->view->title = 'Регистрация';

        $model = new RegistrationForm(new User());

        if ($this->getRequest()->isPost() && $model->load($this->getRequest()->post())) {
            if ($user = $model->register()) {
                App::i()->getApp()->user->login($user, 3600 * 24);
                return $this->redirect('/');
            }
        }

        return $this->render('registration', ['model' => $model]);
    }

    public function actionRecovery()
    {
        $this->view->title = 'Смена пароля';

        $form = new RecoveryPasswordForm();

        if ($this->getRequest()->isPost() && $form->load($this->getRequest()->post())) {
            if ($form->sendMail()) {
                // если пользователь попросил отправить ещё раз - идет аякс запрос
                if ($this->getRequest()->isAjax()) {
                    return ['success' => 1];
                }
                return $this->render('recovery_success', ['email' => $form->email]);
            }
        }

        return $this->render('recovery', ['model' => $form]);
    }

    public function actionChangePassword($token)
    {
        $this->view->title = 'Изменение пароля';

        $user = User::findByResetToken($token);

        if (!$user) {
            return $this->redirect(Url::toRoute('/login'));
        }

        $form = new ChangePasswordForm($user);

        if ($this->getRequest()->isPost() && $form->load($this->getRequest()->post())) {
            if ($form->changePassword()) {
                return $this->redirect(Url::toRoute('/login'));
            }
        }

        return $this->render('recovery_change', ['model' => $form]);
    }
}