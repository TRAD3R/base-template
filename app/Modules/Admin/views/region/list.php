<?php
use App\App;
use App\Html;
use App\Models\Region;
use App\Params;

/* @var $this yii\web\View */
/* @var $regions Region[] */



$this->title = 'Регионы';
?>
<div class="regions-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <button class="btn btn-success region-add">Добавить регион</button>
    </p>

    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>Код</th>
            <th>
                Название
            </th>
            <th class="action-column"></th>
        </tr>
        </thead>
        <tbody>
            <tr class="empty-row" style="display: none">
                <td class="region-code">
                    <input type="text">
                </td>
                <td class="region-title">
                    <input type="text">
                </td>
                <td>
                    <div class="region-action">
                        <span class="glyphicon glyphicon-ok region-accept" title="Принять"></span>
                        <span class="glyphicon glyphicon-remove region-reject" title="Отклонить"></span>
                    </div>
                </td>
            </tr>
            <?php foreach ($regions as $key => $item): ?>
                <tr data-key="<?=$item['id']?>">
                    <td class="region-code" data-value="<?=$item['code']?>">
                        <span>
                            <?=$item['code']?>
                        </span>
                    </td>
                    <td class="region-title" data-value="<?=$item['name']?>">
                        <span>
                            <?=$item['name']?>
                        </span>
                    </td>
                    <td>
                        <div class="region-edit">
                            <span class="glyphicon glyphicon-pencil" title="Редактировать"></span>
                            <span class="glyphicon glyphicon-trash region-remove" title="Удалить"></span>
                        </div>
                        <div class="region-action" style="display: none">
                            <span class="glyphicon glyphicon-ok region-accept" title="Принять"></span>
                            <span class="glyphicon glyphicon-remove region-reject" title="Отклонить"></span>
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
    BODY.on('click', '.region-edit', function () {
        let tr = $(this).closest('tr');
        let title = tr.find('.region-title');
        let code = tr.find('.region-code');

        title.html('<input type="text" value="' + title.data('value') + '">');
        code.html('<input type="text" value="' + code.data('value') + '">');
        $(this).hide();
        $(this).next('div').show();
    });

    /**
     * Сохранение отредактированных данных
     */
    BODY.on('click', '.region-accept', function (){
        let tr = $(this).closest('tr');
        let title = tr.find('.region-title');
        let code = tr.find('.region-code');

        $.ajax({
            url: "/admin/regions/accept/" + tr.data('key'),
            method: "POST",
            data: {
                <?=Params::TITLE?>: title.find('input').val(),
                <?=Params::CODE?>: code.find('input').val(),
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
    BODY.on('click', '.region-reject', function (){
        let tr = $(this).closest('tr');
        if (tr.data('key') == 0) {
            tr.remove();
        }
        let title = tr.find('.region-title');
        let code = tr.find('.region-code');
        title.text(title.data('value'));
        code.text(code.data('value'));
        $(this).closest('div').hide().prev('div').show();
    })

    // Добавление
    $('.region-add').on('click', function () {
        let tbody = BODY.find('tbody');
        let emptyRow = tbody.find('.empty-row');
        tbody.prepend("<tr data-key='0'>" + emptyRow.html() + "</tr>");
    });

    BODY.on('click', '.region-remove', function (){
        let tr = $(this).closest('tr');
        $.ajax({
            url: "/admin/regions/delete/" + tr.data('key'),
            method: "get"
        }).done(res => {
            if(res.status == '<?=Params::STATUS_OK?>') {
                tr.remove();
            }
        })
    })
</script>