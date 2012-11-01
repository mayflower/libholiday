<?php

namespace Holiday;

/**
 * Implements a template class for holiday calculation.
 *
 */
abstract class Calculator
{
    /**
     * The template method to be used in the between calculation.
     *
     * Returns an array of Holidays.
     *
     * @see between()
     *
     * @param int $year The year to get the holidays for.
     * @return array
     */
    abstract public function getHolidays($year);

    /**
     * Provides a DateTime object that represents easter sunday for this year.
     *
     * The DateTime object is always set to the current default timezone and
     * not UTC and time is set 0:00.
     *
     * The method tries to reuse already initialized objects. If you need
     * to modify the object make sure you create a copy.
     *
     * @param int $year The year for which to calculcate the easter sunday date.
     *
     * @return DateTime
     */
    public static function getEaster($year)
    {
        $phpmessfixup = date("Y-m-d", easter_date($year));
        $easter = new \DateTime($phpmessfixup);
        return new \DateTime($easter->format("Y-m-d"));
    }

    /**
     * Returns all holidays in the given time period.
     *
     * @param DateTime $start The start date
     * @param DateTime $end   The end date
     *
     * @return array
     */
    public function between(\DateTime $start, \DateTime $end)
    {
        $startyear = (int) $start->format("Y");
        $interval  = $start->diff($end);
        $holidays  = array();
        for ($yearcount = 0; $yearcount <= $interval->y; $yearcount++) {
            $year     = $startyear + $yearcount;
            $holidays = array_merge($holidays, $this->getHolidays($year));
        }

        return array_filter($holidays,
            function(\DateTime $dt) use ($start, $end) {
                return $dt >= $start && $dt <= $end;
            });
    }
}

