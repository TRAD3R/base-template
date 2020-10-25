<?php


namespace Admin\Controllers;

use App\Assets\Packages\AjaxSelectAsset;
use App\Controller\Admin;
use App\File;
use App\Forms\Admin\ContractForm;
use App\Helpers\ConvertHelper;
use App\Macroses\ContractMacros;
use App\Models\Client;
use App\Models\Contract;
use App\Models\Review;

class ContractController extends Admin
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
     * Список договоров
     * @return string
     */
    public function actionList()
    {
        $contracts = Contract::getTitle();

        return $this->render('list', [
            'contracts' => $contracts,
        ]);
    } // actionOccupationList

    /**
     * Добавление, редактирование родов деятельности
     * @param $id
     * @return string|\yii\web\Response
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\di\NotInstantiableException
     */
    public function actionEdit($id)
    {
        if (!Contract::isCorrectType($id)) {
            return $this->redirect(['list']);
        }

        $form = new ContractForm($id);
        if ($form->load($this->getRequest()->post()) && $form->save()) {
            return $this->redirect(['list']);
        }

        $macroses = ContractMacros::getMacroses($id);

        AjaxSelectAsset::register($this->view);
        return $this->render('form', [
            'model' => $form,
            'macroses' => $macroses,
            'type' => $id,
        ]);
    }

    public function actionPreview($id)
    {

        $filename = (new File())->generateMd5('') . '.pdf';
        $dirpath = (new File())->getContractsDir();
        $filepath = $dirpath . DIRECTORY_SEPARATOR . $filename;
        $template = Contract::getTemplate($id);
        $orientation = in_array($id, [Contract::CONTRACT_MEDICAL_SERVICES]) ? 'landscape' : 'portrait';
        ConvertHelper::savePdf($filepath, $template, $orientation);

        return $this->redirect((new File())->getContractsDir(true) . "/" . $filename);
    } // actionOccupationPreview

}