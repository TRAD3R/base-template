<?php
/**
 * @var $this View
 * @var $materials Material[]
 */

use App\App;
use App\Helpers\TextUtils;
use App\Helpers\Url;
use App\Models\Material;
use yii\web\View;

?>
<script>
    document.body.classList.add('bg-accent__super-lightest');
</script>

<section class="section section-materials">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="headers-h1 page-title text-center c-accent__darken"><?=$this->title?></h1>
                <div class="material-list">
                    <div class="row">

                        <?php
                        /** @var Material $material */
                        foreach($materials as $material) : ?>
                            <div class="col-12 col-md-6 col-lg-4; ?>">
                                <div
                                    class="panel
                                    panel-column
                                    justify-content-between
                                    material-item
                                    material-item__<?=!empty($material->getStatus()) ? $material->getStatus() : 'normal'; ?>">

                                <span class="data-user__status bage
                                <?= !empty($material->getStatus()) ? 'bg-orange-darken' : 'bg-accent-gradient__lighten'; ?>">
                                    <?=$material->getStatus();?>
                                </span>

                                    <div class="panel-inner">
                                        <p class="headers-h3 material-item__title">
                                            <?=$material->title ?>
                                        </p>

                                        <p class="dr-text__small material-item__description">
                                            <?=TextUtils::truncate(strip_tags($material->description), 150)?>
                                        </p>
                                    </div>
                                    <div class="w-100">
                                        <?php
                                            $text = 'читать дальше';
                                            if($material->is_paid) {
                                                if(!App::i()->getCurrentUser()) {
                                                    $url = Url::toRoute(['auth/login']);
                                                    $text = 'перейти в pro-аккаунт и читать дальше';
                                                }else{
                                                    if(App::i()->getCurrentUser()->isVip()) {
                                                        $url = Url::toRoute(['site/material', 'alias' => $material->alias]);
                                                    } else {
                                                        $url = Url::toRoute(['account/index']);
                                                        $text = 'перейти в pro-аккаунт и читать дальше';
                                                    }
                                                }
                                            }else{
                                                $url = Url::toRoute(['site/material', 'alias' => $material->alias]);
                                            }
                                        ?>
                                        <a href="<?=$url?>" class="dr-btn dr-btn__orange-gradient ml-0"><?=$text?></a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <br><br><br><br><br><br><br><br>
            </div>
        </div>
    </div>
</section>
