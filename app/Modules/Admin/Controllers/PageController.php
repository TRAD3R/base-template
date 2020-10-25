<?php


namespace Admin\Controllers;


use App\App;
use App\Controller\Admin;
use App\Forms\Admin\Page\PageForm;
use App\Models\Faq;
use App\Models\Page;
use App\Params;

class PageController extends Admin
{
    public function actionFaq()
    {
        $faq = Faq::find()->orderBy(['id' => 'ASC'])->all();
        return $this->render('faq', ['faq' => $faq]);
    }

    /**
     * Сохранение клиента
     * @param int $id
     * @return array|void
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\di\NotInstantiableException
     * @throws \yii\web\HttpException
     */
    public function actionFaqAccept($id)
    {
        if(!$this->getRequest()->isAjax() || !$this->getRequest()->isPost()) {
            return $this->getResponse()->set404();
        }

        $question = $this->getRequest()->postStr(Params::QUESTION);
        $answer = $this->getRequest()->postStr(Params::ANSWER);

        if((int)$id === 0) {
            $faq = new Faq();
        } else {
            $faq = Faq::findOne($id);
            if (!$faq) {
                return $this->getResponse()->set404();
            }
        }

        $faq->question = $question;
        $faq->answer = $answer;
        return ['status' => $faq->save()];

    } // actionAccept

    public function actionLicense()
    {
        $page = Page::findOne(Page::PAGE_LICENSE);

        $form = new PageForm($page);
        if($form->load($this->getRequest()->post()) && $form->save()) {
            App::i()->getSession()->setFlash('success', 'Данные успешно сохранены');
        }
        $this->view->title = 'Лицензионное дело';
        return $this->render('license', ['model' => $form]);
    }

    public function actionProcedure()
    {
        $page = Page::findOne(Page::PAGE_PROCEDURE);

        $form = new PageForm($page);
        if($form->load($this->getRequest()->post()) && $form->save()) {
            App::i()->getSession()->setFlash('success', 'Данные успешно сохранены');
        }
        $this->view->title = 'Порядок оформления лицензии';
        return $this->render('license', ['model' => $form]);
    }

    public function actionTermService()
    {
        $page = Page::findOne(Page::PAGE_SERVICE_TERMS);

        $form = new PageForm($page);
        if($form->load($this->getRequest()->post()) && $form->save()) {
            App::i()->getSession()->setFlash('success', 'Данные успешно сохранены');
        }
        return $this->render('terms', ['model' => $form]);
    }

    public function actionPolicy()
    {
        $page = Page::findOne(Page::PAGE_CONFIDENCE_POLICY);

        $form = new PageForm($page);
        if($form->load($this->getRequest()->post()) && $form->save()) {
            App::i()->getSession()->setFlash('success', 'Данные успешно сохранены');
        }
        return $this->render('policy', ['model' => $form]);
    }

    public function actionPpk()
    {
        $page = Page::findOne(Page::PAGE_PPK);

        $form = new PageForm($page);
        if($form->load($this->getRequest()->post()) && $form->save()) {
            App::i()->getSession()->setFlash('success', 'Данные успешно сохранены');
        }
        return $this->render('ppk', ['model' => $form]);
    }
}