<?php

use App\Helpers\ConfiguratorHelper;
use App\Models\Configuration;
use App\Models\Region;
use App\Models\Specialty;
use App\Params;

/**
 * @var $configurator Configuration
 * @var $key int
 */

$filename = $configurator->type == Configuration::TYPE_SUB ? 'Переоформление-лицензии.zip' : 'Первая-лицензия.zip';
$title = $configurator->type == Configuration::TYPE_SUB ? 'Переоформление лицензии' : 'Первая лицензия';
?>

<div class="col-12 col-sm-12 col-md-12 col-lg-6">
    <div class="list-panel__item panel panel-column align-items-start">
        <p class="panel-header dr-text__normal"><b>Пакет файлов <?= ++$key ?> (<?=$title?>)</b></p>
        <div class="panel-body">
            <ul class="custom-list">
                <li>
                    <p>
                        <span class="dr-text__small c-accent">Образование:</span>
                        <span class="dr-text__normal c-accent__darker">
                            <?php if($configurator->education) {
                                echo Configuration::getEducationTitle($configurator->education);
                            }else{
                                echo "-";
                            }
                            ?>
                        </span>
                    </p>
                </li>
                <li>
                    <p>
                        <span class="dr-text__small c-accent">Персонал:</span>
                        <span class="dr-text__normal c-accent__darker">
                            <?php if($configurator->staff) {
                                echo Configuration::getPersonal($configurator->staff);
                            }else{
                                echo "-";
                            }
                            ?>
                        </span>
                    </p>
                </li>
                <li>
                    <p>
                        <span class="dr-text__small c-accent">Специальность:</span>
                        <span class="dr-text__normal c-accent__darker">
                            <?php
                            $specialities = json_decode($configurator->speciality, true);
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
                            ?>
                        </span>
                    </p>
                </li>
                <li>
                    <p>
                        <span class="dr-text__small c-accent">Форма:</span>
                        <span class="dr-text__normal c-accent__darker">
                            <?php if($configurator->form) {
                                echo Configuration::getOwnerType($configurator->form);
                            }else{
                                echo "-";
                            }
                            ?>
                        </span>
                    </p>
                </li>
                <li>
                    <p>
                        <span class="dr-text__small c-accent">Регион:</span>
                        <span class="dr-text__normal c-accent__darker">
                            <?php
                                if ($region = Region::findOne($configurator->region)) {
                                    echo $region->name;
                                }
                            ?>
                        </span>
                    </p>
                </li>
                <li>
                    <p>
                        <span class="dr-text__small c-accent">Дата:</span>
                        <span class="dr-text__normal c-accent__darker">
                            <?= (new DateTime($configurator->date_created))->format('d.m.Y') ?>
                        </span>
                    </p>
                </li>
            </ul>
        </div>
        <div class="panel-footer mt-20">
            <?php
                $dateTime = new DateTime();
                $current = $dateTime->getTimestamp();
                $from_base = new DateTime($configurator->date_created);
                $from_base = $from_base->getTimestamp();
                if ($current < $from_base + 24 * 60 * 60 * 30):
            ?>
                <a href="<?= ConfiguratorHelper::getArchive($configurator) ?>"
                   class="dr-btn dr-btn-h40 dr-btn__orange-gradient mb-0" download="<?=$filename?>">скачать</a>
            <?php endif; ?>
        </div>
    </div>
</div>
