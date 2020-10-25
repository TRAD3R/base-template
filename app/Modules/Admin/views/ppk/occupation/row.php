<?php
/**
 * @var $item \app\models\Occupation
 * @var $key int
 */

use App\Helpers\Url;
use App\Models\Occupation;

$parent = Occupation::getParentTitle($item['parent_id']);
?>

<tr>
    <td><?=$key?></td>
    <td>
        <span>
            <?=$item['title']?>
        </span>
    </td>
    <td>
        <span>
            <?=$parent?>
        </span>
    </td>
    <td class="trd-is-template">
        <?php if($item['template']):?>
            <i class="fas fa-check trd-has"></i>
        <?php else:?>
            <i class="far fa-circle trd-hasnot"></i>
        <?php endif;?>
    </td>
    <td>
        <div class="сlient-edit">
            <a href="<?=Url::toRoute(['occupation-edit', 'id' => $item['id']])?>" class="glyphicon glyphicon-pencil" title="Редактировать"></a>
            <a href="<?=Url::toRoute(['occupation-preview', 'id' => $item['id']])?>" class="glyphicon glyphicon-film" title="Предварительный просмотр" target="_blank"></a>
        </div>
    </td>
</tr>
