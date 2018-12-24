<?php

namespace App\Helpers;

class Status
{
    const PROJECT_APPLICATION = 1;

    const INITIAL_APPROVED_BY_KS = 2;
    const INITIAL_KIV_BY_KS = 3;
    const INITIAL_REJECTED_BY_KS = 4;

    const INITIAL_APPROVED_BY_SUB = 5;
    const INITIAL_KIV_BY_SUB = 6;
    const INITIAL_REJECTED_BY_SUB = 7;

    const PROJECT_VERIFICATION = 8;

    const PLANNING_APPROVED_BY_KS = 9;
    const PLANNING_KIV_BY_KS = 10;
    const PLANNING_REJECTED_BY_KS = 11;

    const PLANNING_APPROVED_BY_SUB = 12;
    const PLANNING_KIV_BY_SUB = 13;
    const PLANNING_REJECTED_BY_SUB = 14;

    const NOTIFY_FOR_PAYMENT = 20;


    public static function project_application($value = null)
    {
        if (!empty($value)) {
            if (self::PROJECT_APPLICATION == $value) {
                return true;
            }
        } else {
            return self::PROJECT_APPLICATION;
        }

        return false;
    }

    public static function initial_approved_by_ks($value = null)
    {
        if (!empty($value)) {
            if (self::INITIAL_APPROVED_BY_KS == $value) {
                return true;
            }
        } else {
            return self::INITIAL_APPROVED_BY_KS;
        }

        return false;
    }

    public static function initial_kiv_by_ks($value = null)
    {
        if (!empty($value)) {
            if (self::INITIAL_KIV_BY_KS == $value) {
                return true;
            }
        } else {
            return self::INITIAL_KIV_BY_KS;
        }

        return false;
    }

    public static function initial_rejected_by_ks($value = null)
    {
        if (!empty($value)) {
            if (self::INITIAL_REJECTED_BY_KS == $value) {
                return true;
            }
        } else {
            return self::INITIAL_REJECTED_BY_KS;
        }

        return false;
    }

    public static function initial_approved_by_sub($value = null)
    {
        if (!empty($value)) {
            if (self::INITIAL_APPROVED_BY_SUB == $value) {
                return true;
            }
        } else {
            return self::INITIAL_APPROVED_BY_SUB;
        }

        return false;
    }

    public static function initial_kiv_by_sub($value = null)
    {
        if (!empty($value)) {
            if (self::INITIAL_KIV_BY_SUB == $value) {
                return true;
            }
        } else {
            return self::INITIAL_KIV_BY_SUB;
        }

        return false;
    }

    public static function initial_rejected_by_sub($value = null)
    {
        if (!empty($value)) {
            if (self::INITIAL_REJECTED_BY_SUB == $value) {
                return true;
            }
        } else {
            return self::INITIAL_REJECTED_BY_SUB;
        }

        return false;
    }

    public static function project_verification($value = null)
    {
        if (!empty($value)) {
            if (self::PROJECT_VERIFICATION == $value) {
                return true;
            }
        } else {
            return self::PROJECT_VERIFICATION;
        }

        return false;
    }

    public static function planning_approved_by_ks($value = null)
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

    public static function planning_kiv_by_ks($value = null)
    {
        if (!empty($value)) {
            if (self::PLANNING_KIV_BY_KS == $value) {
                return true;
            }
        } else {
            return self::PLANNING_KIV_BY_KS;
        }

        return false;
    }

    public static function planning_rejected_by_ks($value = null)
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

    public static function planning_approved_by_sub($value = null)
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

    public static function planning_kiv_by_sub($value = null)
    {
        if (!empty($value)) {
            if (self::PLANNING_KIV_BY_SUB == $value) {
                return true;
            }
        } else {
            return self::PLANNING_KIV_BY_SUB;
        }

        return false;
    }

    public static function planning_rejected_by_sub($value = null)
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

    public static function notify_for_payment($value = null)
    {
        if (!empty($value)) {
            if (self::NOTIFY_FOR_PAYMENT == $value) {
                return true;
            }
        } else {
            return self::NOTIFY_FOR_PAYMENT;
        }

        return false;
    }
}