<?php


namespace Admin\Controllers;


use App\Controller\Admin;
use App\Models\Review;

class ReviewController extends Admin
{
    /**
     * Вывод списка отзывов
     * @return string
     */
    public function actionIndex()
    {
        $reviews = Review::find()->orderBy(['date_created' => SORT_DESC])->all();

        return $this->render('index', [
            'reviews' => $reviews
        ]);
    } // actionIndex

    /**
     * Подтверждение отзыва
     * @param $id
     * @return array|void
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\di\NotInstantiableException
     * @throws \yii\web\HttpException
     */
    public function actionAccept($id)
    {
        if(!$this->getRequest()->isAjax()) {
            return $this->getResponse()->set404();
        }

        $review = Review::findOne($id);
        if (!$review) {
            return $this->getResponse()->set404();
        }

        $review->status = Review::STATUS_ACCEPT;
        return ['status' => $review->save()];

    } // actionAccept

    /**
     * Отклонение отзыва
     * @param $id
     * @return array|void
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\di\NotInstantiableException
     * @throws \yii\web\HttpException
     */
    public function actionReject($id)
    {
        if(!$this->getRequest()->isAjax()) {
            return $this->getResponse()->set404();
        }

        $review = Review::findOne($id);
        if (!$review) {
            return $this->getResponse()->set404();
        }

        $review->status = Review::STATUS_REJECT;
        return ['status' => $review->save()];

    } // actionReject

    /**
     * Отклонение отзыва
     * @param $id
     * @return array|void
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\di\NotInstantiableException
     * @throws \yii\web\HttpException
     */
    public function actionRemove($id)
    {
        if(!$this->getRequest()->isAjax()) {
            return $this->getResponse()->set404();
        }

        $review = Review::findOne($id);
        if (!$review) {
            return $this->getResponse()->set404();
        }

        return ['status' => $review->delete()];

    } // actionRemove

    /**
     * Отклонение отзыва
     * @param $id
     * @return array|void
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\di\NotInstantiableException
     * @throws \yii\web\HttpException
     */
    public function actionEdit($id)
    {
        if(!$this->getRequest()->isAjax()) {
            return $this->getResponse()->set404();
        }

        $review = Review::findOne($id);
        if (!$review) {
            return $this->getResponse()->set404();
        }

        $text = $this->getRequest()->post('text');
        $date = $this->getRequest()->post('date');

        $review->text = $text;
        $review->date_created = $date;
        return ['status' => $review->save()];

    } // actionEdit
}