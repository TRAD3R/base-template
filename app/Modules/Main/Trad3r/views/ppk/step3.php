<?php

use App\Helpers\Url;
use App\Models\Service;

$ppk = Service::findOne(Service::PPK)
?>

<div class="section section-configurator_ppk bg-overlay bg-accent-gradient__lighten">
    <div class="container">
        <h1 class="headers-h1 c-light text-center mb-50">Программа производственного контроля</h1>
        <div class="configurator-box mb-50">
            <form action="/" class="dr-form modal-content modal-content__horizontal bg-accent__darker">

                <div class="configurator-box__header text-center">
                    <p class="dr-text__normal c-accent__lighter mb-0">Конфигуратор</p>
                    <p class="dr-text__normal">Шаг 3</p>
                </div>
                <div class="configurator-box__body">
                    <div class="modal">
                        <div class="modal-content modal-box_notpadding modal-content__components w-100 max-w-820 bg-light">
                            <div class="modal-header bg-orange-gradient">
                                <p class="headers-h1 w-100 text-center">Программа производственного контроля</p>
                            </div>
                            <div class="modal-body w-100 text-center ">
                                <p class="headers-h2 c-accent__darken">Подготовлен документ ППК</p>
                                <p class="dr-text__normal c-accent__darker mb-0">Стоимость:</p>
                                <p class="headers-h1 c-accent__darker"><?=$ppk->cost?> ₽</p>
                                <div class="d-flex justify-content-center w-100">
                                    <a href="<?=Url::toRoute(['download'])?>"
                                       class="dr-btn dr-btn__orange-gradient dr-btn__big w-100 max-w-400 mb-30"
                                       target="_blank"
                                       id="download"
                                    >
                                        оплатить и скачать
                                    </a>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <img src="/images/_src/payments.png" class="max-w-400 w-100" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="configurator-box__footer">
                </div>
            </form>
        </div>

    </div>
</div>
<?=$this->render('@modals/modal_thanks', ['pretext' => '']);?>
<script>
    $('#download').on('click', function (){
        drModalShow('modal_thanks');
        startTimerSeconds(function (){location.href = '<?=Url::toRoute(['site/section'])?>'});
    })
</script>