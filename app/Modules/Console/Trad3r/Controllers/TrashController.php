<?php
namespace Console\Trad3r\Controllers;

use Yii;
use yii\console\Controller;

class TrashController extends Controller
{
    public function actionArchive()
    {
        $dir = Yii::getAlias('@Web') . "/out/temp/archives";

        $files = scandir($dir);

        echo sprintf("Total files before: %d", count($files) - 2);

        foreach ($files as $file) {
            $filepath = $dir . '/' . $file;
            if(!is_file($filepath)) {
                continue;
            }
            unlink($filepath);
        }

        echo sprintf("Total files after: %d", count(scandir($dir)) - 2);
    }
}