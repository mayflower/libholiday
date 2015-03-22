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

class BavariaTest extends \PHPUnit_Framework_TestCase
{
    public function testEasterBug() {
        $utc      = new \DateTimeZone("UTC");
        $by       = new Holiday\Bavaria($utc);
        $holidays = $by->between(
            new \DateTime("2012-04-09", $utc),
            new \DateTime("2012-04-09", $utc));

        $holiday = array_pop($holidays);
        $this->assertEquals("Ostermontag", $holiday->name);
        $this->assertEquals("2012-04-09 00:00:00", $holiday->format("Y-m-d H:i:s"));
        $this->assertEquals("UTC", $holiday->getTimeZone()->getName());
    }
}
