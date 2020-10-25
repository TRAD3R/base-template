<?php
/**
 * @var string $name
 * @var string $email
 * @var string $text
 */

use App\App;

?>
На сайте <?=App::i()->getApp()->params['site']['name']?> добавился новый отзыв<br>
ФИО: <?=$name?><br>
Email: <?=$email?><br>
Отзыв: <?=$text?><br>