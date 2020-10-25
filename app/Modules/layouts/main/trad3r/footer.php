<?php


use App\App;
use App\Helpers\Url;
use App\Models\Page;

/**
 * @var $this \yii\web\View
 */

$policy = Page::findOne(Page::PAGE_CONFIDENCE_POLICY);
$terms = Page::findOne(Page::PAGE_SERVICE_TERMS);


switch (App::i()->getController()->getRoute()) {
    case "site/index":
    case "site/material":
    case "site/materials":
    case "site/license-work":
    case "site/license-page":
    case "site/license-procedure":
    case "site/legal-assistance":
    case "site/service":
    case "auth/registration":
    case "auth/login":
    case "review/index":
        $dataImgFooter = "/images/_src/frame-5.svg";
        break;
    case "site/feedback":
    case "ppk/index":
    case "ppk/step1":
    case "ppk/step2":
    case "ppk/step3":
    case "contract/step1":
    case "contract/step2":
    case "contract/step3":
    case "contract/rent":
    case "contract/rent-three":
    case "contract/employment":
    case "contract/paid":
    case "contract/total":
    case "contract/type":
        $dataImgFooter = "/images/_src/frame-6.svg";
        break;
    case "site/section":
    case "site/faq":
        $dataImgFooter = "images/_src/frame-7.svg";
        break;
    case "account/index":
    case "account/orders":
        $dataImgFooter = "/images/_src/frame-8.svg";
        break;
    case "expertize/index":
        $dataImgFooter = "/images/_src/frame-11.svg";
        break;
    case "review/add":
        $dataImgFooter = "/images/_src/frame-14.svg";
        break;
    default:
        $dataImgFooter = null;
}

$userIsVip = App::i()->getCurrentUser() && App::i()->getCurrentUser()->isVip();
?>


<footer class="footer bg-overlay">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-4">
                <!-- картинка на страницах разная, поэтому в каждом шаблоне она обьявлена -->
                <img class="footer-img" src="<?= $dataImgFooter; ?>" alt="">
            </div>
            <div class="col-12 col-sm-12 col-md-7 offset-lg-1">
                <div class="section-content align-items-end">
                    <div class="section-content__wrapper">
                        <nav class="footer-nav">
                            <div class="row">
                                <div class="col-12 col-md-7">
                                    <ul>
                                        <li><a href="<?= Url::toRoute(['site/license-page']) ?>">Лицензионное дело</a>
                                        </li>
                                        <li>
                                            <a href="<?=Url::toRoute('configurator/education')?>"
                                                <?php if(!$userIsVip) :?>
                                                    data-modal="modal_purchasing_access_configuration"
                                                <?php endif;?>
                                               class="<?=App::i()->getCurrentUser()?'':'inactive-link'?>"
                                            >
                                                Конфигуратор «Первая лицензия»
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?=Url::toRoute('configurator/cause')?>"
                                                <?php if(!$userIsVip) :?>
                                                    data-modal="modal_purchasing_access_configuration"
                                                <?php endif;?>
                                               class="<?=App::i()->getCurrentUser()?'':'inactive-link'?>"
                                            >
                                               Конфигуратор «Переоформление лицензии»
                                            </a>
                                        </li>
                                        <li><a href="<?= Url::toRoute(['expertize/index']) ?>" class="<?=App::i()->getCurrentUser()?'':'inactive-link'?>">
                                                Экспертиза документов
                                            </a></li>
                                        <li><a href="<?=Url::toRoute('ppk/index')?>">Программы производственного контроля</a></li>
                                        <li><a href="<?=Url::toRoute('contract/step1')?>">Типовые договоры</a></li>
                                    </ul>
                                </div>
                                <div class="col-12 col-md-5">
                                    <ul>
                                        <li><a href="<?=Url::toRoute(['site/section'])?>">Разделы сайта</a></li>
                                        <li><a href="<?=Url::toRoute(['site/legal-assistance'])?>" class="<?=App::i()->getCurrentUser()?'':'inactive-link'?>">Правовая помощь</a></li>
                                        <li><a href="<?=Url::toRoute(['site/faq'])?>">Вопрос-ответ</a></li>
                                        <li><a href="<?= Url::toRoute(['site/feedback']) ?>">Контакты</a></li>
                                        <?php if(App::i()->getCurrentUser() && App::i()->getController()->id != 'account'):?>
                                            <li><a href="<?= Url::toRoute(['account/orders']) ?>">Личный кабинет</a></li>
                                        <?php endif;?>
                                    </ul>
                                </div>
                            </div>
                        </nav>
                        <p class="dr-text__small c-light" style="opacity: .5; margin-top: 15px;">
                            ® <?=(new DateTime())->format('Y')?>. Все права защищены. Копирование материалов сайта запрещено.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<?=$this->render('template-parts/modal_purchasing_access_configuration')?>
<?=$this->render('@layouts/main/trad3r/template-parts/modal_policy', ['text' => $policy->content_1])?>
<?=$this->render('@layouts/main/trad3r/template-parts/modal_terms', ['text' => $terms->content_1])?>

