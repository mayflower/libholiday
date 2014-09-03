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

use DateTime;

class America extends Calculator
{
	/**
	 * The template method to be used in the between calculation.
	 *
	 * Returns an array of Holidays.
	 *
	 * @see between()
	 *
	 * @param int $year The year to get the holidays for.
	 * @return array
	 */
	protected function getHolidays($year)
	{
		$holidays = array();

		$holidays[] = new Holiday($this->getChristmas($year), 'Christmas', $this->timezone);
		$holidays[] = new Holiday($this->getChristmas($year)->modify('-1 day'), 'Christmas Eve', $this->timezone);
		$holidays[] = new Holiday($this->getThanksgiving($year), 'Thanksgiving Day', $this->timezone);
		$holidays[] = new Holiday($this->getThanksgiving($year)->modify('+1 day'), 'Thanksgiving Adam', $this->timezone);
		$holidays[] = new Holiday($this->getNewYearsDay($year), "New Year's Day", $this->timezone);
		$holidays[] = new Holiday($this->getIndependenceDay($year), 'Independence Day', $this->timezone);
		$holidays[] = new Holiday($this->getMLKDay($year), 'Martin Luther King, Jr. Day', $this->timezone);
		$holidays[] = new Holiday($this->getPresidentsDay($year), "President's Day", $this->timezone);
		$holidays[] = new Holiday($this->getMemorialDay($year), 'Memorial Day', $this->timezone);
		$holidays[] = new Holiday($this->getLaborDay($year), 'Labor Day', $this->timezone);
		$holidays[] = new Holiday($this->getVeteransDay($year), 'Veterans Day', $this->timezone);
		$holidays[] = new Holiday($this->getColumbusDay($year), 'Columbus Day', $this->timezone);

		return $holidays;
	}

	/**
	 * Get Veterans Day: November 11th
	 *
	 * @param $year
	 * @return DateTime
	 */
	protected function getVeteransDay($year)
	{
		$veteransDay = new DateTime('now', $this->timezone);
		$veteransDay->setDate($year, 11, 11);
		$veteransDay->setTime(0, 0, 0);
		return $veteransDay;
	}

	/**
	 * Get American Independence Day: July 4th
	 *
	 * @param $year
	 * @return DateTime
	 */
	protected function getIndependenceDay($year)
	{
		$independenceDay = new DateTime('now', $this->timezone);
		$independenceDay->setDate($year, 7, 4);
		$independenceDay->setTime(0, 0, 0);
		return $independenceDay;
	}

	/**
	 * Get New Years Day: January 1st
	 *
	 * @param $year
	 * @return DateTime
	 */
	protected function getNewYearsDay($year)
	{
		$newYearsDay = new DateTime('now', $this->timezone);
		$newYearsDay->setDate($year, 1, 1);
		$newYearsDay->setTime(0, 0, 0);
		return $newYearsDay;
	}

	/**
	 * Get Christmas Day: December 25th
	 *
	 * @param $year
	 * @return DateTime
	 */
	protected function getChristmas($year)
	{
		$christmas = new DateTime('now', $this->timezone);
		$christmas->setDate($year, 12, 25);
		$christmas->setTime(0, 0, 0);
		return $christmas;
	}

	/**
	 * Get Columbus Day: Second Monday in October
	 *
	 * @param $year
	 * @return DateTime
	 */
	protected function getColumbusDay($year)
	{
		return DateTime::createFromFormat('U', strtotime('second Monday of October '.$year), $this->timezone);
	}

	/**
	 * Get Labor Day: First Monday in September
	 *
	 * @param $year
	 * @return DateTime
	 */
	protected function getLaborDay($year)
	{
		return DateTime::createFromFormat('U', strtotime('first Monday of September '.$year), $this->timezone);
	}

	/**
	 * Get Memorial Day: Last Monday in May
	 *
	 * @param $year
	 * @return DateTime
	 */
	protected function getMemorialDay($year)
	{
		return DateTime::createFromFormat('U', strtotime('last Monday of May '.$year), $this->timezone);
	}

	/**
	 * Get American Presidents Day: Third Monday in February
	 *
	 * @param $year
	 * @return DateTime
	 */
	protected function getPresidentsDay($year)
	{
		return DateTime::createFromFormat('U', strtotime('third Monday of February '.$year), $this->timezone);
	}

	/**
	 * Get Martin Luther King, Jr. Day: Third Monday of January
	 *
	 * @param $year
	 * @return DateTime
	 */
	protected function getMLKDay($year)
	{
		return DateTime::createFromFormat('U', strtotime('third Monday of January '.$year), $this->timezone);
	}

	/**
	 * Get Thanksgiving Day: Fourth Thursday in November
	 *
	 * @param $year
	 * @return DateTime
	 */
	protected function getThanksgiving($year)
	{
		return DateTime::createFromFormat('U', strtotime('fourth Thursday of November '.$year), $this->timezone);
	}
}