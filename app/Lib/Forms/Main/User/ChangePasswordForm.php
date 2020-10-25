<?php

namespace App\Forms\Main\User;

use App\Models\User;
use App\Model;

/**
 * Class ChangePasswordForm
 * @property User $_entity
 * @package App\Forms\Main\User
 */
class ChangePasswordForm extends Model {

    public $email;
    public $password;
    public $password_repeat;

    public function __construct(User $user = null)
    {
        parent::__construct($user);
        if ($user) {
            $this->email = $user->email;
        }
    }

    public function rules()
    {
        return [
            ['password', 'required', 'message' => 'Введите пароль'],
            ['password_repeat', 'required', 'message' => 'Повторите пароль'],
            ['password_repeat', 'compare', 'compareAttribute' => 'password', 'skipOnEmpty' => false, 'message' => 'Похоже, что Вы ввели разные пароли'],
        ];
    }

    /**
     * @return bool|null
     * @throws \yii\base\Exception
     */
    public function changePassword()
    {
        if ($this->validate()) {
            if (!$this->_entity) {
                return null;
            }

            $this->_entity->setPassword($this->password);

            return $this->_entity->save();
        }

        return false;
    }

    /**
     * @return bool
     * @throws \yii\base\Exception
     */
    public function resetPassword()
    {
        if ($this->validate()) {
            if (!$this->_entity) {
                return false;
            }

            $this->_entity->setPassword($this->password);
            $this->_entity->password_reset_token = $this->_entity->generatePasswordResetToken();

            return $this->_entity->save();
        }

        return false;
    }

    public function login(User $user)
    {
        $login_form = new LoginForm();

        $login_form->email = $user->email;
        $login_form->password = $this->password;
        $login_form->remember_me = true;

        return $login_form->login();
    }
}