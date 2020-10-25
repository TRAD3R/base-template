<?php

use App\Forms\Main\Ppk\IiiForm;
use yii\widgets\ActiveForm;

/**
 * @var $form ActiveForm
 * @var $model IiiForm
 */
?>

<div class="row mt-80">
    <div class="w-100 max-w-820">
        <?=$form->field($model, 'company')
            ->textInput([
                'class' => 'dr-form-control form-control',
                'required' => true,
                'placeholder' => 'ООО «Ромашка»'
            ])->label(null, ['class' => 'label form-group__label']);
        ?>
        <?=$form->field($model, 'position')
            ->textInput([
                'class' => 'dr-form-control form-control',
                'required' => true,
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
        <?=$form->field($model, 'city')
            ->textInput([
                'class' => 'dr-form-control form-control',
                'required' => true,
                'placeholder' => 'Ростов-на-Дону'
            ])->label(null, ['class' => 'label form-group__label']);
        ?>
        <?=$form->field($model, 'year')
            ->input('number',[
                'class' => 'dr-form-control form-control mask-year',
                'required' => true,
                'placeholder' => 'XXXX'
            ])->label(null, ['class' => 'label form-group__label']);
        ?>
        <p class="dr-text__normal fw-bold c-accent__lightest mt-60">
            Приказ о назначении ответственного за радиационную безопасность
        </p>
        <?=$form->field($model, 'orderNumber')
            ->textInput([
                'class' => 'dr-form-control form-control',
                'required' => true,
                'placeholder' => ' '
            ])->label(null, ['class' => 'label form-group__label']);
        ?>
        <?=$form->field($model, 'orderDate')
            ->textInput([
                'class' => 'dr-form-control form-control mask-date',
                'required' => true,
                'placeholder' => ' '
            ])->label(null, ['class' => 'label form-group__label']);
        ?>
    </div>
</div>
