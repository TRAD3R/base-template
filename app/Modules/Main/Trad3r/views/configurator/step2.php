<?php

use App\Models\Configuration;

/**
 * @var $this \yii\web\View
 * @var $hasEducation bool
 */
$types = Configuration::getPersonal();

if(!$hasEducation) {
    unset($types[Configuration::PERSONAL_SELF]);
}
?>

<div class="section section-configurator section-configurator__2 bg-overlay bg-accent-gradient__darken">
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-6 col-lg-6 configurator-box__wrapper">
                <div class="configurator-box">
                    <div class="modal-content bg-accent__darker">
                        <div class="configurator-box__header text-center">
                            <p class="dr-text__normal c-accent__lighter mb-0">Конфигуратор</p>
                            <p class="dr-text__normal">Шаг 2 из 7</p>
                        </div>
                        <div class="configurator-box__body">
                            <h2 class="headers-h2 text-center">Выберите схему работы</h2>
                        </div>
                        <div class="configurator-box__footer">
                            <p class="dr-text__small">Для получения медицинской лицензии необходимо иметь диплом о среднем медицинской образовании и сертификат специалиста. Кроме этого вы должны проработать по специальности не менее 3 лет, о чем у вас должна быть запись в трудовой книжке. Если у вас нет стажа или сертификата, то вы не сможете получить лицензию на ИП, и вам придется открывать ООО и нанимать специалистов.</p>
                        </div>
                    </div>
                </div>
                <p class="dr-text__small mt-20">
                    <b class="c-light">
                        <span class="c-orange">Важно!</span> Делайте каждый шаг в конфигураторе осознанно, строго следуя нашим инструкциям. После подтверждения выбора шага, вы будете переходить к следующему. Изменить данные в пройденном шаге будет невозможно.
                    </b>
                </p>
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-lg-5 offset-lg-1">
                <div class="configurator-btns__wrapper">
                    <div class="configurator-btns mb-50">
                        <?=$this->render('button-list',['list'=>$types, 'url'=>'configurator/speciality'])?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>