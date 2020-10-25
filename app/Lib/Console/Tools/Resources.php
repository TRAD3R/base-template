<?php


namespace App\Console\Tools;


use App\AppHelper;
use Yii;

class Resources
{
    public function run(){
        $destination = Yii::getAlias('@Web');

        $ico_source = Yii::getAlias(AppHelper::getProjectResourcesAlias()) . '/favicon.ico';
        if(file_exists($ico_source)){
            exec('rm -f ' . $destination . '/favicon.ico');
            exec('cp ' . $ico_source . ' ' , $destination);
        }

        $sources = [
            'images',
            'fonts',
            'files',
            'favicon'
        ];

        foreach ($sources as $folder){
            $source = Yii::getAlias(AppHelper::getProjectResourcesAlias()) . DIRECTORY_SEPARATOR . $folder;
            if(is_dir($source)){
                exec('cd ' . $destination . DIRECTORY_SEPARATOR . $folder . ' && ls | grep -v \'.gitignore\' | xargs rm -rf');
                exec('cp -R ' . $source . ' ' . $destination);
                exec('cd ..');
            }
        }

    } // actionRun
}