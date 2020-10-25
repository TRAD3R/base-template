<?php
/**
 * @var array $params
 */
use App\Helpers\Url;
use App\Html;
use App\Models\Configuration;
use App\Models\Region;
use App\Models\Specialty;
use App\Params;

?>
<?= Html::beginForm(Url::toRoute(['doclist']), 'GET'); ?>
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Фильтр</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-5 col-xs-12">
                    <div class="form-group">
                        <?= Html::label('Поиск', Params::SEARCH); ?>
                        <?= Html::textInput(Params::SEARCH, $params[Params::SEARCH], ['class' => 'form-control']); ?>
                    </div>
                </div>
                <div class="col-md-3 col-xs-6">
                    <div class="form-group">
                        <?= Html::label('ОПФ'); ?>
                        <?= Html::dropDownList(Params::PROPERTY,
                            $params[Params::PROPERTY],
                            Configuration::getOwnerType(),
                            [
                                'class' => 'form-control',
                                'prompt' => 'Все формы',
                            ]);
                        ?>
                    </div>
                </div>
                <div class="col-md-4 col-xs-6">
                    <div class="form-group">
                        <?= Html::label('Образование'); ?>
                        <?= Html::dropDownList(Params::EDUCATION,
                            $params[Params::EDUCATION],
                            Configuration::getEducationTitle(),
                            [
                                'class' => 'form-control',
                                'prompt' => 'Все уровни',
                            ]);
                        ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-xs-12">
                    <div class="form-group">
                        <?= Html::label('Специальность высшего образования'); ?>
                        <?= Html::dropDownList(Params::HIGH_EDUCATION,
                            $params[Params::HIGH_EDUCATION],
                            Specialty::getArraySpecialities(Configuration::EDUCATION_HIGHER),
                            [
                                'class' => 'form-control',
                                'prompt' => 'Все специальности',
                            ]);
                        ?>
                    </div>
                </div>
                <div class="col-md-4 col-xs-12">
                    <div class="form-group">
                        <?= Html::label('Специальность высшего образования'); ?>
                        <?= Html::dropDownList(Params::MIDDLE_EDUCATION,
                            $params[Params::MIDDLE_EDUCATION],
                            Specialty::getArraySpecialities(Configuration::EDUCATION_MIDDLE),
                            [
                                'class' => 'form-control',
                                'prompt' => 'Все специальности',
                            ]);
                        ?>
                    </div>
                </div>
                <div class="col-md-4 col-xs-12">
                    <div class="form-group">
                        <?= Html::label('Регион'); ?>
                        <?= Html::dropDownList(Params::REGION,
                            $params[Params::REGION],
                            Region::getRegionsListCodeKey(),
                            [
                                'class' => 'form-control',
                                'prompt' => 'Все регионы',
                            ]);
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="box-footer">
            <button class="btn btn-success">Поиск</button>
            <a href="<?= Url::toRoute(['']); ?>" class="btn btn-default">Сброс</a>
        </div>
    </div>
<?= Html::endForm(); ?>