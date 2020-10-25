<?php
/**
 * @var RegistrationForm $model
 */

use App\App;
use App\Forms\Main\User\RegistrationForm;
use App\Helpers\Url;
use App\Html;
use yii\widgets\ActiveForm;

?>
<section class="section section-auth">
    <div class="container">
        <div class="row">
            <div class="col-12">
<!--                --><?//= Html::errorSummary($model, ['encode' => false]) ?>
                <div class="modal modal-wpadding">
                    <div class="modal-content bg-accent">
                        <p class="modal-title headers-h2 mt-30"><?=$this->title?></p>
                        <?php
                            $form = ActiveForm::begin([
                                'id'                     => 'registration-form',
                                'options'                => [
                                    'class' => 'dr-form modal-content__wrapper'
                                ],
                                'fieldConfig' => [
                                    'template' => '{input}{error}',
                                    'errorOptions' => [
                                        'class' => 'form-group__message error'
                                    ]
                                ],
                            ]);
                        ?>
                                <?=$form->field($model, 'firstname')
                                ->textInput([
                                        'class' => 'dr-form-control form-control',
                                        'required' => true,
                                        'placeholder' => $model->getAttributeLabel('firstname')
                                        ])->label(false);
                                ?>
                                <?=$form->field($model, 'secondname')
                                    ->textInput([
                                        'class' => 'dr-form-control form-control',
                                        'placeholder' => $model->getAttributeLabel('secondname')
                                    ])->label(false);
                                ?>
                                <?=$form->field($model, 'lastname')
                                    ->textInput([
                                        'class' => 'dr-form-control form-control',
                                        'required' => true,
                                        'placeholder' => $model->getAttributeLabel('lastname')
                                    ])->label(false);
                                ?>
                                <?=$form->field($model, 'phone_number')
                                    ->input('tel', [
                                        'class' => 'dr-form-control form-control mask-tel-registr',
                                        'required' => true,
                                        'placeholder' => $model->getAttributeLabel('phone_number'),
                                    ])->label(false);
                                ?>
                                <?=$form->field($model, 'email')
                                    ->input('email', [
                                        'class' => 'dr-form-control form-control',
                                        'required' => true,
                                        'placeholder' => $model->getAttributeLabel('email'),
                                    ])->label(false);
                                ?>
                                <?=$form->field($model, 'company')
                                    ->textInput([
                                        'class' => 'dr-form-control form-control',
                                        'placeholder' => $model->getAttributeLabel('company')
                                    ])->label(false);
                                ?>
                                <?=$form->field($model, 'password')
                                    ->passwordInput([
                                        'id' => "id-password",
                                        'class' => 'dr-form-control form-control',
                                        'required' => true,
                                        'placeholder' => $model->getAttributeLabel('password'),
                                        'title'=>"Минимум 8 символов, одна цифра, одна заглавная и одна строчная буква",
                                    ])->label(false);
                                ?>
                                <?=$form->field($model, 'password_repeat')
                                    ->passwordInput([
                                        'id' => "id-confirm-password",
                                        'class' => 'dr-form-control form-control',
                                        'required' => true,
                                        'placeholder' => $model->getAttributeLabel('password_repeat'),
                                    ])->label(false);
                                ?>

                                <div class="row">
                                    <div class="g-recaptcha col-sm-12 col-xs-12" data-sitekey="<?=App::i()->getApp()->params['captcha']['siteKey'];?>" data-callback="correctCaptcha"></div>
                                </div>
                                <?= $form->field($model, 'recaptcha')->hiddenInput(['id' => 'g-recaptcha-register'])->label(false);?>
                                <p class="alert msg-validate" role="alert"></p>
                            <div class="form-group text-center align-items-center">
                                <?=Html::submitButton('Создать аккаунт', ['class' => 'dr-btn dr-btn__orange-gradient'])?>
                            </div>
                        <?php ActiveForm::end() ?>

                        <p class="dr-text__small text-center c-light">
                            Уже зарегистрированы?
                            <a href="<?=Url::toRoute('auth/login')?>" class="dr-text__normal c-orange"><b>Авторизуйтесь</b></a>
                        </p>
                    </div>
                </div>
                <p class="dr-text__small c-accent__lightest text-center mt-10 max-w-400">
                    <?=$this->render('/site/template-parts/terms-policy', ['firstPart' => 'Регистрируясь'])?>
                </p>
            </div>
        </div>
    </div>
</section>

<script src="https://www.google.com/recaptcha/api.js?hl=ru" async defer></script>
<script>
    document.body.classList.add('bg-accent-gradient__darken');

    var correctCaptcha = function(response) {
        if(response.length){
            document.querySelector('#g-recaptcha-register').value = response;
        }else{
            document.querySelector('#recaptcchaError').innerHTML = 'Подтвердите, что Вы не робот';
        }
    };
</script>