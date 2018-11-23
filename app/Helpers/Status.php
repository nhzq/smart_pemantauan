<?php

namespace App\Helpers;

class Status
{
    const APPLIED_BY_KU = 1;
    const APPROVED_BY_KS = 2;
    const REJECTED_BY_KS = 3;
    const APPROVED_BY_SUB = 4;
    const REJECTED_BY_SUB = 5;

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

    public static function isApprovedByKS($value = null)
    {
        if (!empty($value)) {
            if (self::APPROVED_BY_KS == $value) {
                return true;
            }
        } else {
            return self::APPROVED_BY_KS;
        }

        return false;
    }

    public static function isRejectedByKS($value = null)
    {
        if (!empty($value)) {
            if (self::REJECTED_BY_KS == $value) {
                return true;
            }
        } else {
            return self::REJECTED_BY_KS;
        }

        return false;
    }

    public static function isApprovedBySUB($value = null)
    {
        if (!empty($value)) {
            if (self::APPROVED_BY_SUB == $value) {
                return true;
            }
        } else {
            return self::APPROVED_BY_SUB;
        }

        return false;
    }

    public static function isRejectedBySUB($value = null)
    {
        if (!empty($value)) {
            if (self::REJECTED_BY_SUB == $value) {
                return true;
            }
        } else {
            return self::REJECTED_BY_SUB;
        }

        return false;
    }
}