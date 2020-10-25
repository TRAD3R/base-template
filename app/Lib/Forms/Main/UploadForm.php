<?php


namespace App\Forms\Main;


use App\App;
use App\Helpers\TextUtils;
use App\Model;
use App\Models\Expertize;
use App\Models\Service;
use DateTime;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    public $files;

    public function rules()
    {
        return [
            [['files'], 'file', 'skipOnEmpty' => true,
                "extensions" => "jpg, jpeg, png, gif, pdf, doc, docx, odt",'maxFiles' => 20,
                "maxSize" => 1024*1024*20,
                'message' => 'Вы можете загрузить для экспертизы документы в форматах jpg, jpeg, png, gif, pdf, doc, docx, odt'
            ],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $userId = App::i()->getCurrentUser()->id;
            $path = Expertize::getFilepath($userId);

            $this->files = UploadedFile::getInstances($this, 'files');
            $names = [];
            $date = (new DateTime())->format('YmdHis');
            $path .= DIRECTORY_SEPARATOR . $date;
            if(!is_dir($path)) {
                mkdir($path, 0777, true);
            }
            foreach ($this->files as $file) {
                $filename =  TextUtils::prepareFilename($file->name);

                if($file->saveAs($path . DIRECTORY_SEPARATOR . $filename)){
                    $names[] = $date . DIRECTORY_SEPARATOR . $filename;
                }
            }

            $entity = Service::findOne(Service::EXPERTIZE);
            $expertize = new Expertize();
            $expertize->files = json_encode($names);
            $expertize->is_paid = false;
            $expertize->user_id = $userId;
            $expertize->total_cost = count($names) * $entity->cost;

            if($expertize->save()) {
                return $expertize->id;
            }
        }
        return null;
    }

}