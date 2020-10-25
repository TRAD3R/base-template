<?php
/**
 * @var $list
 * @var $url string
 */


use App\Helpers\Url;

foreach ($list as $key => $item):?>

    <a href="<?= Url::toRoute([$url, 'id' => $key]) ?>" class="dr-btn dr-btn__accent-lightest"><?= $item ?></a>

<?php endforeach; ?>
