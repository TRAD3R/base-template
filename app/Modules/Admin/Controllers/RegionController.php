<?php


namespace Admin\Controllers;


use App\Controller\Admin;
use App\Models\Region;
use App\Params;

class RegionController extends Admin
{
    public function actionList()
    {
        $regions = Region::getRegions();
        return $this->render('list', [
            'regions' => $regions,
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
        $code = $this->getRequest()->postStr(Params::CODE);

        if((int)$id === 0) {
            $region = new Region();
        } else {
            $region = Region::findOne($id);
            if (!$region) {
                return $this->getResponse()->set404();
            }
        }

        $region->name = $title;
        $region->code = $code;
        return ['status' => $region->save()];

    } // actionAccept

    public function actionDelete($id){
        if( $section = Region::findOne($id)){
            $section->delete();
        }
        return ['status' => Params::STATUS_OK];
    }

}