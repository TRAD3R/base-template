<?php

use App\Html;
use yii\widgets\ActiveForm;

/**
 * @var \yii\web\View $this
 * @var \App\Forms\Admin\Page\PageForm $model
 */

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
                <div class="row">
                    <div class="col-xs-12 col-md-12">
                        <?= $form->field($model, 'content_2')->textarea(['class' => 'form-control ck-editor', 'style' => 'height: 100px', 'id' => 'content_2']); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-md-12">
                        <?= $form->field($model, 'content_3')->textarea(['class' => 'form-control ck-editor', 'style' => 'height: 100px', 'id' => 'content_3']); ?>
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
    // CKEDITOR.replace('content_1', {
    //     extraPlugins: 'embed,autoembed,image2',
    //     height: 500,
    //
    //     // Load the default contents.css file plus customizations for this sample.
    //     contentsCss: [
    //         'http://cdn.ckeditor.com/4.15.0/full-all/contents.css',
    //         'https://ckeditor.com/docs/vendors/4.15.0/ckeditor/assets/css/widgetstyles.css'
    //     ],
    //     // Setup content provider. See https://ckeditor.com/docs/ckeditor4/latest/features/media_embed
    //     embed_provider: '//ckeditor.iframe.ly/api/oembed?url={url}&callback={callback}',
    //
    //     // Configure the Enhanced Image plugin to use classes instead of styles and to disable the
    //     // resizer (because image size is controlled by widget styles or the image takes maximum
    //     // 100% of the editor width).
    //     image2_alignClasses: ['image-align-left', 'image-align-center', 'image-align-right'],
    //     image2_disableResizer: true
    // });
    //
    // CKEDITOR.replace('content_2', {
    //     extraPlugins: 'embed,autoembed,image2',
    //     height: 500,
    //
    //     // Load the default contents.css file plus customizations for this sample.
    //     contentsCss: [
    //         'http://cdn.ckeditor.com/4.15.0/full-all/contents.css',
    //         'https://ckeditor.com/docs/vendors/4.15.0/ckeditor/assets/css/widgetstyles.css'
    //     ],
    //     // Setup content provider. See https://ckeditor.com/docs/ckeditor4/latest/features/media_embed
    //     embed_provider: '//ckeditor.iframe.ly/api/oembed?url={url}&callback={callback}',
    //
    //     // Configure the Enhanced Image plugin to use classes instead of styles and to disable the
    //     // resizer (because image size is controlled by widget styles or the image takes maximum
    //     // 100% of the editor width).
    //     image2_alignClasses: ['image-align-left', 'image-align-center', 'image-align-right'],
    //     image2_disableResizer: true
    // });
    // CKEDITOR.replace('content_3', {
    //     extraPlugins: 'embed,autoembed,image2',
    //     height: 500,
    //
    //     // Load the default contents.css file plus customizations for this sample.
    //     contentsCss: [
    //         'http://cdn.ckeditor.com/4.15.0/full-all/contents.css',
    //         'https://ckeditor.com/docs/vendors/4.15.0/ckeditor/assets/css/widgetstyles.css'
    //     ],
    //     // Setup content provider. See https://ckeditor.com/docs/ckeditor4/latest/features/media_embed
    //     embed_provider: '//ckeditor.iframe.ly/api/oembed?url={url}&callback={callback}',
    //
    //     // Configure the Enhanced Image plugin to use classes instead of styles and to disable the
    //     // resizer (because image size is controlled by widget styles or the image takes maximum
    //     // 100% of the editor width).
    //     image2_alignClasses: ['image-align-left', 'image-align-center', 'image-align-right'],
    //     image2_disableResizer: true
    // });
</script>