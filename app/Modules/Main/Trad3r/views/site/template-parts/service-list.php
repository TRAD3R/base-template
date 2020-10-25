<?php

use App\App;
use App\Helpers\Url;
use App\Models\Service;
use yii\web\View;
/**
 * @var $this View
 * @var $services \App\Models\Service[]
 */

?>
<div class="service-list">
    <?php foreach($services as $service) : ?>
        <div class="service-item_wrapper">
            <div class="service-item panel panel-column panel-wicon panel-wicon__left">
                <div class="panel-icon__wrapper">
                    <div class="panel-icon"><span class="<?=$service->icon; ?>"></span></div>
                </div>
                <div class="service-item__content">
                    <div class="headers-h2 c-accent text-center service-item__title"><?=$service->title; ?></div>
                    <div class="service-item__show_active">
                        <p class="dr-text__normal service-item__descr_full">
                            <?=$service->description; ?>
                        </p>
                        <div class="d-flex w-100 text-center justify-content-center">
                            <?php
                                $url = $service->url;
                                if(in_array($service->id, [Service::CONFIGURATOR, Service::REREGISTRATION])) {
                                    $url = App::i()->getCurrentUser() && App::i()->getCurrentUser()->canFillConfigurator() ? $service->url : 'site/license-page';
                                }
                            ?>
                            <a href="<?=Url::toRoute([$url]); ?>" class="service-item_btn_cta dr-btn dr-btn__outline c-orange max-w-250">
                                <span class="headers-h3">Перейти</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="service-item__toggle text-center">
                    <a href="#" class="dr-btn dr-btn-h40 dr-btn__orange-gradient">Развернуть</a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
