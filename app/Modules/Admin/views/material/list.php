<?php
use App\Helpers\Url;
use App\Html;
use App\Models\material;

/* @var $this yii\web\View */
/* @var $materials Material[] */



$this->title = 'Материалы';
?>
<div>

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <a href="<?=Url::toRoute(['edit', 'id' => 0]) ?>" class="btn btn-success material-add">
            Добавить материал
        </a>
    </p>

    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>#</th>
            <th>
                Название
            </th>
            <th>
                Статус
            </th>
            <th>
                Платный контент
            </th>
            <th class="action-column"></th>
        </tr>
        </thead>
        <tbody>
            <?php foreach ($materials as $key => $item): ?>
                <tr data-key="<?=$item['id']?>">
                    <td><?=++$key?></td>
                    <td>
                        <span>
                            <?=$item->title?>
                        </span>
                    </td>
                    <td>
                        <span>
                            <?=$item->is_published ? 'Опубликован' : "Закрыт"?>
                        </span>
                    </td>
                    <td>
                        <span>
                            <?=$item->is_paid ? 'Да' : "Нет"?>
                        </span>
                    </td>
                    <td>
                        <div class="material-edit">
                            <a href="<?=Url::toRoute(['edit', 'id' => $item->id]) ?>">
                                <span class="glyphicon glyphicon-pencil" title="Редактировать"></span>
                            </a>
                            <a href="<?=Url::toRoute(['remove', 'id' => $item->id]) ?>">
                                <span class="glyphicon glyphicon-trash" title="Удалить"></span>
                            </a>
                        </div>
                    </td>
                </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</div>