<?php
/**
 * @var \App\Forms\Main\User\RecoveryPasswordForm $model
 */

use App\Helpers\Url;
use App\Html;
use yii\widgets\ActiveForm;
?>

<section class="section section-auth bg-accent-gradient__lighten">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="modal modal-wpadding">
                    <div class="modal-content bg-accent__darker">
                        <p class="modal-title headers-h2 mt-30"><?=$this->title?></p>
                        <?php
                            $form = ActiveForm::begin([
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
                            <div class="form-group">
                                <?=$form->field($model, 'email')
                                    ->input('email', [
                                        'class' => 'dr-form-control form-control',
                                        'required' => true,
                                        'placeholder' => $model->getAttributeLabel('email'),
                                    ])->label(false);
                                ?>
                            </div>

                            <div class="form-group text-center">
                                <?=Html::submitButton('Сбросить пароль', ['class' => 'dr-btn dr-btn__orange-gradient w100 max-w-200'])?>
                            </div>
                        <?php ActiveForm::end() ?>

                        <p class="dr-text__small text-center c-light ">
                            Еще не зарегистрированы?
                            <a href="<?=Url::toRoute('auth/registration')?>" class="dr-text__normal c-orange"><b>Зарегистрироваться</b></a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.body.classList.add('bg-accent-gradient__lighten');
</script>