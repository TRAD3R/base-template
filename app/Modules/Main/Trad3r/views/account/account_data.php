<?php
/**
 * @var $this View
 * @var $user \App\Models\User
 */
use yii\web\View;
?>

<div class="col-12 col-lg-9 col-md-9 col-sm-12 section-content__cabinet-wrapper bg-accent__lightest">
    <div class="section-content__cabinet ">
        <h2 class="headers-h3 c-accent__darken mb-30"><?=$this->title?></h2>
        <ul class="cabinet-info">
            <li class="cabinet-info__row">
                <p class="cabinet-info__lbl dr-text__small c-accent__darken">Имя</p>
                <p class="cabinet-info__val dr-text__normal fw-bold c-accent__darker"><?=$user->getShortname()?></p>
            </li>
            <li class="cabinet-info__row">
                <p class="cabinet-info__lbl dr-text__small c-accent__darken">Телефон</p>
                <p class="cabinet-info__val dr-text__normal fw-bold c-accent__darker"><?=$user->phone?></p>
            </li>
            <li class="cabinet-info__row">
                <p class="cabinet-info__lbl dr-text__small c-accent__darken">Почта</p>
                <p class="cabinet-info__val dr-text__normal fw-bold c-accent__darker"><?=$user->email?></p>
            </li>
            <li class="cabinet-info__row">
                <p class="cabinet-info__lbl dr-text__small c-accent__darken">Название</p>
                <p class="cabinet-info__val dr-text__normal fw-bold c-accent__darker"><?=$user->company?></p>
            </li>
        </ul>
    </div>
</div>
