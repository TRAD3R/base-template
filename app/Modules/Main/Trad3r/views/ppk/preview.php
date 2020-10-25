<?php

use App\Helpers\Url;

/**
 * @var \yii\web\View $this
 * @var \App\Models\Page $page
 */

?>
<section class="section section-ppk-preview-info bg-accent__super-lightest pb-90">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="headers-h1 text-center page-title c-accent__darken"><?=$this->title?></h1>
                <div class="max-w-820">
                    <div class="readmore">
                        <div class="readmore-content">
                            <div class="customizer-content">
                                <?=$page->content_1?>
                            </div>
                            <div class="readmore-overlay"></div>
                        </div>
                        <div class="w-100 d-flex justify-content-center text-center">
                            <a href="#" class="dr-btn dr-btn__outline dr-btn__accent max-w-300 w-100 readmore-btn  mt-60">читать дальше</a>
                        </div>
                    </div>
                    <div class="w-100 d-flex justify-content-center text-center mt-10">
                        <a href="<?=Url::toRoute(['ppk/step1'])?>" class="dr-btn dr-btn__orange-gradient max-w-300 w-100">перейти к оформлению</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
