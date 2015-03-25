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
 * @copyright  Copyright (c) 2014 Galo Arends
 * @license    LGPL v3 (See LICENSE file)
 */

namespace Holiday;

class Netherlands extends Calculator
{
    protected function getHolidays($year)
    {
        $timezone = $this->timezone;

        $data   = array();
        $easter = $this->getEaster($year);
        $data[] = (new Holiday($easter, "2de paasdag", $timezone))->modify("+1 day");
        $data[] = (new Holiday($easter, "Hemelvaartsdag", $timezone))->modify("+39 days");
        $data[] = (new Holiday($easter, "2de pinksterdag", $timezone))->modify("+50 days");
        $data[] = new Holiday("01.01." . $year, "Nieuwjaarsdag", $timezone);

        if($year < 2014) {
            $royal = new Holiday("30.04." . $year, "Koninginnedag", $timezone);
        } else {
            $royal = new Holiday("27.04." . $year, "Koningsdag", $timezone);
        }
        if ($royal->format('N') == 7) {
            $royal->modify('-1 day');
        }
        if ($year % 5 == 0) {
            $data[] = new Holiday("05.05." . $year, "Bevrijdingsdag", $timezone);
        }
        $data[] = $royal;

        $data[] = new Holiday("25.12." . $year, "1ste kerstdag", $timezone);
        $data[] = new Holiday("26.12." . $year, "2de kerstdag", $timezone);


        return array_merge($data, $this->getSpecial($year));
    }
    
    private function getSpecial($year)
    {
        $timezone = $this->timezone;

        $data   = array();
        $easter = $this->getEaster($year);

        $data[] = new Holiday($easter, "1ste paasdag", $timezone, NOTABLE);
        $data[] = (new Holiday($easter, "1ste pinksterdag", $timezone, NOTABLE))->modify("+49 days");
        $data[] = new Holiday("24.12." . $year, "Kerstavond", $timezone, NOTABLE, 0.5);
        $data[] = new Holiday("31.12." . $year, "Oudejaarsavond", $timezone, NOTABLE, 0.5);

        return $data;
    }
}
