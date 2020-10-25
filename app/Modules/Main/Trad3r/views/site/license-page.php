<?php use App\App;
use App\Helpers\Url;
use App\Models\Service;

/**
 * @var \yii\web\View $this
 * @var \App\Models\Page $page
 */

$user = App::i()->getCurrentUser();
$isVip = $user && $user->isVip();
$isAccept = $user && $user->is_accept;
$configurator = Service::findOne(Service::CONFIGURATOR);
$reRegistration = Service::findOne(Service::REREGISTRATION);

$configuratorModalId = 'modal_configuration_accept_first';
$reconfiguratorModalId = 'modal_configuration_accept_reorganization';
?>
<section class="section section-license-work bg-accent__super-lightest pb-90">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="headers-h1 text-center page-title c-accent__darken"><?=$this->title?></h1>
                <div class="max-w-820">
                    <div class="customizer-content">
                        <?=$page->content_1?>
                    </div>

                    <!-- блок, который будет скрыт, если пользователь зарегистрирован -->
                    <?php if(!$isVip):?>
                        <div class="block-not-registered" style="display: block">
                            <div class="d-flex justify-content-center w-100 mt-80 mb-80">
                                <a href="<?=Url::toRoute(['account/payment'])?>" class="dr-btn dr-btn__orange-gradient max-w-600">получить доступ к полному документу приобрести премиум-аккаунт</a>
                            </div>
                            <p class="headers-h3 c-accent__darker mb-30">Премиум-аккаунт дает возможность пройти один раз конфигуратор документов для получения или продления медицинской лицензии</p>
                            <p class="dr-text__normal c-accent__darker">В течение 30 дней после приобретения «Премиум-аккаунта» вы можете возвращаться к документу «<?=$this->title?>» для получения информации по лицензированию.</p>
                        </div>
                    <?php else:?>
                        <div class="customizer-content">
                            <?=$page->content_2?>
                        </div>
                    <?php endif;?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php if($isVip):?>
    <section class="section section-license-work bg-accent-gradient bg-overlay pt-100">
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-6 col-md-6">
                <div class="customizer-content bg-overlay">
                    <?=$page->content_3?>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-5 offset-md-1">
                <div class="">
                    <div class="list-panel__item panel panel-column align-items-start panel-wicon panel-wicon__right">
                        <div class="panel-header c-accent__darker">
                            <div class="panel-icon__wrapper">
                                <div class="panel-icon"><span class="ic-file-text"></span></div>
                            </div>
                            <p class="dr-text__small c-accent__darker mb-0"><b>конфигуратор 1</b></p>
                            <p class="headers-h2">Первая лицензия</p>
                        </div>
                        <div class="panel-body c-accent__darker">
                            <p class="dr-text__normal">
                                Это конфигуратор, который будет пошагово двигать вас к своей лицензии.
                            </p>
                        </div>
                        <div class="panel-footer d-flex align-items-center justify-content-between w-100">
                            <a href="<?=Url::toRoute(['configurator/step1'])?>"
                               class="dr-btn dr-btn__orange-gradient"
                                <?=(!$isAccept?"data-modal='{$configuratorModalId}'":"")?>
                            >
                                начать
                            </a>
                            <div class="license-cost d-flex align-items-end flex-column">
                                <p class="dr-text__small c-accent__darken mb-0"><b>Стоимость услуги</b></p>
                                <p class="headers-h3 c-accent__darken mb-0"><?=$configurator->cost?> ₽</p>
                            </div>
                        </div>
                    </div>
                    <div class="list-panel__item panel panel-column align-items-start panel-wicon panel-wicon__right">
                        <div class="panel-header c-accent__darker">
                            <div class="panel-icon__wrapper">
                                <div class="panel-icon"><span class="ic-file-text"></span></div>
                            </div>
                            <p class="dr-text__small c-accent__darker mb-0"><b>конфигуратор 2</b></p>
                            <p class="headers-h2">Переоформление действующих лицензий</p>
                        </div>
                        <div class="panel-body c-accent__darker">
                            <p class="dr-text__normal">
                                У вас изменился адрес или нужно добавить новые виды деятельности
                            </p>
                        </div>
                        <div class="panel-footer d-flex align-items-center justify-content-between w-100">
                            <a href="<?=Url::toRoute(['configurator/cause'])?>"
                               class="dr-btn dr-btn__orange-gradient"
                               <?=(!$isAccept?"data-modal='{$reconfiguratorModalId}'":"")?>
                            >Начать
                            </a>
                            <div class="license-cost d-flex align-items-end flex-column">
                                <p class="dr-text__small c-accent__darken mb-0"><b>Стоимость услуги</b></p>
                                <p class="headers-h3 c-accent__darken mb-0"><?=$reRegistration->cost?> ₽</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
    <?php
    echo $this->render('@layouts/main/trad3r/template-parts/modal_configuration_accept', [
        'id' => $configuratorModalId,
        'title' => 'Конфигуратор оформления медлицензии',
        'url'   => 'configurator/step1'
    ]);

    echo $this->render('@layouts/main/trad3r/template-parts/modal_configuration_accept', [
        'id' => $reconfiguratorModalId,
        'title' => 'Конфигуратор переоформления медлицензии',
        'url'   => 'configurator/cause'
    ]);
    ?>
<?php endif;?>
