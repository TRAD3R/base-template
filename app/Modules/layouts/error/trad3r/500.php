<?php
/**
 * @var string $url Ссылка ведущая назад
 * @var $this  yii\web\View
 */

$this->title = 'Упс, что-то пошло не так!';
?>

<table class="error_page">
    <tr>
        <td>
            <div class="error_center error_mac">
                <div class="content_error">
<!--                    <img src="--><?//= App::i()->getFile()->mdUrl('/images/error/404/7offers.png'); ?><!--"/>-->
                    <span><?=$this->title?></span>
                    <?php $backUrl = Yii::$app->getRequest()->getReferrer(); ?>
                    <a class="prev btn" href="<?= ($backUrl) ? $backUrl : $url; ?>">Назад</a>
                </div>
                <div class="clear"></div>
            </div>
        </td>
    </tr>
</table>

<script>
    $(document).ready(function () {
        function content_height() {
            var wh = $(window).height();
            $(".error_page").css("height", wh + "px");
        }

        content_height();
        $(window).load(function () {
            content_height();
        });
        $(window).resize(function () {
            content_height();
        });
    });
</script>