<?php


namespace Main\Trad3r\Controllers;


use App\App;
use App\Controller\Main;
use App\Forms\Main\FeedbackForm;
use App\Models\Metadata;
use App\Params;

class SiteController extends Main
{

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

        return $this->render('index');
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

        return $this->render('feedback', ['model' => $model]);
    }
}