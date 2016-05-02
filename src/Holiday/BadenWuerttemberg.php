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

class BadenWuerttemberg extends Germany
{
    protected function getHolidays($year)
    {
        $timezone = $this->timezone;

        $easter = $this->getEaster($year);
        $data   = parent::getHolidays($year);
        $data[] = new Holiday("6.1." . $year, "Heilige Drei Könige", $timezone);

        $date   = new Holiday($easter, "Fronleichnam", $timezone);
        $date->modify("+60 days");
        $data[] = $date;

        if($year == 2017) {
            $data[] = new Holiday("31.10." . $year, "Reformationstag", $timezone);
        }

        $data[] = new Holiday("1.11." . $year, "Allerheiligen", $timezone);

        return $data;
    }
}
