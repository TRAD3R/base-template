<?php

use App\Helpers\Url;

/**
 * @var string $firstPart
 */

if (!$firstPart) {
    $firstPart = 'Регистрируясь';
}
?>

<?=$firstPart?>, вы соглашаетесь с <a href="<?=Url::toRoute(['site/terms'])?>"
                                    class="c-light dr-text__small dr-text__underline" data-modal="modal_terms">
    Условиями обслуживания
</a> и <a href="<?=Url::toRoute(['site/policy'])?>" class="c-light dr-text__small dr-text__underline" data-modal="modal_policy">
    Политикой конфиденциальности</a>.
