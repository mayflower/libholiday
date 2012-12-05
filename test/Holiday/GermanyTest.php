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

require_once "vendor/autoload.php";

class GermanyTest extends \PHPUnit_Framework_TestCase
{
    public function testGermanyCalculations()
    {
        $de = new Holiday\Germany();
        $this->assertCount(19, $de->getHolidays(2012));
        $days = $de->getHolidays(2012);
        $this->assertEquals(
            new Holiday\Holiday("6.4.2012", "Karfreitag"),
            $days[0]);
        $this->assertEquals(
            new Holiday\Holiday("9.4.2012", "Ostermontag"),
            $days[1]);
    }

    public function testGermanyBetween()
    {
        $de = new Holiday\Germany();
        $res = $de->between(
                new \DateTime("1.4.2012"),
                new \DateTime("30.4.2012"));
        $this->assertCount(5, $res);
        $this->assertContainsOnlyInstancesOf("Holiday\Holiday", $res);

        $mapped = array_values(
            array_map(function(\DateTime $dt) {
                return $dt->format("d.m.Y H:i");
            }, $res));

        $expected = [
            '01.04.2012 00:00',
            '05.04.2012 00:00',
            '06.04.2012 00:00',
            '08.04.2012 00:00',
            '09.04.2012 00:00'];

        sort($expected);
        sort($mapped);
        $this->assertEquals($expected, $mapped);

        $this->assertCount(20, $de->between(
            new \DateTime("1.5.2012"),
            new \DateTime("1.5.2013")));

        $res = $de->between(
                new \DateTime("1.5.2012"),
                new \DateTime("1.5.2012"));

        $this->assertEquals(
            new Holiday\Holiday("01.05.2012", "Tag der Arbeit"),
            array_pop($res));
    }

    public function testGermanyPST() {
        $de = new Holiday\Germany(new \DateTimeZone("PST"));
        $res = $de->between(
                new \DateTime("1.5.2012"),
                new \DateTime("2.5.2012"));
        $this->assertEquals(
            new Holiday\Holiday("1.5.2012", "Tag der Arbeit",
                new \DateTimeZone("PST")),
            array_pop($res));
    }
}
