<?php

use App\App;
use App\Helpers\Url;
/**
 * @var $this \yii\web\View
 */

$proClass = (App::i()->getCurrentUser() && App::i()->getCurrentUser()->isVip()) ? 'data-user_status_pro' : 'data-user_status_base';
?>
<header class="header header-cabinet">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <nav class="dr-navbar  navbar navbar-expand-sm d-flex align-items-center justify-content-between w-100">
                    <!-- Brand/logo -->
                    <a class="navbar-brand d-flex align-items-center c-light" href="/">
                        <img src="/images/_src/logo.png"
                             alt="super license"
                             title="super license"
                             class="img-responsive">
                        <span class="dr-text__logo">Супермаркет <br> медлицензий</span>
                    </a>

                    <p class="header-title-page dr-text__normal fw-bold d-none d-md-flex">Личный кабинет</p>

                    <div class="d-flex justify-content-center align-items-center">
                        <a href="<?=Url::toRoute('account/orders')?>" class="data-user data-user_status_base <?=$proClass?>">
                            <span class="icon"><span class="ic-user ic-white"></span></span>
                            <span class="data-user__status bage">
                                <?=(App::i()->getCurrentUser()->isVip())?'Pro':'Base'?>
                            </span>
                            <span class="data-user__title dr-text__small c-light">
                                <b><?=App::i()->getCurrentUser()->getShortname()?></b>
                            </span>
                        </a>
                        <a href="<?=Url::toRoute('auth/logout')?>" class="dr-text__normal fw-bold ml-20 c-light d-none d-md-flex">Выйти</a>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>