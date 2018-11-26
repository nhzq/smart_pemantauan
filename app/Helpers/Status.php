<?php

namespace App\Helpers;

class Status
{
    const APPLIED_BY_KU = 1;
    const APPROVED_BY_KS = 2;
    const REJECTED_BY_KS = 3;
    const APPROVED_BY_SUB = 4;
    const REJECTED_BY_SUB = 5;
    const PLANNING_PHASE = 10;
    const PLANNING_BY_KU = 11;
    const PLANNING_APPROVED_BY_KS = 12;
    const PLANNING_REJECTED_BY_KS = 13;
    const PLANNING_APPROVED_BY_SUB = 14;
    const PLANNING_REJECTED_BY_SUB = 15;

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

    public static function toPlanningPhase($value = null)
    {
        if (!empty($value)) {
            if (self::PLANNING_PHASE == $value) {
                return true;
            }
        } else {
            return self::PLANNING_PHASE;
        }

        return false;
    }

    public static function planningByKU($value = null)
    {
        if (!empty($value)) {
            if (self::PLANNING_BY_KU == $value) {
                return true;
            }
        } else {
            return self::PLANNING_BY_KU;
        }

        return false;
    }

    public static function planningApprovedByKS($value = null)
    {
        if (!empty($value)) {
            if (self::PLANNING_APPROVED_BY_KS == $value) {
                return true;
            }
        } else {
            return self::PLANNING_APPROVED_BY_KS;
        }

        return false;
    }

    public static function planningRejectedByKS($value = null)
    {
        if (!empty($value)) {
            if (self::PLANNING_REJECTED_BY_KS == $value) {
                return true;
            }
        } else {
            return self::PLANNING_REJECTED_BY_KS;
        }

        return false;
    }

    public static function planningApprovedBySUB($value = null)
    {
        if (!empty($value)) {
            if (self::PLANNING_APPROVED_BY_SUB == $value) {
                return true;
            }
        } else {
            return self::PLANNING_APPROVED_BY_SUB;
        }

        return false;
    }

    public static function planningRejectedBySUB($value = null)
    {
        if (!empty($value)) {
            if (self::PLANNING_REJECTED_BY_SUB == $value) {
                return true;
            }
        } else {
            return self::PLANNING_REJECTED_BY_SUB;
        }

        return false;
    }
}