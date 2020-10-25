<?php
/**
 * @var string $name
 * @var string $lastname
 * @var string $phone
 * @var string $email
 * @var string $message
 */

use App\Html;

if(!isset($lastname)) {
    $lastname = '';
}
?>
    Message from <?= Html::encode($name)?> <?=Html::encode($lastname); ?>.
<?php if (isset($phone)):?>
    <br>
    Phone: <?=Html::encode($phone)?>.
<?php endif; ?>
    <br>
    Email: <?=Html::encode($email)?>.
<br>
<?= HTMLPurifier::getInstance()->purify($message); ?>