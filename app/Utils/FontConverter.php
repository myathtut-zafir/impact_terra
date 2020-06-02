<?php

namespace App\Utils;

use Illuminate\Support\Facades\Auth;

class FontConverter
{

    public static function ZawgyiConverter($input_string): string
    {
        if ($input_string) {
            $checkFontMyanmar = isMyanmarSar($input_string);
            if ($checkFontMyanmar) {
                $fontDetect = fontDetect($input_string);

                if ($fontDetect !== "zawgyi") {
                    $input_string = uni2zg($input_string);
                }
            }
        }
        return $input_string;
    }

    public static function UniConverter($input_string): string
    {
        if ($input_string) {
            $checkFontMyanmar = isMyanmarSar($input_string);

            if ($checkFontMyanmar) {
                $fontDetect = fontDetect($input_string);
                if ($fontDetect == "zawgyi") {
                    $input_string = zg2uni($input_string);
                }
            }
        }
        return $input_string;
    }

}
