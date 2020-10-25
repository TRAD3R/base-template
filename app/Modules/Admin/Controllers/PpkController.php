<?php


namespace Admin\Controllers;

use App\Assets\Packages\AjaxSelectAsset;
use App\Controller\Admin;
use App\File;
use App\Forms\Admin\OccupationForm;
use App\Helpers\ConvertHelper;
use App\Macroses\PpkMacros;
use App\Models\Client;
use App\Models\Occupation;
use App\Models\Review;
use App\Params;
use App\SearchList\OccupationSL;
use yii\db\Query;

class PpkController extends Admin
{
    /**
     * Список заявок на программы
     * @return string
     */
    public function actionIndex()
    {
        $clients = Client::find()->all();
        $reviews = Review::findAll(['status' => Review::STATUS_ACCEPT]);
        return $this->render('index', [
            'reviews' => $reviews,
            'clients' => $clients,
        ]);
    } // actionIndex

    /**
     * Список родов деятельности
     * @return string
     */
    public function actionOccupationList()
    {
        $params = [
            Params::PAGE => $this->getRequest()->getInt(Params::PAGE, 1),
            Params::LIMIT => Params::DEFAULT_PAGE_SIZE,
        ];
        $params[Params::OFFSET] = ($params[Params::PAGE] - 1) * $params[Params::LIMIT];

        $searchList = new OccupationSL($params);
        $pagination = $this->getPagination($searchList->getTotalCount(), $params[Params::LIMIT]);

        return $this->render('occupation/list', [
            'occupations' => $searchList->getResults(),
            'pagination' => $pagination,
            'params' => $params,
        ]);
    } // actionOccupationList

    /**
     * Добавление, редактирование родов деятельности
     * @param $id
     * @return string|\yii\web\Response
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\di\NotInstantiableException
     */
    public function actionOccupationEdit($id)
    {
        if ((int)$id == 0) {
            $occupation = new Occupation();
        } else {
            $occupation = Occupation::findOne($id);
        }
        if (!$occupation) {
            return $this->redirect('admin/occupations');
        }

        $form = new OccupationForm($occupation);
        if ($form->load($this->getRequest()->post()) && $form->save()) {
            return $this->redirect('/admin/occupations');
        }

        $macroses = PpkMacros::getMacroses();

        AjaxSelectAsset::register($this->view);
        return $this->render('occupation/form', [
            'model' => $form,
            'macroses' => $macroses
        ]);
    }

    /**
     * Получить роды деятельности через ajax-селект
     * @return array
     */
    public function actionOccupationGetAjax()
    {
        if (!$this->getRequest()->isAjax() || !$search = $this->getRequest()->getStr(Params::VALUE)) {
            return $this->getAjaxSelectResult([]);
        }

        $query = (new Query())
            ->select(['id', 'title'])
            ->from(Occupation::tableName())
            ;
        if (is_numeric($search)) {
            $query->where(['id' => $search]);
        } else {
            $query->where(['LIKE', 'title', $search]);
        }

        $occupations_raw = $query
            ->andWhere(['parent_id' => null])
            ->all();

        $occupations = [];

        foreach ($occupations_raw as $item) {
            $occupations[] = ['id' => $item['id'], 'text' => '[' . $item['id'] . '] ' .$item['title']];
        }

        return $this->getAjaxSelectResult($occupations);
    }

    public function actionOccupationPreview($id)
    {
        $occupation = Occupation::findOne($id);
        if (!$occupation) {
            return $this->redirect('admin/occupations');
        }

        $filename = (new File())->generateMd5('template') . '.pdf';
        $dirpath = (new File())->getPpkDir('template');
        if(!is_dir($dirpath)) {
            mkdir($dirpath, 0777, true);
        }
        $filepath = $dirpath . DIRECTORY_SEPARATOR . $filename;
        $template = $occupation->getTemplate();
        ConvertHelper::savePdf($filepath, $template);

        return $this->redirect((new File())->getPpkDir('template', true) . "/" . $filename);
    } // actionOccupationPreview

    /**
     * @param $data
     *
     * @return array
     */
    protected function getAjaxSelectResult($data)
    {
        return ['results' => $data];
    }

}