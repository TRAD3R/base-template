<?php
/**
 * @var $this \yii\web\View
 * @var $occupations array
 */

use App\App;
use App\Models\Occupation;
use App\Params;

?>

<div class="section section-configurator_ppk bg-overlay">
    <div class="container">
        <h1 class="headers-h1 c-light text-center mb-50"><?=$this->title?></h1>
        <div class="configurator-box mb-50">
            <div class="modal-content modal-content__horizontal bg-accent__darker">

                <div class="configurator-box__header text-center">
                    <p class="dr-text__normal c-accent__lighter mb-0">Конфигуратор</p>
                    <p class="dr-text__normal">Шаг 1</p>
                </div>
                <div class="configurator-box__body">
                    <h2 class="headers-h2 text-center">Выберите область деятельности <br>для которой
                        требуется составить ППК
                        <br>(программу производственного контроля)</h2>
                    <div class="row mt-80">
                        <div id="programs" class="radio-group__wrapper radio-group__masonry d-flex flex-wrap w-100">
                            <?php foreach ($occupations as $key => $children) :?>
                                <div class="radio-group__item col-12 col-sm-6 col-md-6">
                                    <div class="radio-group">
                                        <p class="radio-group__title c-accent__lightest">
                                            <?=Occupation::getParentTitle($key)?>
                                        </p>
                                        <ul class="radio-group__list">
                                            <?php foreach ($children as $occupation):?>
                                                <li>
                                                    <label class="radio radio-default">
                                                        <input type="radio" name="ppk-step1" value="<?=$occupation->id?>">
                                                        <span class="radio-inner">
                                                            <span class="radio-box"></span>
                                                            <span class="radio-text dr-text__normal"><?=$occupation->title?></span>
                                                        </span>
                                                    </label>
                                                </li>
                                            <?php endforeach;?>
                                        </ul>
                                    </div>
                                </div>
                            <?php endforeach;?>
                        </div>
                    </div>
                </div>
                <div class="configurator-box__footer">
                    <div class="w-100 d-flex justify-content-center text-center mb-50">
                        <button id="next" class="dr-btn dr-btn__orange-gradient max-w-300 w-100">дальше</button>
                    </div>
                </div>
                <form id="selected-program" method="post" class="d-none">
                    <input id="<?=Params::PPK_PROGRAM?>" type="number" name="<?=Params::PPK_PROGRAM?>" value="">
                    <input type="text" name="_csrf" value="<?= App::i()->getRequest()->getCsrf() ?>">
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.querySelector('#main').classList.add('bg-accent-gradient__lighten');

    $('#next').on('click', function (){
        let program = $("#programs").find('input[name="ppk-step1"]:checked');

        if(typeof program.val() == "undefined") {
            alert('Следует выбрать хотя бы 1 программу');
            return;
        }

        let form = $("#selected-program");
        form.find('input#<?=Params::PPK_PROGRAM?>').val(program.val());
        form.submit();
    })
</script>
