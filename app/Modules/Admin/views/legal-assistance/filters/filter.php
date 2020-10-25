<?php
/**
 * @var array $params
 */
use App\Helpers\Url;
use App\Html;
use App\Models\LegalAssistance;
use App\Params;

?>
<?= Html::beginForm(Url::toRoute(['legal-assistance/index']), 'GET'); ?>
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Фильтр</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-4 col-xs-12">
                    <div class="form-group">
                        <?= Html::label('Статус'); ?>
                        <?= Html::dropDownList(Params::STATUS,
                            $params[Params::STATUS],
                            LegalAssistance::getStatusTitle(),
                            [
                                'class' => 'form-control',
                                'prompt' => 'Все статусы'
                            ]); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="box-footer">
            <button class="btn btn-success">Фильтр</button>
            <a href="<?= Url::toRoute(['legal-assistance/index']); ?>" class="btn btn-default">Сброс</a>
        </div>
    </div>
<?= Html::endForm(); ?>