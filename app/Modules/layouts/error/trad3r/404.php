<?php
/**
 * @var string $url
 */
use App\App;

$this->title = 'Страница не найдена';
?>
<table class="error_page error_page_404">
    <tr>
        <td>
            <div class="error_center">
                <div class="col-sm-6 col-xs-12 content_404 pull-right">
                    <img src="<?= App::i()->getFile()->mdUrl('/images/_src/logo.png'); ?>" alt="<?=App::i()->getApp()->params['site']['name']?>"/>
                    <span>Страница не найдена!</span>
                    <a class="backup btn" href="<?= $url; ?>">Вернуться на главную</a>
                </div>
                <div class="col-sm-6 col-xs-12 pull-right text-right">
                    <img class="big-img" src="<?= App::i()->getFile()->mdUrl('/images/error/404/404.png'); ?>" alt="Страница не найдена"/>
                </div>
                <div class="clear"></div>
            </div>
        </td>
    </tr>
</table>