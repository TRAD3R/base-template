<?php
/**
 * @var ChangePasswordForm $model
 */

use App\Forms\Main\User\ChangePasswordForm;
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
                            <?=$form->field($model, 'password')
                                ->passwordInput([
                                    'class' => 'dr-form-control form-control',
                                    'required' => true,
                                    'placeholder' => $model->getAttributeLabel('password'),
                                ])->label(false);
                            ?>
                        </div>
                        <div class="form-group">
                            <?=$form->field($model, 'password_repeat')
                                ->passwordInput([
                                    'class' => 'dr-form-control form-control',
                                    'required' => true,
                                    'placeholder' => $model->getAttributeLabel('password_repeat'),
                                ])->label(false);
                            ?>
                        </div>

                        <div class="form-group text-center">
                            <?=Html::submitButton('Изменить пароль', ['class' => 'dr-btn dr-btn__orange-gradient w100 max-w-200'])?>
                        </div>
                        <?php ActiveForm::end() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.body.classList.add('bg-accent-gradient__lighten');
</script>