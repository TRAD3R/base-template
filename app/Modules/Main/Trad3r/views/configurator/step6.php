<?php

use App\Html;
use App\Models\Region;

$regions = Region::find()->orderBy(['code' => 'ASC'])->all();
?>

<div class="section section-configurator bg-overlay section-configurator__6 bg-accent-gradient__darken">
    <div class="container">
        <div class="configurator-box">
            <div class="modal-content modal-content__horizontal bg-accent__darker">
                <div class="configurator-box__header text-center">
                    <p class="dr-text__normal c-accent__lighter mb-0">Конфигуратор</p>
                    <p class="dr-text__normal">Шаг 6 из 7</p>
                </div>
                <div class="configurator-box__body">
                    <h2 class="headers-h2 text-center">Выбор региона</h2>
                </div>
                <div class="configurator-box__footer">
                </div>
            </div>
        </div>
        <div class="list-content__wrapper list-content__numeric list-selection list-regions list-selection-js-custom">
            <?=$this->render('region-list',['list'=>$regions])?>
        </div>
        <div class="text-center mt-100">
            <?=Html::a('Дальше', '#', ['id' => 'next','class' => 'dr-btn dr-btn__disabled dr-btn__accent-lightest w-100 max-w-400 mb-100'])?>
        </div>
    </div>
</div>

<script>
    const BTN_LINK = $('#next');
    $('.list-selection__item').on('click', function () {
        BTN_LINK.attr('href', '/configurator/step7/' + $(this).data('id'));
    })
</script>