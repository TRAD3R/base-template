<?php

use App\App;
use App\Models\Configuration;
use App\Models\Contract;
use App\Models\Ppk;
use yii\web\View;
use App\Models\User;

/**
 * @var $this View
 * @var $drafts Configuration[]
 * @var Configuration[] $packages
 * @var Ppk[] $ppks
 * @var Contract[] $contracts
 */

$configuratorModalId = 'modal_configuration_accept_first';
$reconfiguratorModalId = 'modal_configuration_accept_reorganization';
?>

<div class="col-12 col-lg-9 col-md-9 col-sm-12 section-content__cabinet-wrapper bg-accent__lightest">
    <div class="section-content__cabinet ">
        <div class="list-orders list-panels">
            <h2 class="headers-h3 c-accent__darken mb-30">Мои заказы</h2>
            <?php if(App::i()->getCurrentUser()->category == User::CATEGORY_PREMIUM):?>
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-6">
                    <div class="list-panel__item panel panel-column align-items-start">
                        <p class="panel-header dr-text__normal"><b>Первичное оформление лицензии</b></p>
                        <div class="panel-body">
                            <ul class="custom-list">
                                <li>
                                    <p>
                                        <span class="dr-text__small c-accent">Выберите этот конфигуратор, если Вы оформляете новую лицензию.</span>
                                        <span class="dr-text__normal c-accent__darker"></span>
                                    </p>
                                </li>
                            </ul>
                        </div>
                        <div class="panel-footer mt-20">
                            <a href="javascript:void(0)"
                               class="dr-btn dr-btn-h40 dr-btn__orange-gradient mb-0"
                               data-modal="<?=$configuratorModalId?>">
                                пройти
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-6">
                    <div class="list-panel__item panel panel-column align-items-start">
                        <p class="panel-header dr-text__normal"><b>Переоформление лицензии</b></p>
                        <div class="panel-body">
                            <ul class="custom-list">
                                <li>
                                    <p>
                                        <span class="dr-text__small c-accent">Выберите этот конфигуратор, если Вы переоформляете лицензию.</span>
                                        <span class="dr-text__normal c-accent__darker"></span>
                                    </p>
                                </li>
                            </ul>
                        </div>
                        <div class="panel-footer mt-20">
                            <a href="javascript:void(0)"
                               class="dr-btn dr-btn-h40 dr-btn__orange-gradient mb-0"
                               data-modal="<?=$reconfiguratorModalId?>">
                                пройти
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif;?>
            <div class="row">
                <?php
                    if ($packages) {
                        /** @var Configuration $item */
                        foreach ($packages as $key => $item) {
                            echo $this->render("_package", [
                                'configurator' => $item,
                                'key' => $key
                            ]);
                        }
                    }
                    if ($drafts) {
                        /** @var Configuration $item */
                        foreach ($drafts as $key => $item) {
                            echo $this->render("_draft", [
                                'draft' => $item,
                                'key' => $key
                            ]);
                        }
                    }
                    if ($ppks) {
                        /** @var Ppk $item */
                        foreach ($ppks as $key => $item) {
                            echo $this->render("_ppk", [
                                'ppk' => $item,
                                'key' => $key
                            ]);
                        }
                    }
                    if ($contracts) {
                        /** @var Contract $item */
                        foreach ($contracts as $key => $item) {
                            echo $this->render("_contract", [
                                'contract' => $item,
                                'key' => $key
                            ]);
                        }
                    }
                ?>
            </div>
        </div>
    </div>
</div>
<?php
    if(App::i()->getCurrentUser()->category == User::CATEGORY_PREMIUM) {
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
    }
?>