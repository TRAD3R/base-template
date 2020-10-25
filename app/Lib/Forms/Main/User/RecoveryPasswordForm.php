<?php

namespace App\Forms\Main\User;

use App\Mail\MailHelper;
use App\Models\User;
use yii\base\Model;

class RecoveryPasswordForm extends Model {

    public $email;

    public function rules()
    {
        return [
            ['email', 'required', 'message' => 'Введите email'],
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'email', 'message' => 'Введите корректный email'],
            ['email', 'string', 'max' => 255],
        ];
    }

    /**
     * @return bool
     * @throws \yii\base\Exception
     */
    public function sendMail()
    {
        if ($this->validate()) {

            /** @var User $user */
            $user = User::findOne(['email' => $this->email]);

            if (!$user) {
                $this->addError('email', 'Данного email адреса нет в нашей базе, либо время действия аккаунта истекло. Пожалуйста, зарегистрируйтесь заново.');
                return false;
            }

            if (!User::isPasswordResetTokenValid($user->password_reset_token)) {
                $user->generatePasswordResetToken();
                $user->detachBehaviors();
                $user->save(false);
            }

            $mail = MailHelper::createRecoveryMail($user);
            return $mail->send();
        }

        return false;
    }

}