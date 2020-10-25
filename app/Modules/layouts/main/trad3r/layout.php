<?php
/** @var $this \yii\web\View */

/** @var string $content контент страницы */

use App\App; ?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="ru">
<head>

    <meta charset="utf-8">

    <title><?= $this->title ?></title>
    <meta name="description" content="">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Template Basic Images Start -->
    <meta property="og:image" content="path/to/image.jpg">
    <link rel="icon" href="/favicon/favicon.ico">
    <link rel="apple-touch-icon" sizes="180x180" href="/favicon/apple-touch-icon-180x180.png">
    <!-- Template Basic Images End -->

    <!-- Custom Browsers Color Start -->
    <meta name="theme-color" content="#000">
    <!-- Custom Browsers Color End -->
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<main id="main">
    <?php
    if (in_array(App::i()->getController()->id, ['auth'])) {
        echo $this->render('header-empty');
    } else {
        echo $this->render('header');
    }
    ?>

    <section class="content-page">
        <?= $content ?>
    </section>

    <?=$this->render('footer');?>

</main>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
