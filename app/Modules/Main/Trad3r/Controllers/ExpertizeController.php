<?php


namespace Main\Trad3r\Controllers;


use App\App;
use App\Controller\Main;
use App\Forms\Main\UploadForm;
use App\Helpers\Url;
use App\Mail\MailHelper;
use App\Models\Expertize;
use App\Models\Service;
use App\Models\Metadata;
use App\Remote\YandexKassa;

class ExpertizeController extends Main
{
    public function beforeAction($action)
    {
        if (!parent::beforeAction($action)) {
            return false;
        }
        if (is_null(App::i()->getCurrentUser())) {
            return $this->redirect(['auth/login']);
        }

        $metadata = Metadata::getMetaDescription(Metadata::EXPERTIZE);
        $this->view->title = $metadata['title'];
        $this->view->registerMetaTag(
            ['name' => 'keywords', 'content' => $metadata['meta_keywords']]
        );
        $this->view->registerMetaTag(
            ['name' => 'description', 'content' => $metadata['meta_description']]
        );

        return true;
    }

    public function actionIndex()
    {
        $model = new UploadForm();
        $expertize = Service::findOne(Service::EXPERTIZE);

        if ($this->getRequest()->isPost()) {
            if ($id = $model->upload()) {
                $filesCount = count($model->files);

                $totalCost = $expertize->cost * $filesCount;
                return $this->render('prepare', ['count' => $filesCount, 'totalCost' => $totalCost, 'id' => $id]);
            }
        }

        return $this->render('index', ['model' => $model, 'price' => $expertize->cost]);
    }

    public function actionPayment($id)
    {
        $docs = Expertize::findOne($id);
        if(!$docs) {
            return $this->redirect(['index']);
        }

        $description = sprintf('Пользователь: %d, документы: %d', $docs->user_id, $docs->id);

        $yandexKassa = new YandexKassa();
        $token = $yandexKassa->getConfirmationToken($docs->total_cost, $description);

        return $this->render('@layouts/main/trad3r/yandex/widget', [
            'confirmationToken' => $token,
            'successUrl' => Url::toRoute(['paid', 'id' => $id], true)
        ]);
    } // actionDownload

    public function actionPaid($id)
    {
        $docs = Expertize::findOne($id);
        if(!$docs) {
            return $this->redirect(['index']);
        }

        $docs->is_paid = true;
        if($docs->save()) {
            MailHelper::sendExpertizeAdminMail($docs);
        }

        return $this->render('paid');
    }
}