<?php
namespace App\Forms\Admin\User;

use App\Forms\Main\User\LoginForm;
use App\Models\User;
use Yii;

class LoginAdminForm extends LoginForm
{

    public $username;
    public $password;
    public $remember_me = true;

    public function rules()
    {
        return [
            ['username', 'required', 'message' => 'Введите логин'],
            ['password', 'required', 'message' => 'Введите пароль'],
            ['remember_me', 'boolean'],
            ['password', 'validatePassword'],
        ];
    }

    /**
     * @return bool|User
     */
    public function getUser()
    {
        if ($this->_entity === false) {
            $this->_entity = User::findOne([
                'username' => $this->username,
                'type' => User::TYPE_ADMIN
            ]);

        }

        return $this->_entity;
    }

    public function login()
    {
        if ($this->validate() && $this->getUser()->isAdmin()) {
            return Yii::$app->user->login($this->getUser(), 3600 * 24 * 30);
        }
        return false;
    }
}
