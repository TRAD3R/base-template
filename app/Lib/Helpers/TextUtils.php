<?php

namespace App\Helpers;

use App\App;

class TextUtils
{

    const RE_CHK_UTF8_ENCODED = '/%u([0-9a-fA-F]{3,4})/';

    /**
     * @var string
     */
    public static $_UTF8_MODIFIER = 'u';

    /**
     * Декодирование url (%uXXXX/%XX)
     * @param string $str Значение
     * @return string
     */
    public static function utf8_urldecode($str)
    {
        if (preg_match(self::RE_CHK_UTF8_ENCODED, $str)) {
            return html_entity_decode(preg_replace(self::RE_CHK_UTF8_ENCODED, '&#x\1;', $str), null, 'UTF-8');
        }
        return urldecode($str);
    }

    /**
     * Транслитерация русских слов
     * @param string $str
     * @param bool   $to_lower
     * @return string
     */
    public static function rus2Translate($str, $to_lower = true)
    {
        $tr     = [
            'А'  => 'A',
            'Б'  => 'B',
            'В'  => 'V',
            'Г'  => 'G',
            'Д'  => 'D',
            'Е'  => 'E',
            'Ё'  => 'YO',
            'Ж'  => 'J',
            'З'  => 'Z',
            'И'  => 'I',
            'Й'  => 'Y',
            'К'  => 'K',
            'Л'  => 'L',
            'М'  => 'M',
            'Н'  => 'N',
            'О'  => 'O',
            'П'  => 'P',
            'Р'  => 'R',
            'С'  => 'S',
            'Т'  => 'T',
            'У'  => 'U',
            'Ф'  => 'F',
            'Х'  => 'H',
            'Ц'  => 'C',
            'Ч'  => 'CH',
            'Ш'  => 'SH',
            'Щ'  => 'SCH',
            'Ъ'  => '',
            'Ы'  => 'YI',
            'Ь'  => '',
            'Э'  => 'E',
            'Ю'  => 'YU',
            'Я'  => 'YA',
            'а'  => 'a',
            'б'  => 'b',
            'в'  => 'v',
            'г'  => 'g',
            'д'  => 'd',
            'е'  => 'e',
            'ё'  => 'yo',
            'ж'  => 'j',
            'з'  => 'z',
            'и'  => 'i',
            'й'  => 'y',
            'к'  => 'k',
            'л'  => 'l',
            'м'  => 'm',
            'н'  => 'n',
            'о'  => 'o',
            'п'  => 'p',
            'р'  => 'r',
            'с'  => 's',
            'т'  => 't',
            'у'  => 'u',
            'ф'  => 'f',
            'х'  => 'h',
            'ц'  => 'c',
            'ч'  => 'ch',
            'ш'  => 'sh',
            'щ'  => 'sch',
            'ъ'  => '',
            'ы'  => 'y',
            'ь'  => '',
            'э'  => 'e',
            'ю'  => 'yu',
            'я'  => 'ya',
            ' '  => '_',
            '-'  => '_',
            '&'  => '_',
            '\'' => '',
            '—'  => '_',
        ];
        $result = preg_replace('/[^0-9_a-z.]/i', '', strtr($str, $tr));
        return $to_lower ? mb_strtolower($result, 'UTF-8') : $result;
    }

    /**
     * @param string  $string      вхождение строки
     * @param integer $length      Определяет максимальную длинну обрезаемой строки
     * @param string  $etc         Текстовая строка, которая заменяет обрезанный текст. Её длинна НЕ включена в максимальную длинну обрезаемой строки.
     * @param boolean $break_words Определяет, обрезать ли строку в промежутке между словами (false) или строго на указаной длинне (true).
     * @param boolean $middle      Определяет, нужно ли обрезать строку в конце (false) или в середине строки (true).~
     *                             ↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑ ~Обратите внимание, что при включении этой опции, промежутки между словами игнорируются.
     * @return string
     */
    public static function truncate($string, $length = 80, $etc = '...', $break_words = false, $middle = false)
    {
        if ($length == 0) {
            return '';
        }

        if (function_exists('mb_strlen') && function_exists('mb_substr')) {
            if (mb_strlen($string, App::i()->getApp()->charset) > $length) {
                $length -= min($length, mb_strlen($etc, App::i()->getApp()->charset));
                if (!$break_words && !$middle) {
                    $string = preg_replace('/\s+?(\S+)?$/' . self::$_UTF8_MODIFIER,
                        '',
                        mb_substr($string, 0, $length + 1, App::i()->getApp()->charset)
                    );
                }
                if (!$middle) {
                    return mb_substr($string, 0, $length, App::i()->getApp()->charset) . $etc;
                }

                return mb_substr($string,
                        0,
                        $length / 2,
                        App::i()->getApp()->charset)
                    . $etc
                    . mb_substr($string, -$length / 2, $length, App::i()->getApp()->charset
                    );
            }

            return $string;
        }

        // no MBString fallback
        if (isset($string[$length])) {
            $length -= min($length, strlen($etc));
            if (!$break_words && !$middle) {
                $string = preg_replace('/\s+?(\S+)?$/', '', substr($string, 0, $length + 1));
            }
            if (!$middle) {
                return substr($string, 0, $length) . $etc;
            }

            return substr($string, 0, $length / 2) . $etc . substr($string, -$length / 2);
        }

        return $string;
    }

    /**
     * Сделать первую букву заглавной
     * @param                    $str
     * @param bool               $press понижать ли остальные буквы
     * @return string
     */
    public static function mb_ucfirst($str, $press = false)
    {
        $first = mb_substr($str, 0, 1, App::i()->getApp()->charset);
        $last  = mb_substr($str, 1, (strlen($str) - 1), App::i()->getApp()->charset);
        $first = mb_strtoupper($first, App::i()->getApp()->charset);
        if ($press) {
            $last = mb_strtolower($last, App::i()->getApp()->charset);
        }
        return $first . $last;
    }

    /**
     * Получаем правильный strlen с кодировкой
     * @param $string
     * @return int
     */
    public static function getStrlen($string)
    {
        return mb_strlen($string, App::i()->getApp()->charset);
    }

    /**
     * Меняем строку с русской раскладки на английский или наоборот
     * @param string $str
     * @return string
     */
    public static function switcher($str)
    {
        $tr = [
            'А'  => 'F',
            'Б'  => '<',
            'В'  => 'D',
            'Г'  => 'U',
            'Д'  => 'L',
            'Е'  => 'T',
            'Ё'  => '~',
            'Ж'  => ':',
            'З'  => 'P',
            'И'  => 'B',
            'Й'  => 'Q',
            'К'  => 'R',
            'Л'  => 'K',
            'М'  => 'V',
            'Н'  => 'Y',
            'О'  => 'J',
            'П'  => 'G',
            'Р'  => 'H',
            'С'  => 'C',
            'Т'  => 'N',
            'У'  => 'E',
            'Ф'  => 'A',
            'Х'  => '{',
            'Ц'  => 'W',
            'Ч'  => 'X',
            'Ш'  => 'I',
            'Щ'  => 'O',
            'Ъ'  => '}',
            'Ы'  => 'S',
            'Ь'  => 'M',
            'Э'  => '""',
            'Ю'  => '>',
            'Я'  => 'Z',
            'а'  => 'f',
            'б'  => ',',
            'в'  => 'd',
            'г'  => 'u',
            'д'  => 'l',
            'е'  => 't',
            'ё'  => '``',
            'ж'  => ';',
            'з'  => 'p',
            'и'  => 'b',
            'й'  => 'q',
            'к'  => 'r',
            'л'  => 'k',
            'м'  => 'v',
            'н'  => 'y',
            'о'  => 'j',
            'п'  => 'g',
            'р'  => 'h',
            'с'  => 'c',
            'т'  => 'n',
            'у'  => 'e',
            'ф'  => 'a',
            'х'  => '[',
            'ц'  => 'w',
            'ч'  => 'x',
            'ш'  => 'i',
            'щ'  => 'o',
            'ъ'  => ']',
            'ы'  => 's',
            'ь'  => 'm',
            'э'  => '\'',
            'ю'  => '.',
            'я'  => 'z',
            'A'  => 'Ф',
            'B'  => 'И',
            'C'  => 'С',
            'D'  => 'В',
            'E'  => 'У',
            'F'  => 'А',
            'G'  => 'П',
            'H'  => 'Р',
            'I'  => 'Ш',
            'J'  => 'О',
            'K'  => 'Л',
            'L'  => 'Д',
            'M'  => 'Ь',
            'N'  => 'Т',
            'O'  => 'Щ',
            'P'  => 'З',
            'Q'  => 'Й',
            'R'  => 'К',
            'S'  => 'Ы',
            'T'  => 'Е',
            'U'  => 'Г',
            'V'  => 'М',
            'W'  => 'Ц',
            'X'  => 'Ч',
            'Y'  => 'Н',
            'Z'  => 'Я',
            'a'  => 'ф',
            'b'  => 'и',
            'c'  => 'с',
            'd'  => 'в',
            'e'  => 'у',
            'f'  => 'а',
            'g'  => 'п',
            'h'  => 'р',
            'i'  => 'ш',
            'j'  => 'о',
            'k'  => 'л',
            'l'  => 'д',
            'm'  => 'ь',
            'n'  => 'т',
            'o'  => 'щ',
            'p'  => 'з',
            'q'  => 'й',
            'r'  => 'к',
            's'  => 'ы',
            't'  => 'е',
            'u'  => 'г',
            'v'  => 'м',
            'w'  => 'ц',
            'x'  => 'ч',
            'y'  => 'н',
            'z'  => 'я',
            '{'  => 'Х',
            '~'  => 'Ё',
            '}'  => 'Ъ',
            ':'  => 'Ж',
            '"'  => 'Э',
            '<'  => 'Б',
            '>'  => 'Ю',
            '['  => 'х',
            '``' => 'ё',
            ']'  => 'ъ',
            ';'  => 'ж',
            '\'' => 'э',
            ','  => 'б',
            '.'  => 'ю',
        ];
        return strtr($str, $tr);
    }

    public static function formatBytes($size)
    {
        $base   = log($size) / log(1024);
        $suffix = ["", "KB", "MB", "GB", "TB"];
        $f_base = floor($base);

        return round(pow(1024, $base - floor($base)), 1) . (' '.$suffix[(int)$f_base]);
    }

    public static function aliasFromTitle($title)
    {
        $tr = array(
            " "=> "_", "/"=> "_"
        );

        $str = (string) $title; // преобразуем в строковое значение
        $str = strip_tags($str); // убираем HTML-теги
        $str = str_replace(array("\n", "\r"), " ", $str); // убираем перевод каретки
        $str = trim($str); // убираем пробелы в начале и конце строки
        $str = function_exists('mb_strtolower') ? mb_strtolower($str) : strtolower($str); // переводим строку в нижний регистр (иногда надо задать локаль)
        $str = strtr($str, $tr);
        $str = preg_replace("/\s+/", ' ', $str); // удаляем повторяющие пробелы
        $str = preg_replace("/[^0-9a-z-_.]/i", "-", $str); // очищаем строку от недопустимых символов

        return $str;
    }

    public static function prepareFilename(string $name)
    {
        $str = function_exists('mb_strtolower') ? mb_strtolower($name) : strtolower($name); // переводим строку в нижний регистр (иногда надо задать локаль)
        $str = self::rus2Translate($str);
        return preg_replace("/[^0-9a-z-_.]/i", "-", $str); // очищаем строку от недопустимых символов
    }

    /**
     * Добавляет суффикс перед расширением файла
     * @param string $title
     * @param string $suffix
     *
     * return string
     */
    public static function addFilenameSuffix($title, $suffix)
    {
        $extPos = strripos($title, '.');

        if($extPos === false) {
            return $title . $suffix;
        }

        return sprintf("%s%s%s", mb_substr($title, 0, $extPos), $suffix, mb_substr($title, $extPos));
    }

    /**
     * Склонение существительных с числительными
     * @param int    $number
     * @param string $form1 строчка в ед. числе          (файл)
     * @param string $form2 строка в двойственном числе  (файла)
     * @param string $form3 строка в мн. числе           (файлов)
     * @return string
     */
    public static function pluralForm($number, $form1, $form2, $form3)
    {
        if (!is_numeric($number)) {
            return '';
        }
        $n  = abs($number) % 100;
        $n1 = $n % 10;
        if ($n > 10 && $n < 20) {
            return $form3;
        }
        if ($n1 > 1 && $n1 < 5) {
            return $form2;
        }
        if ($n1 == 1) {
            return $form1;
        }
        return $form3;
    }
}
