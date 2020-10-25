<?php
/**
 * @var $this \yii\web\View
 */

use App\App;
use App\Helpers\Url;

$proClass = (App::i()->getCurrentUser() && App::i()->getCurrentUser()->isVip()) ? 'data-user_status_pro' : 'data-user_status_base';
?>

<header class="header bg-accent">
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

                    <?php echo $this->render('template-parts/navbar-menu'); ?>

                    <div class="mobile-menu d-none">
                        <button class="dr-btn dr-btn__icon mobile-menu__btn">
                            <span class="mobile-menu__icon ic-white ic-align-left"></span>
                        </button>
                        <div class="mobile-menu__drop ">
                            <div class="mobile-menu__wrapper">

                                <!-- кнопки вход регистрация заменены на данные пользователя -->
                                <?php if(App::i()->getCurrentUser()):?>
                                    <div class="d-flex justify-content-center align-items-center">
                                        <a href="<?=Url::toRoute('account/orders')?>" class="data-user <?=$proClass?>">
                                            <span class="icon"><span class="ic-user ic-white"></span></span>
                                                <span class="data-user__title dr-text__small c-light">
                                                    <b><?=App::i()->getCurrentUser()->getShortname()?></b>
                                                </span>

                                            <?php if(App::i()->getCurrentUser()->isVip()):?>
                                                <span class="data-user__status bage">Pro</span>
                                            <?php endif;?>
                                        </a>
                                        <a href="<?=Url::toRoute('auth/logout')?>" class="dr-text__normal fw-bold ml-20 c-light">Выйти</a>
                                    </div>
                                <?php else: ?>
                                    <div class="btn-group align-items-center d-flex justify-content-center">
                                        <a href="<?=Url::toRoute('auth/login')?>" id="id-btn__signin" class="dr-btn dr-text__menu c-accent__lighter">Вход</a>
                                        <a href="<?=Url::toRoute('auth/registration')?>" id="id-btn__signup" class="dr-btn dr-btn__orange-gradient">Регистрация</a>
                                    </div>
                                <?php endif;?>
                                <!-- кнопки вход регистрация заменены на данные пользователя -->

                                <?php echo $this->render('template-parts/navbar-menu.php'); ?>

                                <div class="btn d-flex align-items-center text-center w-100">
                                    <a href="<?=Url::toRoute('site/feedback')?>" class="dr-btn dr-btn__accent-gradient max-w-250 w-100">форма обратной связи</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php if(App::i()->getCurrentUser()):?>
                        <div class="d-flex justify-content-center align-items-center">
                            <a href="<?=Url::toRoute('account/orders')?>" class="data-user  <?=$proClass?>">
                                <span class="icon"><span class="ic-user ic-white"></span></span>
                                <span class="data-user__title dr-text__small c-light">
                                    <b><?=App::i()->getCurrentUser()->getShortname()?></b>
                                </span>
                                <?php if(App::i()->getCurrentUser()->isVip()):?>
                                    <span class="data-user__status bage">Pro</span>
                                <?php endif;?>
                            </a>
                        </div>
                    <?php else: ?>
                        <div class="btn-group align-items-center btn-group__auth d-flex">
                            <a href="<?=Url::toRoute('auth/login')?>" id="id-btn__signup" class="dr-btn dr-btn__orange-gradient dr-btn-h40">Вход / Регистрация</a>
                        </div>
                    <?php endif;?>
                </nav>
            </div>
        </div>
    </div>
</header>
