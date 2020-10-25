<?php
/**
 * @var string $username
 * @var string $link
 */

use App\App;
use App\Helpers\Url;
use App\Html;

?>
Здравствуйте, <?= Html::encode($username)?>. <br>
<br>
Вы запросили восстановление пароля на сайте <?=App::i()->getApp()->params['site']['url']?> <br>
Для восстановления пароля перейдите по ссылке ниже: <br>
<a href="<?= $link ?> "> <?= $link?> </a> <br>
<br>
Если по каким-то причинам ссылка не открывается, скопируйте ее и вставьте в строку адреса в браузере. <br>
Если Вы не запрашивали восстановление пароля, <a href="<?= Url::toRoute('/contacts', true); ?> "> сообщите нам </a> об этом. <br>
<br><br>
С уважением,
<br/>
<?=App::i()->getApp()->params['site']['name']?>
