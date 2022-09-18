<?php

if ( ! function_exists('getCssJsPath') )
{
    function getCssJsPath($url)
    {
        return asset($url);// . "?v=" . config('app.version');
    }
}

if ( ! function_exists('capitalize') ) {
    function capitalize($string)
    {
        return ucfirst(strtolower($string));
    }
}