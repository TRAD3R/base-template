<?php
use App\App;
use App\Html;
use App\Models\Configuration;
use App\Params;

/* @var $this yii\web\View */
/* @var $specs \App\Models\Specialty[] */



$this->title = 'Специальности';
$middleEdu = Configuration::getEducationTitle(Configuration::EDUCATION_MIDDLE);
$highEdu = Configuration::getEducationTitle(Configuration::EDUCATION_HIGHER);
?>
<div class="regions-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <button id="add" class="btn btn-success">Добавить специальность</button>
    </p>

    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>Уровень</th>
            <th>
                Название
            </th>
            <th>
                Стаж
            </th>
            <th class="action-column"></th>
        </tr>
        </thead>
        <tbody>
            <tr class="empty-row" style="display: none">
                <td class="level">
                    <?=Html::dropDownList('level', null, [
                            Configuration::EDUCATION_MIDDLE => $middleEdu,
                            Configuration::EDUCATION_HIGHER => $highEdu,
                    ])?>
                </td>
                <td class="title">
                    <input type="text" style="width: 90%">
                </td>
                <td class="experience">
                    <input type="number">
                </td>
                <td>
                    <div class="region-action">
                        <span class="glyphicon glyphicon-ok accept" title="Принять"></span>
                        <span class="glyphicon glyphicon-remove reject" title="Отклонить"></span>
                    </div>
                </td>
            </tr>
            <?php foreach ($specs as $key => $item): ?>
                <tr data-key="<?=$item['id']?>">
                    <td class="level" data-value="<?=Configuration::getEducationTitle($item->education_level)?>">
                        <?=Html::dropDownList('level', $item->education_level, [
                            Configuration::EDUCATION_MIDDLE => $middleEdu,
                            Configuration::EDUCATION_HIGHER => $highEdu,
                        ], ['class' => 'hidden'])?>
                        <span>
                            <?=($item->education_level == Configuration::EDUCATION_HIGHER ? $highEdu : $middleEdu)?>
                        </span>
                    </td>
                    <td class="title" data-value="<?=$item->title?>">
                        <span>
                            <?=$item->title?>
                        </span>
                    </td>
                    <td class="experience" data-value="<?=$item->experience?>">
                        <span>
                            <?=$item->experience?>
                        </span>
                    </td>
                    <td>
                        <div class="edit">
                            <span class="glyphicon glyphicon-pencil" title="Редактировать"></span>
                            <span class="glyphicon glyphicon-trash remove" title="Удалить"></span>
                        </div>
                        <div class="action" style="display: none">
                            <span class="glyphicon glyphicon-ok accept" title="Принять"></span>
                            <span class="glyphicon glyphicon-remove reject" title="Отклонить"></span>
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
    BODY.on('click', '.edit', function () {
        let tr = $(this).closest('tr');
        let title = tr.find('.title');
        let experience = tr.find('.experience');
        let level = tr.find('.level');

        title.html('<input type="text" value="' + title.data('value') + '" style="width: 90%">');
        experience.html('<input type="number" value="' + experience.data('value') + '">');
        level.find('span').addClass('hidden');
        level.find('select').removeClass('hidden');

        $(this).hide();
        $(this).next('div').show();
    });

    /**
     * Сохранение отредактированных данных
     */
    BODY.on('click', '.accept', function (){
        let tr = $(this).closest('tr');
        let title = tr.find('.title');
        let experience = tr.find('.experience');
        let level = tr.find('.level');

        $.ajax({
            url: "/admin/specialities/accept/" + tr.data('key'),
            method: "POST",
            data: {
                <?=Params::TITLE?>: title.find('input').val(),
                <?=Params::EXPERIENCE?>: experience.find('input').val(),
                <?=Params::EDUCATION?>: level.find('select option:selected').val(),
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
    BODY.on('click', '.reject', function (){
        let tr = $(this).closest('tr');
        if (tr.data('key') == 0) {
            tr.remove();
        }
        let title = tr.find('.title');
        let experience = tr.find('.experience');
        let level = tr.find('.level');

        title.text(title.data('value'));
        experience.text(experience.data('value'));
        level.find('span').removeClass('hidden');
        level.find('select').addClass('hidden');
        $(this).closest('div').hide().prev('div').show();
    })

    // Добавление
    $('.region-add').on('click', function () {
        let tbody = BODY.find('tbody');
        let emptyRow = tbody.find('.empty-row');
        tbody.prepend("<tr data-key='0'>" + emptyRow.html() + "</tr>");
    });

    BODY.on('click', '.remove', function (){
        let tr = $(this).closest('tr');
        $.ajax({
            url: "/admin/specialities/delete/" + tr.data('key'),
            method: "get"
        }).done(res => {
            if(res.status == '<?=Params::STATUS_OK?>') {
                tr.remove();
            }
        })
    })
    // Добавление
    $('#add').on('click', function () {
        let tbody = BODY.find('tbody');
        let emptyRow = tbody.find('.empty-row');
        tbody.prepend("<tr data-key='0'>" + emptyRow.html() + "</tr>");
    })
</script>