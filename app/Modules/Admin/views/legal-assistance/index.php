<?php

use App\Html;
use App\Models\LegalAssistance;
use App\Params;
use yii\data\Pagination;
use App\Models\User;

/**
 * @var $this yii\web\View
 * @var $questions \App\Models\LegalAssistance[]
 * @var $pagination Pagination
 * @var $params array
 */


$this->title = 'Правовая помощь';
?>
<?= $this->render('filters/filter', ['params' => $params]); ?>
<div class="regions-index">

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
                Дата вопроса
            </th>
            <th>
                Вопрос
            </th>
            <th>
                Статус
            </th>
            <th>
                Дата ответа
            </th>
            <th class="action-column">Действия</th>
        </tr>
        </thead>
        <tbody>
            <?php foreach ($questions as $key => $question): ?>
            <?php $user = User::findOne($question['user_id'])?>
                <tr data-key="<?=$question['id']?>" class="<?=$question['status'] == LegalAssistance::STATUS_ANSWERED ? 'question-answered' : ''?>">
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
                            <?=(new DateTime($question['date_created']))->format('d.m.Y H:i')?>
                        </span>
                    </td>
                    <td>
                        <span>
                            <?=$question['question']?>
                        </span>
                    </td>
                    <td>
                        <span class="question-status">
                            <?=LegalAssistance::getStatusTitle($question['status'])?>
                        </span>
                    </td>
                    <td>
                        <span class="question-answered-date">
                            <?=(new DateTime($question['date_answered']))->format('d.m.Y H:i')?>
                        </span>
                    </td>
                    <td>
                        <div>
                            <?php if($question['status'] == LegalAssistance::STATUS_NEW):?>
                                <span class="glyphicon glyphicon-ok status-ok" title="Пометить отмеченным"></span>
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
     * Отметка об ответе
     */
    BODY.on('click', '.status-ok', function (){
        let question = $(this).closest('tr');
        $.ajax({
            url: "/admin/legal-assistance/edit/" + question.data('key'),
            method: 'get'
        }).done(res => {
            if(res.status == '<?=Params::STATUS_OK?>') {
                question.addClass('question-answered');
                question.find('.question-status').text(res.state);
                question.find('.question-answered-date').text(res.answeredDate);
                $(this).remove();
            }
        })
    });
    BODY.on('click', '.status-trash', function (){
        let question = $(this).closest('tr');
        $.ajax({
            url: "/admin/legal-assistance/delete/" + question.data('key'),
            method: 'get'
        }).done(res => {
            if(res.status == '<?=Params::STATUS_OK?>') {
                question.hide();
                $(this).remove();
            }else{
                alert(res.message);
            }
        })
    })
</script>