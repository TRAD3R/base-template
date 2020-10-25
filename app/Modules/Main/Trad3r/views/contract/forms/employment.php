<?php

use App\Forms\Main\Contract\RentForm;
use App\Html;
use yii\widgets\ActiveForm;

/**
 * @var $model RentForm
 * @var $type int
 */

?>

<div class="section section-configurator_ppk bg-overlay">
    <div class="container">
        <h1 class="headers-h1 c-light text-center mb-50">Трудовой договор стандартный</h1>
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
                                <p class="headers-h3 c-accent__lighten mt-20">Работник</p>
                                <label for="id-date-contract-begin" class="label form-group__label">
                                    <?=Html::activeLabel($model, 'employerName', ['class' => 'label form-group__label'])?>
                                </label>
                                <?=Html::activeTextInput($model, 'employerName', [
                                    'class' => 'dr-form-control form-control',
                                    'placeholder' => ' ',
                                    'required' => true,
                                ])?>
                                <div class="form-group__message error"></div>
                            </div>
                            <div class="form-group">
                                <label for="id-date-contract-begin" class="label form-group__label">
                                    <?=Html::activeLabel($model, 'employerAddress', ['class' => 'label form-group__label'])?>
                                </label>
                                <?=Html::activeTextInput($model, 'employerAddress', [
                                    'class' => 'dr-form-control form-control',
                                    'placeholder' => 'Адрес регистрации: Ростов-на-Дону, ул. Большая Садовая, 3',
                                    'required' => true,
                                ])?>
                                <div class="form-group__message error"></div>
                            </div>
                            <div class="form-group">
                                <p class="headers-h3 c-accent__lighten mt-20">Работодатель</p>
                                <label for="id-date-contract-begin" class="label form-group__label">
                                    <?=Html::activeLabel($model, 'owner', ['class' => 'label form-group__label'])?>
                                </label>
                                <?=Html::activeTextInput($model, 'owner', [
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
                                    <?=Html::activeLabel($model, 'ownerData', ['class' => 'label form-group__label'])?>
                                </label>
                                <?=Html::activeTextarea($model, 'ownerData', [
                                    'class' => 'dr-form-control form-control',
                                    'placeholder' => 'ИНН 12312312 р/с 34234234234234 в банке БАНК, БИК 12312322. Юр.адрес: Ростов-на-Дону, ул. Большая Садовая, 123',
                                    'required' => true,
                                ])?>
                                <div class="form-group__message error"></div>
                            </div>
                            <div class="form-group">
                                <label for="id-date-contract-begin" class="label form-group__label">
                                    <?=Html::activeLabel($model, 'address', ['class' => 'label form-group__label'])?>
                                </label>
                                <?=Html::activeTextInput($model, 'address', [
                                    'class' => 'dr-form-control form-control',
                                    'placeholder' => 'Адрес регистрации: Ростов-на-Дону, ул. Большая Садовая, 3',
                                    'required' => true,
                                ])?>
                                <div class="form-group__message error"></div>
                            </div>
                            <div class="form-group">
                                <p class="headers-h3 c-accent__lighten mt-20">Предмет договора</p>
                                <label for="id-date-contract-begin" class="label form-group__label">
                                    <?=Html::activeLabel($model, 'employerPosition', ['class' => 'label form-group__label'])?>
                                </label>
                                <?=Html::activeTextInput($model, 'employerPosition', [
                                    'class' => 'dr-form-control form-control',
                                    'placeholder' => 'Специалист широкого профиля',
                                    'required' => true,
                                ])?>
                                <div class="form-group__message error"></div>
                            </div>
                            <div class="form-group">
                                <label for="id-date-contract-begin" class="label form-group__label">
                                    <?=Html::activeLabel($model, 'employerStartDate', ['class' => 'label form-group__label'])?>
                                </label>
                                <?=Html::activeTextInput($model, 'employerStartDate', [
                                    'class' => 'dr-form-control form-control mask-date',
                                    'placeholder' => ' ',
                                    'required' => true,
                                ])?>
                                <div class="form-group__message error"></div>
                            </div>
                            <div class="form-group">
                                <label for="id-date-contract-begin" class="label form-group__label">
                                    <?=Html::activeLabel($model, 'employerRate', ['class' => 'label form-group__label'])?>
                                </label>
                                <?=Html::activeTextInput($model, 'employerRate', [
                                    'class' => 'dr-form-control form-control',
                                    'placeholder' => '1,0 ставки, 0,5 ставки',
                                    'required' => true,
                                ])?>
                                <div class="form-group__message error"></div>
                            </div>
                            <div class="form-group">
                                <label for="id-date-contract-begin" class="label form-group__label">
                                    <?=Html::activeLabel($model, 'cost', ['class' => 'label form-group__label'])?>
                                </label>
                                <?=Html::activeTextInput($model, 'cost', [
                                    'class' => 'dr-form-control form-control',
                                    'placeholder' => ' ',
                                    'required' => true,
                                ])?>
                                <div class="form-group__message error"></div>
                            </div>
                            <div class="form-group">
                                <label for="id-date-contract-begin" class="label form-group__label">
                                    <?=Html::activeLabel($model, 'employerStartTime', ['class' => 'label form-group__label'])?>
                                </label>
                                <?=Html::activeTextInput($model, 'employerStartTime', [
                                    'class' => 'dr-form-control form-control mask-time',
                                    'placeholder' => ' ',
                                    'required' => true,
                                ])?>
                                <div class="form-group__message error"></div>
                            </div>
                            <div class="form-group">
                                <label for="id-date-contract-begin" class="label form-group__label">
                                    <?=Html::activeLabel($model, 'employerEndTime', ['class' => 'label form-group__label'])?>
                                </label>
                                <?=Html::activeTextInput($model, 'employerEndTime', [
                                    'class' => 'dr-form-control form-control mask-time',
                                    'placeholder' => ' ',
                                    'required' => true,
                                ])?>
                                <div class="form-group__message error"></div>
                            </div>
                            <div class="form-group">
                                <label for="id-date-contract-begin" class="label form-group__label">
                                    <?=Html::activeLabel($model, 'restDays', ['class' => 'label form-group__label'])?>
                                </label>
                                <?=Html::activeTextInput($model, 'restDays', [
                                    'class' => 'dr-form-control form-control',
                                    'placeholder' => 'суббота, воскресенье',
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
