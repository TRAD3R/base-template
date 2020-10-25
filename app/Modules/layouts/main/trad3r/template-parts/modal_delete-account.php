<?php

use App\Helpers\Url;

?>
<div class="dr-modal dr-modal-sm-bigger dr-modal__default" id="modal_delete-account">

    <div class="dr-modal-wrapper">
        <div class="dr-modal__content">
            <div class="dr-modal__header bg-orange c-light">
                <p class="headers-h2">Удаление аккаунта</p>
                <button class="dr-modal__close d-none">
                    <svg width="25" height="25" viewBox="0 0 25 25" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18.011 6.42627L6.01099 18.4263" stroke="inherit" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M6.01099 6.42627L18.011 18.4263" stroke="inherit" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </button>
            </div>
            <div class="dr-modal__body">
                <p class="dr-text__normal c-accent__darker">
                    <b>Вы действительно хотите удалить свой аккаунт? Восстановление будет невозможно!</b>
                </p>
            </div>
            <div class="dr-modal__footer">
                <div class="d-flex w-100 align-items-center justify-content-center dr-btn-group flex-wrap ">
                    <button type="button" id="btn_deleteAccount" data-modal="modal_delete-account_confirm" class="dr-btn dr-btn__outline c-orange" onclick="startTimerSeconds()">удалить</button>
                    <button type="button"
                            class="modal-cancel dr-btn dr-btn__outline c-orange">отмена</button>
                </div>
            </div>
        </div>
        <div class="dr-modal__overlay"></div>
    </div>

</div>

<script>
    const TIMER_COUNT = 10;
    let TIMER = null;
    function startTimerSeconds() {
        var index = TIMER_COUNT;
        TIMER = setInterval(function () {
            if (index > 0) {
                $('.timer-seconds').html(index--);
                return;
            }
            location.href = '<?=Url::toRoute(["account/delete"])?>';
        }, 1000);
    }
</script>