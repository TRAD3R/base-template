<?php

use App\Forms\Main\Ppk\MedicForm;
use App\Html;
use App\Models\Region;
use yii\widgets\ActiveForm;

/**
 * @var $form ActiveForm
 * @var $model MedicForm
 */

$regions = Region::getRegions();
?>

<div class="row mt-80">
    <div class="w-100 max-w-820">
        <?=$this->render('common_form', ['form' => $form, 'model' => $model])?>
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
                                <li class="simple-select__item" data-value="${val}" role="option">
                                    <button type="button" data-id="<?=$region->id?>" class="tab"><?=$region->name?></button>
                                </li>
                            <?php endforeach;?>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>