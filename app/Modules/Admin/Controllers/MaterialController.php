<?php


namespace Admin\Controllers;


use App\App;
use App\Controller\Admin;
use App\Forms\Admin\MaterialForm;
use App\Models\Material;
use App\Params;

class MaterialController extends Admin
{
    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    public function actionList()
    {
        $materials = Material::find()->orderBy(['id' => 'ASC'])->all();

        return $this->render('list', [
            'materials' => $materials
        ]);
    }

    /**
     * Добавление, редактирование родов деятельности
     * @param $id
     * @return string|\yii\web\Response
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\di\NotInstantiableException
     */
    public function actionEdit($id)
    {
        if($id == 0) {
            $material = new Material();
        }else{
            $material = Material::findOne($id);
        }

        if(!$material){
            return $this->getResponse()->set404();
        }

        $form = new MaterialForm($material);
        if ($form->load($this->getRequest()->post()) && $form->save()) {
            return $this->redirect(['list']);
        }

        return $this->render('form', [
            'model' => $form,
        ]);
    }

    public function actionRemove($id)
    {
        $material = Material::findOne($id);

        if(!$material) {
            return $this->getResponse()->set404();
        }

        if(!$material->delete()) {
            App::i()->getSession()->addFlash('danger', 'Ошибка удаления материала');
        }else{
            App::i()->getSession()->addFlash('success', 'Материал удален');
        }

        return $this->redirect(['list']);
    } // actionRemove

    public function actionCreateAlias()
    {
        if(!$this->getRequest()->isAjax() || !$this->getRequest()->isPost()) {
            return $this->getResponse()->set404();
        }

        $title = $this->getRequest()->postStr(Params::TITLE);

        $url = Material::getUniqueUrl($title);

        return [
            'status' => Params::STATUS_OK,
            'alias'  => $url
        ];
    }
}