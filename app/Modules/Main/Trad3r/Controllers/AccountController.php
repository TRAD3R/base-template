<?php


namespace Main\Trad3r\Controllers;

use App\App;
use App\Controller\Main;
use App\Helpers\Url;
use App\Models\Configuration;
use App\Models\Contract;
use App\Models\Ppk;
use App\Models\Service;
use App\Models\User;
use App\Params;
use App\Remote\YandexKassa;
use DateTime;
use yii\filters\AccessControl;


class AccountController extends Main
{
    public $layout = '//main/trad3r/account/layout';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@']
                    ]
                ],
                'denyCallback' => function () {
                    return $this->redirect(Url::toRoute('auth/login'));
                }
            ]
        ];
    }

    public function actionIndex()
    {
        $this->view->title = 'Личные данные';
        $user = App::i()->getCurrentUser();
        return $this->render('account_data', ['user' => $user]);
    }


    public function actionOrders()
    {
        $drafts = Configuration::getDrafts(App::i()->getCurrentUser()->id);
        $packages = Configuration::getPackages(App::i()->getCurrentUser()->id);
        $ppks = Ppk::find()->where(['user_id' => App::i()->getCurrentUser()->id, 'is_paid' => true])->all();
        $contracts = Contract::find()->where(['user_id' => App::i()->getCurrentUser()->id])->all();
        return $this->render('account', [
            'drafts' => $drafts,
            'packages' => $packages,
            'ppks' => $ppks,
            'contracts' => $contracts,
        ]);
    }

    /**
     * Переход при клике по черновику
     * @param $id
     * @return \yii\web\Response
     */
    public function actionContinueDraft($id)
    {
        /** @var Configuration $configurator */
        $configurator = Configuration::getByIdAndUserId($id, App::i()->getCurrentUser()->getId());
        if(!$configurator) {
            return $this->redirect(['configurator/education']);
        }

        App::i()->getSession()->set(Params::CONFIGURATOR, $configurator->id);
        if($configurator->type == Configuration::TYPE_SUB) {
            $causes = json_decode($configurator->cause);
            if(!in_array(1, $causes) && !in_array(2, $causes)) {
                return $this->redirect(['configurator/region']);
            }
        }

        if (!$configurator->education) {
            return $this->redirect(['configurator/education']);
        }

        if (!$configurator->staff) {
            return $this->redirect(['configurator/staff', 'id' => $configurator->education]);
        }

        if (!$configurator->speciality) {
            return $this->redirect(['configurator/speciality', 'id' => $configurator->staff]);
        }

        if (!$configurator->form) {
            return $this->redirect(['configurator/property']);
        }

        if (!$configurator->region) {
            return $this->redirect(['configurator/region']);
        }

        return $this->redirect(['configurator/education']);
    } // actionContinueDraft

    public function actionDelete()
    {
        $user = App::i()->getCurrentUser();
        if(!$user) {
            return $this->getResponse()->set404();
        }

        $user->status = User::STATUS_ARCHIVE;

        if($user->save()) {
            return $this->redirect(['auth/logout']);
        }

        return $this->redirect(['index']);
    }

    public function actionPayment()
    {
        $service = Service::findOne(Service::CONFIGURATOR);
        if(!$service) {
            return $this->redirect(['index']);
        }

        $user = App::i()->getCurrentUser();
        $user->generatePaidToken();
        if(!$user->save()) {
            return $this->redirect(['site/license-page']);
        }
        $description = sprintf('Конфигуратор для пользователя: %d', $user->paid_token);

        $yandexKassa = new YandexKassa();
        $token = $yandexKassa->getConfirmationToken($service->cost, $description);

        return $this->render('@layouts/main/trad3r/yandex/widget', [
            'confirmationToken' => $token,
            'successUrl' => Url::toRoute(['paid', 'token' => $user->paid_token], true)
        ]);
    } // actionDownload

    public function actionPaid($token)
    {
        $user = User::findOne(['paid_token' => $token]);
        if(!$user) {
            return $this->redirect(['index']);
        }

        $user->paid_token = null;
        $user->category = User::CATEGORY_PREMIUM;
        $user->last_configurator_paid = (new DateTime())->format("Y-m-d H:i:s");
        $user->save();

        return $this->redirect(['orders']);
    }
}