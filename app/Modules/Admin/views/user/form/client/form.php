<?php
use App\Forms\Admin\User\UserForm;
use App\Helpers\Url;
use App\Html;
use App\Models\User;
use yii\widgets\ActiveForm;

/**
 * @var $model UserForm
 */


$this->title = $model->isNewRecord ? 'Добавление пользователя' : 'Редактирование пользователя ' . Html::encode($model->username);
$emailInputType = !$model->isNewRecord ? ['readonly' => 'readonly', 'disabled' => 'disabled'] : [];
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Профиль пользователя</h3>
            </div>
            <?php $form = ActiveForm::begin([
                'id'     => 'manager-form',
                'method' => 'POST',
            ]); ?>
            <div class="box-body">
                <div class="col-xs-6">
                    <?= $form->field($model, 'email')->input('email',
                        array_merge($emailInputType, ['class' => 'form-control no-toggle'])
                    );
                    ?>
                    <?= $form->field($model, 'username')->textInput(['class' => 'form-control no-toggle']); ?>
                    <?= $form->field($model, 'password')->passwordInput(['class' => 'form-control no-toggle']); ?>
                    <?= $form->field($model, 'status')->dropDownList(User::getStatus(), ['class' => 'form-control no-toggle']); ?>
                    <?= $form->field($model, 'category')->dropDownList(User::getUserCategory(), ['class' => 'form-control no-toggle']); ?>
                    <span class="generate" style="font-weight: normal;"></span>
                </div>
                <div class="col-xs-6">
                    <div class="form-group">
                        <?= $form->field($model, 'firstname')->textInput(['class' => 'form-control no-toggle', 'required' => true]); ?>
                        <?= $form->field($model, 'secondname')->textInput(['class' => 'form-control no-toggle']); ?>
                        <?= $form->field($model, 'lastname')->textInput(['class' => 'form-control no-toggle', 'required' => true]); ?>
                        <?= $form->field($model, 'phone')->textInput(['class' => 'form-control no-toggle', 'required' => true]); ?>
                        <?= $form->field($model, 'company')->textInput(['class' => 'form-control no-toggle', 'required' => true]); ?>
                    </div>
                </div>
            </div>
            <div class="box-footer sev-btns">
                <button class="btn btn-success">Сохранить</button>
                <a href="<?=Url::toRoute(['user/client'])?>" class="btn btn-danger">Отменить</a>
                <a class="btn btn-primary generate-btn">Сгенерировать пароль</a>
            </div>
            <?php $form->end(); ?>
        </div>
    </div>

</div>

<script>
    $(function() {
        $('.generate-btn').on('click', function() {
            $('.generate').text(Math.random().toString(36).slice(-8)+''+Math.random().toString(36).slice(-8));
        });
    });
</script>