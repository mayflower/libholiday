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

class Sweden extends Calculator
{
    protected function getHolidays($year)
    {
        $timezone = $this->timezone;

        $data   = array();

        $data[] = new Holiday("01.01." . $year, "Nyårsdagen", $timezone);
        $data[] = new Holiday("05.01." . $year, "Trettondagsafton", $timezone);
        $data[] = new Holiday("06.01." . $year, "Trettondedag jul", $timezone);


        $easter = $this->getEaster($year);

        $data[] = (new Holiday($easter, "Skärtorsdagen", $timezone, NOTABLE, 0.5))->modify("-3 days");
        $data[] = (new Holiday($easter, "Långfredagen", $timezone))->modify("-2 days");
        $data[] = (new Holiday($easter, "Påskafton", $timezone))->modify("-1 days");
        $data[] = new Holiday($easter, "Påskdagen", $timezone);
        $data[] = (new Holiday($easter, "Annandag påsk", $timezone))->modify("+1 day");

        $data[] = new Holiday("30.04." . $year, "Valborgsmässoafton", $timezone, NOTABLE, 0.5);
        $data[] = new Holiday("01.05." . $year, "Första maj", $timezone);

        $data[] = (new Holiday($easter, "Kristi himmelsfärdsdag", $timezone))->modify("+39 days");

        $data[] = new Holiday("06.06." . $year, "Sveriges nationaldag", $timezone);

        $data[] = (new Holiday($easter, "Pingstafton", $timezone))->modify("+48 days");

        $data[] = (new Holiday($easter, "Pingstdagen", $timezone))->modify("+49 days");

        $midSummerDay = $this->getMidSummerDay($year, $timezone);
        $data[] = (new Holiday($midSummerDay, "Midsommarafton", $timezone))->modify("-1 day");
        $data[] = new Holiday($midSummerDay, "Midsommardagen", $timezone);


        $allSaintsDay = $this->getAllSaintsDay($year, $timezone);
        $data[] = (new Holiday($allSaintsDay, "Allhelgonaafton", $timezone, NOTABLE, 0.5))->modify("-1 day");
        $data[] = new Holiday($allSaintsDay, "Alla helgons dag", $timezone);


        $data[] = new Holiday("24.12." . $year, "Julafton", $timezone);
        $data[] = new Holiday("25.12." . $year, "Juldagen", $timezone);
        $data[] = new Holiday("26.12." . $year, "Annandag jul", $timezone);
        $data[] = new Holiday("31.12." . $year, "Nyårsafton", $timezone);

        return $data;
    }

    /**
     * the Swedish midsummer day is the saturday between 20 and 26:th of June
     */
    public function getMidSummerDay($year, $timezone)
    {
        $date = new \DateTime('20.06.'.$year, $timezone);
        for ($i = 0; $i < 7; $i++) {
            if ($date->format('w') == 6) {
                break;
            }
            $date->add(new \DateInterval('P1D'));
        }

        return $date;
    }


    /**
     * the Swedish 'alla helgons dag' is the saturday between 31 October and 6:th of November
     */
    public function getAllSaintsDay($year, $timezone)
    {
        $date = new \DateTime('31.10.'.$year, $timezone);
        for ($i = 0; $i < 7; $i++) {
            if ($date->format('w') == 6) {
                break;
            }
            $date->add(new \DateInterval('P1D'));
        }

        return $date;
    }
}
