$(document).ready(function () {
    // Копирование по клику
    $(document).on('click', '.btn-copy', (e)=> {
        copyText(e.currentTarget);
    });
})

function copyText(el) {
    let input = document.createElement('input');

    input.setAttribute('value', el.getAttribute('data-copy'));
    document.body.append(input);
    input.select();
    document.execCommand("copy");
    input.remove();

    $('#macros-modal').removeClass('fade').show();
    setTimeout(function (){
        $('#macros-modal').addClass('fade').hide();
    }, 500)
}

if($('#content_1').length){
    CKEDITOR.replace('content_1', {
        extraPlugins: 'embed,autoembed,image2',
        height: 500,

        // Load the default contents.css file plus customizations for this sample.
        contentsCss: [
            'http://cdn.ckeditor.com/4.15.0/full-all/contents.css',
            'https://ckeditor.com/docs/vendors/4.15.0/ckeditor/assets/css/widgetstyles.css'
        ],
        // Setup content provider. See https://ckeditor.com/docs/ckeditor4/latest/features/media_embed
        embed_provider: '//ckeditor.iframe.ly/api/oembed?url={url}&callback={callback}',

        // Configure the Enhanced Image plugin to use classes instead of styles and to disable the
        // resizer (because image size is controlled by widget styles or the image takes maximum
        // 100% of the editor width).
        image2_alignClasses: ['image-align-left', 'image-align-center', 'image-align-right'],
        image2_disableResizer: true
    });
}

if($('#content_2').length){
    CKEDITOR.replace('content_2', {
        extraPlugins: 'embed,autoembed,image2',
        height: 300,

        // Load the default contents.css file plus customizations for this sample.
        contentsCss: [
            'http://cdn.ckeditor.com/4.15.0/full-all/contents.css',
            'https://ckeditor.com/docs/vendors/4.15.0/ckeditor/assets/css/widgetstyles.css'
        ],
        // Setup content provider. See https://ckeditor.com/docs/ckeditor4/latest/features/media_embed
        embed_provider: '//ckeditor.iframe.ly/api/oembed?url={url}&callback={callback}',

        // Configure the Enhanced Image plugin to use classes instead of styles and to disable the
        // resizer (because image size is controlled by widget styles or the image takes maximum
        // 100% of the editor width).
        image2_alignClasses: ['image-align-left', 'image-align-center', 'image-align-right'],
        image2_disableResizer: true
    });
}

if($('#content_3').length){
    CKEDITOR.replace('content_3', {
        extraPlugins: 'embed,autoembed,image2',
        height: 300,

        // Load the default contents.css file plus customizations for this sample.
        contentsCss: [
            'http://cdn.ckeditor.com/4.15.0/full-all/contents.css',
            'https://ckeditor.com/docs/vendors/4.15.0/ckeditor/assets/css/widgetstyles.css'
        ],
        // Setup content provider. See https://ckeditor.com/docs/ckeditor4/latest/features/media_embed
        embed_provider: '//ckeditor.iframe.ly/api/oembed?url={url}&callback={callback}',

        // Configure the Enhanced Image plugin to use classes instead of styles and to disable the
        // resizer (because image size is controlled by widget styles or the image takes maximum
        // 100% of the editor width).
        image2_alignClasses: ['image-align-left', 'image-align-center', 'image-align-right'],
        image2_disableResizer: true
    });
}