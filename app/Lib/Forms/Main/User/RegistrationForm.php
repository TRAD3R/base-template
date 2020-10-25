<?php

namespace App\Forms\Main\User;

use App\App;
use App\Mail\MailHelper;
use App\Models\User;
use App\Helpers\Url;
use App\Model;
use Exception;
use yii\httpclient\Client;

/**
 * Class RegistrationForm
 * @property User $_entity;
 * @package App\Forms\Main\User
 */
class RegistrationForm extends Model
{
    public $firstname;
    public $secondname;
    public $lastname;
    public $password;
    public $password_repeat;
    public $email;
    public $phone_number;
    public $company;
    public $recaptcha;

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'lastname'        => 'Фамилия',
            'firstname'       => 'Имя',
            'secondname'      => 'Отчество',
            'password'        => 'Пароль',
            'password_repeat' => 'Повторить пароль',
            'email'           => 'email',
            'phone_number'    => 'Номер телефона',
            'company'         => 'ИП или название компании',
        ];
    }

    public function rules()
    {
        return [
            [['lastname', 'firstname', 'email', 'password', 'password_repeat'], 'required'],
            ['recaptcha', 'required', 'message' => 'Подтвердите, что вы не робот'],
            [
                'password_repeat',
                'compare',
                'compareAttribute' => 'password',
                'operator'         => '==',
                'skipOnEmpty'      => false,
                'message'          => 'Похоже пароли не совпадают',
            ],
            [
                'lastname',
                'string',
                'length'   => [2, 150],
                'tooShort' => 'Слишком короткое значение имени',
            ],
            [
                'password',
                'string',
                'min'      => 5,
                'tooShort' => 'Минимальная длина пароля {min} символов. Пожалуйста, придумайте более сложный пароль',
            ],
            [
                'email',
                'isUnique',
            ],
            ['email', 'email', 'message' => 'Email не валиден'],
            ['email', 'string', 'max' => 255, 'tooLong' => 'Email слишком длинный'],
            [
                [
                    'lastname',
                    'firstname',
                    'secondname',
                    'email',
                    'company',
                    'phone_number',
                ],
                'filter',
                'filter' => 'trim',
            ],
            ['recaptcha', 'validateRecaptcha'],
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

    public function isUnique()
    {
        if(!$this->hasErrors()) {
            if (User::issetEmail($this->email)) {
                $this->addError('email', 'Такой email уже зарегистрирова. Попробуйте <a href="' . Url::toRoute('/recovery') . '"> восстановить Ваш пароль</a>.');
            }
        }
    }

    /**
     * @return User
     * @throws \Exception
     */
    public function register()
    {
        if ($this->validate()) {
            /** @var User $user */
            $user = $this->_entity;

            $user->firstname         = $this->firstname;
            $user->secondname        = $this->secondname;
            $user->lastname          = $this->lastname;
            $user->email             = $this->email;
            $user->phone             = $this->phone_number;
            $user->company           = $this->company;
            $user->type              = User::TYPE_USER;
            $user->category          = User::CATEGORY_FREE;
            $user->status            = User::STATUS_ACTIVE;

            $user->setPassword($this->password);
            $user->generateAuthKey();
            $user->generatePasswordResetToken();

            if ($user->save(false)) {
                try {
                    MailHelper::createRegistrationMail($user)->send();
                }
                catch (Exception $e) {}

                return $user;
            }
        }

        return null;
    }

}
