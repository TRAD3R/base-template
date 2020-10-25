<?php
/**
 * Работа со страницей отзывов и списка клиентов
 */

namespace Main\Trad3r\Controllers;


use App\Controller\Main;
use App\Forms\ReviewForm;
use App\Models\Client;
use App\Models\Review;
use App\Models\Metadata;

class ReviewController extends Main
{
    public function actionIndex()
    {
        $metadata = Metadata::getMetaDescription(Metadata::REVIEW);
        $this->view->title = $metadata['title'];
        $this->view->registerMetaTag(
            ['name' => 'keywords', 'content' => $metadata['meta_keywords']]
        );
        $this->view->registerMetaTag(
            ['name' => 'description', 'content' => $metadata['meta_description']]
        );
        $clients = Client::getNext();
        $reviews = Review::find()
            ->where(['status' => Review::STATUS_ACCEPT])
            ->orderBy(['date_created' => SORT_DESC])
            ->all()
        ;

        return $this->render('index', [
            'reviews' => $reviews,
            'clients' => $clients,
        ]);
    } // actionIndex

    public function actionAdd()
    {
        $form = new ReviewForm();
        if($this->getRequest()->isPost() && $form->load($this->getRequest()->post())) {
            if($form->save()) {
                $this->setFlash('success', 'Ваш отзыв добавлен и будет доступен для просмотра после модерации');
                return $this->redirect('/reviews');
            }
        }

        return $this->render('form', ['model' => $form]);
    } // actionAdd

    public function actionNext($page)
    {
        if(!$this->getRequest()->isAjax() || !$this->getRequest()->isGet()) {
            $this->getResponse()->set404();
        }

        $clients = Client::getNext($page);

        $view = $this->renderPartial('_clients', ['clients' => $clients]);

        return [
            'view' => $view,
            'hasMore' => count($clients) == Client::PER_PAGE
        ];

    } // actionNext
}