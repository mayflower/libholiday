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

class Bavaria extends Germany
{
    public function getHolidays($year)
    {
        $easter = self::getEaster($year);
        $data   = parent::getHolidays($year);
        $data[] = new Holiday("6.1." . $year, "Dreikönigstag");

        $date   = new Holiday($easter, "Fronleichnam");
        $date->add(\DateInterval::createFromDateString("60 days"));
        $data[] = $date;

        $data[] = new Holiday("15.8." . $year, "Mariä Himmelfahrt");
        $data[] = new Holiday("1.11." . $year, "Allerheiligen");

        return $data;
    }
}
