<?php

namespace App\Services;

use Request;
use Carbon\Carbon;

class Helper
{
    public static function getActiveClass($url)
    {
        if (Request::is($url)) {
            return 'class=active';
        } else {
            return '';
        }
    }

    public static function rating($rating)
    {
        $overallStars = '';
        for ($i = 1; $i <= $rating; $i++) {
            $overallStars .= '<i class="fas fa-star" style = "color: #FFD700" ></i >';
            if (($i == $rating) && ($rating < 5)) {
                $remainingStars = 5 - $rating;
                for ($j = 1; $j <= $remainingStars; $j++) {
                    $overallStars .= '<i class="fas fa-star" style = "color: #c0c0c0" ></i >';
                }
            }
        }

        return $overallStars;
    }

    public static function getFormattedDate($date)
    {
        return self::getMonth($date) . ' ' . self::getDay($date) . ', ' . self::getYear($date);
    }

    public static function getTime($date)
    {
        return Carbon::parse($date)->format('g:i A');
    }

    public static function getMonth($date)
    {
        return substr(Carbon::parse($date)->format('F'), 0, 3);
    }

    public static function getMonthNumber($date)
    {
        return (int)$date->format('m');
    }

    public static function getDay($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->day;
    }

    public static function getYear($date)
    {
        return Carbon::parse($date)->format('Y');
    }

    public static function pluralSingular($count)
    {
        if ($count > 1) {
            return 's';
        } else {
            return '';
        }
    }
}
