<?php

use App\App;use App\Helpers\Url;

/**
 * @var string $id
 * @var string $title
 * @var string $url
 */

$user = App::i()->getCurrentUser();
?>
<div class="dr-modal dr-modal-sm-bigger dr-modal__default" id="<?=$id?>">

    <div class="dr-modal-wrapper">
        <div class="dr-modal__content">
            <div class="dr-modal__header bg-orange c-light">
                <p class="headers-h2">Подтверждение выбора услуги
                    «<?=$title?>»</p>
                <button class="dr-modal__close d-none">
                    <svg width="25" height="25" viewBox="0 0 25 25" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18.011 6.42627L6.01099 18.4263" stroke="inherit" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M6.01099 6.42627L18.011 18.4263" stroke="inherit" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </button>
            </div>
            <div class="dr-modal__body">
                <p class="dr-text__normal c-accent__darker-t3 mb-0">
                    Уважаемый(ая), <?=sprintf('%s %s', $user->firstname, $user->secondname)?>!<br>
                    Уведомляем Вас, что данный сервис предоставляется на условиях разового доступа.
                    Т.е. повторное прохождение оплачивается отдельно. Перед прохождением Конфигуратора
                    Вам необходимо ознакомиться с разделом «Порядок оформления медицинской лицензии».
                </p>
                <div class="w-100 d-flex flex-column justify-content-center text-center">
                    <a href="<?=Url::toRoute(['site/license-procedure'])?>" class="dr-btn dr-btn__outline dr-btn__accent c-accent max-w-300 w-100">
                        изучить порядок оформления медицинской лицензии
                    </a>
                    <a href="<?=Url::toRoute([$url])?>" class="dr-btn dr-btn__outline max-w-300 w-100 c-orange <?=(!$user->is_accept?"dr-btn__disabled":"")?>">
                        начать прохождение конфигуратора
                    </a>
                </div>
                <p class="dr-text__small c-accent__darker-t3 text-center mt-10">
                    После прохождения конфигуратора Вы сможете скачать сформированный файл сразу, а так же и позже в течение 30 дней
                    после покупки услуги в разделе «Личный кабинет».
                </p>
            </div>
        </div>
    </div>
    <div class="dr-modal__overlay"></div>

</div>
