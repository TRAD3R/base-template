<?php

use App\Html;
use App\Params;
use yii\data\Pagination;
use App\Models\User;

/**
 * @var $this yii\web\View
 * @var $expertizes \App\Models\Expertize[]
 * @var $pagination Pagination
 * @var $params array
 */


$this->title = 'Экспертиза документов';
?>
<?= $this->render('filters/filter', ['params' => $params]); ?>
<div>

    <h1><?= Html::encode($this->title) ?></h1>

    <?= Html::pagination($this, $pagination); ?>

    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>#</th>
            <th>
                Имя
            </th>
            <th>
                Email
            </th>
            <th>
                Дата подачи
            </th>
            <th>
                Количество файлов
            </th>
            <th>
                Общая стоимость
            </th>
            <th>
                Статус оплаты
            </th>
            <th>
                Дата ответа
            </th>
            <th class="action-column">Действие</th>
        </tr>
        </thead>
        <tbody>
            <?php foreach ($expertizes as $key => $expertize): ?>
            <?php $user = User::findOne($expertize['user_id'])?>
                <tr data-key="<?=$expertize['id']?>" class="<?=$expertize['date_checked'] ? 'expertize-checked' : ''?>">
                    <td><?=++$key?></td>
                    <td>
                        <span>
                            <?=$user->getShortname()?>
                        </span>
                    </td>
                    <td>
                        <span>
                            <?=$user->email?>
                        </span>
                    </td>
                    <td>
                        <span>
                            <?=(new DateTime($expertize['date_created']))->format('d.m.Y H:i')?>
                        </span>
                    </td>
                    <td>
                        <span>
                            <?=count(json_decode($expertize['files']))?>
                        </span>
                    </td>
                    <td>
                        <span>
                            <?=$expertize['total_cost']?>
                        </span>
                    </td>
                    <td>
                        <span class="expertize-status">
                            <?=$expertize['is_paid'] ? 'Оплачено' : ''?>
                        </span>
                    </td>
                    <td>
                        <?php if($expertize['date_checked']):?>
                            <span class="expertize-checked-date">
                                <?=(new DateTime($expertize['date_checked']))->format('d.m.Y H:i')?>
                            </span>
                        <?php endif;?>
                    </td>
                    <td>
                        <div>
                            <?php if(!$expertize['date_checked']):?>
                                <span class="glyphicon glyphicon-ok status-ok" title="Пометить обработанным"></span>
                            <?php endif;?>
                                <span class="glyphicon glyphicon-trash status-trash" title="Удалить"></span>
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
     * Отметка о проверке
     */
    BODY.on('click', '.status-ok', function (){
        let expertize = $(this).closest('tr');
        $.ajax({
            url: "/admin/expertize/checked/" + expertize.data('key'),
            method: 'get'
        }).done(res => {
            if(res.status == '<?=Params::STATUS_OK?>') {
                expertize.addClass('expertize-checked');
                expertize.find('.expertize-status').text('Оплачено');
                expertize.find('.expertize-checked-date').text(res.checkedDate);
                $(this).remove();
            }else{
                alert(res.message);
            }
        })
    });

    BODY.on('click', '.status-trash', function (){
        let expertize = $(this).closest('tr');
        $.ajax({
            url: "/admin/expertize/delete/" + expertize.data('key'),
            method: 'get'
        }).done(res => {
            if(res.status == '<?=Params::STATUS_OK?>') {
                expertize.hide();
                $(this).remove();
            }else{
                alert(res.message);
            }
        })
    })
</script>