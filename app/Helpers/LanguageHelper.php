<?php

namespace App\Helpers;

use Illuminate\Support\Facades\App;

class LanguageHelper
{
    public static function getCurrentLocale()
    {
        return App::getLocale();
    }
    
    public static function isEnglish()
    {
        return App::getLocale() === 'en';
    }
    
    public static function isMalay()
    {
        return App::getLocale() === 'ms';
    }
    
    public static function getFieldValue($model, $field)
    {
        $locale = App::getLocale();
        
        // If Malay and BM field exists, use it
        if ($locale === 'ms' && isset($model->{$field . '_bm'}) && $model->{$field . '_bm'}) {
            return $model->{$field . '_bm'};
        }
        
        // Otherwise use default (English)
        return $model->{$field};
    }
}