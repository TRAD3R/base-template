<?php
/**
 * @var \App\Models\Material $material
 */

use App\Helpers\Url;
use App\Html;
use App\Macroses\Macros;


?>
<section class="section section-material max-w-820">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="material-header">
                    <h1 class="headers-h2 material-title c-accent__darker mb-0" ><?=$this->title?></h1>
                    <em class="headers-h5 material-date c-accent">
                        <?php $date = new DateTime($material->date_created);
                            echo sprintf("%s %s %s", $date->format('d'), Macros::getRusMonth($date->format('m')), $date->format('Y'))
                        ?>
                    </em>
                </div>
<!--                <div class="tag-list">-->
<!--                    --><?php //foreach ($material->getTags() as $tag) :?>
<!--                        <div class="tag-item bg-accent__super-lightest">-->
<!--                            <span class="c-accent__darken">--><?//=$tag?><!--</span>-->
<!--                        </div>-->
<!--                    --><?php //endforeach;?>
<!--                </div>-->
                <div class="material-body">
                    <?=Html::decode($material->description)?>
                </div>

                <div class="w-100 d-flex flex-column justify-content-center text-center">
                    <a href="<?=Url::toRoute(['site/materials'])?>" class="dr-btn dr-btn__outline dr-btn__accent c-accent max-w-300 w-100">
                        Вернуться ко всем вопросам в разделе «FAQ»
                    </a>
                    <a href="<?=Url::toRoute(['site/feedback'])?>" class="dr-btn dr-btn__outline max-w-300 w-100 c-orange">
                        Задать свой вопрос в разделе «Контакты»
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
