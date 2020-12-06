<?php


namespace App\Forms\Admin\User;


use App\Models\User;
use DateTime;

class ClientForm extends UserForm
{
    public $firstname;
    public $secondname;
    public $lastname;
    public $phone;
    public $company;
    public $category;

    public function __construct(User $user)
    {
        parent::__construct($user);
        $this->id = $user->id;
        $this->firstname = $user->firstname;
        $this->secondname = $user->secondname;
        $this->lastname = $user->lastname;
        $this->email = $user->email;
        $this->phone = $user->phone;
        $this->company = $user->company;
        $this->username = $user->username;
        $this->category = $user->category;
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
            'lastname'        => 'Фамилия',
            'firstname'       => 'Имя',
            'secondname'      => 'Отчество',
            'phone'           => 'Номер телефона',
            'company'         => 'ИП или название компании',
            'category'        => 'Категория',
        ]);
    }

    public function rules()
    {
        return array_merge(parent::rules(), [
            [['lastname', 'firstname', 'company', 'phone'], 'required'],
            [
                [
                    'lastname',
                    'firstname',
                    'secondname',
                    'company',
                    'phone',
                ],
                'filter',
                'filter' => 'trim',
            ],
            [['category'], 'integer']
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

            $user->firstname         = $this->firstname;
            $user->secondname        = $this->secondname;
            $user->lastname          = $this->lastname;
            $user->email             = $this->email;
            $user->phone             = $this->phone;
            $user->company           = $this->company;
            $user->category          = $this->category;
            if(in_array($user->category, [User::CATEGORY_PREMIUM, User::CATEGORY_VIP])){
                $user->last_configurator_paid = (new DateTime())->format("Y-m-d H:i:s");
            }
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