<?php

use App\Helpers\Url;
use App\Html;
use yii\data\Pagination;
use yii\web\View;

/**
 * @var $this View
 * @var $contracts array
 * @var $pagination Pagination
 * @var $params array
 */

$this->title = 'Договоры';
?>
<div class="regions-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>#</th>
            <th>
                Название
            </th>
            <th>
                Наличие<br>шаблона
            </th>
            <th class="action-column"></th>
        </tr>
        </thead>
        <tbody>
            <?php
                foreach ($contracts as $key => $contract):?>
            <tr>
                <td><?=$key?></td>
                <td>
                    <span>
                        <?=$contract?>
                    </span>
                </td>
                <td>
                    <div>
                        <a href="<?=Url::toRoute(['edit', 'id' => $key])?>" class="glyphicon glyphicon-pencil" title="Редактировать"></a>
                        <a href="<?=Url::toRoute(['preview', 'id' => $key])?>" class="glyphicon glyphicon-film" title="Предварительный просмотр" target="_blank"></a>
                    </div>
                </td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</div>