<?php


namespace Admin\Controllers;


use App\Controller\Admin;
use App\Forms\Admin\LicenseAuthorityForm;
use App\Models\LicensingAuthority;

class LicensingAuthorityController extends Admin
{
    public function actionList()
    {
        $items = LicensingAuthority::find()->orderBy(['title' => 'ASC'])->all();
        return $this->render('list', [
            'items' => $items,
        ]);
    } // actionList

    public function actionEdit($id){
        if ((int)$id == 0) {
            $la = new LicensingAuthority();
        } else {
            $la = LicensingAuthority::findOne($id);
        }
        if (!$la) {
            return $this->redirect(['list']);
        }

//        соответственно сделать форму
        $form = new LicenseAuthorityForm($la);
        if ($form->load($this->getRequest()->post()) && $form->save()) {
            return $this->redirect(['list']);
        }

        return $this->render('form', [
            'model' => $form
        ]);
    }

}