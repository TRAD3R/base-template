<?php
/**
 * @var string $email
 */

?>
<div class="trd-fp-section">
    <div class="center trd-recovery-wrap">
        <div class="default-modal__content">
            <h3 class="default-modal__title"><?=$this->title?></h3>
            <?php if (!empty($email)): ?>
                <p class="modal-reg__descr">
                    На Вашу почту <strong> <?= $email?> </strong> отправлено письмо для смены пароля
                </p>
            <?php else: ?>
                <p class="modal-reg__descr">
                    Ваш пароль был изменен
                </p>
            <?php endif; ?>
        </div>
    </div>
</div>