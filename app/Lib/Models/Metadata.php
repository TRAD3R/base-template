<?php


namespace App\Models;

/**
 *
 * Class SettingPage
 * @package App\Models
 *
 * @property int    $id                 [integer]
 * @property int    $action             [varchar(100)]
 * @property string $title              [varchar(250)]
 * @property string $meta_description   [text]
 * @property string $meta_keywords      [varchar(250)]
 */

use App\ActiveRecord;

class Metadata extends ActiveRecord
{

    const PER_PAGE = 24;

    const SITE_INDEX = 'site';

    public static function tableName()
    {
        return '{{%meta_data}}';
    }

    public static function getMetaDescription($actionId)
    {
        return self::find()->where(['action' => $actionId])->one();
    }

}