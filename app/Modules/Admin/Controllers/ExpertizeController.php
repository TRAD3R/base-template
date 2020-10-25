<?php


namespace Admin\Controllers;


use App\Controller\Admin;
use App\Models\Expertize;
use App\Params;
use App\SearchList\ExpertizeSL;
use DateTime;

class ExpertizeController extends Admin
{
    public function actionIndex()
    {
        $params = [
            Params::PAGE => $this->getRequest()->getInt(Params::PAGE, 1),
            Params::STATUS => $this->getRequest()->get(Params::STATUS),
        ];
        $params[Params::LIMIT] = Params::DEFAULT_PAGE_SIZE;
        $params[Params::OFFSET] = ($params[Params::PAGE] - 1) * Params::DEFAULT_PAGE_SIZE;

        $searchList = new ExpertizeSL($params);
        $pagination = $this->getPagination($searchList->getTotalCount(), $params[Params::LIMIT]);

        return $this->render('index', [
            'expertizes' => $searchList->getResults(),
            'pagination' => $pagination,
            'params' => $params
        ]);
    } // actionIndex

    /**
     * Отметка документов как проверенными
     * @param $id
     * @return array|void
     * @throws \yii\web\HttpException
     */
    public function actionChecked($id)
    {
        if(!$this->getRequest()->isAjax() && !$this->getRequest()->isGet()) {
            return $this->getResponse()->set404();
        }

        $expertize = Expertize::findOne($id);

        if(!$expertize) {
            return $this->getResponse()->set404();
        }

        if(!$expertize->is_paid) {
            return [
                'status' => Params::STATUS_FAIL,
                'message' => "Экспертиза не оплачена",
            ];
        }

        $expertize->setChecked();

        if($expertize->save()) {
            return [
                'status' => Params::STATUS_OK,
                'checkedDate' => (new DateTime($expertize->date_checked))->format('d.m.Y H:i'),
            ];
        }

        return ['status' => Params::STATUS_FAIL];
    } // actionChecked

    public function actionDelete($id)
    {
        if(!$this->getRequest()->isAjax() && !$this->getRequest()->isGet()) {
            return $this->getResponse()->set404();
        }

        $expertize = Expertize::findOne($id);

        if(!$expertize) {
            return $this->getResponse()->set404();
        }

        if($expertize->delete()) {
            return [
                'status' => Params::STATUS_OK,
            ];
        }

        return ['status' => Params::STATUS_FAIL];
    } // actionDelete
}