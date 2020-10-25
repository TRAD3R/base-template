<?php


namespace Admin\Controllers;


use App\Controller\Admin;
use App\Models\LegalAssistance;
use App\Params;
use App\SearchList\LegalAssSL;
use DateTime;

class LegalAssistanceController extends Admin
{
    public function actionIndex()
    {
        $params = [
            Params::PAGE => $this->getRequest()->getInt(Params::PAGE, 1),
            Params::STATUS => $this->getRequest()->get(Params::STATUS),
        ];
        $params[Params::LIMIT] = Params::DEFAULT_PAGE_SIZE;
        $params[Params::OFFSET] = ($params[Params::PAGE] - 1) * Params::DEFAULT_PAGE_SIZE;

        $searchList = new LegalAssSL($params);
        $pagination = $this->getPagination($searchList->getTotalCount(), $params[Params::LIMIT]);

        return $this->render('index', [
            'questions' => $searchList->getResults(),
            'pagination' => $pagination,
            'params' => $params
        ]);
    } // actionIndex

    public function actionEdit($id)
    {
        if(!$this->getRequest()->isAjax() && !$this->getRequest()->isGet()) {
            return $this->getResponse()->set404();
        }

        $legalAssistance = LegalAssistance::findOne($id);

        if(!$legalAssistance) {
            return $this->getResponse()->set404();
        }

        $legalAssistance->setAnswered();

        if($legalAssistance->save()) {
            return [
                'status' => Params::STATUS_OK,
                'state' => LegalAssistance::getStatusTitle($legalAssistance->status),
                'answeredDate' => (new DateTime($legalAssistance->date_answered))->format('d.m.Y H:i'),
            ];
        }

        return ['status' => Params::STATUS_FAIL];
    } // actionEdit

    public function actionDelete($id)
    {
        if(!$this->getRequest()->isAjax() && !$this->getRequest()->isGet()) {
            return $this->getResponse()->set404();
        }

        $legalAssistance = LegalAssistance::findOne($id);

        if(!$legalAssistance) {
            return $this->getResponse()->set404();
        }

        if($legalAssistance->delete()) {
            return [
                'status' => Params::STATUS_OK,
            ];
        }

        return ['status' => Params::STATUS_FAIL];
    } // actionDelete
}