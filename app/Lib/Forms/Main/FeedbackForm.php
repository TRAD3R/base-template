<?php

namespace App\Forms\Main;

use App\App;
use App\Mail\MailHelper;
use App\Models\User;
use App\Model;
use yii\httpclient\Client;

/**
 * Class LoginForm
 * @property User $_entity
 * @package App\Forms\Main\User
 */
class FeedbackForm extends Model
{
    const BAD_USERNAME_ATTEMPTS = 3;

    const BAD_FINGERPRINT_ATTEMPTS = 5;

    public $name;
    public $email;
    public $message;
    public $recaptcha;

    public function rules()
    {
        return[
            [['name', 'email', 'message'], 'required'],
            ['recaptcha', 'required', 'message' => 'Подтвердите, что вы не робот'],
            ['recaptcha', 'validateRecaptcha'],

        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Имя',
            'email'   => 'Почта или телефон',
            'message'   => 'Ваше сообщение'
        ];
    }

    /** проверяем рекапчу от гугла
     * @throws \yii\base\InvalidConfigException
     */
    public function validateRecaptcha()
    {
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('POST')
            ->setUrl('https://www.google.com/recaptcha/api/siteverify')
            ->setData(['secret' => App::i()->getApp()->params['captcha']['secretKey'], 'response' => $this->recaptcha])
            ->send();
        if ($response->isOk) {
            if (!$response->data['success']) {
                $this->addError('recaptcha', 'Подтвердите, что Вы не робот');
            }
        }else{
            $this->addError('recaptcha', 'Подтвердите, что Вы не робот');
        }
    }

    /**
     * @return bool
     * @throws \yii\base\Exception
     */
    public function send()
    {
        if ($this->validate()) {

            $mail = MailHelper::createFeedbackMail($this->name, $this->email, $this->message);
            $status = $mail->send();
            return $status;
        }

        return false;
    }
}
