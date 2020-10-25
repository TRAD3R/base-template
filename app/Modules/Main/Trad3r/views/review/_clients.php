<?php
/**
 * @var \yii\web\View $this
 * @var \App\Models\Client[] $clients
 */
?>
<?php foreach ($clients as $client) {
    echo $this->render('_client', ['client' => $client]);
} ?>
