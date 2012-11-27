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

class Germany extends Calculator
{
    public function getHolidays($year)
    {
        $data   = array();

        $easter = self::getEaster($year);
        $data[] = new Holiday($easter, "Karfreitag");
        $data[0]->sub(\DateInterval::createFromDateString("2 days"));
        $data[] = new Holiday($easter, "Ostermontag");
        $data[1]->add(\DateInterval::createFromDateString("1 day"));
        $data[] = new Holiday($easter, "Christi Himmelfahrt");
        $data[2]->add(\DateInterval::createFromDateString("39 days"));
        $data[] = new Holiday($easter, "Pfingstmontag");
        $data[3]->add(\DateInterval::createFromDateString("50 days"));

        $data[] = new Holiday("01.01." . $year, "Neujahrstag");
        $data[] = new Holiday("01.05." . $year, "Tag der Arbeit");
        $data[] = new Holiday("03.10." . $year, "Tag der deutschen Einheit");
        $data[] = new Holiday("25.12." . $year, "1. Weihnachtsfeiertag");
        $data[] = new Holiday("26.12." . $year, "2. Weihnachtsfeiertag");

        return array_merge($data, $this->getSpecial($year));
    }

    private function getSpecial($year)
    {
        $data   = array();
        $easter = self::getEaster($year);

        $data[] = new Holiday($easter, "Rosenmontag", null, SPECIAL);
        $data[0]->sub(\DateInterval::createFromDateString("48 days"));
        $data[] = new Holiday($easter, "Fastnacht", null, SPECIAL);
        $data[1]->sub(\DateInterval::createFromDateString("47 days"));
        $data[] = new Holiday($easter, "Aschermittwoch", null, SPECIAL);
        $data[2]->sub(\DateInterval::createFromDateString("46 days"));
        $data[] = new Holiday($easter, "Palmsonntag", null, SPECIAL);
        $data[3]->sub(\DateInterval::createFromDateString("7 days"));
        $data[] = new Holiday($easter, "Gründonnerstag", null, SPECIAL);
        $data[4]->sub(\DateInterval::createFromDateString("3 days"));
        $data[] = new Holiday($easter, "Ostersonntag", null, SPECIAL);

        $data[] = new Holiday($easter, "Pfingstsonntag", null, SPECIAL);
        $data[6]->add(\DateInterval::createFromDateString("49 days"));

        $data[] = new Holiday("6.12."  . $year, "Nikolaus", null, SPECIAL);
        $data[] = new Holiday("24.12." . $year, "Heilig Abend", null, SPECIAL);
        $data[] = new Holiday("31.12." . $year, "Silvester", null, SPECIAL);

        return $data;
    }
}
