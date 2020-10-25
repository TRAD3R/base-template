<?php

use App\Models\Occupation;
use App\Models\Ppk;

/**
 * @var Ppk $ppk
 */
?>

<div class="col-12 col-sm-12 col-md-12 col-lg-6">
    <div class="list-panel__item panel panel-column align-items-start">
        <p class="panel-header dr-text__normal"><b>Программа производственного контроля: <br><?=Occupation::getParentTitle($ppk->type)?></b></p>
        <div class="panel-footer mt-20">
            <a href="<?= $ppk->getFilepath() ?>"
               class="dr-btn dr-btn-h40 dr-btn__orange-gradient mb-0"
               download="<?=Occupation::getParentTitle($ppk->type)?>.pdf"
            >
                Скачать
            </a>
        </div>
    </div>
</div>
