<?php

// Remove dash(-) and capitalize first character of role
if (!function_exists('helperRoleName')) {
    function helperRoleName($value)
    {
        return ucwords(str_replace('-', ' ', $value));
    }
}

if (!function_exists('helperCurrency')) {
    function helperCurrency($value)
    {
        return number_format($value, 2);
    }
}
