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
        if (!empty($value)) {
            return number_format($value, 2);
        }
        
        return '0.00';
    }
}

if (!function_exists('removeMaskMoney')) {
    function removeMaskMoney($value)
    {
        if (!empty($value)) {
            return str_replace(',', '', $value);
        }

        return 0.00;
    }
}

if (!function_exists('setBudgetTitle')) {
    function setBudgetTitle($code, $desc, $style = '')
    {
        if ($style == 'no-bold') {
            if (!empty($code) && !empty($desc)) {
                return $code . ' : ' . $desc;
            }
        } else {
            if (!empty($code) && !empty($desc)) {
                return '<b>' . $code . '</b>' . ' : ' . $desc;
            }
        }

        return 'N/A';
    }
}

if (!function_exists('getList')) {
    function getList() {
        $types = [
            'Jawatankuasa Spesifikasi Teknikal',
            'Jawatankuasa Penilaian Teknikal',
            'Jawatankuasa Penilaian Harga'
        ];

        $output = '';

        $i = 1;
        foreach ($types as $type) {
            $output .= '<option value="' .  $i . '" listname="' . $type . '">' . $type . '</option>';

            $i++;
        }

        return $output;
    }
}

if (!function_exists('getEstimateCostBalance')) {
    function getEstimateCostBalance($estimation, $allocation) {
        if (!empty($estimation)) {
            return $allocation - $estimation;
        }

        return $allocation;
    }
}

if (!function_exists('setDateValue')) {
    function setDateValue($request, $date) {
        if (!empty($request)) {
            return $date;
        }

        return null;
    }
}
