<?php


namespace App\Forms\Admin\User;


use App\Model;
use App\Models\User;

class UserForm extends Model
{
    public $id;
    public $password;
    public $email;
    public $username;
    public $status;

    public function __construct(User $user)
    {
        parent::__construct($user);
        $this->id = $user->id;
        $this->email = $user->email;
        $this->username = $user->username;
        $this->status = $user->status;
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'password'        => 'Пароль',
            'email'           => 'email',
            'username'        => 'Логин',
            'status'          => 'Статус',
        ];
    }

    public function rules()
    {
        return [
            [['email'], 'required'],
            [
                'email',
                'isUnique',
            ],
            ['email', 'email', 'message' => 'Email не валиден'],
            ['email', 'string', 'max' => 255, 'tooLong' => 'Email слишком длинный'],
            [
                [
                    'email',
                    'username',
                    'status'
                ],
                'filter',
                'filter' => 'trim',
            ],
            [['status'], 'integer'],
            ['password', 'safe']
        ];
    }

    public function isUnique()
    {
        if(!$this->hasErrors()) {
            if(!$this->isNewRecord) {
                return;
            }
            if (User::issetEmail($this->email)) {
                $this->addError('email', 'Такой email уже зарегистрирова.');
            }
        }
    }
}