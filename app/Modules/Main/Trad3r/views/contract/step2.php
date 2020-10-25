<?php

use App\Model;

/**
 * @var $view string
 * @var $model Model
 * @var $type int
 */


$this->title = 'Шаг2';
?>

<?=$this->render('forms/' . $view, ['model' => $model, 'type' => $type])?>


<script>
    document.querySelector('#main').classList.add('bg-accent-gradient__lighten');
</script>
