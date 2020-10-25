<?php

namespace App\Mail;

use App\App;
use App\Helpers\Url;
use App\Models\Expertize;
use App\Models\LegalAssistance;
use App\Models\User;
use Yii;
use yii\mail\MessageInterface;

class MailHelper
{
    /**
     * @param User $user
     *
     * @return MessageInterface
     */
    public static function createRegistrationMail(User $user)
    {
        $subject = 'Регистрация на ' . App::i()->getApp()->params['site']['name'];
        $subject = '=?utf-8?B?' . base64_encode($subject) . '?=';

        $html_body = Yii::$app->controller->renderPartial('/mail/registration_success', [
            'username'  => $user->username,
            'user_type' => $user->type,
            'link'      => Url::to('/', true),
        ]);

        return App::i()->getMailer()->compose()
            ->setSubject($subject)
            ->setFrom(App::i()->getNoReplyEmail())
            ->setTo($user->email)
            ->setHtmlBody($html_body)
            ->setTextBody(strip_tags(html_entity_decode($html_body)));
    }

    /**
     * @param User $user
     *
     * @return MessageInterface
     */
    public static function createResetPasswordMail(User $user)
    {

        $subject = 'Запрос на восстановление пароля';
        $subject = '=?utf-8?B?' . base64_encode($subject) . '?=';

        return App::i()->getMailer()->compose()
            ->setSubject($subject)
            ->setFrom(App::i()->getNoReplyEmail())
            ->setTo($user->email)
            ->setHtmlBody(Yii::$app->controller->renderPartial('/mail/password_recovery', [
                'username' => $user->username,
                'link'     => Url::to(['reset-password', 'token' => $user->password_reset_token], true),
            ]));
    }

    /**
     * @param User $user
     *
     * @return MessageInterface
     */
    public static function createRecoveryMail(User $user)
    {

        $subject = 'Password Recovery on WhoCPA.asia';
        $subject = '=?utf-8?B?' . base64_encode($subject) . '?=';

        return App::i()->getMailer()->compose()
            ->setSubject($subject)
            ->setFrom(App::i()->getNoReplyEmail())
            ->setTo($user->email)
            ->setHtmlBody(Yii::$app->controller->renderPartial('/mail/recovery_mail', [
                'username' => $user->username,
                'link'     => Url::to(['change-password', 'token' => $user->password_reset_token], true),
            ]));
    }

    public static function createFeedbackMail($name, $email, $message){
        $subject = 'Сообщение из формы обратной связи ' . App::i()->getApp()->params['site']['name'];
        $subject = '=?utf-8?B?' . base64_encode($subject) . '?=';

        return App::i()->getMailer()->compose()
            ->setSubject($subject)
            ->setFrom(App::i()->getNoReplyEmail())
            ->setTo(User::getManagerEmails())
            ->setHtmlBody(Yii::$app->controller->renderPartial('/mail/feedback_mail', [
                'name' => $name,
                'email' =>$email,
                'message' => $message
            ]));
    }

    /**
     * @param $to
     * @param $subject
     * @param $message
     * @param $from
     *
     * @return MessageInterface
     */
    public static function createMail($to, $subject, $message, $from)
    {
        $subject = '=?utf-8?B?' . base64_encode($subject) . '?=';

        return App::i()->getMailer()->compose()
            ->setSubject($subject)
            ->setFrom($from)
            ->setTo($to)
            ->setTextBody($message);
    }

    /**
     * @param $to
     * @param $subject
     * @param $html_message
     * @param $from
     *
     * @return MessageInterface
     */
    public static function createHtmlMail($to, $subject, $html_message, $from)
    {
        $subject = '=?utf-8?B?' . base64_encode($subject) . '?=';

        return App::i()->getMailer()->compose()
            ->setSubject($subject)
            ->setFrom($from)
            ->setTo($to)
            ->setHtmlBody($html_message);
    }

    /**
     * Собирает письмо для сообщения с контактов
     *
     * @param array  $params
     * @param array|string $manager_email
     *
     * @return MessageInterface
     */
    public static function contactsLetter($params)
    {
        $subject = 'Ответ на сообщение, отправленное через форму обратной связи ' . App::i()->getApp()->params['site']['url'];
        $subject = '=?utf-8?B?' . base64_encode($subject) . '?=';
        $message = Yii::$app->controller->renderPartial('/mail/contacts', $params);

        return App::i()->getMailer()->compose()
            ->setSubject($subject)
            ->setFrom($params['email'])
            ->setTo(User::getManagerEmails())
            ->setHtmlBody($message);
    }

    /**
     * Письмо для отправки вопроса с правовой помощи
     *
     * @param LegalAssistance  $question
     * @param array|string $manager_email
     *
     * @return MessageInterface
     */
    public static function legalAssistanceLetter($question)
    {
        $subject = 'Запрос правовой помощи ' . App::i()->getApp()->params['site']['url'];
        $subject = '=?utf-8?B?' . base64_encode($subject) . '?=';
        $message = Yii::$app->controller->renderPartial('/mail/legal-assistance', ['question' => $question]);

        return App::i()->getMailer()->compose()
            ->setSubject($subject)
            ->setFrom($question->user->email)
            ->setTo(User::getManagerEmails())
            ->setHtmlBody($message);
    }

    public static function reviewNotificationEmail($text)
    {
        $user = App::i()->getCurrentUser();
        $subject = 'Новый отзыв на сайте ' . App::i()->getApp()->params['site']['name'];
        $subject = '=?utf-8?B?' . base64_encode($subject) . '?=';

        return App::i()->getMailer()->compose()
            ->setSubject($subject)
            ->setFrom(App::i()->getNoReplyEmail())
            ->setTo(User::getManagerEmails())
            ->setHtmlBody(Yii::$app->controller->renderPartial('/mail/new_review', [
                'name' => $user->getShortname(),
                'email' =>$user->email,
                'text' => $text
            ]));
    }

    public static function sendExpertizeAdminMail(Expertize $expertize)
    {
        $user = App::i()->getCurrentUser();
        $subject = 'Запрос экспертизы документов ' . App::i()->getApp()->params['site']['name'];
        $subject = '=?utf-8?B?' . base64_encode($subject) . '?=';

        $mail = App::i()->getMailer()->compose()
            ->setSubject($subject)
            ->setFrom(App::i()->getNoReplyEmail())
            ->setTo(User::getManagerEmails())
            ;

        $filepath = Expertize::getFilepath($expertize->user_id);
        $countFiles = 0;
        $files = json_decode($expertize->files);
        foreach ($files as $filename) {
            $file = $filepath . DIRECTORY_SEPARATOR . $filename;
            if(is_file($file)) {
                $mail->attach($file);
                $countFiles++;
            }
        }
        $mail
            ->setTextBody("Новый запрос экспертизы документов от пользователя " . $user->getShortname() . ' в количестве ' . $countFiles);

        $mail->send();
    }
}
