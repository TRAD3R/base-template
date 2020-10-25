<?php
/**
 * @var array $params
 */
use App\Helpers\Url;
use App\Html;
use App\Params;
use App\Models\User;

?>
<?= Html::beginForm(Url::toRoute(['user/client']), 'GET'); ?>
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Фильтр</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-4 col-xs-12">
                    <div class="form-group">
                        <?= Html::label('Поиск', Params::SEARCH); ?>
                        <?= Html::textInput(Params::SEARCH, $params[Params::SEARCH], ['class' => 'form-control']); ?>
                    </div>
                </div>
                <div class="col-md-4 col-xs-12">
                    <div class="form-group">
                        <?= Html::label('Активен'); ?>
                        <?= Html::dropDownList(Params::USER_STATUS, $params[Params::USER_STATUS], User::getStatus(), [
                            'class' => 'form-control',
                            'prompt' => 'Все статусы'
                        ]); ?>
                    </div>
                </div>
                <div class="col-md-4 col-xs-12">
                    <div class="form-group">
                        <?= Html::label('Категория'); ?>
                        <?= Html::dropDownList(Params::USER_CATEGORY,
                            $params[Params::USER_CATEGORY],
                            User::getUserCategory(),
                            ['class' => 'form-control',
                                'prompt' => 'Все категории']); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="box-footer">
            <button class="btn btn-success">Поиск</button>
            <a href="<?= Url::toRoute(['user/client']); ?>" class="btn btn-default">Сброс</a>
        </div>
    </div>
<?= Html::endForm(); ?>