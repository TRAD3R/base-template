<?php

namespace App\Models;

use App\App;
use App\ActiveRecord;
use DateTime;
use Yii;
use yii\web\IdentityInterface;

/**
 * Class User
 *
 * @property int                   $id                                  ID
 * @property DateTime              $date_created                        [timestamp]
 * @property DateTime              $date_updated                        [timestamp]
 * @property string                $username                            [varchar(255)]
 * @property string                $firstname                           [varchar(255)]
 * @property string                $secondname                          [varchar(255)]
 * @property string                $lastname                            [varchar(255)]
 * @property string                $auth_key                            [varchar(32)]
 * @property string                $password_hash                       [varchar(255)]
 * @property string                $password_reset_token                [varchar(255)]
 * @property string                $email                               [varchar(255)]
 * @property string                $company                             [varchar(255)]
 * @property string                $phone                               [varchar(255)]
 * @property int                   $category                            [smallint(6)]
 * @property int                   $type                                [smallint(6)]
 * @property int                   $status                              [smallint(6)]
 * @property DateTime              $last_configurator_paid              [timestamp]
 * @property string                $paid_token                          [varchar(32)]
 * @property bool                  $is_accept                           [tinyint(1)]
 */
class User extends ActiveRecord implements IdentityInterface
{
    const TYPE_ADMIN = 1;
    const TYPE_USER  = 2;

    const STATUS_ACTIVE         = 1;
    const STATUS_ARCHIVE        = 2;

    const CATEGORY_FREE         = 0;
    const CATEGORY_PREMIUM      = 1;
    const CATEGORY_VIP          = 2;

    const PASSWORD_RESET_TOKEN_TTL = 3600;

    const DEFAULT_ADMIN_ID = 3;

    const VIP_PERIOD = 30;  // количество дней после оплаты конфигуратора, в течение которых пользователь остается vip

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    public static function issetEmail($email)
    {
        return self::find()->where(['email' => $email])->exists();
    }

    public static function getColor($category, $status)
    {
        $color = '';

        switch ($category) {
            case User::CATEGORY_FREE:
//                $color = '#000000';
                break;
            case User::CATEGORY_PREMIUM:
                $color = '#1e5a065e';
                break;
        }

        if ($status == User::STATUS_ARCHIVE) {
            $color = '#f1b7b7';
        }

        return $color;
    }

    public function beforeSave($insert)
    {
        if(!parent::beforeSave($insert)) {
            return false;
        }

        if($insert) {
            $this->date_created = (new DateTime())->format('Y-m-d H:i:s');
        }

        $this->date_updated = (new DateTime())->format('Y-m-d H:i:s');

        return true;
    }

    public static function findIdentity($id)
    {
        return self::findOne($id);
    }

    /**
     * @param mixed $token
     * @param null  $type
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
//        return self::findOne(['access_token' => $token]);
    }

    public function getId()
    {
        return $this->id;
    }

    /**
     * Метод для
     * @return string
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * Валидация по кукам
     * @param string $authKey
     * @return bool
     */
    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    /**
     * Генерируем и установаливаем хеш пароля
     * @param string $password
     * @throws \yii\base\Exception
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Генерируем и устанавдиваем auth_key
     * @throws \yii\base\Exception
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Валидация пароля через заебизь
     * @param $password
     * @return bool
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Проверяем действует ли токен сброса пароля
     * @param string $token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int)substr($token, strrpos($token, '_') + 1);

        return $timestamp + self::PASSWORD_RESET_TOKEN_TTL >= time();
    }

    /**
     * Генерируем и устанавливаем токен для сброса пароля
     * @throws \yii\base\Exception
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Ищем по токену сброса пароля
     * @param $token
     * @return null|self()
     */
    public static function findByResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return self::findOne([
            'password_reset_token' => $token,
            'status'               => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * @param null $type
     * @return array|mixed
     */
    public static function getUserType($type = null)
    {
        $types = [
            self::TYPE_ADMIN => 'Админстратор',
            self::TYPE_USER  => 'Пользователь',
        ];

        return isset($types[$type]) ? $types[$type] : $types;
    }

    /**
     * @param null $category
     * @return array|mixed
     */
    public static function getUserCategory($category = null)
    {
        $categories = [
            self::CATEGORY_FREE     => 'Без оплаты',
            self::CATEGORY_PREMIUM  => 'Может оформить конфигуратор',
            self::CATEGORY_VIP      => 'VIP пользователь',
        ];

        return isset($categories[$category]) ? $categories[$category] : $categories;
    }

    /**
     * @return bool
     */
    public function isAdmin()
    {
        return $this->type == self::TYPE_ADMIN;
    }

    /**
     * @return bool
     */
    public function isUser()
    {
        return $this->type == self::TYPE_USER;
    }

    /**
     * Пользователь остается VIP в течение 30 дней после оплаты конфигуратора
     * @return bool
     */
    public function isVip()
    {
        return in_array($this->category, [self::CATEGORY_PREMIUM, self::CATEGORY_VIP]) && $this->last_configurator_paid &&
            ((new DateTime($this->last_configurator_paid))->getTimestamp() + 60 * 60 * 24 * self::VIP_PERIOD) > (new DateTime())->getTimestamp();
    }

    /**
     * Возвращает ссылку на главное приложение
     * @return string
     */
    public function getUserBaseUrl()
    {
        $urls = [
            self::TYPE_ADMIN      => App::i()->getConfig()->getAdminBaseUrl(),
        ];

        return isset($urls[$this->type]) ? $urls[$this->type] : '/';
    }

    /**
     * @param null $status
     * @return array|mixed
     */
    public static function getStatus($status = null)
    {
        $arr = [
            self::STATUS_ARCHIVE    => 'В архиве',
            self::STATUS_ACTIVE     => 'Активен',
        ];

        return isset($arr[$status]) ? $arr[$status] : $arr;
    }

    public static function getActiveStatuses()
    {
        return [self::STATUS_ACTIVE];
    }

    /**
     * @return bool
     */
    public function isActive()
    {
        return in_array($this->status, self::getActiveStatuses());
    }

    /**
     * Формирует ФИО из данных пользователя
     * @return string
     */
    public function getShortname()
    {
        $first = mb_substr($this->firstname, 0, 1) . '. ';
        $second = !empty($this->secondname) ? mb_substr($this->secondname, 0, 1) . '.' : '';

        return  sprintf("%s %s%s", $this->lastname, $first, $second);
    }

    /**
     * Генерируем и устанавдиваем токен оплаты за конфигуратор
     * @throws \yii\base\Exception
     */
    public function generatePaidToken()
    {
        $this->paid_token = Yii::$app->security->generateRandomString();
    }

    public function canFillConfigurator()
    {
        return $this->category == self::CATEGORY_PREMIUM;
    }

    /**
     * Список всех email активных менеджеров
     * @return array
     */
    public static function getManagerEmails()
    {
        return User::find()
            ->select('email')
            ->where(['type' => self::TYPE_ADMIN, 'status' => self::STATUS_ACTIVE])
            ->column();
    }
}