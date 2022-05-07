<?php

namespace Kanboard\Core;

/**
 * DateTime helper class
 *
 * @package core
 * @author  Thorsten Schüller
 */
class DateTime
{
    /**
     * Prepare the given time to allow special time string (like '1h 15m')
     * or , as separator instead .
     *
     * @static
     * @access public
     * @param  mixed $time
     */
    public static function prepareTime(mixed $time) {
        $time = str_replace(",", ".", $time);

        if (is_numeric($time)) {
            return round($time, 2);
        }

        $sum = 0;
        $data = preg_match_all('/(\d+)d/', $time, $matches);
        $sum += intval(($matches[1][0]??0)) * 8;
        $data = preg_match_all('/(\d+)h/', $time, $matches);
        $sum += intval(($matches[1][0]??0));
        $data = preg_match_all('/(\d+)m/', $time, $matches);
        $sum += intval(($matches[1][0]??0))/60;

        return round($sum, 2);
    }
}
