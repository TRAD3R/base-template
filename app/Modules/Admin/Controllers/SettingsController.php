<?php


namespace Admin\Controllers;


use App\Controller\Admin;
use App\Forms\Admin\SettingsForm;
use App\Models\Service;
use App\Models\Metadata;
use App\Models\Settings;
use App\Params;
use App\SearchList\PageSL;

class SettingsController extends Admin
{
    public function actionService()
    {
        $services = Service::find()->orderBy("weight ASC")->all();

        return $this->render('service', ['services' => $services]);
    } // actionCost

    public function actionServiceEdit($id)
    {
        if(!$this->getRequest()->isAjax() || !$this->getRequest()->isPost()) {
            return $this->getResponse()->set404();
        }

        $title = $this->getRequest()->postStr(Params::TITLE);
        $description = $this->getRequest()->postStr(Params::DESCRIPTION);
        $cost = (int)$this->getRequest()->postStr(Params::COST);
        $icon = $this->getRequest()->postStr(Params::ICON);
        $weight = $this->getRequest()->postStr(Params::WEIGHT);
        $enabled = $this->getRequest()->postStr(Params::ENABLE);

        $service = Service::findOne($id);
        if (!$service) {
            return $this->getResponse()->set404();
        }

        $service->title = $title;
        $service->description = $description;
        $service->cost = $cost;
        $service->icon = $icon;
        $service->weight = $weight;
        $service->is_enable = $enabled;
        return ['status' => $service->save()];
    } // actionServiceEdit

    public function actionPages(){
        $params = [
            Params::PAGE => $this->getRequest()->getInt(Params::PAGE, 1)
        ];
        $params[Params::LIMIT] = Params::DEFAULT_PAGE_SIZE;
        $params[Params::OFFSET] = ($params[Params::PAGE] - 1) * Params::DEFAULT_PAGE_SIZE;

        $searchList = new PageSL($params);
        $pagination = $this->getPagination($searchList->getTotalCount(), $params[Params::LIMIT]);

        return $this->render('pages', [
            'pages' => $searchList->getResults(),
            'pagination' => $pagination,
        ]);
    }

    /**
     * Сохранение метаданных
     * @param int $id
     * @return array|void
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\di\NotInstantiableException
     * @throws \yii\web\HttpException
     */
    public function actionMetaEdit($id)
    {
        if(!$this->getRequest()->isAjax() || !$this->getRequest()->isPost()) {
            return $this->getResponse()->set404();
        }

        $title = $this->getRequest()->postStr(Params::TITLE);
        $description = $this->getRequest()->postStr(Params::DESCRIPTION);
        $keywords = $this->getRequest()->postStr(Params::KEYWORDS);

        $page = Metadata::findOne($id);
        if (!$page) {
            return $this->getResponse()->set404();
        }

        $page->title = $title;
        $page->meta_description = $description;
        $page->meta_keywords = $keywords;

        return ['status' => $page->save()];

    } // actionMetaEdit

    public function actionSettings()
    {
        $settings = Settings::findOne(1);
        if(!$settings) {
            $settings = new Settings();
            $settings->id = 1;
            $settings->save();
        }
        $form = new SettingsForm($settings);

        if($form->load($this->getRequest()->post()) && $form->save()) {
            $this->addFlash('success', 'Данные сохранены');
        }

        return $this->render('settings', [
            'model' => $form
        ]);
    } // actionSettings
}