<?php

use App\Helpers\Url;

/**
 * @var $la \App\Models\LicensingAuthority
 */
?>
<div class="section section-configurator section-configurator__7 bg-overlay bg-accent-gradient__darken">
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-6 col-lg-6 configurator-box__wrapper">
                <div class="configurator-box">
                    <div class="modal-content bg-accent__darker">
                        <div class="configurator-box__header text-center">
                            <p class="dr-text__normal c-accent__lighter mb-0">Конфигуратор</p>
                            <p class="dr-text__normal">Шаг 7 из 7</p>
                        </div>
                        <div class="configurator-box__body">
                            <h2 class="headers-h2 text-center">Лицензирующий орган</h2>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-12 col-sm-12 col-md-6 col-lg-5 offset-lg-1">
                <div class="configurator-btns__wrapper">
                    <div class="configurator-btns">
                        <p class="dr-text__normal">
                            После того, как вы подготовите свое лицензионное дело, вам необходимо будет обратиться в свой
                            территориальный лицензирующий орган для подачи заявления о предоставлении лицензии на осуществление
                            медицинской или фармацевтической деятельности. В некоторых субъектах РФ прием документов осуществляется
                            дистанционно, через портал Госуслуги, либо путем обращения в Многофункциональные центры (МФЦ).
                            Адрес своего лицензирующего орган вы найдете в одном из файлов подборки, которую вы получите на следующем шаге.
                        </p>
                        <a href="<?=Url::toRoute('configurator/summary')?>" class="dr-btn dr-btn__accent-lightest mb-30">Дальше</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>