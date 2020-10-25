<?php

use App\Helpers\TextUtils;
use App\Helpers\Url;
/**
 * @var $count int
 * @var $totalCost int
 * @var int $id
 */

?>
<section class="section section-expertize-payment">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="modal">
                    <div class="modal-content modal-content__components w-100 max-w-820">
                        <div class="modal-header bg-orange-gradient">
                            <p class="headers-h1 w-100 text-center">Экспертиза документов</p>
                        </div>
                        <div class="modal-body w-100 text-center ">
                            <p class="headers-h2 c-accent__darken">Загружено <?=$count?> <?=TextUtils::pluralForm($count, 'файл', 'файла', 'файлов')?>.</p>
                            <p class="dr-text__normal c-accent__darker mb-0">Общая стоимость:</p>
                            <p class="headers-h1 c-accent__darker"><?=$totalCost?> ₽</p>
                            <div class="d-flex justify-content-center w-100">
                                <a href="<?=Url::toRoute(['expertize/payment', 'id' => $id])?>" class="dr-btn dr-btn__orange-gradient dr-btn__big w-100 max-w-400 mb-30">оплатить</a>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <img src="/images/_src/payments.png" class="max-w-400 w-100" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>