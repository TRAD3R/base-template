<?php

use App\Models\Configuration;

$specialities = Configuration::getEducationTitle();
?>

<div class="section section-configurator section-configurator__1 bg-overlay bg-accent-gradient__darken">
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-6 col-lg-6 configurator-box__wrapper">
                <div class="configurator-box">
                    <div class="modal-content bg-accent__darker">
                        <div class="configurator-box__header text-center">
                            <p class="dr-text__normal c-accent__lighter mb-0">Конфигуратор</p>
                            <p class="dr-text__normal">Шаг 1 из 7</p>
                        </div>
                        <div class="configurator-box__body">
                            <h2 class="headers-h2 text-center">Выберите ваше образование</h2>
                        </div>
                        <div class="configurator-box__footer">
                            <p class="dr-text__small">Если вы имеете и среднее, и высшее медицинское образование, то
                                выбирайте пункт Высшее медицинское образование. Далее вам будет предложено выбирать
                                специальности, как после высшего, так и после среднего образования.</p>
                        </div>
                    </div>
                </div>
                <p class="dr-text__small mt-20">
                    <b class="c-light">
                        <span class="c-orange">Важно!</span> Делайте каждый шаг в конфигураторе осознанно, строго следуя
                        нашим инструкциям. После подтверждения выбора шага, вы будете переходить к следующему. Изменить
                        данные в пройденном шаге будет невозможно.
                    </b>
                </p>
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-lg-5 offset-lg-1">
                <div class="configurator-btns__wrapper">
                    <div class="configurator-btns mb-50">
                        <?= $this->render('button-list', ['list' => $specialities, 'url' => 'configurator/staff']) ?>
                    </div>
                    <div class="configurator-img">
                        <img src="/images/_src/frame-10.svg" alt="">
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
