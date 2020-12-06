<?php


namespace App\Forms\Admin\User;


use App\Models\User;

class ManagerForm extends UserForm
{
    public $username;
    public $email;
    public $password;

    public function __construct(User $user)
    {
        parent::__construct($user);
        $this->id = $user->id;
        $this->email = $user->email;
        $this->username = $user->username;
    }

    public function rules()
    {
        return array_merge(parent::rules(), [
            [
                [
                    'username',
                ],
                'filter',
                'filter' => 'trim',
            ],
        ]);
    }

    /**
     * @return User
     * @throws \Exception
     */
    public function save()
    {
        if ($this->validate()) {
            /** @var User $user */
            $user = $this->_entity;

            $user->email             = $this->email;
            $user->username          = $this->username;
            $user->status            = $this->status;

            if($this->password) {
                $user->setPassword($this->password);
                $user->generateAuthKey();
                $user->generatePasswordResetToken();
            }

            if ($user->save(false)) {
                return $user;
            }
        }

        return null;
    }


}