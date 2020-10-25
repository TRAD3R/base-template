<?php

use App\App;
use App\Helpers\Url;
use App\Html;
use App\Params;
use yii\widgets\ActiveForm;

/**
 * @var $model \App\Forms\Main\FeedbackForm
 * @var $status string
 * @var string $requisites
 */

$this->title = 'Контакты';
?>

<script>
    document.body.classList.add('bg-accent-gradient__lighten');
</script>

<section class="section section-auth">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="page-title headers-h1 text-center c-light"><?=$this->title?></h1>
                <p class="headers-h3 text-center d-flex flex-column mb-50">
                    <a href="tel:+7 999 888 77 66" class="c-light">+7 999 888 77 66</a>
                    <a href="mailto:info@medlicense.ru" class="c-light">info@medlicense.ru</a>
                </p>
                <div class="modal modal-wpadding">
                    <div class="modal-content bg-accent__lighter">
                        <p class="modal-title headers-h2 mt-30">Форма обратной связи</p>
                        <?php
                        $form = ActiveForm::begin([
                            'options' => [
                                'class' => 'dr-form modal-content__wrapper'
                            ],
                            'fieldConfig' => ['template' => "{input}"]
                        ]);
                        ?>
                        <div class="form-group">
                            <?= $form->field($model, 'name')
                                ->textInput([
                                    'class' => 'dr-form-control form-control',
                                    'required' => true,
                                    'placeholder' => $model->getAttributeLabel('name'),
                                ])->label(false);
                            ?>
                        </div>
                        <div class="form-group">
                            <?= $form->field($model, 'email')
                                ->textInput([
                                    'class' => 'dr-form-control form-control',
                                    'required' => true,
                                    'placeholder' => $model->getAttributeLabel('email'),
                                ])->label(false);
                            ?>
                        </div>
                        <div class="form-group">
                            <?= $form->field($model, 'message')
                                ->textarea([
                                    'class' => 'dr-form-control form-control min-h-190',
                                    'required' => true,
                                    'placeholder' => $model->getAttributeLabel('message'),
                                ])->label(false);
                            ?>
                        </div>
                        <div class="row">
                            <div class="g-recaptcha col-sm-12 col-xs-12" data-sitekey="<?=App::i()->getApp()->params['captcha']['siteKey'];?>" data-callback="correctCaptcha"></div>
                        </div>
                        <?= $form->field($model, 'recaptcha')->hiddenInput(['id' => 'g-recaptcha-register'])->label(false);?>
                        <div class="form-group d-flex align-items-center justify-content-center text-center">
                            <?= Html::submitButton('Отправить', [
                                'class' => 'dr-btn dr-btn__orange-gradient',
                                'onclick' => 'thanx()'
                            ]) ?>
                        </div>
                        <p id='thanx' class="dr-text__small c-light text-center" style="display: none">
                            Ваш запрос отправляется. Спасибо!
                        </p>
                        <p class="dr-text__small c-light text-center">
                            <?=$this->render('template-parts/terms-policy', ['firstPart' => 'Отправляя сообщение'])?>
                        </p>
                        <? ActiveForm::end() ?>
                    </div>
                </div>
                <div class="modal modal-wpadding">
                    <div class="toggle-wrapper mt-60" style="max-width: 600px;">
                        <div class="toggle">
                            <div class="toggle-header">
                                <div class="toggle-header__title">
                                    <h3 class="headers-h3 c-accent__darken">Наши реквизиты</h3>
                                </div>
                                <button type="button" class="dr-btn dr-btn__circle toggle-btn">
                                </button>
                            </div>
                            <div class="toggle-content">
                                <div class="toggle-content__wrapper">
                                    <?=$requisites?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
<?=$this->render('@modals/modal_thanks', ['pretext' => '']);?>
<script src="https://www.google.com/recaptcha/api.js?hl=ru" async defer></script>
<script>
    const TIMER_COUNT = 10;
    $(document).ready(function (){
        if('<?=$status?>' === '<?=Params::STATUS_OK?>') {
            drModalShow('modal_thanks');
            startTimerSeconds(function (){location.href = '<?=Url::toRoute(['site/section'])?>'});
        }
    })

    var correctCaptcha = function(response) {
        if(response.length){
            document.querySelector('#g-recaptcha-register').value = response;
        }else{
            document.querySelector('#recaptcchaError').innerHTML = 'Подтвердите, что Вы не робот';
        }
    };

    function thanx()
    {
        let form = $(this).closest('form');
        $('#thanx').show();
        form.submit();
    }
</script>