<?php

/**
 * @var $model \App\Forms\ReviewForm
 */

use App\Html;
use yii\widgets\ActiveForm;

?>

<section class="section section-review-form">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="page-title headers-h1 text-center c-accent__darken">Оставить отзыв</h1>
                <div class="max-w-650">
                    <?php
                        $form = ActiveForm::begin([
                                'class' => "dr-form",
                        ])
                    ?>
                    <?=$form->field($model, 'text')->textarea([
                        'class' => 'dr-form-control form-control min-h-190',
                        'placeholder' => "Ваш отзыв"
                    ])->label(false)?>
                        <p class="dr-text__small c-accent text-center">
                            <?=$this->render('/site/template-parts/terms-policy', ['firstPart' => 'Оставляя отзыв'])?>
                        </p>
                        <div class="form-group text-center w-100 d-flex align-items-center">
                            <?=Html::submitButton('отправить', [
                                'class' => 'dr-btn dr-btn__orange-gradient w-100 max-w-300',
                                'onclick' => 'thanx()'
                            ])?>
                        </div>
                        <p id='thanx' class="dr-text__small c-accent text-center" style="display: none">
                            Ваш отзыв отправляется. Спасибо!
                        </p>

                    <?php ActiveForm::end();?>
                </div>
            </div>
        </div>
    </div>

</section>

<script>
    document.body.classList.add('bg-accent__lightest');
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelector('.footer-img').classList.add('review-form-img');
    });
</script>
