<?php

use App\Forms\Main\LegalAssistanceForm;
use App\Helpers\Url;
use App\Html;
use App\Params;
use yii\widgets\ActiveForm;

/**
 * @var \yii\web\View $this
 * @var $model LegalAssistanceForm
 * @var $status string
 */

?>

<script>
    document.body.classList.add('bg-accent-gradient__lighten');
</script>

<section class="section section-prav-help bg-accent-gradient__lighten">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="headers-h1 page-title text-center w-100 c-light"><?=$this->title?></h1>
                <div class="modal modal-wpadding">
                    <div class="modal-content bg-accent__lighter max-w-1000 pb-90">
                        <?php
                        $form = ActiveForm::begin([
                            'options' => [
                                'class' => 'dr-form modal-content__wrapper max-w-650 mt-30 flex-column'
                            ],
                            'fieldConfig' => ['template' => "{input}"]
                        ]);
                        ?>
                            <div class="form-group">
                                <?= $form->field($model, 'question')
                                    ->textarea([
                                        'class' => 'dr-form-control form-control min-h-190',
                                        'required' => true,
                                        'placeholder' => "Ваше сообщение",
                                    ])->label(false);
                                ?>
                            </div>
                            <p class="dr-text__small c-light text-center">
                                <?=$this->render('template-parts/terms-policy', ['firstPart' => 'Отправляя сообщение'])?>
                            </p>
                            <div class="form-group text-center">
                                <?= Html::submitButton('Отправить', [
                                        'class' => 'dr-btn dr-btn__orange-gradient  w-100 max-w-300',
                                    'onclick' => 'thanx()'
                                ]) ?>
                            </div>
                            <p id='thanx' class="dr-text__small c-light text-center" style="display: none">
                                Ваш запрос отправляется. Спасибо!
                            </p>
                        <?php ActiveForm::end() ?>
                    </div>
                </div>
                <img src="/images/_src/frame-13.svg" class="prav-help-img" alt="">
            </div>
        </div>
    </div>

</section>
<?=$this->render('@modals/modal_thanks', ['pretext' => '']);?>
<script>
    const TIMER_COUNT = 10;
    $(document).ready(function (){
        if('<?=$status?>' === '<?=Params::STATUS_OK?>') {
            drModalShow('modal_thanks');
            startTimerSeconds(function (){location.href = '<?=Url::toRoute(['site/section'])?>'});
        }
    })
</script>