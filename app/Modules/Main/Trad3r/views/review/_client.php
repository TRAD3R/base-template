<?php
/**
 * @var \App\Models\Client $client
 */
?>
<div class="col-12 col-sm-6 col-md-3">
    <div class="client-item">
        <div class="client-item__header">
            <p class="client-item__number c-orange"></p>
            <p class="c-accent__darker headers-h4"><?=$client->title; ?></p>
        </div>
        <div class="client-item__body">
            <p class="c-accent__darker dr-text__normal">
                <?=$client->description; ?>
            </p>
        </div>
    </div>
</div>
