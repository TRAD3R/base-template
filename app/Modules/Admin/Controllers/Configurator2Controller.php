<?php


namespace Admin\Controllers;


use App\Controller\Admin;
use App\File;
use App\Helpers\ConfiguratorHelper;
use App\Helpers\TextUtils;
use App\Models\Region;
use App\Models\Specialty;
use App\Params;
use yii\web\UploadedFile;

class Configurator2Controller extends Admin
{
    const CONFIG_TYPE = Params::CONFIGURATOR_TYPE_2;
    /**
     * Список загруженных документов для конфигуратора
     */
    public function actionDoclist()
    {
        $params = [
            Params::CONFIGURATOR => self::CONFIG_TYPE,
            Params::SEARCH  => $this->getRequest()->getStr(Params::SEARCH),
            Params::PROPERTY => $this->getRequest()->get(Params::PROPERTY),
            Params::EDUCATION => $this->getRequest()->get(Params::EDUCATION),
            Params::HIGH_EDUCATION => $this->getRequest()->get(Params::HIGH_EDUCATION),
            Params::MIDDLE_EDUCATION => $this->getRequest()->get(Params::MIDDLE_EDUCATION),
            Params::REGION => $this->getRequest()->get(Params::REGION),

        ];
        $docs = $this->getDocs($params);
        $dirs = $this->getDirs(self::CONFIG_TYPE);

        return $this->render('docs/list', [
            'docs' => $docs,
            'dirs' => $dirs,
            'params' => $params
        ]);
    } // actionDoc

    public function actionRemove()
    {
        if(!$this->getRequest()->isAjax() || !$this->getRequest()->isPost()) {
            return $this->getResponse()->set404();
        }

        $filepath = $this->getRequest()->postStr(Params::FILEPATH);
        $fullPath = File::getDocsDir(self::CONFIG_TYPE) . DIRECTORY_SEPARATOR . $filepath;
        if(!is_file($fullPath)) {
            return ['status' => Params::STATUS_OK];
        }

        return ['status' => unlink($fullPath) ? Params::STATUS_OK : Params::STATUS_FAIL];
    } // actionRemove

    /**
     * Добавление файла
     * @return array|void
     * @throws \yii\web\HttpException
     */
    public function actionAdd()
    {
        if(!$this->getRequest()->isAjax() || !$this->getRequest()->isPost()) {
            return $this->getResponse()->set404();
        }

        $dir = $this->getRequest()->postStr(Params::FILEPATH);
        $file = UploadedFile::getInstanceByName('file');
        $path = File::getDocsDir(self::CONFIG_TYPE) . DIRECTORY_SEPARATOR . $dir;
        if(!is_dir($path)) {
            return ['status' => Params::STATUS_FAIL];
        }

        $filename = TextUtils::prepareFilename($file->name);
        if($file->saveAs($path . DIRECTORY_SEPARATOR . $filename)) {
            return ['status' => Params::STATUS_OK];
        }


        return ['status' => Params::STATUS_FAIL];
    } // actionAdd

    /**
     * Список загруженных документов
     * @param $params
     * @return array
     */
    private function getDocs($params)
    {
        $docs = [];
        foreach (ConfiguratorHelper::getDirTitle() as $dir => $title) {
            $params[Params::DIR] = $dir;
            $docs = array_merge($docs, ConfiguratorHelper::getDocsInDir($params));
        }

        return $docs;
    }

    private function getDirs($configType)
    {
        $mainDir = File::getDocsDir($configType);
        $dirs = ConfiguratorHelper::getDirTitle();
        $res = [];
        foreach ($dirs as $key => $title) {
            $path = $mainDir . DIRECTORY_SEPARATOR . $key;
            if(!is_dir($path)) {
                mkdir($path, 0777, true);
            }

            if(ConfiguratorHelper::DIR_REGIONS == $key) {
                $regions = Region::getRegions();
                /** @var Region $region */
                foreach ($regions as $region) {
                    $subdir = $path . DIRECTORY_SEPARATOR . $region->code;
                    if(!is_dir($subdir)) {
                        mkdir($subdir, 0777, true);
                    }
                    $res[$key . DIRECTORY_SEPARATOR . $region->code] = $region->name;
                }
            } elseif(in_array($key, [ConfiguratorHelper::DIR_SPEC_HIGH, ConfiguratorHelper::DIR_SPEC_MID])) {
                switch ($key) {
                    case ConfiguratorHelper::DIR_SPEC_HIGH:
                        $educations = Specialty::getHigher();
                        break;
                    case ConfiguratorHelper::DIR_SPEC_MID:
                        $educations = Specialty::getMiddle();
                        break;
                    default:
                        $educations = [];
                }
                /** @var Specialty $type */
                foreach ($educations as $type) {
                    $subdir = $path . DIRECTORY_SEPARATOR . $type->alias;
                    if(!is_dir($subdir)) {
                        mkdir($subdir, 0777, true);
                    }
                    $res[$key . DIRECTORY_SEPARATOR . $type->alias] = sprintf('%s (%s)', ConfiguratorHelper::getDirTitle($key), $type->title);
                }

            } else {
                $res[$key] = ConfiguratorHelper::getDirTitle($key);
            }
        }

        return $res;
    }
}