<?php


namespace Flyty\Mytools;

/**
 * 时间起始段 开始-结束 （十位秒级时间戳）
 * Class DateTime
 * @package Flyty\Tools\Lib
 */
class DateTime
{
    private $base_timestamp;

    public function __construct($base_timestamp = null)
    {
        if (null === $base_timestamp) {
            $base_timestamp = time();
        }
        $this->base_timestamp = $base_timestamp;
    }

    /**
     * 每小时的开始结束
     * @param $hour
     * @return array
     */
    public function hourBeginEnd($hour): array
    {
        $date  = date('Y-m-d', $this->base_timestamp);
        $hour  = sprintf('%02d', $hour);
        $begin = strtotime($date . ' ' . $hour . ':00:00');
        $end   = strtotime($date . ' ' . $hour . ':00:00 +1 hour -1 seconds');

        return compact('begin', 'end');
    }

    /**
     * 每天的开始结束
     * @param null $date
     * @return array
     */
    public function dayBeginEnd($date = null): array
    {
        if (null === $date) {
            $date = date('Y-m-d', $this->base_timestamp);
        }
        $begin = strtotime($date . ' 00:00:00');
        $end   = strtotime("{$date} +1 day -1 seconds");

        return compact('begin', 'end');
    }

    /**
     * 每月的开始结束
     * @param null $year
     * @param null $month
     * @return array
     */
    public function monthBeginEnd($year = null, $month = null): array
    {
        if (null === $year) {
            $year = date('Y', $this->base_timestamp);
        }
        if (null === $month) {
            $month = date('m', $this->base_timestamp);
        }
        $month = sprintf('%02d', $month);
        $ymd   = $year . '-' . $month . '-01';
        $begin = strtotime($ymd . ' 00:00:00');
        $end   = strtotime("{$ymd} +1 month -1 seconds");

        return compact('begin', 'end');
    }

    /**
     * 每年的开始结束
     * @param $year
     * @return array
     */
    public function yearBeginEnd($year): array
    {
        if (null === $year) {
            $year = date('Y', $this->base_timestamp);
        }
        $ymd   = $year . '-01-01';
        $begin = strtotime($ymd . ' 00:00:00');
        $end   = strtotime("{$ymd} +1 year -1 seconds");

        return compact('begin', 'end');
    }


}