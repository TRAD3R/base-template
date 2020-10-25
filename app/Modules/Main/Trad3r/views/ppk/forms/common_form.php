<?php


use App\Forms\Main\Ppk\MedicForm;
use App\Html;
use yii\widgets\ActiveForm;

/**
 * @var $form ActiveForm
 * @var $model MedicForm
 */
?>

<?=$form->field($model, 'company')
    ->textInput([
        'class' => 'dr-form-control form-control',
        'required' => true,
        'placeholder' => 'ООО «Ромашка»'
    ])->label(null, ['class' => 'label form-group__label']);
?>
<?=$form->field($model, 'specTitle')
    ->textInput([
        'class' => 'dr-form-control form-control',
        'placeholder' => 'Кафе «Роза»'
    ])->label(null, ['class' => 'label form-group__label']);
?>
<?=$form->field($model, 'position')
    ->textInput([
        'class' => 'dr-form-control form-control',
        'required' => false,
        'placeholder' => 'директор'
    ])->label(null, ['class' => 'label form-group__label']);
?>
<?=$form->field($model, 'headmaster')
    ->textInput([
        'class' => 'dr-form-control form-control',
        'required' => true,
        'placeholder' => 'Иванов Иван Иванович'
    ])->label(null, ['class' => 'label form-group__label']);
?>
<?=$form->field($model, 'phone')
    ->input('tel',[
        'class' => 'dr-form-control form-control mask-tel',
        'required' => true,
        'placeholder' => ''
    ])->label(null, ['class' => 'label form-group__label']);
?>
<?=$form->field($model, 'legalAddress')
    ->textInput([
        'class' => 'dr-form-control form-control',
        'required' => true,
        'placeholder' => '344000, Ростов-на-Дону, ул. Большая Садовая, 2'
    ])->label(null, ['class' => 'label form-group__label']);
?>
<?=$form->field($model, 'actualAddress')
    ->textInput([
        'class' => 'dr-form-control form-control',
        'required' => true,
        'placeholder' => '344000, Ростов-на-Дону, ул. Большая Садовая, 3'
    ])->label(null, ['class' => 'label form-group__label']);
?>
<?=$form->field($model, 'inn')
    ->textInput([
        'class' => 'dr-form-control form-control',
        'required' => true,
        'placeholder' => ' ',
        'pattern' => "[0-9]+",
        'maxlength' => 12
    ])->label(null, ['class' => 'label form-group__label']);
?>
<div class="form-group form-group_row ml-0" style="max-width: 420px;">
    <label for="id-number-people" class="label form-group__label">
        <?=$model->getAttributeLabel('employes')?>
    </label>
    <div class="input-wrapper">
        <?= Html::activeInput('number', $model, 'employes', [
            'placeholder' => ' ',
            'class' => 'dr-form-control form-control input-number-people',
            'required' => true,
        ]); ?>
        <span class="dr-text__normal">чел.</span>
    </div>
</div>
<div class="form-group form-group_row ml-0">
    <label for="id-number-people2" class="label form-group__label">
        <span>Из них относящихся к «декретированному контингенту»</span>
        <span class="tooltip-btn tooltip-btn__circle"
              data-toggle="popover"
              data-placement="top"
              data-html="true"
              data-content="Должностные лица и работники организаций, деятельность, которых связана с медицинским обслуживанием населения">
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
    <div class="input-wrapper">
        <?= Html::activeInput('number', $model, 'specEmployes', [
            'placeholder' => ' ',
            'class' => 'dr-form-control form-control input-number-people',
            'required' => true,
        ]); ?>
        <span class="dr-text__normal">чел.</span>
    </div>
</div>
<div class="form-group">
    <label class="label form-group__label">
        Свидетельство о государственной регистрации
    </label>
    <div class="form-group form-group_row mb-0">
        <div class="col-12 col-sm-9 p-0">
            <div class="form-group form-group_row">
                <label for="id-reg-num" class="label form-group__label">
                    №
                </label>
                <?= Html::activeInput('number', $model, 'certNumber', [
                    'placeholder' => ' ',
                    'class' => 'dr-form-control form-control',
                    'required' => true,
                    'pattern' => "[0-9]+"
                ]); ?>
            </div>
        </div>
        <div class="col-12 col-sm-3 p-0">
            <div class="form-group form-group_row">
                <label for="id-reg-date" class="label form-group__label">
                    от
                </label>
                <?= Html::activeInput('text', $model, 'certDate', [
                    'placeholder' => ' ',
                    'class' => 'dr-form-control form-control  mask-date',
                    'required' => true,
                ]); ?>
            </div>
        </div>
    </div>
    <div class="d-flex flex-wrap w-100 mt-20">
        <div class="form-group form-group_row">
            <label for="id-issued-by" class="label form-group__label">
                кем выдано
            </label>
            <?= Html::activeInput('text', $model, 'certIssue', [
                'placeholder' => ' ',
                'class' => 'dr-form-control form-control',
                'required' => true,
            ]); ?>
        </div>
    </div>
</div>
<?=$form->field($model, 'ogrnTitle')
    ->textInput([
        'class' => 'dr-form-control form-control',
        'required' => true,
        'placeholder' => ' ',
        'maxlength' => 15
    ])->label(null, ['class' => 'label form-group__label']);
?>
<?=$form->field($model, 'ogrnDate')
    ->textInput([
        'class' => 'dr-form-control form-control  mask-date',
        'required' => true,
        'placeholder' => ' '
    ])->label(null, ['class' => 'label form-group__label']);
?>
<div class="form-group">
    <label for="id-gov-peop" class="label form-group__label">
        Перечень должностных лиц (работников), на которых возложены функции по осуществлению производственного контроля (ФИО, должность, телефон)
    </label>
    <div class="controls-added">
        <div class="controls-added__row controls-added__row_original">
            <div class="controls-added__element">
                <input type="text" class="dr-form-control form-control"
                       required=""
                       id="id-gov-peop"
                       name="manager"
                       placeholder="Иванов Иван Иванович, директор, 8-999-777-0000">
            </div>
            <div class="controls-added__btn">
                <div class="controls-btn_add">
                    <p class="dr-text__small">добавить</p>
                    <button type="button" class="dr-btn dr-btn__square"><span class="headers-h2">+</span></button>
                </div>
                <div class="controls-btn_remove">
                    <p class="dr-text__small">удалить</p>
                    <button type="button" class="dr-btn dr-btn__circle"><span class="headers-h2">—</span></button>
                </div>
            </div>
        </div>
    </div>
</div>
<?=$form->field($model, 'managers')
    ->hiddenInput([
        'id' => 'managers',
        'required' => true,
        'placeholder' => ''
    ])->label(false);
?>
