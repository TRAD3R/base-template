<?php
use App\App;
use App\Html;
use App\Models\Faq;
use App\Params;

/* @var $this yii\web\View */
/* @var $faq Faq[] */



$this->title = 'Вопрос-ответ';
?>
<div>

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <button class="btn btn-success faq-add">Добавить вопрос</button>
    </p>

    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>#</th>
            <th>
                Вопрос
            </th>
            <th>
                Ответ
            </th>
            <th class="action-column"></th>
        </tr>
        </thead>
        <tbody>
            <tr class="empty-row" style="display: none">
                <td></td>
                <td class="faq-question">
                    <input type="text">
                </td>
                <td class="faq-answer">
                    <textarea type="text" class="edit-textarea"></textarea>
                </td>
                <td>
                    <div class="сlient-action">
                        <span class="glyphicon glyphicon-ok faq-accept" title="Принять"></span>
                        <span class="glyphicon glyphicon-remove faq-reject" title="Отклонить"></span>
                    </div>
                </td>
            </tr>
            <?php foreach ($faq as $key => $item): ?>
                <tr data-key="<?=$item['id']?>">
                    <td><?=$key?></td>
                    <td class="faq-question" data-value="<?=$item->question?>">
                        <span>
                            <?=$item->question?>
                        </span>
                    </td>
                    <td class="faq-answer" data-value="<?=$item->answer?>">
                        <span>
                            <?=$item->answer?>
                        </span>
                    </td>
                    <td>
                        <div class="faq-edit">
                            <span class="glyphicon glyphicon-pencil" title="Редактировать"></span>
                        </div>
                        <div class="сlient-action" style="display: none">
                            <span class="glyphicon glyphicon-ok faq-accept" title="Принять"></span>
                            <span class="glyphicon glyphicon-remove faq-reject" title="Отклонить"></span>
                        </div>
                    </td>
                </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</div>

<script>
    const BODY = $('body');
    /**
     * Редактирование данных клиента
     */
    BODY.on('click', '.faq-edit', function () {
        let faq = $(this).closest('tr');
        let faqQuestion = faq.find('.faq-question');
        let faqAnswer = faq.find('.faq-answer');

        faqQuestion.html('<input type="text" value="' + faqQuestion.data('value') + '">');
        faqAnswer.html('<textarea type="text" class="edit-textarea">' + faqAnswer.data('value') + '</textarea>');
        $(this).hide();
        $(this).next('div').show();
    });

    /**
     * Сохранение отредактированных данных
     */
    BODY.on('click', '.faq-accept', function (){
        let faq = $(this).closest('tr');
        let faqQuestion = faq.find('.faq-question');
        let faqAnswer = faq.find('.faq-answer');

        $.ajax({
            url: "/admin/faq/accept/" + faq.data('key'),
            method: "POST",
            data: {
                <?=Params::QUESTION?>: faqQuestion.find('input').val(),
                <?=Params::ANSWER?>: faqAnswer.find('textarea').val(),
                _csrf       : '<?= App::i()->getRequest()->getCsrf() ?>',
            }
        }).done(function(res) {
            if(res.status) {
                location.href = "";
            } else {
                alert('Что-то пошло не так. Попробуйте еще раз');
            }
        }).fail(() => {
            alert('Не правильная отправка данных');
        });
    });

    /**
     * Отмена редактирования
     */
    BODY.on('click', '.faq-reject', function (){
        let faq = $(this).closest('tr');
        if (faq.data('key') == 0) {
            faq.remove();
        }
        let faqQuestion = faq.find('.faq-question');
        let faqAnswer = faq.find('.faq-answer');
        faqQuestion.text(faqQuestion.data('value'));
        faqAnswer.text(faqAnswer.data('value'));
        $(this).closest('div').hide().prev('div').show();
    })

    // Добавление клиента
    $('.faq-add').on('click', function () {
        let tbody = BODY.find('tbody');
        let emptyRow = tbody.find('.empty-row');
        tbody.prepend("<tr data-key='0'>" + emptyRow.html() + "</tr>");
    })
</script>