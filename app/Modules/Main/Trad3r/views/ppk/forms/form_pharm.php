<?php

use App\Forms\Main\Ppk\PharmForm;
use yii\widgets\ActiveForm;

/**
 * @var $form ActiveForm
 * @var $model PharmForm
 */
?>

<div class="row mt-80">
    <div class="w-100 max-w-820">
        <?=$this->render('common_form', ['form' => $form, 'model' => $model])?>
    </div>
</div>