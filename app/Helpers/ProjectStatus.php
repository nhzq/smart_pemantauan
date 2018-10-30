<?php

namespace App\Helpers;

class ProjectStatus
{
    const APPLIED_BY_KU = 1;
    const APPROVED_BY_KS = 2;
    const APPROVED_BY_KJ = 4;
    const REJECTED_BY_KS = 8;
    const REJECTED_BY_KJ = 16;

    public static function isAppliedByKU($value = null)
    {
        if (!empty($value)) {
            if (self::APPLIED_BY_KU == $value) {
                return true;
            }
        } else {
            return self::APPLIED_BY_KU;
        }

        return false;
    }

    public static function isApprovedByKS($value)
    {
        return self::APPROVED_BY_KS;
    }

    public static function isApprovedByKJ($value)
    {
        return self::APPROVED_BY_KJ;
    }

    public static function isRejectedByKS($value)
    {
        return self::REJECTED_BY_KS;
    }

    public static function isRejectedByKJ($value)
    {
        return self::REJECTED_BY_KJ;
    }
}