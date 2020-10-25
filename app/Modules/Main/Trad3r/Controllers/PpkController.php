<?php
/**
 * Оформление ППК (программы производственного контроля)
 */

namespace Main\Trad3r\Controllers;

use App\App;
use App\Controller\Main;
use App\Forms\Main\Ppk\FoodForm;
use App\Forms\Main\Ppk\IiiForm;
use App\Forms\Main\Ppk\MedicForm;
use App\Forms\Main\Ppk\OtherForm;
use App\Forms\Main\Ppk\PharmForm;
use App\Helpers\Url;
use App\Models\Contract;
use App\Models\Occupation;
use App\Models\Page;
use App\Models\Ppk;
use App\Models\Service;
use App\Models\Metadata;
use App\Params;
use App\Remote\YandexKassa;

class PpkController extends Main
{
    public function beforeAction($action)
    {
        $metadata = Metadata::getMetaDescription(Metadata::PPK);
        $this->view->title = $metadata['title'];
        $this->view->registerMetaTag(
            ['name' => 'keywords', 'content' => $metadata['meta_keywords']]
        );
        $this->view->registerMetaTag(
            ['name' => 'description', 'content' => $metadata['meta_description']]
        );
        return parent::beforeAction($action);
    }

    public function actionIndex()
    {
        $page = Page::findOne(Page::PAGE_PPK);
        return $this->render('preview', ['page' => $page]);
    } // actionIndex

    public function actionStep1()
    {
        if ($this->getRequest()->isPost()) {
            $progId = $this->getRequest()->postInt(Params::PPK_PROGRAM, 0);

            if ($progId) {
                App::i()->getSession()->set(Params::PPK_PROGRAM, $progId);
                return $this->redirect(['ppk/step2']);
            }
        }
        $occupations = Occupation::groupAllByParents();

        return $this->render('step1', [
            'occupations' => $occupations,
        ]);
    } // actionIndex

    public function actionStep2()
    {
        $programId = App::i()->getSession()->get(Params::PPK_PROGRAM, 0);
        $programm = Occupation::findOne($programId);
        if(!$programm) {
            return $this->redirect(['ppk/step1']);
        }

        switch ($programm->parent_id) {
            case Occupation::PPK_III:
                $form = new IiiForm($programm);
                $view = 'form_iii';
                break;
            case Occupation::PPK_MEDICINE:
                $form = new MedicForm($programm);
                $view = 'form_medic';
                break;
            case Occupation::PPK_FOOD:
                $form = new FoodForm($programm);
                $view = 'form_food';
                break;
            case Occupation::PPK_PHARMACY:
                $form = new PharmForm($programm);
                $view = 'form_pharm';
                break;
            case Occupation::PPK_OTHER:
                $form = new OtherForm($programm);
                $view = 'form_other';
                break;
            default:
                return $this->redirect(['ppk/step1']);
        }

        if($form->load($this->getRequest()->post()) && $form->save()) {
            return $this->redirect(['step3']);
        }

        return $this->render('step2', [
            'view' => $view,
            'model' => $form
        ]);
    } // actionStep2

    public function actionStep3()
    {
        return $this->render('step3');
    } // actionStep3

    public function actionDownload()
    {
        $ppk = Ppk::findOne(App::i()->getSession()->get(Params::PPK_PROGRAM));
        if(!$ppk) {
            return $this->redirect(['step1']);
        }

        $filepath = $ppk->getFilepath();

        $service = Service::findOne(Service::PPK);
        if(!$service) {
            return $this->redirect(['step1']);
        }
        $filename = explode("/", $filepath);
        $description = 'ППК ' . array_pop($filename);

        $successUrl = Url::toRoute(['paid', 'filename' => $ppk->filename], true);
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
        $ppk = Ppk::findOne(['filename' => $filename]);
        if(!$ppk) {
            return $this->redirect(['site/index']);
        }
        $ppk->is_paid = true;
        $res = $ppk->save(false);
        $filepath = $ppk->getFilepath();

        return $this->redirect($filepath);
    }
}