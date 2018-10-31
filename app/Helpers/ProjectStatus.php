<?php

namespace App\Helpers;

class ProjectStatus
{
    const APPLIED_BY_KU = 1;
    const APPROVED_BY_KS = 2;
    const APPROVED_BY_KJ = 4;
    const REJECTED_BY_KS = 8;
    const REJECTED_BY_KJ = 16;

    // Status by Ketua Unit
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

    // Status by Ketua Seksyen
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

    // Status by Ketua Jabatan
    public static function isApprovedByKJ($value = null)
    {
        if (!empty($value)) {
            if (self::APPROVED_BY_KJ == $value) {
                return true;
            }
        } else {
            return self::APPROVED_BY_KJ;
        }

        return false;
    }

    // Status by Ketua Seksyen
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

    // Status by Ketua Seksyen
    public static function isRejectedByKJ($value = null)
    {
        if (!empty($value)) {
            if (self::REJECTED_BY_KJ == $value) {
                return true;
            }
        } else {
            return self::REJECTED_BY_KJ;
        }

        return false;
    }
}