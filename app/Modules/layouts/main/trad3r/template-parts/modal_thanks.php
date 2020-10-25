<?php

use App\Helpers\Url;

/**
 * @var string $pretext
 */
$pretext = $pretext ?? '';
?>
<div class="dr-modal dr-modal-sm-bigger dr-modal__default" id="modal_thanks">

    <div class="dr-modal-wrapper">
        <div class="dr-modal__content">
            <div class="dr-modal__header bg-orange c-light">
                <p class="headers-h2">Благодарим Вас, что воспользовались нашим сервисом</p>
                <button class="dr-modal__close d-none">
                    <svg width="25" height="25" viewBox="0 0 25 25" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18.011 6.42627L6.01099 18.4263" stroke="inherit" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M6.01099 6.42627L18.011 18.4263" stroke="inherit" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </button>
            </div>
            <div class="dr-modal__body">
                <p class="dr-text__normal c-accent__darker text-center">
                    <b><?=$pretext?></b>
                </p>
                <p class="dr-text__normal c-accent__darker text-center">
                    <b>Переход на страницу «Разделы сайта» произойдет через</b>
                </p>
                <p class="headers-h2 text-center c-accent">
                    <span class="timer-seconds"></span> секунд
                </p>
            </div>
            <div class="dr-modal__footer">
                <div class="d-flex w-100 align-items-center justify-content-center dr-btn-group flex-wrap ">
                    <a href="<?=Url::toRoute(['site/section'])?>"
                            class="timer-end-btn dr-btn dr-btn__outline c-orange">Перейти</a>
                </div>
            </div>
        </div>
        <div class="dr-modal__overlay"></div>
    </div>

</div>
