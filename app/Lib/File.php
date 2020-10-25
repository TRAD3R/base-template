<?php

namespace App;

use Yii;
use yii\base\BaseObject;

/**
 * Класс по работе с публичными и приватными файломи
 */
class File extends BaseObject
{
    /**
     * @param string $path
     *
     * @return bool
     */
    protected function deleteFile($path)
    {
        if (file_exists($path)) {
            return unlink($path);
        }
        return true;
    }

    /**
     * Путь к файлам PPK
     * @param $subdir
     * @param false $forOut - для ссылки
     * @return string
     */
    public function getPpkDir($subdir, $forOut = false)
    {
        $domain = $forOut ? App::i()->getApp()->params['domains']['main'] . '/' . $this->getPublicDir() : App::i()->getConfig()->getPathToPublicStatic();
        $path = $domain . DIRECTORY_SEPARATOR . $subdir;
        if(!$forOut && !is_dir($path)) {
            mkdir($path, 0777, true);
        }

        return $path;
    }

    /**
     * Путь к файлам контрактов
     * @param false $forOut - для ссылки
     * @return string
     */
    public function getContractsDir($forOut = false)
    {
        $domain = $forOut ? App::i()->getApp()->params['domains']['main'] . '/' . $this->getPublicDir() : App::i()->getConfig()->getPathToPublicStatic();
        $path = $domain . DIRECTORY_SEPARATOR . 'contracts';
        if(!$forOut && !is_dir($path)) {
            mkdir($path, 0777, true);
        }

        return $path;
    }

    /**
     * @return string
     */
    public function getPublicDir()
    {
        return App::i()->getConfig()->getPublicDir();
    }

    public function getArchiveDir($forOut = false)
    {
        $path = Yii::getAlias('@Web') . DIRECTORY_SEPARATOR .
            $this->getPublicDir() . DIRECTORY_SEPARATOR .
            'temp' . DIRECTORY_SEPARATOR . 'archives'
        ;
       if($forOut) {
           $path = App::i()->getApp()->params['domains']['main'] . '/out/temp/archives';
       }

        return $path;
    }

    /**
     * Путь к файлам на экспертизу
     * @param false $forOut
     * @return string
     */
    public static function getUserDocsDir($forOut = false)
    {
        $path = Yii::getAlias('@Web') . DIRECTORY_SEPARATOR .
            App::i()->getConfig()->getPublicDir() . DIRECTORY_SEPARATOR . 'user_docs'
        ;
        if($forOut) {
            $path = App::i()->getApp()->params['domains']['main'] . '/out/user_docs';
        }

        return $path;
    }

    /**
     * Генерация уникального имени
     *
     * @param mixed $file
     *
     * @return string
     */
    public function generateMd5($file)
    {
        return md5(microtime() . $file);
    }

    /**
     * Multi Domain Url -- отдает статический контент с разных поддоменов.
     * Для использования во вьюхах:
     * @example File::imgUrl('/bs3style/icons/actions.ico') --> 'http://st2.hotfix.7img.ru/bs3style/icons/actions.ico'
     *
     * @param string $filename --  имя файла (можно с путем)
     *
     * @return string
     */
    public function mdUrl($filename)
    {
        return App::i()->getConfig()->getFaceDomain() . $filename;
    }

    public static function getDocsDir($configType)
    {
        $dir = Yii::getAlias('@common_resources') . DIRECTORY_SEPARATOR;

        switch ($configType) {
            case Params::CONFIGURATOR_TYPE_1:
                $dir .= App::i()->getConfig()->getConfig1Dir();
                break;
            case Params::CONFIGURATOR_TYPE_2:
                $dir .= App::i()->getConfig()->getConfig2Dir();
                break;
        }
        return  $dir;
    }
}
