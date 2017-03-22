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

class Switzerland extends Calculator
{
    /**
     * Get public holidays valid in states of switzerland as well as special holidays not valid in states of switzerland.
     * @param int $year
     * @return array
     */
    public function getHolidays($year)
    {
        return array_merge(
            $this->getPublicHolidays($year),
            $this->getSpecial($year)
        );
    }

    /**
     * Get _public holidays_ only. Not in all states of Switzerland days from getSpecial() are public holidays.
     *
     * Moved to dedicated method in order to retain compatibility of getHolidays() with existing code.
     *
     * @param int $year Year
     * @return Holiday[]
     */
    protected function getPublicHolidays($year)
    {
        $timezone = $this->timezone;

        /** @var Holiday[] $data */
        $data = array();
        $easter = $this->getEaster($year);
        $data[] = new Holiday($easter, "Karfreitag", $timezone);
        $data[0]->modify("-2 days");
        $data[] = new Holiday($easter, "Ostermontag", $timezone);
        $data[1]->modify("+1 day");
        $data[] = new Holiday($easter, "Christi Himmelfahrt", $timezone);
        $data[2]->modify("+39 days");
        $data[] = new Holiday($easter, "Pfingstmontag", $timezone);
        $data[3]->modify("+50 days");

        $data[] = new Holiday("01.01." . $year, "Neujahrstag", $timezone);
        $data[] = new Holiday("01.05." . $year, "Tag der Arbeit", $timezone);
        $data[] = new Holiday("01.08." . $year, "Nationalfeiertag", $timezone);
        $data[] = new Holiday("25.12." . $year, "1. Weihnachtsfeiertag", $timezone);
        $data[] = new Holiday("26.12." . $year, "2. Weihnachtsfeiertag", $timezone);

        return $data;
    }

    private function getSpecial($year)
    {
        $timezone = $this->timezone;

        /** @var Holiday[] $data */
        $data   = array();
        $easter = $this->getEaster($year);

        $data[] = new Holiday($easter, "Rosenmontag", $timezone, NOTABLE);
        $data[0]->modify("-48 days");
        $data[] = new Holiday($easter, "Fastnacht", $timezone, NOTABLE);
        $data[1]->modify("-47 days");
        $data[] = new Holiday($easter, "Aschermittwoch", $timezone, NOTABLE);
        $data[2]->modify("-46 days");
        $data[] = new Holiday($easter, "Palmsonntag", $timezone, NOTABLE);
        $data[3]->modify("-7 days");
        $data[] = new Holiday($easter, "Gründonnerstag", $timezone, NOTABLE);
        $data[4]->modify("-3 days");
        $data[] = new Holiday($easter, "Ostersonntag", $timezone, NOTABLE);

        $data[] = new Holiday($easter, "Pfingstsonntag", $timezone, NOTABLE);
        $data[6]->modify("+49 days");

        $data[] = new Holiday("6.12."  . $year, "Nikolaus", $timezone, NOTABLE);
        $data[] = new Holiday("24.12." . $year, "Heilig Abend", $timezone, NOTABLE, 0.5);
        $data[] = new Holiday("31.12." . $year, "Silvester", $timezone, NOTABLE, 0.5);

        return $data;
    }
}
