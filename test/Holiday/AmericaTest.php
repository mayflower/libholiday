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
use Holiday\America;
use PHPUnit_Framework_TestCase;

require_once "vendor/autoload.php";

class AmericaTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @var \Holiday\America
	 */
	private $holiday = null;

	function __construct()
	{
		$this->holiday = new America();
	}

	public function testIsHoliday()
	{
		$christmas = new DateTime('2015-12-25');
		$christmasEve = new DateTime('2015-12-24');
		$thanksgiving = new DateTime('2015-11-26');
		$thanksgivingAdamOrBlackFriday = new DateTime('2015-11-27');
		$newYears = new DateTime('2015-01-01');
		$independenceDay = new DateTime('2015-07-04');
		$mlkDay = new DateTime('2015-01-19');
		$presidentsDay = new DateTime('2015-02-16');
		$memorialDay = new DateTime('2015-05-25');
		$laborDay = new DateTime('2014-09-01');
		$veteransDay = new DateTime('2014-11-11');
		$columbusDay = new DateTime('2014-10-13');

		$dummyDate = new DateTime('2015-03-11');

		$this->assertEquals(true, count($this->holiday->isHoliday($christmas)) > 0);
		$this->assertEquals(true, count($this->holiday->isHoliday($christmasEve)) > 0);
		$this->assertEquals(true, count($this->holiday->isHoliday($thanksgiving)) > 0);
		$this->assertEquals(true, count($this->holiday->isHoliday($thanksgivingAdamOrBlackFriday)) > 0);
		$this->assertEquals(true, count($this->holiday->isHoliday($newYears)) > 0);
		$this->assertEquals(true, count($this->holiday->isHoliday($independenceDay)) > 0);
		$this->assertEquals(true, count($this->holiday->isHoliday($mlkDay)) > 0);
		$this->assertEquals(true, count($this->holiday->isHoliday($presidentsDay)) > 0);
		$this->assertEquals(true, count($this->holiday->isHoliday($memorialDay)) > 0);
		$this->assertEquals(true, count($this->holiday->isHoliday($laborDay)) > 0);
		$this->assertEquals(true, count($this->holiday->isHoliday($veteransDay)) > 0);
		$this->assertEquals(true, count($this->holiday->isHoliday($columbusDay)) > 0);
		$this->assertNotEquals(true, count($this->holiday->isHoliday($dummyDate)) > 0);
	}
}
