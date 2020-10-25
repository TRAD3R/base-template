<?php
/**
 * @var string $username
 * @var string $link
 * @var int $user_type
 */

use App\App;
use App\Html;
use App\Models\User;

?>
    Здравствуйте, <?= Html::encode($username)?>. <br>
<br>
    Благодарим за регистрацию на сайте <?=App::i()->getApp()->params['site']['name']?> <br>
<?php if ($user_type == User::TYPE_USER):?>
    Ваш аккаунт уже активирован и Вы можете перейти на сайт <a href="<?= $link ?> "> прямо сейчас</a>.
<?php endif; ?>
<br> <br>
С уважением,
<br/>
<?=App::i()->getApp()->params['site']['name']?>
