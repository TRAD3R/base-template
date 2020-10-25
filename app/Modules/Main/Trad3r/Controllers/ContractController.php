<?php


namespace Main\Trad3r\Controllers;


use App\App;
use App\Controller\Main;
use App\Forms\Main\Contract\EmploymentForm;
use App\Forms\Main\Contract\RentForm;
use App\Forms\Main\Contract\ServiceForm;
use App\Helpers\Url;
use App\Models\Contract;
use App\Models\Service;
use App\Models\Metadata;
use App\Params;
use App\Remote\YandexKassa;

class ContractController extends Main
{
    public function beforeAction($action)
    {
        $metadata = Metadata::getMetaDescription(Metadata::CONTRACTS);
        $this->view->title = $metadata['title'];
        $this->view->registerMetaTag(
            ['name' => 'keywords', 'content' => $metadata['meta_keywords']]
        );
        $this->view->registerMetaTag(
            ['name' => 'description', 'content' => $metadata['meta_description']]
        );

        return parent::beforeAction($action);
    }

    public function actionStep1()
    {
        if ($this->getRequest()->isPost()) {
            $progId = $this->getRequest()->postInt(Params::CONTRACT_TYPE, 0);

            if ($progId) {
                App::i()->getSession()->set(Params::CONTRACT_TYPE, $progId);
                return $this->redirect(['step2']);
            }
        }

        return $this->render('step1');
    } // actionStep1

    public function actionStep2()
    {
        $contractId = App::i()->getSession()->get(Params::CONTRACT_TYPE, 0);
        if(!Contract::isCorrectType($contractId)) {
            return $this->redirect(['step1']);
        }

        switch ($contractId) {
            case Contract::CONTRACT_RENT_PHARM:
            case Contract::CONTRACT_RENT_PAHRM_TWO_OWNER:
            case Contract::CONTRACT_RENT_MEDICAL:
            case Contract::CONTRACT_RENT_MEDICAL_TWO_OWNER:
                $form = new RentForm($contractId);
                $view = 'rent';
                break;
            case Contract::CONTRACT_EMPLOYMENT:
                $form = new EmploymentForm();
                $view = 'employment';
                break;
            case Contract::CONTRACT_MEDICAL_SERVICES:
                $form = new ServiceForm();
                $view = 'service';
                break;
            default:
                return $this->redirect(['step1']);
        }

        if($form->load($this->getRequest()->post()) && $form->save()) {
            return $this->redirect(['step3']);
        }

        return $this->render('step2', [
            'view' => $view,
            'model' => $form,
            'type' => $contractId,
        ]);
    } // actionStep2

    public function actionStep3()
    {
        $contractId = App::i()->getSession()->get(Params::CONTRACT_TYPE);
        switch ($contractId) {
            case Contract::CONTRACT_RENT_PHARM:
                $this->view->title = "Договор аренды помещения для аптеки";
                break;
            case Contract::CONTRACT_RENT_PAHRM_TWO_OWNER:
                $this->view->title = "Договор аренды помещения для аптеки. Арендодатели — два физлица";
                break;
            case Contract::CONTRACT_RENT_MEDICAL:
                $this->view->title = "Договор аренды помещения для медицинского учреждения";
                break;
            case Contract::CONTRACT_RENT_MEDICAL_TWO_OWNER:
                $this->view->title = "Договор аренды помещения для медицинского учреждения. Арендодатели — два физлица";
                break;
            case Contract::CONTRACT_EMPLOYMENT:
                $this->view->title = "Трудовой договор стандартный";
                break;
            case Contract::CONTRACT_MEDICAL_SERVICES:
                $this->view->title = "Договор на оказание платных медицинских услуг";
                break;
        }

        return $this->render('step3');
    } // actionStep3

    public function actionDownload()
    {
        $contract = Contract::findOne(App::i()->getSession()->get(Params::CONTRACT));
        if(!$contract) {
            return $this->redirect(['step1']);
        }

        $service = Service::findOne(Service::CONTRACT);
        if(!$service) {
            return $this->redirect(['step1']);
        }
        $successUrl = Url::toRoute(['paid', 'filename' => $contract->filename], true);
        $description = 'Договор ' . Contract::getTitle($contract->type);

        $yandexKassa = new YandexKassa();
        $token = $yandexKassa->getConfirmationToken($service->cost, $description);

        return $this->render('@layouts/main/trad3r/yandex/widget', [
            'confirmationToken' => $token,
            'successUrl' => $successUrl
        ]);
    } // actionDownload

    public function actionPaid($filename)
    {
        if(empty($filename)) {
            return $this->redirect(['site/index']);
        }
        $contract = Contract::findOne(['filename' => $filename]);
        if(!$contract) {
            return $this->redirect(['site/index']);
        }
        $contract->is_paid = true;
        $contract->save();
        $filepath = $contract->getFilepath();

        return $this->redirect($filepath);
    }
}