<?php

use App\App;
use App\Helpers\Url;
use App\Html;
use App\Params;
use yii\web\View;

/**
 * @var $this View
 * @var $docs array
 * @var $dirs array
 * @var $params array
 */

$this->title = 'Документы для конфигуратора';
$iterator = 1;
?>

<?=$this->render("_filters", ['params' => $params])?>
<div class="regions-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <button class="btn btn-success doc-add">Добавить документ</button>
    </p>

    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>#</th>
            <th>
                Название
            </th>
            <th>
                Папка
            </th>
            <th class="action-column"></th>
        </tr>
        </thead>
        <tbody>
        <tr class="empty-row" style="display: none">
            <?=Html::beginForm(Url::toRoute(['add']), 'post', [
                'enctype' => 'multipart/form-data'
            ])?>
                <td></td>
                <td>
                    <input type="file" name="file" id="file">
                </td>
                <td>
                    <?=Html::dropDownList(Params::FILEPATH, null, $dirs, ['id' => 'path'])?>
                </td>
                <td>
                    <div class="сlient-action">
                        <?=Html::button('<span class="glyphicon glyphicon-ok" title="Загрузить"></span>', ['id' => 'but-upload'])?>
                        <span class="glyphicon glyphicon-remove doc-cancel" title="Отменить"></span>
                    </div>
                </td>
            <?=Html::endForm()?>
        </tr>
        <?php foreach ($docs as $key => $files): ?>
            <?php foreach ($files as $doc): ?>
                <tr data-key="<?=$doc['path']?>">
                    <td><?=$iterator++?></td>
                    <td class="client-title" data-value="<?=$doc?>">
                            <span>
                                <?=$doc['title']?>
                            </span>
                    </td>
                    <td class="client-description">
                            <span>
                                <?=$doc['dirname']?>
                            </span>
                    </td>
                    <td>
                        <div class="сlient-action">
                            <span class="glyphicon glyphicon-remove doc-remove" title="Удалить"></span>
<!--                            <a href="resources/common/configurator/docs/--><?//=$doc['path']?><!--" download>-->
<!--                                <span class="glyphicon glyphicon-download-alt" title="Скачать"></span>-->
<!--                            </a>-->
                        </div>
                    </td>
                </tr>
            <?php endforeach;?>
        <?php endforeach;?>
        </tbody>
    </table>
</div>
<script>
    const BODY = $('body');

    /**
     * Удаление документа
     */
    BODY.on('click', '.doc-remove', function (){
        let tr = $(this).closest('tr');
        $.ajax({
            url: '<?=Url::toRoute(['remove'])?>',
            method: "POST",
            data: {
                <?=Params::FILEPATH?>: tr.data('key'),
                _csrf       : '<?= App::i()->getRequest()->getCsrf() ?>',
            }
        }).done(res => {
            if(res.status == '<?=Params::STATUS_OK?>') {
                tr.remove()
            } else {
                alert('Ошибка удаления файла')
            }
        })
    });

    $("#but-upload").on('click', function (){
        var fd = new FormData();
        var file = $('#file')[0].files[0];
        var path = $('#path').find('option:selected').val();
        fd.append('file',file);
        fd.append('<?=Params::FILEPATH?>',path);
        fd.append('_csrf', '<?= App::i()->getRequest()->getCsrf() ?>');


        $.ajax({
            url: '<?=Url::toRoute(['add'])?>',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function(response){
                if(response != 0){
                    location.href = '';
                }else{
                    alert('Ошибка загрузки файла');
                }
            },
        });
    });

    // Показать форму для добавление документа
    $('.doc-add').on('click', function () {
        let tbody = BODY.find('tbody');
        let emptyRow = tbody.find('.empty-row');
        emptyRow.show();
    })

    // Отмена добавления документа
    $('.doc-cancel').on('click', function () {
        let tbody = BODY.find('tbody');
        let emptyRow = tbody.find('.empty-row');
        emptyRow.hide();
    })
</script>