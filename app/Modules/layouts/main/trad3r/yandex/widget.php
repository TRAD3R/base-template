<?php
/**
 * @var string $confirmationToken
 * @var string $successUrl
 */
?>
<!--Подключение библиотеки-->
<script src="https://kassa.yandex.ru/checkout-ui/v2.js"></script>

<div class="dr-modal dr-modal-sm-bigger dr-modal__default is-active">

    <div class="dr-modal-wrapper">
        <div class="dr-modal__content">
            <div class="dr-modal__body">
                <div id="payment-form"></div>
            </div>
        </div>
        <div class="dr-modal__overlay"></div>
    </div>

</div>
<!--HTML-элемент, в котором будет отображаться платежная форма-->


<script>
    //Инициализация виджета. Все параметры обязательные.
    const checkout = new window.YandexCheckout({
        confirmation_token: '<?=$confirmationToken?>', //Токен, который перед проведением оплаты нужно получить от Яндекс.Кассы
        return_url: '<?=$successUrl?>', //Ссылка на страницу завершения оплаты
        //Настройка виджета
        customization: {
            //Настройка цветовой схемы, минимум один параметр, значения цветов в HEX
            colors: {
                //Цвет акцентных элементов: кнопка Заплатить, выбранные переключатели, опции и текстовые поля
                controlPrimary: '#ff9840', //Значение цвета в HEX
            }
        },
        error_callback(error) {
            //Обработка ошибок инициализации
        }
    });

    //Отображение платежной формы в контейнере
    checkout.render('payment-form');
</script>
