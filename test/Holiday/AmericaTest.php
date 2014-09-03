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
use Holiday\America;
use PHPUnit_Framework_TestCase;

require_once "vendor/autoload.php";

class AmericaTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @var \Holiday\America
	 */
	private $holiday = null;

	/**
	 * @var \DateTimeZone
	 */
	private $timezone = null;

	function __construct()
	{
		$this->timezone = new DateTimeZone('UTC');
		$this->holiday = new America($this->timezone);
	}

	public function testIsHoliday()
	{
		$christmas = new DateTime('2015-12-25', $this->timezone);
		$christmasEve = new DateTime('2015-12-24', $this->timezone);
		$thanksgiving = new DateTime('2015-11-26', $this->timezone);
		$thanksgivingAdamOrBlackFriday = new DateTime('2015-11-27', $this->timezone);
		$newYears = new DateTime('2015-01-01', $this->timezone);
		$independenceDay = new DateTime('2015-07-04', $this->timezone);
		$mlkDay = new DateTime('2015-01-19', $this->timezone);
		$presidentsDay = new DateTime('2015-02-16', $this->timezone);
		$memorialDay = new DateTime('2015-05-25', $this->timezone);
		$laborDay = new DateTime('2014-09-01', $this->timezone);
		$veteransDay = new DateTime('2014-11-11', $this->timezone);
		$columbusDay = new DateTime('2014-10-13', $this->timezone);

		$dummyDate = new DateTime('2015-03-11', $this->timezone);

		$this->assertEquals(true, count($this->holiday->isHoliday($christmas)) > 0, 'Christmas Failed');
		$this->assertEquals(true, count($this->holiday->isHoliday($christmasEve)) > 0, 'Christmas Eve Failed');
		$this->assertEquals(true, count($this->holiday->isHoliday($thanksgiving)) > 0, 'Thanksgiving Failed');
		$this->assertEquals(true, count($this->holiday->isHoliday($thanksgivingAdamOrBlackFriday)) > 0, 'Black Friday Failed');
		$this->assertEquals(true, count($this->holiday->isHoliday($newYears)) > 0, 'New Years Failed');
		$this->assertEquals(true, count($this->holiday->isHoliday($independenceDay)) > 0, 'Independence Day Failed');
		$this->assertEquals(true, count($this->holiday->isHoliday($mlkDay)) > 0, 'MLK Day Failed');
		$this->assertEquals(true, count($this->holiday->isHoliday($presidentsDay)) > 0, 'Presidents Day Failed');
		$this->assertEquals(true, count($this->holiday->isHoliday($memorialDay)) > 0, 'Memorial Day Failed');
		$this->assertEquals(true, count($this->holiday->isHoliday($laborDay)) > 0, 'Labor Day Failed');
		$this->assertEquals(true, count($this->holiday->isHoliday($veteransDay)) > 0, 'Veterans Day Failed');
		$this->assertEquals(true, count($this->holiday->isHoliday($columbusDay)) > 0, 'Columbus Day Failed');
		$this->assertNotEquals(true, count($this->holiday->isHoliday($dummyDate)) > 0, 'Dummy Date Test Failed');
	}
}
