<?php


namespace Main\Trad3r\Controllers;


use App\App;
use App\Controller\Main;
use App\Forms\Main\FeedbackForm;
use App\Forms\Main\LegalAssistanceForm;
use App\Helpers\TextUtils;
use App\Models\Faq;
use App\Models\Material;
use App\Models\Page;
use App\Models\Service;
use App\Models\Metadata;
use App\Models\Settings;
use App\Params;

class SiteController extends Main
{

    const CONFIG_TYPE = Params::CONFIGURATOR_TYPE_1;

    public function beforeAction($action)
    {
        if (!parent::beforeAction($action)) {
            return false;
        }
        if (in_array($action->id, ['legal-assistance']) && is_null(App::i()->getCurrentUser())) {
            return $this->redirect(['auth/login']);
        }
        return true;
    }

    public function actionIndex()
    {
        $metadata = Metadata::getMetaDescription(Metadata::SITE_INDEX);
        $this->view->title = $metadata['title'];
        $this->view->registerMetaTag([
            'name' => 'keywords',
            'content' => $metadata['meta_keywords']
        ]);
        $this->view->registerMetaTag([
            'name' => 'description',
            'content' => $metadata['meta_description']
        ]);

        $this->view->title = App::i()->getApp()->params['site']['name'];

        $services = Service::find()->orderBy('weight ASC')->indexBy('id')->all();

        return $this->render('index', ['services' => $services]);
    }

    public function actionSection()
    {
        $metadata = Metadata::getMetaDescription(Metadata::SECTIONS);
        $this->view->title = $metadata['title'];
        $this->view->registerMetaTag([
            'name' => 'keywords',
            'content' => $metadata['meta_keywords']
        ]);
        $this->view->registerMetaTag([
            'name' => 'description',
            'content' => $metadata['meta_description']
        ]);

        $services = Service::find()->orderBy('weight ASC')->indexBy('id')->all();

        return $this->render('sections', ['services' => $services]);
    }

    public function actionService()
    {
        $metadata = Metadata::getMetaDescription(Metadata::SERVICES);
        $this->view->title = $metadata['title'];
        $this->view->registerMetaTag(
            ['name' => 'keywords', 'content' => $metadata['meta_keywords']]
        );
        $this->view->registerMetaTag(
            ['name' => 'description', 'content' => $metadata['meta_description']]
        );


        $services = Service::find()->orderBy('weight ASC')->indexBy('id')->all();
        return $this->render('services', ['services' => $services]);
    }

    public function actionLicensePage()
    {
        $metadata = Metadata::getMetaDescription(Metadata::LICENGE_PAGE);
        $this->view->title = $metadata['title'];
        $this->view->registerMetaTag(
            ['name' => 'keywords', 'content' => $metadata['meta_keywords']]
        );
        $this->view->registerMetaTag(
            ['name' => 'description', 'content' => $metadata['meta_description']]
        );

        $page = Page::findOne(Page::PAGE_LICENSE);
        return $this->render('license-page', ['page' => $page]);
    }

    public function actionMaterial($alias)
    {
        $material = Material::findOne(['alias' => $alias, 'is_published' => true]);
        if(!$material) {
            return $this->redirect(['materials']);
        }

        $this->view->title = $material->title;
        $this->view->registerMetaTag(
            ['name' => 'description', 'content' => TextUtils::truncate($material->description, 250)]
        );

        return $this->render('material', ['material' => $material]);
    }

    public function actionMaterials()
    {
        $metadata = Metadata::getMetaDescription(Metadata::FAQ);
        $this->view->title = $metadata['title'];
        $this->view->registerMetaTag(
            ['name' => 'keywords', 'content' => $metadata['meta_keywords']]
        );
        $this->view->registerMetaTag(
            ['name' => 'description', 'content' => $metadata['meta_description']]
        );
        $materials = Material::find()->where(['is_published' => true])->orderBy(['id' => 'desc'])->all();

        return $this->render('materials', ['materials' => $materials]);
    }

    public function actionFeedback()
    {
        $metadata = Metadata::getMetaDescription(Metadata::FEEDBACK);
        $this->view->title = $metadata['title'];
        $this->view->registerMetaTag(
            ['name' => 'keywords', 'content' => $metadata['meta_keywords']]
        );
        $this->view->registerMetaTag(
            ['name' => 'description', 'content' => $metadata['meta_description']]
        );

        $model = new FeedbackForm();

        if ($this->getRequest()->isPost() && $model->load($this->getRequest()->post())) {
            if ($model->send()) {
                return $this->render('feedback', ['model' => new FeedbackForm(), 'status' => Params::STATUS_OK]);
            }
        }

        $settings = Settings::findOne(1);

        return $this->render('feedback', ['model' => $model, 'requisites' => $settings->requisites]);
    }

    public function actionLegalAssistance()
    {
        $metadata = Metadata::getMetaDescription(Metadata::LEGAL_ASSISTANCE);
        $this->view->title = $metadata['title'];
        $this->view->registerMetaTag(
            ['name' => 'keywords', 'content' => $metadata['meta_keywords']]
        );
        $this->view->registerMetaTag(
            ['name' => 'description', 'content' => $metadata['meta_description']]
        );

        $form = new LegalAssistanceForm();

        if($this->getRequest()->isPost() && $form->load($this->getRequest()->post())) {
            if($form->save()){
                return $this->render('legal-assistance', ['model' => new LegalAssistanceForm(), 'status' => Params::STATUS_OK]);
            }
        }
        return $this->render('legal-assistance', ['model' => $form, 'status' => '']);
    } // actionLegalAssistance

    public function actionFaq()
    {
        $metadata = Metadata::getMetaDescription(Metadata::ANSWERS);
        $this->view->title = $metadata['title'];
        $this->view->registerMetaTag(
            ['name' => 'keywords', 'content' => $metadata['meta_keywords']]
        );
        $this->view->registerMetaTag(
            ['name' => 'description', 'content' => $metadata['meta_description']]
        );

        $faq = Faq::find()->orderBy(['id' => 'ASC'])->all();
        return $this->render('faq', ['faq' => $faq]);
    }

    public function actionTerms()
    {
        $page = Page::findOne(Page::PAGE_SERVICE_TERMS);

        return $this->render('terms', ['page' => $page]);
    }

    public function actionPolicy()
    {
        $page = Page::findOne(Page::PAGE_CONFIDENCE_POLICY);

        return $this->render('policy', ['page' => $page]);
    }

    public function actionLicenseProcedure()
    {
        $metadata = Metadata::getMetaDescription(Metadata::LICENGE_PROCEDURE);
        $this->view->title = $metadata['title'];
        $this->view->registerMetaTag(
            ['name' => 'keywords', 'content' => $metadata['meta_keywords']]
        );
        $this->view->registerMetaTag(
            ['name' => 'description', 'content' => $metadata['meta_description']]
        );

        $page = Page::findOne(Page::PAGE_PROCEDURE);
        return $this->render('license-procedure', ['page' => $page]);
    }

    /**
     * Подтверждение согласия прохождения конфигуратора
     * @return array|void
     * @throws \yii\web\HttpException
     */
    public function actionAcceptRules()
    {
        if(!$this->getRequest()->isAjax() && !$this->getRequest()->isGet()) {
            return $this->getResponse()->set404();
        }

        $user = App::i()->getCurrentUser();

        if(!$user) {
            return $this->getResponse()->set404();
        }

        $user->is_accept = true;

        return [
            'status' => $user->save()
        ];
    }
}