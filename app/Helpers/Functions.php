<?php

if (!function_exists('getRoleName')) {
    function getRoleName($value)
    {
        return ucwords(str_replace('-', ' ', $value));
    }
}

if (!function_exists('currency')) {
    function currency($value)
    {
        return number_format($value, 2);
    }
}

if (!function_exists('removeMaskMoney')) {
    function removeMaskMoney($value)
    {
        if (!empty($value)) {
            return str_replace(',', '', $value);
        }

        return null;
    }
}

if (!function_exists('setBudgetTitle')) {
    function setBudgetTitle($code, $desc)
    {
        if (!empty($code) && !empty($desc)) {
            return '<b>' . $code . '</b>' . ' : ' . $desc;
        }

        return 'N/A';
    }
}
