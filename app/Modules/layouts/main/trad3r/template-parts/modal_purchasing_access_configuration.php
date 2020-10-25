<?php

use App\App;use App\Helpers\Url;
use App\Models\Service;

$service = Service::findOne(Service::CONFIGURATOR)
?>
<div class="dr-modal dr-modal-sm-bigger dr-modal__default" id="modal_purchasing_access_configuration">

    <div class="dr-modal-wrapper">
        <div class="dr-modal__content">
            <div class="dr-modal__header bg-orange c-light">
                <p class="headers-h2">Приобретение услуги
                    «Конфигуратор медлицензии»</p>
                <button class="dr-modal__close d-none">
                    <svg width="25" height="25" viewBox="0 0 25 25" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18.011 6.42627L6.01099 18.4263" stroke="inherit" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M6.01099 6.42627L18.011 18.4263" stroke="inherit" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </button>
            </div>
            <div class="dr-modal__body">
                <p class="dr-text__normal c-accent__darker-t3 mb-0">
                    Оплачивая конфигуратор оформления (или переформления) медицинской лицензии,
                    вы дополнительно получаете (или продлеваете) на 30 дней премиум-аккаунт,
                    который открывает доступ к полной информации в разделе «Лицензионное дело».
                </p>
                <div class="license-cost d-flex align-items-center flex-column mt-20 mb-20">
                    <p class="dr-text__small c-accent__darken mb-0"><b>Стоимость услуги</b></p>
                    <p class="headers-h3 c-accent__darken mb-0"><?=$service->cost?> ₽</p>
                </div>
                <div class="w-100 d-flex flex-column justify-content-center text-center">
                    <a href="<?=Url::toRoute(['site/license-procedure'])?>" class="dr-btn dr-btn__outline dr-btn__accent c-accent max-w-350 w-100">
                        перейти в раздел «порядок оформления лицензии»
                    </a>
                    <a href="<?=Url::toRoute(['account/payment'])?>" class="dr-btn dr-btn__outline max-w-350 w-100 c-orange">
                        оплатить единоразовый доступ к конфигуратору
                    </a>
                </div>
                <?php if (!App::i()->getCurrentUser()):?>
                    <p class="dr-text__small c-accent__darker-t3 text-center mt-10">Услуга доступна только для авторизованных пользователей. Пожалуйста, <a
                                href="<?=Url::toRoute(['auth/login'])?>" class="c-orange">войдите</a> под своей учетной записью или <a
                                href="<?=Url::toRoute(['auth/registration'])?>" class="c-orange">зарегистрируйтесь</a>.
                    </p>
                <?php endif;?>
            </div>
        </div>
    </div>
    <div class="dr-modal__overlay"></div>

</div>
