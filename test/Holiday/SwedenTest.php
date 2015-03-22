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
namespace Holiday\Test;

use DateTime;
use DateTimeZone;
use Holiday\Sweden;
use PHPUnit_Framework_TestCase;

class SwedenTest extends PHPUnit_Framework_TestCase
{
    /** @var DateTimeZone */
    var $timezone;

    public function __construct()
    {
        $this->timezone = new DateTimeZone('Europe/Stockholm');
        $this->holiday = new Sweden($this->timezone);
    }

    public function assertIsHoliday($date, $errorMessage)
    {
        $this->assertEquals(true, count($this->holiday->isHoliday(new DateTime($date, $this->timezone))) > 0, $errorMessage);
    }

    public function testIsHoliday()
    {
        $this->assertIsHoliday('2015-01-01', 'Nyårsdagen Failed');

        $this->assertIsHoliday('2015-01-05', 'Trettondagsafton Failed');
        $this->assertIsHoliday('2015-01-06', 'Trettondedag jul Failed');


        $this->assertIsHoliday('2015-04-02', 'Skärtorsdagen Failed');
        $this->assertIsHoliday('2015-04-03', 'Långfredagen Failed');
        $this->assertIsHoliday('2015-04-04', 'Påskafton Failed');
        $this->assertIsHoliday('2015-04-05', 'Påskdagen Failed');
        $this->assertIsHoliday('2015-04-06', 'Annandag påsk Failed');


        $this->assertIsHoliday('2015-04-30', 'Valborgsmässoafton Failed');
        $this->assertIsHoliday('2015-05-01', 'Första maj Failed');

        $this->assertIsHoliday('2015-05-14', 'Kristi himmelsfärdsdag Failed');

        $this->assertIsHoliday('2015-05-23', 'Pingstafton Failed');
        $this->assertIsHoliday('2015-05-24', 'Pingstdagen Failed');

        $this->assertIsHoliday('2015-06-06', 'Sveriges nationaldag Failed');

        $this->assertIsHoliday('2015-06-19', 'Midsommarafton Failed');
        $this->assertIsHoliday('2015-06-20', 'Midsommardagen Failed');

        $this->assertIsHoliday('2015-10-30', 'Allhelgonaafton Failed');
        $this->assertIsHoliday('2015-10-31', 'Alla helgons dag Failed');

        $this->assertIsHoliday('2015-12-24', 'Julafton Failed');
        $this->assertIsHoliday('2015-12-25', 'Juldagen Failed');

        $this->assertIsHoliday('2015-12-31', 'Nyårsafton Failed');


        $this->assertNotEquals(true, count($this->holiday->isHoliday(new DateTime('2015-03-11', $this->timezone))) > 0, 'Dummy Date Test Failed');
    }
}
