<?php

use App\Forms\Admin\SectionForm;
use App\Helpers\Url;
use App\Html;
use yii\widgets\ActiveForm;

/**
 * @var $model SectionForm
 */
$form = ActiveForm::begin() ?>

<div class="row">
    <div class="col-xs-12 col-md-12">
        <div class="box box-success">
            <div class="box-body">
                <?= Html::errorSummary($model, ['encode' => false]) ?>
                <div class="row">
                    <div class="col-xs-4 col-md-4">
                        <label>Название</label>
                        <?=$form->field($model, 'title')->textInput(['class' => 'form-control'])->label(false); ?>
                    </div>
                    <div class="col-xs-6 col-md-6">
                        <label>Иконка</label>
                        <?=$form->field($model, 'icon')->textInput(['class' => 'form-control'])->label(false); ?>
                    </div>

                </div>
                <div class="row">
                    <div class="col-xs-4 col-md-4">
                        <label>URL записи</label>
                        <?=$form->field($model, 'url')->textInput(['class' => 'form-control'])->label(false); ?>
                    </div>
                    <div class="col-xs-4 col-md-4">
                        <label>Доступно</label>
                        <?=$form->field($model, 'isPaid')->dropDownList(['Про', 'Бесплатно'], ['class' => 'form-control'])->label(false); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-4 col-md-4">
                        <label>Содержание</label>
                        <?=$form->field($model, 'description')->textArea(['class' => 'form-control'])->label(false); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-2 col-xs-12">
        <button class="btn btn-success" id="save-form">
            <?= $model->isNewRecord ? 'Добавить' : 'Изменить'; ?>
        </button>
    </div>
    <div class="col-sm-2 col-xs-12">
                <a href="<?=Url::toRoute(['section/index'])?>" class="btn btn-danger">Отменить</a>
    </div>
</div>
<?php ActiveForm::end(); ?>