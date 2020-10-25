<?php

namespace App\Forms\Main\User;

use App\Models\User;
use App\Model;
use Yii;

/**
 * Class LoginForm
 * @property User $_entity
 * @package App\Forms\Main\User
 */
class LoginForm extends Model
{
    const BAD_USERNAME_ATTEMPTS = 3;

    const BAD_FINGERPRINT_ATTEMPTS = 5;

    public $email;
    public $password;
    public $remember_me;

    public $error;

    public function rules()
    {
        return [
            [['email', 'password'], 'required'],
            ['remember_me', 'boolean'],
            ['password', 'validatePassword'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'email'   => 'Email',
            'password'   => 'Пароль',
            'remember_me' => _('Remember me')
        ];
    }

    public function validatePassword()
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError('email', '');
                $this->addError('password', 'Не верный логин или пароль!');
            }
        }
    }

    public function login()
    {
        if ($this->validate()) {
            if (!$this->getUser()->isActive()) {
                $this->addError('email', '');
                $this->addError('password', 'Ваш аккаунт заблокирован!');
                return false;
            }
            return Yii::$app->user->login($this->getUser(), 3600 * 24);
        }

        return false;
    }

    /**
     * @return bool|User
     */
    public function getUser()
    {
        if ($this->_entity === false) {
            $this->_entity = User::find()
                ->where(
                    ['email' => $this->email]
                )
                ->andWhere(['IN', 'type', [User::TYPE_USER]])
                ->one();
        }

        return $this->_entity;
    }
}
