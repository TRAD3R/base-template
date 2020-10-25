<?php


namespace Admin\Controllers;


use App\Controller\Admin;
use App\Models\Specialty;
use App\Params;

class SpecialityController extends Admin
{
    public function actionList()
    {
        $specs = Specialty::find()->orderBy(['education_level' => SORT_DESC, 'title' => SORT_ASC])->all();
        return $this->render('list', [
            'specs' => $specs,
        ]);
    } // actionList

    /**
     * Сохранение региона
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
        $level = $this->getRequest()->postInt(Params::EDUCATION);
        $experience = $this->getRequest()->postInt(Params::EXPERIENCE);

        if((int)$id === 0) {
            $speciality = new Specialty();
        } else {
            $speciality = Specialty::findOne($id);
            if (!$speciality) {
                return $this->getResponse()->set404();
            }
        }

        $speciality->title = $title;
        $speciality->experience = $experience;
        $speciality->education_level = $level;
        return ['status' => $speciality->save()];

    } // actionAccept

    public function actionDelete($id){
        if( $speciality = Specialty::findOne($id)){
            $speciality->delete();
        }
        return ['status' => Params::STATUS_OK];
    }

}