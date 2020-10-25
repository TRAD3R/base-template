<?php
namespace Admin\Controllers;

use App\Assets\Packages\AjaxSelectAsset;
use App\Controller\Admin;
use App\Forms\Admin\SectionForm;
use App\Models\Section;
use App\Params;

class SectionController extends Admin
{

    /**
     * список разделов сайта
     */
    public function actionIndex(){

        $sections = Section::find()->all();
        $params = [
            Params::PAGE => $this->getRequest()->getInt(Params::PAGE, 1)
        ];
        $params[Params::LIMIT] = Params::DEFAULT_PAGE_SIZE;
        $params[Params::OFFSET] = ($params[Params::PAGE] - 1) * Params::DEFAULT_PAGE_SIZE;

//        $section = new SectionSL($params);
//        $pagination = $this->getPagination($section->getTotalCount(), $params[Params::LIMIT]);
        return $this->render('index', ['sections' => $sections,]
//            'pagination' => $pagination]
        );
    }

    public function actionEdit($id){
        if ((int)$id == 0) {
            $section = new Section();
        } else {
            $section = Section::findOne($id);
        }
        if (!$section) {
            return $this->redirect('/admin/sections');
        }

//        соответственно сделать форму
        $form = new SectionForm($section);
        if ($form->load($this->getRequest()->post()) && $form->save()) {
            return $this->redirect('/admin/sections');
        }

//        сделать форму под редачку
        AjaxSelectAsset::register($this->view);
        return $this->render('form', [
            'model' => $form
        ]);
    }

    public function actionDelete($id){
        if( $section = Section::findOne($id)){
        $section->delete();
        }
        return $this->redirect('/admin/sections');
    }

}