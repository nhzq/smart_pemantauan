<?php

// Remove dash(-) and capitalize first character of role
if (!function_exists('helperRoleName')) {
    function helperRoleName($value)
    {
        return ucwords(str_replace('-', ' ', $value));
    }
}
