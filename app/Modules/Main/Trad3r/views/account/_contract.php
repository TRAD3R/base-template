<?php

use App\Models\Contract;

/**
 * @var Contract $contract
 */
?>

<div class="col-12 col-sm-12 col-md-12 col-lg-6">
    <div class="list-panel__item panel panel-column align-items-start">
        <p class="panel-header dr-text__normal"><b><?=Contract::getTitle($contract->type)?></b></p>
        <div class="panel-footer mt-20">
            <a href="<?= $contract->getFilepath() ?>"
               class="dr-btn dr-btn-h40 dr-btn__orange-gradient mb-0"
               download="<?=Contract::getTitle($contract->type)?>.pdf"
            >
                Скачать
            </a>
        </div>
    </div>
</div>
