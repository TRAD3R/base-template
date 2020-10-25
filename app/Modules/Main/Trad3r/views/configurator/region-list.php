<?php

/**
 * @var $list array
 */
?>
<div class="col-12 col-sm-6 col-lg-4">
    <?php
    $countInColumn = round(count($list) / 3, 0);
    $i = 0;
    foreach($list as $item) : ?>
    <?php if ($i++ < $countInColumn): ?>
        <div class="list-selection__item" data-id="<?=$item->id?>">
            <span class="list-selection__item-inner">
                <?= $item['name']; ?> (код: <?=$item->getCode()?>)&nbsp;→
            </span>
        </div>
    <?php else:  ?>
    <?php $i = 0; ?>
</div>
<div class="col-12 col-sm-6 col-lg-4">
    <?php endif;?>
    <?php endforeach; ?>
</div>
