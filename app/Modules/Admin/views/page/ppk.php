<?php

use App\Html;
use yii\widgets\ActiveForm;

/**
 * @var \yii\web\View $this
 * @var \App\Forms\Admin\Page\PageForm $model
 */

$this->title = 'ППК';

?>

<div class="row">
    <?php $form = ActiveForm::begin()?>
    <div class="col-xs-12 col-md-12">
        <div class="box box-success">
            <div class="box-body">
                <?= Html::errorSummary($model, ['encode' => false]) ?>
                <div class="row">
                    <div class="col-xs-8 col-md-6">
                        <h3><?= $this->title ?></h3>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-md-12">
                        <?= $form->field($model, 'content_1')->textarea(['class' => 'form-control', 'style' => 'height: 100px', 'id' => 'content_1']); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2 col-xs-12">
                <?=Html::submitButton('Сохранить', ['class' => 'btn btn-success'])?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end();?>
</div>
<script>
    // CKEDITOR.replace('content_1');
</script>