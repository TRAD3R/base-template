<?php

use App\App;
use App\Helpers\Url;

?>

<div class="col-12 col-lg-3 col-md-3 col-sm-12 bg-light">
    <div class="section-sidebar sidebar d-flex justify-content-center">
        <div class="sidebar-inner">
            <div class="data-user align-items-start justify-content-start">
                <span class="icon"><span class="ic-user"></span></span>
                <div class="data-user__inner">
                    <span class="data-user__title headers-h3">
                        <b><?=App::i()->getCurrentUser()->getShortname()?></b>
                    </span>
                </div>
            </div>
            <nav class="sidebar-navbar">
                <ul class="sidebar-nav">
                    <li class="sidebar-nav__item
                    <?php echo (App::i()->getController()->action->id == 'orders') ? 'is-active' : '';?>"
                    >
                        <a href="<?=Url::toRoute("account/orders")?>" class="dr-text__nav">
                            Мои заказы
                        </a>
                    </li>
                    <li class="sidebar-nav__item
                    <?php echo (App::i()->getController()->action->id == 'index') ? 'is-active' : '';?>"
                    >
                        <a href="<?=Url::toRoute("account/index")?>" class="dr-text__nav">
                            Личные данные
                        </a>
                    </li>
                    <li class="sidebar-nav__item">
                        <a href="#"
                           class="dr-text__nav"
                           data-modal="modal_delete-account">Удалить профиль</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>
