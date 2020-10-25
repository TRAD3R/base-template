<?php

use App\Models\Service;


/**
 * @var Service[] $services
 */

?>
<section class="section section-website-sections">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="license-types max-w-1000">
                    <div class="license-type__item">
                        <p class="headers-h1 text-center page-title c-accent__darker">Услуги для оформляющих медлицензию</p>
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="list-panel__item panel panel-column align-items-start panel-wicon panel-wicon__right">
                                    <div class="panel-header c-accent__darker">
                                        <div class="panel-icon__wrapper">
                                            <div class="panel-icon"><span class="ic-file-text"></span></div>
                                        </div>
                                        <p class="headers-h2"><?=$services[Service::LEGAL_ASSISTANCE]->title?></p>
                                    </div>
                                    <div class="panel-body c-accent__darker">
                                        <p class="dr-text__normal">
                                            <?=$services[Service::LEGAL_ASSISTANCE]->description?>
                                        </p>
                                    </div>
                                    <div class="panel-footer d-flex align-items-center justify-content-md-between justify-content-center w-100">
                                        <a href="<?=$services[Service::LEGAL_ASSISTANCE]->url?>" class="dr-btn dr-btn__orange-gradient ">начать</a>
                                        <div class="license-cost d-flex align-items-end flex-column">
                                            <p class="dr-text__small c-accent__darken mb-0"><b>Стоимость услуги</b></p>
                                            <p class="headers-h3 c-accent__darken mb-0"><?=$services[Service::LEGAL_ASSISTANCE]->cost?> ₽</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="list-panel__item panel panel-column align-items-start panel-wicon panel-wicon__right">
                                    <div class="panel-header c-accent__darker">
                                        <div class="panel-icon__wrapper">
                                            <div class="panel-icon"><span class="ic-file-text"></span></div>
                                        </div>
                                        <p class="headers-h2"><?=$services[Service::EXPERTIZE]->title?></p>
                                    </div>
                                    <div class="panel-body c-accent__darker">
                                        <p class="dr-text__normal">
                                            <?=$services[Service::EXPERTIZE]->description?>
                                        </p>
                                    </div>
                                    <div class="panel-footer d-flex align-items-center justify-content-md-between justify-content-center w-100">
                                        <a href="<?=$services[Service::EXPERTIZE]->url?>" class="dr-btn dr-btn__orange-gradient ">начать</a>
                                        <div class="license-cost d-flex align-items-end flex-column">
                                            <p class="dr-text__small c-accent__darken mb-0"><b>Стоимость услуги</b></p>
                                            <p class="headers-h3 c-accent__darken mb-0"><?=$services[Service::EXPERTIZE]->cost?> ₽</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="license-type__item">
                        <p class="headers-h1 text-center page-title c-accent__darker">Подготовка типовых документов</p>
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="list-panel__item panel panel-column align-items-start panel-wicon panel-wicon__right">
                                    <div class="panel-header c-accent__darker">
                                        <div class="panel-icon__wrapper">
                                            <div class="panel-icon"><span class="ic-file-text"></span></div>
                                        </div>
                                        <p class="headers-h2"><?=$services[Service::CONTRACT]->title?></p>
                                    </div>
                                    <div class="panel-body c-accent__darker">
                                        <p class="dr-text__normal">
                                            <?=$services[Service::CONTRACT]->description?>
                                        </p>
                                    </div>
                                    <div class="panel-footer d-flex align-items-center justify-content-md-between justify-content-center w-100">
                                        <a href="<?=$services[Service::CONTRACT]->url?>" class="dr-btn dr-btn__orange-gradient ">начать</a>
                                        <div class="license-cost d-flex align-items-end flex-column">
                                            <p class="dr-text__small c-accent__darken mb-0"><b>Стоимость услуги</b></p>
                                            <p class="headers-h3 c-accent__darken mb-0"><?=$services[Service::CONTRACT]->cost?> ₽</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="list-panel__item panel panel-column align-items-start panel-wicon panel-wicon__right">
                                    <div class="panel-header c-accent__darker">
                                        <div class="panel-icon__wrapper">
                                            <div class="panel-icon"><span class="ic-file-text"></span></div>
                                        </div>
                                        <p class="headers-h2"><?=$services[Service::PPK]->title?></p>
                                    </div>
                                    <div class="panel-body c-accent__darker">
                                        <p class="dr-text__normal">
                                            <?=$services[Service::PPK]->description?>
                                        </p>
                                    </div>
                                    <div class="panel-footer d-flex align-items-center justify-content-md-between justify-content-center w-100">
                                        <a href="<?=$services[Service::PPK]->url?>" class="dr-btn dr-btn__orange-gradient ">начать</a>
                                        <div class="license-cost d-flex align-items-end flex-column">
                                            <p class="dr-text__small c-accent__darken mb-0"><b>Стоимость услуги</b></p>
                                            <p class="headers-h3 c-accent__darken mb-0"><?=$services[Service::PPK]->cost?> ₽</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
