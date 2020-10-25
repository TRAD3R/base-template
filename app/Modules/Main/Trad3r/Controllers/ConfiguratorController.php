<?php


namespace Main\Trad3r\Controllers;


use App\App;
use App\Controller\Main;
use App\Helpers\ConfiguratorHelper;
use App\Models\Configuration;
use App\Models\Metadata;
use App\Models\Region;
use App\Models\User;
use App\Params;

class ConfiguratorController extends Main
{
    // тип конфигуратора
    private $type;

    public function beforeAction($action)
    {
        if (!parent::beforeAction($action)) {
            return false;
        }
        $user = App::i()->getCurrentUser();
        if (!$user || !$user->isVip()) {
            return $this->redirect(['/login']);
        }

        $metadata = Metadata::getMetaDescription(Metadata::CONFIGURATOR);
        $this->view->title = $metadata['title'];
        $this->view->registerMetaTag(
            ['name' => 'keywords', 'content' => $metadata['meta_keywords']]
        );
        $this->view->registerMetaTag(
            ['name' => 'description', 'content' => $metadata['meta_description']]
        );

        return true;
    }

    public function actionCause()
    {
        $user = App::i()->getCurrentUser();
        if (!$model = $this->getSessionModel()) {
            if (!$user->canFillConfigurator()) {
                return $this->redirect(['account/payment']);
            }
            $user->category = User::CATEGORY_VIP;
            $user->save();
            $model = new Configuration();
            $model->type = Configuration::TYPE_SUB;
            $model->user_id = App::i()->getCurrentUser()->id;
            $model->save();
            App::i()->getSession()->set(Params::CONFIGURATOR, $model->id);
        }

        if ($this->getRequest()->isPost()) {
            $causes = $this->getRequest()->postArrayStr(Params::CAUSE);
            if (empty($causes)) {
                return $this->render('cause');
            }
            $this->type = Configuration::TYPE_SUB;

            $model->cause = json_encode($causes);
            $model->save();

            if (in_array(1, $causes) || in_array(2, $causes)) {
                return $this->redirect(['education']);
            } else {
                return $this->redirect(['region']);
            }
        }

        return $this->render('cause');
    }

    public function actionEducation()
    {
        $user = App::i()->getCurrentUser();
        if (!$model = $this->getSessionModel()) {
            if (!$user->canFillConfigurator()) {
                return $this->redirect(['account/payment']);
            }
            $user->category = User::CATEGORY_VIP;
            $user->save();
            $this->type = Configuration::TYPE_PRIMARY;
            $model = new Configuration();
            $model->type = Configuration::TYPE_PRIMARY;
            $model->user_id = App::i()->getCurrentUser()->id;
            $model->save();
            App::i()->getSession()->set(Params::CONFIGURATOR, $model->id);
        }

        if (!empty($model->education)) {
            return $this->redirect(['staff', "id" => $model->education]);
        }

        return $this->render('step1');
    }

    public function actionStaff($id)
    {
        if (!$model = $this->getSessionModel()) {
            return $this->redirect(['configurator/education']);
        }

        if (!empty($model->staff)) {
            return $this->redirect(['speciality', 'id' => $model->staff]);
        }

        $model->education = $id;
        if (!$model->save()) {
            return $this->redirect(['configurator/education']);
        }

        return $this->render('step2', [
            'hasEducation' => in_array($model->education, [Configuration::EDUCATION_MIDDLE, Configuration::EDUCATION_HIGHER])
        ]);
    }

    public function actionSpeciality($id)
    {
        if (!$model = $this->getSessionModel()) {
            return $this->redirect(['configurator/education']);
        }

        if (!empty($model->speciality)) {
            return $this->redirect(["property"]);
        }

        if (!in_array($id, [Configuration::PERSONAL_HIRE, Configuration::PERSONAL_SELF])) {
            return $this->redirect(['configurator/staff', 'id' => $model->education]);
        }

        /** @var $model Configuration */
        $model->staff = $id;
        if (!$model->save()) {
            return $this->redirect(['configurator/staff', 'id' => $model->education]);
        }

        return $this->render('step3', [
            'highIsNotAvailable' => $model->staff == Configuration::PERSONAL_SELF && $model->education < Configuration::EDUCATION_HIGHER
        ]);
    }

    public function actionProperty()
    {

        if (!$model = $this->getSessionModel()) {
            return $this->redirect(['configurator/education']);
        }

        if (!empty($model->form)) {
            return $this->redirect(['step5', 'id' => $model->form]);
        }

        // Если переходим из черновика
        if (App::i()->getRequest()->isGet()) {
            return $this->render('step4', [
                'unavailableIP' => $model->education == Configuration::EDUCATION_NONE || $model->staff == Configuration::PERSONAL_HIRE
            ]);
        }


        $params = [
            Params::HIGH_EDUCATION => $this->getRequest()->postArrayStr(Params::HIGH_EDUCATION),
            Params::MIDDLE_EDUCATION => $this->getRequest()->postArrayStr(Params::MIDDLE_EDUCATION)
        ];

        /** Общее количество выбранных специальностей */
        $totalSpecialities = count($params[Params::HIGH_EDUCATION]) + count($params[Params::MIDDLE_EDUCATION]);
        /**
         * Если на Шаге №1 выбрано “Среднее образование”, на Шаге №2 “Работаю один”, то одновременно может быть выбрано не более 2 специальностей
         */
        if ($model->staff == Configuration::PERSONAL_SELF && $model->education < Configuration::EDUCATION_HIGHER) {
            if ($totalSpecialities > 2) {
                return $this->redirect(['configurator/speciality', 'id' => $model->staff]);
                // запилить сообщение, что выбрано не то образование и тд
            }
        }

        $arr = [
            Params::HIGH_EDUCATION => $params[Params::HIGH_EDUCATION],
            Params::MIDDLE_EDUCATION => $params[Params::MIDDLE_EDUCATION]
        ];

        $model->speciality = json_encode($arr);
        if (!$model->save()) {
            return $this->redirect(['configurator/speciality', 'id' => $model->staff]);
        }

        return $this->render('step4', [
            'unavailableIP' => $model->education == Configuration::EDUCATION_NONE || $totalSpecialities > 5
        ]);
    }

    public function actionStep5($id)
    {
        if (!$model = $this->getSessionModel()) {
            return $this->redirect(['configurator/education']);
        }

        if (!Configuration::getOwnerType($id)) {
            return $this->redirect(['configurator/property', 'id' => $model->staff]);
        }


        $model->form = $id;
        if (!$model->save()) {
            return $this->redirect(['configurator/property', 'id' => $model->staff]);
        }

        return $this->render('step5');
    }

    public function actionRegion()
    {
        if (!$model = $this->getSessionModel()) {
            return $this->redirect(['configurator/education']);
        }

        if (!empty($model->region)) {
            return $this->redirect(['step7', 'id' => $model->region]);
        }

        return $this->render('step6');
    }

    public function actionStep7($id)
    {
        if (!$model = $this->getSessionModel()) {
            return $this->redirect(['configurator/education']);
        }

        $region = Region::findOne($id);
        if (!$region) {
            return $this->redirect(['configurator/region']);
        }
        $model->region = $id;
        if (!$model->save()) {
            return $this->redirect(['configurator/region']);
        }

        return $this->render('step7', [
            'la' => $region->licensingAuthority
        ]);
    }

    public function actionSummary()
    {
        if (!$model = $this->getSessionModel()) {
            return $this->redirect(['configurator/education']);
        }

        App::i()->getSession()->set(Params::CONFIGURATOR, null);

        $region = Region::findOne($model->region);
        $archive = ConfiguratorHelper::getArchive($model);
        return $this->render('summary', [
            'url' => $archive,
            'la' => $region->licensingAuthority,
            'title' => $model->type == Configuration::TYPE_SUB ? 'Переоформление-лицензии.zip' : 'Первая-лицензия.zip'
        ]);
    } // actionSummary

    /**
     * Возвращает конфигуратор из БД по сессионным данным
     * @return Configuration|array|\yii\db\ActiveRecord|null
     */
    private function getSessionModel()
    {
        $model_id = App::i()->getSession()->get(Params::CONFIGURATOR);
        $user_id = App::i()->getCurrentUser()->id;

        if (!$model_id) {
            return null;
        }

        return Configuration::getByIdAndUserId($model_id, $user_id);
    }

}