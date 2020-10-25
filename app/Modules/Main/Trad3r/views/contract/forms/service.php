<?php

use App\Forms\Main\Contract\RentForm;
use App\Html;
use App\Models\Region;
use yii\widgets\ActiveForm;

/**
 * @var $model RentForm
 * @var $type int
 */

$regions = Region::getRegions();

?>

<div class="section section-configurator_ppk bg-overlay">
    <div class="container">
        <h1 class="headers-h1 c-light text-center mb-50">Договор на оказание платных медицинских услуг</h1>
        <div class="configurator-box mb-50">
            <?php
                $form = ActiveForm::begin([
                    'options'                => [
                        'class' => 'dr-form modal-content modal-content__horizontal bg-accent__darker'
                    ],
                    'fieldConfig' => [
                        'template' => '{label}{input}{error}',
                        'errorOptions' => [
                            'class' => 'form-group__message error'
                        ]
                    ],
                ]);
            ?>
                <div class="configurator-box__header text-center">
                    <p class="dr-text__normal c-accent__lighter mb-0">Конфигуратор «Договоры»</p>
                    <p class="dr-text__normal">Шаг 2</p>
                </div>
                <div class="configurator-box__body">
                    <h2 class="headers-h2 text-center">Заполните необходимые графы документа</h2>
                    <div class="row mt-80">
                        <div class="w-100 max-w-820">
                            <div class="form-group">
                                <label for="id-date-contract-begin" class="label form-group__label">
                                    <?=Html::activeLabel($model, 'city', ['class' => 'label form-group__label'])?>
                                </label>
                                <?=Html::activeTextInput($model, 'city', [
                                    'class' => 'dr-form-control form-control',
                                    'placeholder' => 'Ростов-на-Дону',
                                    'required' => true,
                                ])?>
                                <div class="form-group__message error"></div>
                            </div>
                            <div class="form-group">
                                <label for="id-date-contract-begin" class="label form-group__label">
                                    <?=Html::activeLabel($model, 'date', ['class' => 'label form-group__label'])?>
                                </label>
                                <?=Html::activeTextInput($model, 'date', [
                                    'class' => 'dr-form-control form-control mask-date',
                                    'placeholder' => ' ',
                                    'required' => true,
                                ])?>
                                <div class="form-group__message error"></div>
                            </div>
                            <div class="form-group">
                                <p class="headers-h3 c-accent__lighten mt-20">Медицинская организация</p>
                                <label for="id-date-contract-begin" class="label form-group__label">
                                    <?=Html::activeLabel($model, 'company', ['class' => 'label form-group__label'])?>
                                </label>
                                <?=Html::activeTextInput($model, 'company', [
                                    'class' => 'dr-form-control form-control',
                                    'placeholder' => 'ООО Ромашка',
                                    'required' => true,
                                ])?>
                                <div class="form-group__message error"></div>
                            </div>
                            <div class="form-group">
                                <label for="id-position" class="label form-group__label">
                                    <span>В лице должность, ФИО, действующиего на основании Устава (Свидетельства или другое)</span>
                                    <span class="tooltip-btn tooltip-btn__circle"
                                          data-toggle="popover"
                                          data-html="true"
                                          data-placement="top"
                                          data-content="Укажите должность и ФИО руководителя в родительном падеже">
                                        <span class="icon">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <g clip-path="url(#clip0)">
                                                <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="inherit" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M9.09009 9.00002C9.32519 8.33169 9.78924 7.76813 10.4 7.40915C11.0108 7.05018 11.729 6.91896 12.4273 7.03873C13.1255 7.15851 13.7589 7.52154 14.2152 8.06355C14.6714 8.60555 14.9211 9.29154 14.9201 10C14.9201 12 11.9201 13 11.9201 13" stroke="inherit" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M12 17H12.01" stroke="inherit" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                </g>
                                                <defs>
                                                <clipPath id="clip0">
                                                <rect width="24" height="24" fill="white"/>
                                                </clipPath>
                                                </defs>
                                            </svg>
                                        </span>
                                    </span>
                                </label>
                                <?=Html::activeTextInput($model, 'position', [
                                    'class' => 'dr-form-control form-control',
                                    'placeholder' => 'директора Иванова Ивана Ивановича, действующего на основании Устава',
                                    'required' => true,
                                ])?>
                                <div class="form-group__message error"></div>
                            </div>
                            <div class="form-group">
                                <label for="id-date-contract-begin" class="label form-group__label">
                                    <?=Html::activeLabel($model, 'inspection', ['class' => 'label form-group__label'])?>
                                </label>
                                <?=Html::activeTextInput($model, 'inspection', [
                                    'class' => 'dr-form-control form-control',
                                    'placeholder' => 'ИФНС №00 Ленинского района гор.Ростова-на-Дону',
                                    'required' => true,
                                ])?>
                                <div class="form-group__message error"></div>
                            </div>

                            <div class="form-group">
                                <label for="id-date-contract-begin" class="label form-group__label">
                                    <?=Html::activeLabel($model, 'license', ['class' => 'label form-group__label'])?>
                                </label>
                                <?=Html::activeTextInput($model, 'license', [
                                    'class' => 'dr-form-control form-control',
                                    'placeholder' => ' ',
                                    'required' => true,
                                ])?>
                                <div class="form-group__message error"></div>
                            </div>
                            <div class="form-group">
                                <label for="id-otd-control" class="label form-group__label">
                                    Регион (территориальный отдел управления Роспотребнадзора)
                                </label>
                                <div class="simple-select simple-select__default simple-select__date simple-select__datetime">

                                    <div class="simple-select__main form-control" tabindex="0" role="combobox" aria-expanded="false">
                                        <?=Html::activeTextInput($model, 'region',[
                                            'hidden' => true,
                                            'required' => true,
                                            'data-default-value' => 1,
                                            'id' => 'date'
                                        ])?>
                                        <p class="simple-select__selected"
                                           data-placeholder="">
                                            <button type="button" data-id="" class="tab"></button>
                                        </p>
                                        <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M6.59045 9.7511L12.5905 15.7511L18.5905 9.7511" stroke="#006064" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </div>

                                    <div class="simple-select__drop">
                                        <div class="simple-select__drop-inner">
                                            <ul class="simple-select__list" role="listbox">
                                                <?php foreach ($regions as $region):?>
                                                    <li class="simple-select__item" data-value="<?=$region->id?>" role="option">
                                                        <button type="button" data-id="<?=$region->id?>" class="tab"><?=$region->name?></button>
                                                    </li>
                                                <?php endforeach;?>
                                            </ul>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="form-group">
                                <label for="id-date-contract-begin" class="label form-group__label">
                                    <?=Html::activeLabel($model, 'data', ['class' => 'label form-group__label'])?>
                                </label>
                                <?=Html::activeTextarea($model, 'data', [
                                    'class' => 'dr-form-control form-control',
                                    'placeholder' => 'ИНН 12312312 р/с 34234234234234 в банке БАНК, БИК 12312322. Юр.адрес: Ростов-на-Дону, ул. Большая Садовая, 123',
                                    'required' => true,
                                ])?>
                                <div class="form-group__message error"></div>
                            </div>
                            <div class="form-group">
                                <label for="id-date-contract-begin" class="label form-group__label">
                                    <?=Html::activeLabel($model, 'contacts', ['class' => 'label form-group__label'])?>
                                </label>
                                <?=Html::activeTextInput($model, 'contacts', [
                                    'class' => 'dr-form-control form-control',
                                    'placeholder' => 'Тел. 8-999-999-9999, info@yourcompany.com, www.yourcompany.com',
                                    'required' => true,
                                ])?>
                                <div class="form-group__message error"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="configurator-box__footer">
                    <div class="w-100 d-flex justify-content-center text-center mt-60 mb-50">
                        <?=Html::submitButton('Отправить', ['class' => "dr-btn dr-btn__orange-gradient max-w-300 w-100"])?>
                    </div>
                </div>
            <?php ActiveForm::end();?>
        </div>

    </div>
</div>
