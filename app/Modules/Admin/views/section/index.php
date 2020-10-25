<?php

/**
 * @var $this View
 * @var $sections \App\Models\Section[]
 * @var $pagination Pagination
 */

use yii\data\Pagination;
use yii\web\View;

?>


<section class="section section-website-sections bg-accent-gradient__lighten">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="headers-h1 text-center page-title c-accent__darker">Разделы сайта</h1>

                <?php include 'template-parts/service-list.php'; ?>

            </div>
        </div>
    </div>
</section>
