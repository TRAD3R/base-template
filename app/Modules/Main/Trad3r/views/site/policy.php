<?php

/**
 * @var \yii\web\View $this
 * @var \App\Models\Page $page
 */

$this->title = 'Политика конфиденциальности';
?>
<section class="section section-license-work bg-accent__super-lightest pb-90">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="headers-h1 text-center page-title c-accent__darken"><?=$this->title?></h1>
                <div class="max-w-820">

                    <?=$page->content_1?>

                </div>
            </div>
        </div>
    </div>
</section>