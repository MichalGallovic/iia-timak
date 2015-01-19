<?php
namespace IIA\Lang;


class Lang {
    public static $languages = ['sk'=>'sk_SK','en'=>'en_GB'];
    protected static $default = 'sk';
    protected static $current;

    public static function setLocale($locale) {
        if(array_key_exists($locale,Lang::$languages)) {
            setlocale(LC_ALL,Lang::$languages[$locale]);
            Lang::$current = $locale;
        }
    }

    public static function getLang() {
        return Lang::$current;
    }

    public static function get($string) {
        // get contents of app/Lang/{$current}/$s
        $fileName = explode('_',$string);
        $filePath = dirname(__FILE__).'/'.Lang::$current.'/'.$fileName[0].'.php';

        if(file_exists($filePath)) {
            $langContents = include($filePath);
            if(isset($langContents[$fileName[1]])) {
                return $langContents[$fileName[1]];
            }
        }

        return $string;
    }
} 