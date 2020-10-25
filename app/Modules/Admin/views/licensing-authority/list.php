<?php
use App\Helpers\Url;
use App\Html;

/* @var $this yii\web\View */
/* @var $items \App\Models\LicensingAuthority[] */



$this->title = 'Лицензирующие органы';
?>
<div class="regions-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <a href="<?=Url::toRoute(['edit', 'id' => 0])?>" class="btn btn-success la-add">Добавить орган</a>
    </p>

    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>#</th>
            <th>
                Название
            </th>
            <th>
                Регион
            </th>
            <th>
                Описание
            </th>
            <th>
                Особенности
            </th>
            <th class="action-column"></th>
        </tr>
        </thead>
        <tbody>
            <?php foreach ($items as $key => $item): ?>
                <tr>
                    <td>
                        <span>
                            <?=++$key?>
                        </span>
                    </td>
                    <td>
                        <span>
                            <?=$item->title?>
                        </span>
                    </td>
                    <td>
                        <span>
                            <?=$item->region->name?>
                        </span>
                    </td>
                    <td>
                        <span>
                            <?=$item->description?>
                        </span>
                    </td>
                    <td>
                        <span>
                            <?=$item->features?>
                        </span>
                    </td>
                    <td>
                        <a href="<?=Url::toRoute(['edit', 'id' => $item->id])?>">
                            <span class="glyphicon glyphicon-pencil" title="Редактировать"></span>
                        </a>
                    </td>
                </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</div>