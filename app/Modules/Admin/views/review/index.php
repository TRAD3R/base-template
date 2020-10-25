<?php

use App\Html;
use App\Models\Review;


/* @var $this yii\web\View */
/* @var $reviews Review[] */

$this->title = 'Отзывы';
?>
<div class="regions-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>Дата добавления</th>
            <th>
                Автор
            </th>
            <th>
                Текст
            </th>
            <th class="action-column"></th>
        </tr>
        </thead>
        <tbody>
            <?php foreach ($reviews as $review): ?>
                <tr class="
                <?php
                    switch ($review->status){
                        case Review::STATUS_ACCEPT:
                            echo 'review-status-accept';
                            break;
                        case Review::STATUS_REJECT:
                            echo 'review-status-reject';
                            break;
                    }
                ?>" data-key="<?=$review->id?>">
                    <td class="review-date" data-text="<?=(new DateTime($review->date_created))->format("Y-m-d H:i")?>">
                        <?=(new DateTime($review->date_created))->format("Y-m-d H:i")?>
                    </td>
                    <td>
                        [<?=$review->user->id?>]<?=$review->user->getShortname()?>
                    </td>
                    <td class="review-text">
                        <textarea class="hidden" rows="1" style="width: 100%"><?=$review->text?></textarea>
                        <span>
                            <?=$review->text?>
                        </span>
                    </td>
                    <td>
                        <div class="row">
                            <div class="col-12">
                                <?php if ($review->status == Review::STATUS_NEW):?>
                                    <div class="review-action col-6">
                                        <span class="glyphicon glyphicon-ok review-accept" title="Принять"></span>
                                        <span class="glyphicon glyphicon-remove review-reject" title="Отклонить"></span>
                                    </div>
                                <?php endif; ?>
                                <div class="review-action-global col-6">
                                    <span class="glyphicon glyphicon-pencil review-edit" title="Редактировать"></span>
                                    <span class="glyphicon glyphicon-trash review-remove" title="Удалить"></span>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</div>

<script>
    const BODY = $('body');
    BODY.on('click', '.review-accept', function () {
        let review = $(this).closest('tr');
        $.ajax({
            url: "/admin/reviews/accept/" + review.data('key')
        }).done(function(res) {
            if(res.status) {
                review.addClass('review-status-accept');
                review.find('.review-action').hide();
            } else {
                alert('Что-то пошло не так. Попробуйте еще раз');
            }
        }).fail(() => {
            alert('Не правильная отправка данных');
        });
    });

    BODY.on('click', '.review-reject', function () {
        let review = $(this).closest('tr');
        $.ajax({
            url: "/admin/reviews/reject/" + review.data('key')
        }).done(function(res) {
            if(res.status) {
                review.addClass('review-status-reject');
                review.find('.review-action').hide();
            } else {
                alert('Что-то пошло не так. Попробуйте еще раз');
            }
        }).fail(() => {
            alert('Не правильная отправка данных');
        })
    })

    BODY.on('click', '.review-edit', function () {
        let review = $(this).closest('tr');
        let date = review.find('.review-date');
        let text = review.find('.review-text');
        date.html('<input type="datetime-local" name="date" value="' + date.data('text') + '">')
        text.find('span').addClass('hidden');
        text.find('textarea').removeClass('hidden');
        review.find('.review-edit').removeClass('glyphicon-pencil').addClass('glyphicon-ok');
        review.find('.review-edit').removeClass('review-edit').addClass('review-send');
        review.find('.review-remove').removeClass('glyphicon-trash').addClass('glyphicon-remove');
        review.find('.review-remove').removeClass('review-remove').addClass('review-cancel');
    });

    BODY.on('click', '.review-cancel', function () {
        let review = $(this).closest('tr');
        let date = review.find('.review-date');
        let text = review.find('.review-text');
        date.html(date.data('text'));
        text.find('span').removeClass('hidden');
        text.find('textarea').addClass('hidden');
        review.find('.review-send').removeClass('glyphicon-ok').addClass('glyphicon-pencil');
        review.find('.review-send').removeClass('review-send').addClass('review-edit');
        review.find('.review-cancel').removeClass('glyphicon-remove').addClass('glyphicon-trash');
        review.find('.review-cancel').removeClass('review-cancel').addClass('review-remove');
    });

    BODY.on('click', '.review-send', function (){
        let review = $(this).closest('tr');
        let date = review.find('.review-date').find('input').val();
        let text = review.find('.review-text').find('textarea').val();
        $.ajax({
            url: "/admin/reviews/edit/" + review.data('key'),
            method: 'POST',
            data: {
                'date': date,
                'text': text
            }
        }).done(function(res) {
            if(res.status) {
                location.href = "";
            } else {
                alert('Что-то пошло не так. Попробуйте еще раз');
            }
        }).fail(() => {
            alert('Не правильная отправка данных');
        })
    })

    BODY.on('click', '.review-remove', function () {
        let review = $(this).closest('tr');
        $.ajax({
            url: "/admin/reviews/remove/" + review.data('key')
        }).done(function(res) {
            if(res.status) {
                review.remove();
            } else {
                alert('Что-то пошло не так. Попробуйте еще раз');
            }
        }).fail(() => {
            alert('Не правильная отправка данных');
        })
    })

</script>