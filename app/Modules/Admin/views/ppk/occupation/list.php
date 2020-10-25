<?php

use App\Helpers\Url;
use App\Html;
use app\models\Occupation;
use App\Params;
use yii\data\Pagination;
use yii\web\View;

/**
 * @var $this View
 * @var $occupations Occupation[]
 * @var $pagination Pagination
 * @var $params array
 */

$this->title = 'Род деятельности';
?>
<div class="regions-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <a href="<?=Url::toRoute(['occupation-edit', 'id' => 0])?>" class="btn btn-success">Добавить род деятельности</a>
    </p>

    <?= Html::pagination($this, $pagination); ?>

    <table class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th>#</th>
            <th>
                Название
            </th>
            <th>
                Родитель
            </th>
            <th>
                Наличие<br>шаблона
            </th>
            <th class="action-column"></th>
        </tr>
        </thead>
        <tbody>
            <?php
                $iterator = $params[Params::OFFSET] + 1;
                foreach ($occupations as $occupation){
                    echo $this->render('row', [
                        'item' => $occupation,
                        'key' => $iterator,
                    ]);
                    $iterator++;
                }
            ?>
        </tbody>
    </table>
    <?= Html::pagination($this, $pagination); ?>
</div>