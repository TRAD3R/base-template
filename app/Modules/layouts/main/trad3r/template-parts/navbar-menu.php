<?php

use App\App;
use App\Helpers\Url;

$userIsVip = App::i()->getCurrentUser() && App::i()->getCurrentUser()->isVip();
?>
<!-- Links -->
<ul class="dr-navbar-nav navbar-nav dr-text__menu">
    <li class="nav-item">
        <div class="dropdown-nav">
            <a href="<?=Url::toRoute('site/license-page')?>" class="dropdown-header">
                <div class="dropdown-title">
                    <span class="text-default">Лицензионное дело</span>
                </div>
            </a>
            <div class="dropdown-list">
                <ul>
                    <li class="dropdown-list-item">
                        <a href="<?=Url::toRoute('site/license-procedure')?>">порядок оформления медицинской лицензии</a>
                    </li>
                    <li class="dropdown-list-item">
                        <a href="<?=Url::toRoute('configurator/education')?>"
                            <?php if(!$userIsVip) :?>
                                data-modal="modal_purchasing_access_configuration"
                            <?php endif;?>
                           class="<?=App::i()->getCurrentUser()?'':'inactive-link'?>"
                        >
                            конфигуратор оформления медицинской лицензии
                        </a>
                    </li>
                    <li class="dropdown-list-item">
                        <a href="<?=Url::toRoute('configurator/cause')?>"
                            <?php if(!$userIsVip) :?>
                                data-modal="modal_purchasing_access_configuration"
                            <?php endif;?>
                           class="<?=App::i()->getCurrentUser()?'':'inactive-link'?>"
                        >
                            конфигуратор переоформления медицинской лицензии
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <div class="dropdown-nav">
            <a href="<?=Url::toRoute('site/service')?>" class="dropdown-header">
                <div class="dropdown-title">
                    <span class="text-default">Услуги</span>
                </div>
            </a>
            <div class="dropdown-list">
                <ul>
                    <li class="dropdown-list-item"><a href="<?=Url::toRoute(['site/legal-assistance'])?>" class="<?=App::i()->getCurrentUser()?'':'inactive-link'?>">правовая помощь</a></li>
                    <li class="dropdown-list-item">
                        <a href="<?=Url::toRoute('expertize/index')?>" class="<?=App::i()->getCurrentUser()?'':'inactive-link'?>">экспертиза образовательных документов</a>
                    </li>
                </ul>
                <div class="dr-text__small label-lined-top">
                    Подготовка типовых документов
                </div>
                <ul>
                    <li class="dropdown-list-item"><a href="<?=Url::toRoute('ppk/index')?>">программы производственного контроля</a></li>
                    <li class="dropdown-list-item"><a href="<?=Url::toRoute('contract/step1')?>">трудовые договоры и договоры аренды</a></li>
                </ul>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?=Url::toRoute(['review/index'])?>">Отзывы</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?=Url::toRoute('site/feedback')?>">Контакты</a>
    </li>
    <li class="nav-item">
        <a class="nav-link bg-red" href="<?=Url::toRoute(['site/materials'])?>">FAQ</a>
    </li>
</ul>
