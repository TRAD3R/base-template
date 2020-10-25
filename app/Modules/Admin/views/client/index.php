<?php

/* @var $this yii\web\View */
/* @var $clients Client[] */
/* @var $pagination Pagination */

use App\App;
use App\Html;
use App\Models\Client;
use App\Params;
use yii\data\Pagination;

$this->title = 'Клиенты';
?>
<div class="regions-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <button class="btn btn-success client-add">Добавить клиента</button>
    </p>

    <?= Html::pagination($this, $pagination); ?>

    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>#</th>
            <th>
                Имя
            </th>
            <th>
                Описание
            </th>
            <th class="action-column"></th>
        </tr>
        </thead>
        <tbody>
            <tr class="empty-row" style="display: none">
                <td></td>
                <td class="client-title">
                    <input type="text">
                </td>
                <td class="client-description">
                    <input type="text">
                </td>
                <td>
                    <div class="сlient-action">
                        <span class="glyphicon glyphicon-ok сlient-accept" title="Принять"></span>
                        <span class="glyphicon glyphicon-remove сlient-reject" title="Отклонить"></span>
                    </div>
                </td>
            </tr>
            <?php foreach ($clients as $key => $client): ?>
                <tr data-key="<?=$client['id']?>">
                    <td><?=$key?></td>
                    <td class="client-title" data-value="<?=$client['title']?>">
                        <textarea class="hidden" rows="1" style="width: 100%"><?=$client['title']?></textarea>
                        <span>
                            <?=$client['title']?>
                        </span>
                    </td>
                    <td class="client-description" data-value="<?=$client['description']?>">
                        <textarea class="hidden" rows="1" style="width: 100%"><?=$client['description']?></textarea>
                        <span>
                            <?=$client['description']?>
                        </span>
                    </td>
                    <td>
                        <div class="сlient-edit">
                            <span class="glyphicon glyphicon-pencil" title="Редактировать"></span>
                        </div>
                        <div class="сlient-action" style="display: none">
                            <span class="glyphicon glyphicon-ok сlient-accept" title="Принять"></span>
                            <span class="glyphicon glyphicon-remove сlient-reject" title="Отклонить"></span>
                        </div>
                    </td>
                </tr>
            <?php endforeach;?>
        </tbody>
    </table>
    <?= Html::pagination($this, $pagination); ?>
</div>

<script>
    const BODY = $('body');
    /**
     * Редактирование данных клиента
     */
    BODY.on('click', '.сlient-edit', function () {
        let client = $(this).closest('tr');
        let clientTitle = client.find('.client-title');
        let clientDescription = client.find('.client-description');

        clientTitle.find('span').addClass('hidden');
        clientTitle.find('textarea').removeClass('hidden');
        clientDescription.find('span').addClass('hidden');
        clientDescription.find('textarea').removeClass('hidden');
        $(this).hide();
        $(this).next('div').show();
    });

    /**
     * Сохранение отредактированных данных
     */
    BODY.on('click', '.сlient-accept', function (){
        let client = $(this).closest('tr');
        let clientTitle = client.find('.client-title');
        let clientDescription = client.find('.client-description');

        $.ajax({
            url: "/admin/clients/accept/" + client.data('key'),
            method: "POST",
            data: {
                <?=Params::TITLE?>: clientTitle.find('textarea').val(),
                <?=Params::DESCRIPTION?>: clientDescription.find('textarea').text(),
                _csrf       : '<?= App::i()->getRequest()->getCsrf() ?>',
            }
        }).done(function(res) {
            if(res.status) {
                // Редирект на последнюю страницу при добавлении клиента
                if (client.data('key') == 0) {
                    href = BODY.find('.pagination').eq(0).find('.last a').attr('href');
                }else{
                    href = "";
                }
                location.href = href;
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
    BODY.on('click', '.сlient-reject', function (){
        let client = $(this).closest('tr');
        if (client.data('key') == 0) {
            client.remove();
        }
        let clientTitle = client.find('.client-title');
        let clientDescription = client.find('.client-description');
        clientTitle.find('span').removeClass('hidden');
        clientTitle.find('textarea').addClass('hidden');
        clientDescription.find('span').removeClass('hidden');
        clientDescription.find('textarea').addClass('hidden');

        $(this).closest('div').hide().prev('div').show();
    })

    // Добавление клиента
    $('.client-add').on('click', function () {
        let tbody = BODY.find('tbody');
        let emptyRow = tbody.find('.empty-row');
        tbody.prepend("<tr data-key='0'>" + emptyRow.html() + "</tr>");
    })
</script>