<?php

use App\Helpers\Url;
use App\Models\Configuration;
use App\Models\Region;
use App\Models\Specialty;
use App\Params;

/**
 * @var Configuration $draft
 */

$title = $draft->type == Configuration::TYPE_SUB ? 'Переоформление лицензии' : 'Первая лицензия';
?>

<div class="col-12 col-sm-12 col-md-12 col-lg-6">
    <div class="list-panel__item panel panel-column align-items-start">
        <p class="panel-header dr-text__normal"><b>Черновик (<?=$title?>)</b></p>
        <div class="panel-body">
            <ul class="custom-list">
                <li>
                    <p>
                        <span class="dr-text__small c-accent">Образование:</span>
                        <span class="dr-text__normal c-accent__darker">
                            <?= $draft->education ? Configuration::getEducationTitle($draft->education) : '-' ?>
                        </span>
                    </p>
                </li>
                <li>
                    <p>
                        <span class="dr-text__small c-accent">Персонал:</span>
                        <span class="dr-text__normal c-accent__darker">
                            <?= $draft->staff ? Configuration::getPersonal($draft->staff) : '-' ?>
                        </span>
                    </p>
                </li>
                <li>
                    <p>
                        <span class="dr-text__small c-accent">Специальность:</span>
                        <span class="dr-text__normal c-accent__darker">
                            <?php
                                $specialities = json_decode($draft->speciality, true);
                                if(is_null($specialities)) {
                                    echo "-";
                                } else {
                                    if ($specialities[Params::HIGH_EDUCATION]) {
                                        $highs = [];
                                        foreach ($specialities[Params::HIGH_EDUCATION] as $speciality) {
                                            $highs[] = Specialty::getSpecialityName($speciality);
                                        }

                                        echo sprintf("%s: %s<br>",
                                            Configuration::getEducationTitle(Configuration::EDUCATION_HIGHER),
                                            implode(", ", $highs)
                                        );
                                    }
                                    if ($specialities[Params::MIDDLE_EDUCATION]) {
                                        $middles = [];
                                        foreach ($specialities[Params::MIDDLE_EDUCATION] as $speciality) {
                                            $middles[] = Specialty::getSpecialityName($speciality);
                                        }
                                        echo sprintf("%s: %s<br>",
                                            Configuration::getEducationTitle(Configuration::EDUCATION_MIDDLE),
                                            implode(", ", $middles)
                                        );
                                    }
                                }
                            ?>
                        </span>
                    </p>
                </li>
                <li>
                    <p>
                        <span class="dr-text__small c-accent">Форма:</span>
                        <span class="dr-text__normal c-accent__darker">
                            <?php if ($draft->form): ?>
                                <?php
                                if ($form = Configuration::getOwnerType($draft->form)) {
                                    echo $form;
                                } ?>
                            <?php else: ?>
                                -
                            <?php endif; ?>
                        </span>
                    </p>
                </li>
                <li>
                    <p>
                        <span class="dr-text__small c-accent">Регион:</span>
                        <span class="dr-text__normal c-accent__darker">
                            <?php if($draft->region):?>
                                <?php
                                    if($region = Region::findOne($draft->region)) {
                                        echo $region->name;
                                    }
                                ?>
                            <?php else:?>
                                -
                            <?php endif;?>

                        </span>
                    </p>
                </li>
                <li>
                    <p>
                        <span class="dr-text__small c-accent">Дата:</span>
                        <span class="dr-text__normal c-accent__darker">
                            -
                        </span>
                    </p>
                </li>
            </ul>
        </div>
        <div class="panel-footer mt-20">
            <a href="<?= Url::toRoute(['account/continue-draft', 'id' => $draft->id]) ?>"
               class="dr-btn dr-btn-h40 dr-btn__orange-gradient mb-0"
            >
                продолжить
            </a>
        </div>
    </div>
</div>
