<?php
/**
 * @var \yii\web\View $this
 */

use App\Helpers\Url;

$this->title = 'Оплачена проверка документов';

echo $this->render('@modals/modal_thanks', ['pretext' => 'Мы свяжемся с Вами по указанным при регистрации контактам']);
?>
<script>
    $(document).ready(function () {
        drModalShow('modal_thanks');
        startTimerSeconds(()=>{location.href = '<?=Url::toRoute(["site/section"])?>';});
    })
</script>