<?php


namespace App\Services;


class LocaleService
{
    public static function getLocalAttribute($attribute,$locale = null){
        $locale = $locale?:app()->getLocale();
        return $attribute.'_'.$locale.' as '.$attribute;
    }
}
