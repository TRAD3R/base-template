<?php
/**
 * @var \yii\web\View $this
 * @var array $clients
 * @var array $reviews
 */

use App\App;
use App\Helpers\Url;

?>
<section class="section section-reviews bg-overlay">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <p class="headers-h1 page-title text-center">Отзывы наших клиентов</p>
                <div class="review-carousel__wrapper">
                    <?php if ($reviews):?>
                        <div class="review-carousel owl-carousel">
                            <?php foreach ($reviews as $review) : ?>
                                <div class="review-item panel bg-light">
                                    <div class="review-item__author user-data">
                                        <div class="user-data__header">
                                            <div class="user-data__avatar">
                                            </div>
                                            <div class="user-data__info">
                                                <p class="headers-h3 c-accent__darken"><?= $review->user->getShortname(); ?></p>
                                                <p class="dr-text__small c-accent__darken"><?= $review->user->company; ?></p>
                                                <p class="dr-text__normal c-accent__darker"><?= (new DateTime($review->date_created))->format('d-m-Y'); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="quotes c-accent">“</p>
                                    <p class="review-item__text c-accent__darker">
                                        <?= $review->text; ?>
                                    </p>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <p class="c-accent__lightest dr-text__normal review-carousel__pages">
                            1 из <?=count($reviews)?>
                        </p>
                    <?php endif;?>

                    <?php if(App::i()->getCurrentUser()):?>
                        <div class="text-center mb-100">
                            <a href="<?=Url::toRoute('review/add')?>" class="dr-btn dr-btn__orange-gradient w-100 max-w-200">Оставить отзыв</a>
                        </div>
                    <?php endif;?>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="readmore">
            <div class="readmore-content">
                <div class="clients-list">
                    <p class="text-center w-100 headers-h1 page-title c-accent__darken">Наши клиенты</p>
                    <div id="our-clients" class="row">
                        <?=$this->render('_clients', ['clients' => $clients])?>
                    </div>
                </div>
                <div class="readmore-overlay"></div>
            </div>
            <div id="show-more" class="readmore-btn__wrapper">
                <a href="javascript:void(0)" class="headers-h3 d-flex flex-column align-items-center c-accent__darken" onclick="Clients.getNext()">
                    Показать ещё
                    <span class="ic-arrow-down mt-10"></span>
                </a>
            </div>
        </div>
    </div>
</section>

<script>
    var Clients = {
        page: 1,
        getNext: function () {
            this.page++;
            $.ajax({
                url: '/reviews/next/' + this.page,
                method: 'GET'
            }).done(res => {
                let content = $('.readmore-content');
                let clients = $('#our-clients')
                let showMore = $('#show-more')
                if(res.view) {
                    clients.append(res.view);
                    content.removeAttr('style');
                }
                if (!res.hasMore) {
                    showMore.hide();
                }
            })
        }
    }
</script>