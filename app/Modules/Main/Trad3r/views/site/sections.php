<?php

use App\App;use App\Models\Service;
use yii\web\View;

/**
 * @var $this View
 * @var Service[] $services
 */

?>

<section class="section section-website-sections bg-accent-gradient__lighten">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="headers-h1 text-center page-title c-accent__darker"><?=$this->title?></h1>

                <?=$this->render('template-parts/service-list.php', ['services' => $services]); ?>

                <?php if(!App::i()->getCurrentUser() || !App::i()->getCurrentUser()->isVip()):?>
                    <div class="modal-content modal-content__components w-100 bg-light mt-100">
                    <div class="modal-header bg-orange-gradient">
                        <p class="headers-h2 w-100 text-center c-light">Что дает премиум-аккаунт?</p>
                    </div>
                    <div class="modal-body w-100 ">
                        <p class="dr-text__normal c-accent__darker text-center">
                            <b>
                                Многие разделы сайта являются платными и доступны только для премиум-аккаунта:
                            </b>
                        </p>
                        <div class="text-center d-flex justify-content-center">
                            <ul class="list-content list-content__initial c-accent__darker mb-0">
                                <li class="list-selection__item">конфигуратор</li>
                                <li class="list-selection__item">что-то еще</li>
                                <li class="list-selection__item">в общем тут</li>
                                <li class="list-selection__item">все позиции списком</li>
                                <li class="list-selection__item">можно перечислить</li>
                            </ul>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="d-flex justify-content-center">
                            <a href="#" class="dr-btn dr-btn__outline dr-btn__big dr-btn__wicon mb-30">
                                <span class="ic-init ic-crown ic-big"></span>
                                <span class="c-orange">Перейти на премиум-аккаунт</span>
                            </a>
                        </div>
                    </div>
                </div>
                <?php endif;?>
            </div>
        </div>
    </div>
</section>