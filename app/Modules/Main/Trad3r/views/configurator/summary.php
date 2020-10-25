<?php
use App\Helpers\Url;use App\Html;

/**
 * @var $this \yii\web\View
 * @var $url string
 * @var $title string
 * @var $la \App\Models\LicensingAuthority
 */

?>

<div class="section section-configurator section-configurator__end bg-accent-gradient__darken">
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 configurator-box__wrapper">
                <div class="configurator-box max-w-820 mb-50">
                    <div class="modal-content bg-accent__darker">
                        <div class="configurator-box__header text-center">
                            <p class="dr-text__normal c-accent__lighter mb-0">Конфигуратор</p>
                            <p class="headers-h2">Готово</p>
                        </div>
                        <div class="configurator-box__body">
                            <p class="dr-text__small">
                                <b class="c-light">Все готово, чтобы действовать со знанием дела! Успехов в развитии вашего бизнеса!</b>
                                <br>
                                <br>
                                <span class="c-orange__lighten">Пожалуйста, <?=Html::a('оставьте отзыв', ['review/add'])?> в разделе нашего сайта. Напишите как помогли наши инструкции или с какими трудностями вы столкнулись в процессе. </span>
                                <br>
                                <br>
                                <span class="c-orange__lighten">Мы гарантируем актуальность информации на данный момент и обязуемся в течение 30 дней предоставить вам обновленные данные в случае их изменения.</span>
                            </p>
                            <h2 class="headers-h3 text-center c-accent__lightest">Системой сформирован <br> zip-архив документов, включая исчерпывающую инструкцию по получению медицинской лицензии самостоятельно</h2>
                            <?php if(!empty($url)):?>
                                <div class="text-center">
                                    <a href="<?=$url?>" id="download" class="dr-btn dr-btn__big dr-btn__orange-gradient w-100 max-w-250" download="<?=$title?>">Скачать</a>
                                </div>
                            <?php endif;?>
                        </div>
                        <div class="configurator-box__footer">
                            <p class="dr-text__normal c-accent__lightest text-center">
                                Вы можете скачать файлы в <a href="<?=Url::toRoute('account/orders')?>" class="dr-text__underline">личном кабинете</a> в течении месяца
                            </p>
                            <br><br>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    $("#download").on('click', function (){
        setTimeout(function (){
            location.href = '<?=Url::toRoute(["account/orders"], true)?>';
        }, 2000)

    })
</script>