<?php


namespace Admin\Controllers;


use App\Controller\Admin;
use App\Models\Client;
use App\Params;
use App\SearchList\ClientSL;

class ClientController extends Admin
{
    /**
     * Вывод списка отзывов
     * @return string
     */
    public function actionIndex()
    {
        $params = [
            Params::PAGE => $this->getRequest()->getInt(Params::PAGE, 1)
        ];
        $params[Params::LIMIT] = Params::DEFAULT_PAGE_SIZE;
        $params[Params::OFFSET] = ($params[Params::PAGE] - 1) * Params::DEFAULT_PAGE_SIZE;

        $searchList = new ClientSL($params);
        $pagination = $this->getPagination($searchList->getTotalCount(), $params[Params::LIMIT]);

        return $this->render('index', [
            'clients' => $searchList->getResults(),
            'pagination' => $pagination,
        ]);
    } // actionIndex

    /**
     * Сохранение клиента
     * @param int $id
     * @return array|void
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\di\NotInstantiableException
     * @throws \yii\web\HttpException
     */
    public function actionAccept($id)
    {
        if(!$this->getRequest()->isAjax() || !$this->getRequest()->isPost()) {
            return $this->getResponse()->set404();
        }

        $title = $this->getRequest()->postStr(Params::TITLE);
        $description = $this->getRequest()->postStr(Params::DESCRIPTION);

        if((int)$id === 0) {
            $client = new Client();
        } else {
            $client = Client::findOne($id);
            if (!$client) {
                return $this->getResponse()->set404();
            }
        }

        $client->title = $title;
        $client->description = $description;
        return ['status' => $client->save()];

    } // actionAccept
}