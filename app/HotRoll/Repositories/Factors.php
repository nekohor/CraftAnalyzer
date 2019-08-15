<?php
/**
 * Created by PhpStorm.
 * User: nekohor
 * Date: 2019/8/13
 * Time: 16:00
 */

namespace App\HotRoll\Repositories;


class Factors
{
    public static $tempFactors = [
        "r2dt",
        "fet",
        "fdt",
        "ct",
        "wr_speed7"
    ];

    public static $shapeFactors = [
        "thick_clg",
        "crown40",
        "wedge40",
        "sym_flt",
        "asym_flt",
        "r2_cent_off",
        "fm_cent_off"
    ];

    public static $lengthFactors = [
        "clg_calc_length",
        "mfg_calc_length",
        "calc_length1",
        "calc_length2",
        "calc_length3",
        "calc_length4",
        "calc_length5",
        "calc_length6",
        "calc_length7",
        "fm_calc_length",
        "flt_calc_length",
        "r2dt_calc_length",
        "r2dw_calc_length",
        "ct_calc_length",
        "fet_calc_length",
        "fdt_calc_length"
    ];

    public static $fmStandFactors = [
        "looper_angle",
        "total_roll_force",
        "diff_roll_force",
        "ct_gap",
        "os_bend_force",
        "ds_bend_force",
        "leveling",
        "pos_shft"
    ];

    public static function get()
    {
        $stds = [1, 2, 3, 4, 5, 6, 7];

        $fmFactors = [];
        foreach (self::$fmStandFactors as $factor)
        {
            foreach($stds as $std)
            {
                $fmFactors[]= $factor . strval($std);
            }
        }

        return array_merge(
            self::$tempFactors,
            self::$shapeFactors,
            self::$lengthFactors,
            $fmFactors);
    }
}