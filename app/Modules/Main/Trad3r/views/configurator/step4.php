<?php

use App\Models\Configuration;

/**
 * @var $this \yii\web\View
 * @var $unavailableIP bool
 */

$this->title = 'Организационно-правовая форма';
$types = Configuration::getOwnerType();
if($unavailableIP) {
    unset($types[Configuration::PERSONAL_SELF]);
}
?>

<div class="section section-configurator bg-overlay section-configurator__4 bg-accent-gradient__darken">
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-6 col-lg-6 configurator-box__wrapper">
                <div class="configurator-box">
                    <div class="modal-content bg-accent__darker">
                        <div class="configurator-box__header text-center">
                            <p class="dr-text__normal c-accent__lighter mb-0">Конфигуратор</p>
                            <p class="dr-text__normal">Шаг 4 из 7</p>
                        </div>
                        <div class="configurator-box__body">
                            <h2 class="headers-h2 text-center">Организационно-правовая форма</h2>
                        </div>
                        <div class="configurator-box__footer">
                            <p class="dr-text__small">Доступные организационно-правовые формы</p>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-12 col-sm-12 col-md-6 col-lg-5 offset-lg-1">
                <div class="configurator-btns__wrapper">
                    <div class="configurator-btns">
                        <?=$this->render('button-list', ['list'=>$types, 'url'=>'configurator/step5'])?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>