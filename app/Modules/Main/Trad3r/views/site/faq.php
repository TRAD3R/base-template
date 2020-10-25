<?php

/**
 * @var \yii\web\View $this
 * @var \App\Models\Faq[] $faq
 */
?>

<section class="section section-website-sections bg-accent__super-lightest">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="headers-h1 text-center page-title c-accent__darken"><?=$this->title?></h1>

                <div class="toggle-wrapper">
                    <?php foreach ($faq as $item) :?>
                        <div class="toggle">
                            <div class="toggle-header">
                                <div class="toggle-header__title">
                                    <h3 class="headers-h3 c-accent__darken"><?=$item->question?></h3>
                                </div>
                                <button type="button" class="dr-btn dr-btn__circle toggle-btn">
                                </button>
                            </div>
                            <div class="toggle-content">
                                <div class="toggle-content__wrapper">
                                    <?=$item->answer?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach;?>
                </div>
            </div>
        </div>
    </div>
</section>
