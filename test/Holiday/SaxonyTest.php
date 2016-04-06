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
use Holiday;

class SaxonyTest extends \PHPUnit_Framework_TestCase
{
    public function testDayOfRepentance2016() {
        $utc      = new \DateTimeZone("UTC");
        $by       = new Holiday\Saxony($utc);
        $holidays = $by->between(
            new \DateTime("2016-11-16", $utc),
            new \DateTime("2016-11-16", $utc));

        $holiday = array_pop($holidays);
        $this->assertEquals("Buß- und Bettag", $holiday->name);
        $this->assertEquals("2016-11-16 00:00:00", $holiday->format("Y-m-d H:i:s"));
        $this->assertEquals("UTC", $holiday->getTimeZone()->getName());
    }

    public function testDayOfRepentance2017() {
        $utc      = new \DateTimeZone("UTC");
        $by       = new Holiday\Saxony($utc);
        $holidays = $by->between(
            new \DateTime("2017-11-22", $utc),
            new \DateTime("2017-11-22", $utc));

        $holiday = array_pop($holidays);
        $this->assertEquals("Buß- und Bettag", $holiday->name);
        $this->assertEquals("2017-11-22 00:00:00", $holiday->format("Y-m-d H:i:s"));
        $this->assertEquals("UTC", $holiday->getTimeZone()->getName());
    }
}
