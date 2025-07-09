<?php

namespace App\Helpers;

class NumberFormatterHelper {
    public static function short($number, $precision = 1) {
        if ($number < 1000) return $number;
        $units = ['', 'K', 'M', 'B', 'T'];
        $power = floor(log($number, 1000));
        $formatted = round($number / pow(1000, $power), $precision);
        return $formatted . $units[$power];
    }
}
