<?php

namespace App;

use App\Helpers\Url;
use App\Models\Occupation;
use Exception;
use yii\data\Pagination;
use yii\web\View;

class Html extends \yii\helpers\Html
{

    /**
     * Вставляем во вьюху в то место, где нужен пагинатор
     * @see OfferController
     * @param View       $view
     * @param Pagination $pagination
     * @param array      $options
     * @return string
     * @throws \Exception
     */
    public static function pagination(View $view, Pagination $pagination, $options = [])
    {
        if (!$view || !$pagination) {
            throw new Exception('Invalid params passed');
        }

        return $view->renderFile('@Admin/views/layout/paginator.php', ['pagination' => $pagination, 'options' => $options]);
    }

    /**
     * Селект с аякс подгрузкой родов деятельности
     * @param        $name
     * @param        $selection
     * @param array  $options
     * @param string $option_param
     * @return string
     * @throws \Exception
     */
    public static function occupationAjaxSelect($name, $selection, $options = [], $option_param = 'title')
    {
        $main_options = [
            'class'            => 'form-control',
            'data-select-type' => 'ajax',
            'data-backend'     => Url::toRoute('/admin/occupations/get-ajax'),
            'data-placeholder' => 'Введите ID или название',
        ];

        return Html::dropDownList($name, $selection, Occupation::getParentForSelect($selection, $option_param), array_merge($main_options, $options));
    }

    /**
     * Генерим ссылку на юзера
     * @param        $id
     * @param string $target
     * @param bool   $use_icon
     * @param string $field
     * @return string
     */
    public static function userUrl($url, $id, $target = '_blank', $use_icon = true, $field = null)
    {
        if (!$field) {
            $field = $id;
        }

        return '<a href="' . Url::toRoute([
                $url,
                Params::ID => $id,
            ]) . '" target="' . $target . '">' . ($use_icon ? '<i class="fas fa-user"></i>&nbsp;' : '') . self::encode($field) . '</a>';
    }

    /**
     * @param $name
     * @param $selection
     * @param $options
     * @return string
     */
    public static function boolDropDownList($name, $selection, $options = [])
    {
        return \yii\helpers\Html::dropDownList($name, $selection, [
            0 => 'Нет',
            1 => 'Да',
        ], $options);
    }

}