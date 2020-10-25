<?php

use App\Helpers\Url;
use App\Html;
use App\Models\Region;
use yii\widgets\ActiveForm;

/**
 * @var $model \App\Forms\Admin\LicenseAuthorityForm
 * @var $macroses array
 */
$form = ActiveForm::begin()
?>

<div class="row">
    <div class="col-xs-12 col-md-12">
        <div class="box box-success">
            <div class="box-body">
                <?= Html::errorSummary($model, ['encode' => false]) ?>
                <div class="row">
                    <div class="col-xs-8 col-md-6">
                        <label>Название</label>
                        <?= $form->field($model, 'title')->textInput(['class' => 'form-control'])->label(false); ?>
                    </div>
                    <div class="col-xs-4 col-md-4">
                        <label>Регион</label>
                        <?= Html::activeDropDownList($model, 'region_id', Region::getRegionsList(), [
                            'class' => 'form-control',
                            'data-placeholder' => 'Регион',
                            'multiple'         => false,
                        ]) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-md-12">
                        <label>Описание</label>
                        <?= $form->field($model, 'description')
                            ->textarea(['class' => 'form-control editor', 'id' => 'editor', 'style' => 'height: 100px'])
                            ->label(false); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-md-12">
                        <label>Особенности</label>
                        <?= $form->field($model, 'features')
                            ->textarea(['class' => 'form-control editor', 'id' => 'editor', 'style' => 'height: 100px'])
                            ->label(false); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2 col-xs-12">
                <button class="btn btn-success" id="save-form"><?= $model->isNewRecord ? 'Добавить' : 'Изменить'; ?></button>
            </div>
            <div class="col-sm-2 col-xs-12">
                <a href="<?=Url::toRoute(['list'])?>" class="btn btn-danger">Отменить</a>
            </div>
        </div>
    </div>
<?php ActiveForm::end();?>