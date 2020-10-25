<?php


namespace Admin\Controllers;


use App\Controller\Admin;
use App\Forms\Admin\User\ClientForm;
use App\Forms\Admin\User\ManagerForm;
use App\Models\User;
use App\Params;
use App\SearchList\UserSL;

class UserController extends Admin
{
    public function actionClient()
    {
        $params = [
            Params::USER_TYPE => User::TYPE_USER,
            'filter_view' => 'filters/client',
        ];
        $this->view->title = 'Посетители';
        return $this->index($params);
    } // actionClient

    public function actionManager()
    {
        $params = [
            Params::USER_TYPE => User::TYPE_ADMIN,
            'filter_view' => 'filters/manager',
        ];
        $this->view->title = 'Менеджеры';
        return $this->index($params);
    } // actionIndex

    public function index($params)
    {
        $params = array_merge($params, [
            Params::USER_STATUS => $this->getRequest()->getInt(Params::USER_STATUS),
            Params::USER_CATEGORY => $this->getRequest()->getInt(Params::USER_CATEGORY),
            Params::SEARCH => $this->getRequest()->getStr(Params::SEARCH),
        ]);
        $searchList = new UserSL($params);
        $pagination = $this->getPagination($searchList->getTotalCount());

        return $this->render('list', [
            'users' => $searchList->getResults(),
            'pagination' => $pagination,
            'params' => $params,
        ]);
    } // index

    public function actionClientEdit($id)
    {
        $params = [
            Params::USER_TYPE => User::TYPE_USER,
            Params::ID => (int)$id,
            'view' => 'client',
            'form' => ClientForm::class
        ];

        return $this->edit($params);
    } // actionClientEdit

    public function actionManagerEdit($id)
    {
        $params = [
            Params::USER_TYPE => User::TYPE_ADMIN,
            Params::ID => (int)$id,
            'view' => 'manager',
            'form' => ManagerForm::class
        ];

        return $this->edit($params);
    } // actionClientEdit

    public function edit($params)
    {
        if($params[Params::ID] == 0) {
            $user = new User();
            $user->type = $params[Params::USER_TYPE];
        } else {
            $user = User::findOne($params[Params::ID]);
            if(!$user) {
                return $this->redirect(['user/' . $params['view']]);
            }
        }

        $form = new $params['form']($user);

        if($form->load($this->getRequest()->post()) && $form->save()) {

            return $this->redirect(['user/' . $params['view']]);
        }

        return $this->render('form/' . $params['view'] . '/form', [
            'model' => $form
        ]);
    } // actionEdit
}