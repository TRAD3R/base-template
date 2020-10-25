<?php
/**
 * @var $question \App\Models\LegalAssistance
 */

use App\Html;
?>
    Сообщение от <?= Html::encode($question->user->getShortname())?>.
<?php if (isset($question->user->phone)):?>
    <br>
    Phone: <?=Html::encode($question->user->phone)?>.
<?php endif; ?>
    <br>
    Email: <?=Html::encode($question->user->email)?>.
<br>
<?= HTMLPurifier::getInstance()->purify($question->question); ?>