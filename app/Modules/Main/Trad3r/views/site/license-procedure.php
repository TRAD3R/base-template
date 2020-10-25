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
                            <?php if(!$isAccept):?>
                                <h2 class="headers-h2 c-accent__darken mt-60">Готовы двигаться дальше?</h2>
                                <h3 class="headers-h3 c-accent__darken">Поставьте галочку и вперед!</h3>
                                <label class="checkbox checkbox-default c-accent__darken">
                                    <input type="checkbox" id="configurator-accept" >
                                    <span class="checkbox-inner">
                                    <span class="checkbox-box">
                                        <svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M2 10.5L8.5 17.5L18.5 2.5" stroke="#E1FEFF" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </span>
                                    <span class="checkbox-text dr-text__normal fw-bold">Я, <?=sprintf('%s %s', $user->firstname, $user->secondname)?>,
                                            с правилами оформления медлицензии ознакомлен и готов к прохождению Конфигуратора.</span>
                                    </span>
                                </label>
                            <?php endif;?>
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
                                   class="dr-btn dr-btn__orange-gradient <?=(!$isAccept?"disabled":"")?>"
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
                                   class="dr-btn dr-btn__orange-gradient <?=(!$isAccept?"disabled":"")?>"
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
<?php endif;?>

<script>
    $('#configurator-accept').on('click', function (){
        $.ajax("<?=Url::toRoute('accept-rules')?>")
        .done((res)=>{
            if(res.status) {
                $('.dr-btn').removeClass('disabled')
            }
        })
    })
</script>
