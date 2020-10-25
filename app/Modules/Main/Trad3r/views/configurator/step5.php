<?php

use App\Helpers\Url;

?>
<div class="section section-configurator bg-overlay section-configurator__5 bg-accent-gradient__darken">
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-6 col-lg-6 configurator-box__wrapper">
                <div class="configurator-box">
                    <div class="modal-content bg-accent__darker">
                        <div class="configurator-box__header text-center">
                            <p class="dr-text__normal c-accent__lighter mb-0">Конфигуратор</p>
                            <p class="dr-text__normal">Шаг 5 из 7</p>
                        </div>
                        <div class="configurator-box__body">
                            <h2 class="headers-h2 text-center">Требования к помещениям и оборудованию</h2>
                        </div>
                        <div class="configurator-box__footer">
                            <p class="dr-text__small">Вам будет предоставлена подробная информация по выполнению требований к помещениям и оборудованию</p>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-12 col-sm-12 col-md-6 col-lg-5 offset-lg-1">
                <div class="configurator-btns__wrapper">
                    <div class="configurator-btns">
                        <p class="dr-text__normal"><b>Требования к помещениям</b></p>
                        <p class="dr-text__normal">
                            Для того, чтобы получить лицензию даже на один вид, необходимо подбирать помещение с минимальным набором комнат: вестибюльная группа, комната персонала, туалет, кабинет врача, комната отходов класса В и Г, кладовая для хранения уборочного инвентаря.
                            <br><br> Помещения должны иметь высоту потолков 2,6 метров. Стены в медицинских кабинетах должны быть гладкие для выполнения влажной уборки и дезинфекции. В кабинетах должны быть раковины с подводом горячей и холодной воды. Вокруг раковин необходимо выложить плитку (высота 1,2 м от пола и ширина по 20 см с двух сторон).
                            <br><br> Потолки должны быть гладкие, светильники закрытого типа. Во всех медицинских кабинетах должно быть предусмотрено естественное освещение. В кабинетах допускается естественная вентиляция. В комнате отходов В и Г необходимо предусмотреть принудительную вентиляцию.</p>
                        <a href="<?=Url::toRoute(['configurator/region'])?>" class="dr-btn dr-btn__accent-lightest mb-30">Дальше</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>