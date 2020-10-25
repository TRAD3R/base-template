<?php

use App\Helpers\Url;
use App\Models\Specialty;
use App\Params;
use yii\widgets\ActiveForm;

/**
 * @var $this \yii\web\View
 * @var $education_high Specialty
 * @var $education_middle Specialty
 * @var $highIsNotAvailable bool
 */
$education_high = Specialty::getHigher();
$education_middle = Specialty::getMiddle();

?>

<div class="section section-configurator section-configurator__3 bg-overlay bg-accent-gradient__darken">
    <div class="container">
        <div class="configurator-box">
            <div class="modal-content modal-content__horizontal bg-accent__darker">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="configurator-box__inner">
                            <div class="configurator-box__header text-center">
                                <p class="dr-text__normal c-accent__lighter mb-0">Конфигуратор</p>
                                <p class="dr-text__normal">Шаг 3 из 7</p>
                            </div>
                            <div class="configurator-box__body">
                                <h2 class="headers-h2 text-center">Выберите специальности</h2>
                            </div>
                            <div class="configurator-box__footer">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="configurator-box__inner">
                            <ol class="list-content__numeric">
                                <li><b>Выберите специальность или специальности, по которым вы и ваши сотрудники (при
                                        наличии) обучались.</b></li>
                                <li><b>Нажмите на «Сертификат специалиста» в появившмеся меню специальности.</b> Этим вы
                                    подтверждаете, что у вас на руках есть Диплом о среднем медицинском образовании и
                                    сертификат специалиста по выбранной специальности.
                                </li>
                                <li><b>Станет активен пункт «Стаж 3 года» для среднего образования или «Стаж 5 лет» для высшего образования.
                                        Нажмите его.</b> Этим вы подтверждаете, что у вас
                                    есть стаж по выбираемой специальности и вы имеете об этом запись в вашей
                                    трудовой книжке. Теперь эта специальность выбрана.
                                </li>
                                <li><b>После выбора одной специальности вы можете выбрать другую специальность,</b> при
                                    условии, что имеете по ней сертификат специалиста и необходимый стаж. <span
                                            class="c-orange">После того,
                                    как вы перейдете в следующий раздел Конфигуратора выбрать другую специальность будет
                                    нельзя. Помните об этом!</span>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php if (!$highIsNotAvailable) : ?>
            <h3 class="headers-h3 mt-30">Высшее образование</h3>
            <div class="list-content__wrapper list-selection list-selection-js education_higher" id="high-education">
                <?= $this->render('education-list', ['list' => $education_high, 'experience' => '5 лет']) ?>
            </div>
        <?php endif; ?>
        <h3 class="headers-h3 mt-30">Среднее образование</h3>
        <div class="list-content__wrapper list-selection list-selection-js" id="middle-education">
            <?= $this->render('education-list', ['list' => $education_middle, 'experience' => '3 года']) ?>
        </div>
        <div class="text-center mt-100 pb-90">
            <button class="btn-next dr-btn dr-btn__disabled dr-btn__accent-lightest w-100 max-w-400" id="btn-submit">Специальности выбраны
            </button>
        </div>
        <div class="list-selection__templates" style="display: none;">
            <div class="list-selection__item-selected bg-accent__darker">
                <span class="list-selection__item__close"></span>
                <p class="list-selection__selected-title dr-text__normal mb-0"><b>@value@</b></p>
                <div class="dr-btn-group">
                    <label class="checkbox checkbox-btn">
                        <input type="checkbox" class="check-certificate">
                        <span class="checkbox-inner">
                        <span class="checkbox-box">

                        <svg class="checkbox-svg__active" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9 11L12 14L22 4" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M21 12V19C21 19.5304 20.7893 20.0391 20.4142 20.4142C20.0391 20.7893 19.5304 21 19 21H5C4.46957 21 3.96086 20.7893 3.58579 20.4142C3.21071 20.0391 3 19.5304 3 19V5C3 4.46957 3.21071 3.96086 3.58579 3.58579C3.96086 3.21071 4.46957 3 5 3H16" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>

                        <svg class="checkbox-svg__disabled" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="1" y="1" width="18" height="18" rx="3" stroke="#17343E" stroke-width="2"/>
                        </svg>


                        </span>
                        <span class="checkbox-text dr-text__small">Сертификат</span>
                    </span>
                    </label>
                    <label class="checkbox checkbox-btn">
                        <input type="checkbox" class="check-experience">
                        <span class="checkbox-inner">
                        <span class="checkbox-box">

                        <svg class="checkbox-svg__active" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9 11L12 14L22 4" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M21 12V19C21 19.5304 20.7893 20.0391 20.4142 20.4142C20.0391 20.7893 19.5304 21 19 21H5C4.46957 21 3.96086 20.7893 3.58579 20.4142C3.21071 20.0391 3 19.5304 3 19V5C3 4.46957 3.21071 3.96086 3.58579 3.58579C3.96086 3.21071 4.46957 3 5 3H16" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>

                        <svg class="checkbox-svg__disabled" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="1" y="1" width="18" height="18" rx="3" stroke="#17343E" stroke-width="2"/>
                        </svg>


                        </span>
                        <span class="checkbox-text dr-text__small">
                        Стаж @experience_val@
                        </span>
                    </span>
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>
<!--115-->

<?php $form = ActiveForm::begin(['id' => 'education-form', 'class' => 'd-none', 'action' => Url::toRoute(['configurator/property'])]) ?>
<input type="text" name="<?= Params::HIGH_EDUCATION ?>" value="">
<input type="text" name="<?= Params::MIDDLE_EDUCATION ?>" value="">
<?php ActiveForm::end() ?>

<script>
    function getEducation(highEducation) {
        let educations = [];
        highEducation.find('.selected').each(function () {
            let certificate = $(this).find('.check-certificate').eq(0).prop('checked');
            let experience = $(this).find('.check-experience').eq(0).prop('checked');
            if (certificate && experience) {
                educations.push($(this).data('id'));
            }
        })
        return educations.join(",");
    }

    $('#btn-submit').on('click', function () {
        let highEducation = $('#high-education');
        let middleEducation = $('#middle-education');
        let educationForm = $('#education-form');
        educationForm.find('input[name="<?=Params::HIGH_EDUCATION?>"]').val(getEducation(highEducation));
        educationForm.find('input[name="<?=Params::MIDDLE_EDUCATION?>"]').val(getEducation(middleEducation));
        educationForm.submit();
    })
</script>
