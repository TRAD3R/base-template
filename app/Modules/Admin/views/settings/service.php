<?php

use App\App;
use App\Helpers\TextUtils;
use App\Html;
use App\Models\Service;
use App\Params;

/**
 * @var Service[] $services
 */
$this->title = 'Услуги';

?>

<div class="regions-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <table class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th>#</th>
            <th>
                Название
            </th>
            <th>
                Описание
            </th>
            <th>
                Иконка
            </th>
            <th>
                Стоимость
            </th>
            <th>
                Позиция
            </th>
            <th>
                Доступен
            </th>
            <th class="action-column"></th>
        </tr>
        </thead>
        <tbody>
        <?php
        /**
         * @var int $key
         * @var Service $service
         */
        foreach ($services as $key => $service):?>
            <?php $serviceEnable = $service->is_enable ? 'Да' : 'Нет'; ?>
            <tr data-key="<?=$service->id?>">
                <td><?=$key + 1?></td>
                <td class="service-title"  data-value="<?=$service->title?>">
                    <span>
                        <?=$service->title?>
                    </span>
                </td>
                <td class="service-description"  data-value="<?=$service->description?>">
                    <span>
                        <?=TextUtils::truncate(strip_tags($service->description), 160)?>
                    </span>
                </td>
                <td class="service-icon"  data-value="<?=$service->icon?>">
                    <span>
                        <?=$service->icon?>
                    </span>
                </td>
                <td class="service-cost"  data-value="<?=$service->cost?>">
                    <?=$service->cost?> руб.
                </td>
                <td class="service-weight"  data-value="<?=$service->weight?>">
                    <?=$service->weight?>
                </td>
                <td class="service-enable"  data-value="<?=$serviceEnable?>">
                    <?=$serviceEnable?>
                </td>
                <td>
                    <div class="service-edit">
                        <span class="glyphicon glyphicon-pencil" title="Редактировать"></span>
                    </div>
                    <div class="service-action" style="display: none">
                        <span class="glyphicon glyphicon-ok service-accept" title="Принять"></span>
                        <span class="glyphicon glyphicon-remove service-reject" title="Отклонить"></span>
                    </div>
                </td>
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>
</div>
<script>
    const BODY = $('body');
    /**
     * Редактирование данных клиента
     */
    BODY.on('click', '.service-edit', function () {
        let service = $(this).closest('tr');
        let serviceTitle = service.find('.service-title');
        let serviceDescription = service.find('.service-description');
        let serviceCost = service.find('.service-cost');
        let serviceIcon = service.find('.service-icon');
        let serviceWeight = service.find('.service-weight');
        let serviceEnable = service.find('.service-enable');

        serviceTitle.html('<input type="text" value="' + serviceTitle.data('value') + '">');
        serviceDescription.html('<textarea>' + serviceDescription.data('value') + '</textarea>');
        serviceCost.html('<input type="number" value="' + serviceCost.data('value') + '" min="0">');
        serviceIcon.html('<input type="text" value="' + serviceIcon.data('value') + '">');
        serviceWeight.html('<input type="number" value="' + serviceWeight.data('value') + '">');
        serviceEnable.html('<input class="form-check-input" type="checkbox"' + (serviceEnable.data('value') == 'Да' ? 'checked' : '') + '>');
        $(this).hide();
        $(this).next('div').show();
    });

    /**
     * Сохранение отредактированных данных
     */
    BODY.on('click', '.service-accept', function (){
        let service = $(this).closest('tr');
        let serviceTitle = service.find('.service-title');
        let serviceDescription = service.find('.service-description');
        let serviceCost = service.find('.service-cost');
        let serviceIcon = service.find('.service-icon');
        let serviceWeight = service.find('.service-weight');
        let serviceEnable = service.find('.service-enable');

        $.ajax({
            url: "/admin/service/edit/" + service.data('key'),
            method: "POST",
            data: {
                <?=Params::TITLE?>: serviceTitle.find('input').val(),
                <?=Params::DESCRIPTION?>: serviceDescription.find('textarea').val(),
                <?=Params::COST?>: serviceCost.find('input').val(),
                <?=Params::ICON?>: serviceIcon.find('input').val(),
                <?=Params::WEIGHT?>: serviceWeight.find('input').val(),
                <?=Params::ENABLE?>: serviceEnable.find('input').prop("checked") ? 1 : 0,
                _csrf       : '<?= App::i()->getRequest()->getCsrf() ?>',
            }
        }).done(function(res) {
            if(res.status) {
                location.href = "";
            } else {
                alert('Что-то пошло не так. Попробуйте еще раз');
            }
        }).fail(() => {
            alert('Не правильная отправка данных');
        });
    });

    /**
     * Отмена редактирования
     */
    BODY.on('click', '.service-reject', function (){
        let service = $(this).closest('tr');
        if (service.data('key') == 0) {
            service.remove();
        }
        let serviceTitle = service.find('.service-title');
        let serviceDescription = service.find('.service-description');
        let serviceCost = service.find('.service-cost');
        let serviceIcon = service.find('.service-icon');
        let serviceWeight = service.find('.service-weight');
        let serviceEnable = service.find('.service-enable');

        serviceTitle.text(serviceTitle.data('value'));
        serviceDescription.text(serviceDescription.text());
        serviceCost.text(serviceCost.data('value'));
        serviceIcon.text(serviceIcon.data('value'));
        serviceWeight.text(serviceWeight.data('value'));
        serviceEnable.text(serviceEnable.data('value'));
        $(this).closest('div').hide().prev('div').show();
    })

</script>

