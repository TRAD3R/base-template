<?php

use App\Forms\Admin\OccupationForm;
use App\Helpers\Url;
use App\Html;
use App\Models\Occupation;
use yii\widgets\ActiveForm;

/**
 * @var $model OccupationForm
 * @var $macroses array
 */
$form = ActiveForm::begin();
$marcosKeys = array_keys($macroses);
$marcosDescr = array_values($macroses);
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
                        <label>Родитель</label>
                        <?= Html::activeDropDownList($model, 'parent_id', Occupation::getParentTitle(), [
                                'class' => 'form-control',
                            'data-placeholder' => 'Роды деятельности',
                            'multiple'         => false,
                        ]) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <table class="table table-bordered hover table-dark">
                            <thead>
                            <tr>
                                <th scope="col">Макрос</th>
                                <th scope="col">Описание</th>
                                <th scope="col">Макрос</th>
                                <th scope="col">Описание</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php for($i = 0; $i < count($macroses);):?>
                                <tr>
                                    <th scope="row" class="btn-copy" data-copy="<?=$marcosKeys[$i]?>"><?=$marcosKeys[$i]?></th>
                                    <td><?=$marcosDescr[$i++]?></td>
                                    <th scope="row" class="btn-copy" data-copy="<?=$marcosKeys[$i]?>"><?=$marcosKeys[$i]?></th>
                                    <td><?=$marcosDescr[$i++]?></td>
                                </tr>
                            <?php endfor;?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-md-12">
                        <label>Шаблон документа</label>
                        <?= $form->field($model, 'template')->textarea(['class' => 'form-control', 'style' => 'height: 400px'])->label(false); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2 col-xs-12">
                <button class="btn btn-success" id="save-form"><?= $model->isNewRecord ? 'Добавить' : 'Изменить'; ?></button>
            </div>
            <div class="col-sm-2 col-xs-12">
                <a href="<?=Url::toRoute(['occupation-list'])?>" class="btn btn-danger">Отменить</a>
            </div>
        </div>
    </div>
<?php ActiveForm::end();?>