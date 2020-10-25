<?php

use App\Forms\Main\UploadForm;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var UploadForm $model
 * @var int $price
 */

?>

<section class="section section-expertize">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="headers-h1 page-title c-accent__darker"><?=$this->title?></h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6">
                <p class="headers-h3 c-accent">С помощью сервиса «Экспертиза документов» вы сможете получить
                    квалифицированную экспертизу, не выходя из дома.</p>
                <br>
                <p class="c-accent__darker mb-80">
                    <span class="headers-h1"><?= $price ?> ₽</span> <span
                            class="dr-text__normal"><b>за 1 документ</b></span>
                </p>
                <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data'],
                ]) ?>
                <div class="fl_upld">
                    <span class="fl_upld__btn dr-btn dr-btn__big dr-btn__outline c-orange w-100 max-w-400 ml-0 mb-0">
                            <span class="fl_upld__btn_lbl"
                                  data-text-alternate="Загрузить еще">Загрузить</span>
                            <span class="fl_tracker" style="display: none;">0</span>
                        </span>
                    <span class="fl_field__list">
                          <?= Html::activeInput('file', $model, 'files[]',
                              [
                                  'id' => false,
                                  'multiple' => true,
                                  'hidden' => true,
                                  'class' => 'fl_default fl_default_ex',
                                  'accept'=>".jpg, .jpeg, .png, .gif, .pdf, .doc, .docx, .odt",
                                  'data-id' => 0
                              ])?>
                        </span>
<!--                    <label>-->
<!--                        <span class="dr-btn dr-btn__big dr-btn__outline c-orange w-100 max-w-400 ml-0 mb-0">-->
<!--                          <span>-->
<!--                            <span>Загрузить</span>-->
<!--                              --><?//= $form->field($model, 'files[]')
//                                  ->fileInput(['multiple' => false, 'hidden' => true, 'class' => 'fl_default fl_default_ex', 'accept'=>".jpg, .jpeg, .png, .gif, .pdf, .doc, .docx, .odt"])
//                                  ->label(false) ?>
<!--                          </span>-->
<!--                        </span>-->
<!--                    </label>-->
                    <div class="fl_nm"></div>
                </div>

                <?= Html::submitButton('отправить на экспертизу'
                    , [
                        'class' => 'dr-btn dr-btn__big dr-btn__orange-gradient w-100 max-w-400 ml-0 mb-30',
                    ]) ?>

                <?php ActiveForm::end() ?>

                <ul>
                    <li class="dr-text__small c-accent__darker w-100" style="list-style-type: '\2738'">
                        Вы можете загрузить для экспертизы документы в форматах jpg, jpeg, png, gif, pdf, doc, docx, odt.
                    </li>
                    <li class="dr-text__small c-accent__darker w-100" style="list-style-type: '\2738'">
                        Максимум 20 документов общим размером до 20 МБ.
                    </li>
                </ul>
            </div>
            <div class="col-12 col-md-6">
                <div class="section-image">
                    <img src="/images/_src/frame-12.svg" alt="">
                </div>
            </div>
        </div>
    </div>
</section>


