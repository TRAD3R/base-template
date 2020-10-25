<?php

/* @var $this yii\web\View */
/* @var $pages Metadata[] */
/* @var $pagination Pagination */

use App\App;
use App\Html;
use App\Models\Metadata;
use App\Params;
use yii\data\Pagination;

$this->title = 'Страницы сайта';
?>
<div class="regions-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= Html::pagination($this, $pagination); ?>

    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>#</th>
            <th>
                Action
            </th>
            <th>
                Название
            </th>
            <th>
                Meta-Description
            </th>
            <th>
                Meta-Keywords
            </th>
            <th class="action-column"></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($pages as $key => $page): ?>
            <tr data-key="<?=$page['id']?>">
                <td><?=$key?></td>
                <td class="page-action-id" data-value="<?=$page['action']?>">
                        <span>
                            <?=$page['action']?>
                        </span>
                </td>
                <td class="page-title" data-value="<?=$page['title']?>">
                        <span>
                            <?=$page['title']?>
                        </span>
                </td>
                <td class="page-meta-description" data-value="<?=$page['meta_description']?>">
                        <span>
                            <?=$page['meta_description']?>
                        </span>
                </td>
                <td class="page-meta-keywords" data-value="<?=$page['meta_keywords']?>">
                        <span>
                            <?=$page['meta_keywords']?>
                        </span>
                </td>
                <td>
                    <div class="meta-edit">
                        <span class="glyphicon glyphicon-pencil" title="Редактировать"></span>
                    </div>
                    <div class="meta-action" style="display: none">
                        <span class="glyphicon glyphicon-ok meta-accept" title="Принять"></span>
                        <span class="glyphicon glyphicon-remove meta-reject" title="Отклонить"></span>
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
    BODY.on('click', '.meta-edit', function () {
        let page = $(this).closest('tr');
        let pageTitle = page.find('.page-title');
        let pageDescription = page.find('.page-meta-description');
        let pageKeywords = page.find('.page-meta-keywords');

        pageTitle.html('<input type="text" value="' + pageTitle.data('value') + '">');
        pageDescription.html('<input type="text" value="' + pageDescription.data('value') + '">');
        pageKeywords.html('<input type="text" value="' + pageKeywords.data('value') + '">');
        $(this).hide();
        $(this).next('div').show();
    });

    /**
     * Сохранение отредактированных данных
     */
    BODY.on('click', '.meta-accept', function (){
        // let client = $(this).closest('tr');
        // let clientTitle = client.find('.client-title');
        // let clientDescription = client.find('.client-description');

        let page = $(this).closest('tr');
        let pageTitle = page.find('.page-title');
        let pageDescription = page.find('.page-meta-description');
        let pageKeywords = page.find('.page-meta-keywords');

        $.ajax({
            url: "/admin/settings/meta/edit/" + page.data('key'),
            method: "POST",
            data: {
                <?=Params::TITLE?>: pageTitle.find('input').val(),
                <?=Params::DESCRIPTION?>: pageDescription.find('input').val(),
                <?=Params::KEYWORDS?>: pageKeywords.find('input').val(),
                '_csrf' : '<?= App::i()->getRequest()->getCsrf() ?>',
            }
        }).done(function(res) {
                if(res.status) {
                    // Редирект на последнюю страницу при добавлении клиента
                    if (page.data('key') == 0) {
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
    BODY.on('click', '.meta-reject', function (){
        let page = $(this).closest('tr');
        if (page.data('key') == 0) {
            page.remove();
        }
        let pageTitle = page.find('.page-title');
        let pageDescription = page.find('.page-meta-description');
        let pageKeywords = page.find('.page-meta-keywords');
        pageTitle.text(pageTitle.data('value'));
        pageDescription.text(pageDescription.data('value'));
        pageDescription.text(pageKeywords.data('value'));
        $(this).closest('div').hide().prev('div').show();
    })
</script>