<?php
/**
 * This software is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License version 3 as published by the Free Software Foundation
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 *
 * @copyright  Copyright (c) 2012 Mayflower GmbH (http://www.mayflower.de)
 * @license    LGPL v3 (See LICENSE file)
 */
namespace Holiday;

use DateTime;

class America extends Calculator
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
    protected function getHolidays($year)
    {
        $christmas = new DateTime($year.'-12-25', $this->timezone);
        $thanksgiving = new DateTime('fourth Thursday of November '.$year, $this->timezone);

        $holidays = array(
            new Holiday(clone $christmas, 'Christmas', $this->timezone),
            new Holiday(clone $thanksgiving, 'Thanksgiving Day', $this->timezone),
            new Holiday(new DateTime($year.'-1-1', $this->timezone), "New Year's Day", $this->timezone),
            new Holiday(new DateTime($year.'-7-4', $this->timezone), 'Independence Day', $this->timezone),
            new Holiday(new DateTime($year.'-11-11', $this->timezone), 'Veterans Day', $this->timezone),
            new Holiday(new DateTime('second Monday of October '.$year, $this->timezone), 'Columbus Day', $this->timezone),
            new Holiday(new DateTime('first Monday of September '.$year, $this->timezone), 'Labor Day', $this->timezone),
            new Holiday(new DateTime('last Monday of May '.$year, $this->timezone), 'Memorial Day', $this->timezone),
            new Holiday(new DateTime('third Monday of February '.$year, $this->timezone), "President's Day", $this->timezone),
            new Holiday(new DateTime('third Monday of January '.$year, $this->timezone), 'Martin Luther King, Jr. Day', $this->timezone),
        );

        $holidays[] = new Holiday($christmas->modify('-1 day'), 'Christmas Eve', $this->timezone);
        $holidays[] = new Holiday($thanksgiving->modify('+1 day'), 'Thanksgiving Adam', $this->timezone);

        return $holidays;
    }
}
