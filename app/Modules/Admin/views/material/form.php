<?php

use App\Helpers\Url;
use App\Html;
use App\Params;
use yii\widgets\ActiveForm;

/**
 * @var \yii\web\View $this
 * @var \App\Forms\Admin\MaterialForm $model
 */

$this->title = 'Материал';

?>

<div class="row">
    <?php $form = ActiveForm::begin()?>
    <div class="col-xs-12 col-md-12">
        <div class="box box-success">
            <div class="box-body">
                <?= Html::errorSummary($model, ['encode' => false]) ?>
                <div class="row">
                    <div class="col-xs-8 col-md-6">
                        <h3><?= $this->title ?></h3>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-6 col-md-4">
                        <?= $form->field($model, 'title')->textInput(['class' => 'form-control', 'id' => 'title']); ?>
                    </div>
                    <div class="col-xs-6 col-md-3">
                        <?= $form->field($model, 'url')->textInput(['class' => 'form-control', 'id' => 'url']); ?>
                    </div>
                    <div class="col-xs-6 col-md-3">
                        <?= $form->field($model, 'tags')->textInput(['class' => 'form-control', 'id' => 'url', 'placeholder' => 'Введите теги через запятую']); ?>
                    </div>
                    <div class="col-xs-6 col-md-1">
                        <?=Html::activeLabel($model, 'isPaid')?>
                        <?=Html::boolDropDownList(Html::getInputName($model, 'isPaid'), $model->isPaid, ['class' => 'form-control'])?>
                    </div>
                    <div class="col-xs-6 col-md-1">
                        <?=Html::activeLabel($model, 'isPublished')?>
                        <?=Html::boolDropDownList(Html::getInputName($model, 'isPublished'), $model->isPublished, ['class' => 'form-control'])?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-md-12">
                        <?= $form->field($model, 'description')->textarea(['class' => 'form-control ck-editor', 'style' => 'height: 100px', 'id' => 'description']); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2 col-xs-12">
                <?=Html::submitButton('Сохранить', ['class' => 'btn btn-success'])?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end();?>
</div>
<script>
    // ClassicEditor
    //     .create( document.querySelector('#description') )
    //     .catch( error => {
    //         console.error( error );
    //     } );
    CKEDITOR.replace('description');
    const TITLE = $('#title');
    const URL = $('#url');
    $('body').on('blur', '#title', function (){
        if(URL.val().length > 0) {
            return;
        }

        let title = TITLE.val();
        $.ajax({
            url: '<?=Url::toRoute(['create-alias'])?>',
            method: 'POST',
            data: {
                '<?=Params::TITLE?>': title
            }
        }).done(res => {
            if(res.status == '<?=Params::STATUS_OK?>') {
                URL.val(res.alias);
            }
        });
    })
</script>