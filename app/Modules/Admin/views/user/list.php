<?php

/* @var $this yii\web\View
 * @var $users array
 * @var $pagination Pagination
 * @var $params array
 * @var $filterView string
 */

use App\Helpers\Url;
use App\Html;
use App\Params;
use yii\data\Pagination;
use App\Models\User;

$addUrl = $params[Params::USER_TYPE] == User::TYPE_ADMIN ? 'user/manager-edit' : 'user/client-edit'
?>
<?= $this->render($params['filter_view'], ['params' => $params]); ?>
<div class="box box-success">
    <div class="box-header with-border">
        <?= Html::pagination($this, $pagination); ?>
        <div class="pull-right">
            <a class="btn btn-primary" href="<?= Url::toRoute([$addUrl, 'id' => 0]); ?>" target="_blank">Добавить</a>
        </div>
    </div>
    <div class="box-body table-responsive">
        <table class="table table-stripped table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>Дата добавления</th>
                <th>Логин</th>
                <th>Статус</th>
                <th>Имя</th>
                <th>Email</th>
                <th>Категория</th>
                <th class="text-right">Действия</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($users as $user): ?>
                <?php
                    $editUrl = $user['type'] == User::TYPE_ADMIN ? 'user/manager-edit' : 'user/client-edit'
                ?>
                <tr  style="background-color:<?= User::getColor($user['category'], $user['status']) ?>">
                    <td><?= Html::userUrl($editUrl, $user['id'], '_blank', true); ?></td>
                    <td>
                        <?= (new DateTime($user['date_created']))->format('d.m.Y H:i:s'); ?>
                    </td>
                    <td>
                        <span>
                            <?= Html::encode($user['username']); ?>
                        </span>
                    </td>
                    <td><?=User::getStatus($user['status'])?></td>
                    <td>
                        <?=sprintf("%s %s %s", $user['firstname'], $user['secondname'], $user['lastname'])?>
                    </td>
                    <td>
                        <p>Email: <?= Html::encode($user['email']); ?></p>
                        <?php if ($user['phone']) : ?>
                            <p>Телефон: <?= Html::encode($user['phone']); ?></p>
                        <?php endif; ?>
                        <?php if ($user['company']) : ?>
                            <p>Компания: <?= Html::encode($user['company']); ?></p>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php
                            $category = User::getUserCategory($user['category']);
                            if (is_string($category)) {
                                echo $category;
                            }
                        ?>
                    </td>
                    <td class="pull-right">
                        <a href="<?= Url::toRoute([$editUrl, Params::ID => $user['id']]) ?>" class="btn btn-default">
                            <i class="fas fa-edit"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="box-footer">
        <?= Html::pagination($this, $pagination); ?>
    </div>
</div>