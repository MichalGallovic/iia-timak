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
} 