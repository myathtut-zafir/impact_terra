<?php
/**
 * Created by PhpStorm.
 * User: myathtut
 * Date: 5/6/18
 * Time: 9:31 PM
 */

if (! function_exists('fontDetect')) {
    function fontDetect($content, $default = "zawgyi")
    {
        return SteveNay\MyanFont\MyanFont::fontDetect($content, $default);
    }
}

if (! function_exists('isMyanmarSar')) {
    function isMyanmarSar($content)
    {
        return SteveNay\MyanFont\MyanFont::isMyanmarSar($content);
    }
}

if (! function_exists('uni2zg')) {
    function uni2zg($content)
    {
        return SteveNay\MyanFont\MyanFont::uni2zg($content);
    }
}

if (! function_exists('zg2uni')) {
    function zg2uni($content)
    {
        return SteveNay\MyanFont\MyanFont::zg2uni($content);
    }
}