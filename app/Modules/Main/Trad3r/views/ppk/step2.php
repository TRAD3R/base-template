<?php

use App\Forms\Main\Ppk\PpkForm;
use App\Html;
use yii\widgets\ActiveForm;

/**
 * @var $view string
 * @var $model PpkForm
 */


$this->title = 'Шаг2';
?>

<div class="section section-configurator_ppk bg-overlay">
    <div class="container">
        <h1 class="headers-h1 c-light text-center mb-50">Программа производственного контроля</h1>
        <div class="configurator-box mb-50">
            <?php
                $form = ActiveForm::begin([
                    'options'                => [
                        'class' => 'dr-form modal-content modal-content__horizontal bg-accent__darker'
                    ],
                    'fieldConfig' => [
                        'template' => '{label}{input}{error}',
                        'errorOptions' => [
                            'class' => 'form-group__message error'
                        ]
                    ],
                ]);
            ?>
                <div class="configurator-box__header text-center">
                    <p class="dr-text__normal c-accent__lighter mb-0">Конфигуратор</p>
                    <p class="dr-text__normal"><?=$this->title?></p>
                </div>
                <div class="configurator-box__body">
                    <h2 class="headers-h2 text-center">Заполните необходимые графы документа</h2>
                    <?=$this->render('forms/' . $view, ['form' => $form, 'model' => $model]);?>
                </div>
                <div class="configurator-box__footer">
                    <div class="w-100 d-flex justify-content-center text-center mt-60 mb-50">
                        <?=Html::submitButton('Отправить', ['class' => 'dr-btn dr-btn__orange-gradient max-w-300 w-100'])?>
                    </div>
                </div>
            <?php ActiveForm::end();?>
        </div>
    </div>
</div>

<script>
    document.querySelector('#main').classList.add('bg-accent-gradient__lighten');

    $('form').on('submit', function (){
        let managers = [];
        $(this).find('input[name="manager"]').each(function (){
            if($(this).val()) {
                managers.push($(this).val());
            }
        });

        $(this).find('#managers').val(managers.join(';'));
        return true;
    })
</script>
