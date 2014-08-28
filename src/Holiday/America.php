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
	 * The day constants
	 */
	const SUNDAY    = 0;
	const MONDAY    = 1;
	const TUESDAY   = 2;
	const WEDNESDAY = 3;
	const THURSDAY  = 4;
	const FRIDAY    = 5;
	const SATURDAY  = 6;

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
		$columbusDay = new DateTime('now', $this->timezone);
		$columbusDay->setDate($year, 10, 1);
		$columbusDay->setTime(0, 0, 0);
		$dayOfWeek = intval($columbusDay->format('w'));

		// Add days from beginning of the month according to day of the week
		if ($dayOfWeek == self::MONDAY)
		{
			$columbusDay->modify('+7 days');
		}
		else if ($dayOfWeek == self::TUESDAY)
		{
			$columbusDay->modify('+13 days');
		}
		else if ($dayOfWeek == self::WEDNESDAY)
		{
			$columbusDay->modify('+12 days');
		}
		else if ($dayOfWeek == self::THURSDAY)
		{
			$columbusDay->modify('+11 days');
		}
		else if ($dayOfWeek == self::FRIDAY)
		{
			$columbusDay->modify('+10 days');
		}
		else if ($dayOfWeek == self::SATURDAY)
		{
			$columbusDay->modify('+9 days');
		}
		else if ($dayOfWeek == self::SUNDAY)
		{
			$columbusDay->modify('+8 day');
		}

		return $columbusDay;
	}

	/**
	 * Get Labor Day: First Monday in September
	 *
	 * @param $year
	 * @return DateTime
	 */
	protected function getLaborDay($year)
	{
		$laborDay = new DateTime('now', $this->timezone);
		$laborDay->setDate($year, 9, 1);
		$laborDay->setTime(0, 0, 0);
		$dayOfWeek = intval($laborDay->format('w'));

		// Add days from beginning of the month according to day of the week
		if ($dayOfWeek == self::TUESDAY)
		{
			$laborDay->modify('+6 days');
		}
		else if ($dayOfWeek == self::WEDNESDAY)
		{
			$laborDay->modify('+5 days');
		}
		else if ($dayOfWeek == self::THURSDAY)
		{
			$laborDay->modify('+4 days');
		}
		else if ($dayOfWeek == self::FRIDAY)
		{
			$laborDay->modify('+3 days');
		}
		else if ($dayOfWeek == self::SATURDAY)
		{
			$laborDay->modify('+2 days');
		}
		else if ($dayOfWeek == self::SUNDAY)
		{
			$laborDay->modify('+1 day');
		}
		// Monday is same day

		return $laborDay;
	}

	/**
	 * Get Memorial Day: Last Monday in May
	 *
	 * @param $year
	 * @return DateTime
	 */
	protected function getMemorialDay($year)
	{
		$memorialDay = new DateTime('now', $this->timezone);
		$memorialDay->setDate($year, 5, 31);
		$memorialDay->setTime(0, 0, 0);
		$dayOfWeek = intval($memorialDay->format('w'));

		// Subtract days from end of the month according to day of the week
		if ($dayOfWeek == self::TUESDAY)
		{
			$memorialDay->modify('-1 day');
		}
		else if ($dayOfWeek == self::WEDNESDAY)
		{
			$memorialDay->modify('-2 days');
		}
		else if ($dayOfWeek == self::THURSDAY)
		{
			$memorialDay->modify('-3 days');
		}
		else if ($dayOfWeek == self::FRIDAY)
		{
			$memorialDay->modify('-4 days');
		}
		else if ($dayOfWeek == self::SATURDAY)
		{
			$memorialDay->modify('-5 days');
		}
		else if ($dayOfWeek == self::SUNDAY)
		{
			$memorialDay->modify('-6 days');
		}
		// Monday is same day

		return $memorialDay;
	}

	/**
	 * Get American Presidents Day: Third Monday in February
	 *
	 * @param $year
	 * @return DateTime
	 */
	protected function getPresidentsDay($year)
	{
		$presidentsDay = new DateTime('now', $this->timezone);
		$presidentsDay->setDate($year, 2, 1);
		$presidentsDay->setTime(0, 0, 0);
		$dayOfWeek = intval($presidentsDay->format('w'));

		// Add days from beginning of the month according to day of the week
		if ($dayOfWeek == self::MONDAY)
		{
			$presidentsDay->modify('+14 days');
		}
		else if ($dayOfWeek == self::TUESDAY)
		{
			$presidentsDay->modify('+20 days');
		}
		else if ($dayOfWeek == self::WEDNESDAY)
		{
			$presidentsDay->modify('+19 days');
		}
		else if ($dayOfWeek == self::THURSDAY)
		{
			$presidentsDay->modify('+18 days');
		}
		else if ($dayOfWeek == self::FRIDAY)
		{
			$presidentsDay->modify('+17 days');
		}
		else if ($dayOfWeek == self::SATURDAY)
		{
			$presidentsDay->modify('+16 days');
		}
		else if ($dayOfWeek == self::SUNDAY)
		{
			$presidentsDay->modify('+15 days');
		}

		return $presidentsDay;
	}

	/**
	 * Get Martin Luther King, Jr. Day: Third Monday of January
	 *
	 * @param $year
	 * @return DateTime
	 */
	protected function getMLKDay($year)
	{
		$mlkDay = new DateTime('now', $this->timezone);
		$mlkDay->setDate($year, 1, 1);
		$mlkDay->setTime(0, 0, 0);
		$dayOfWeek = intval($mlkDay->format('w'));

		// Add days from beginning of the month according to day of the week
		if ($dayOfWeek == self::MONDAY)
		{
			$mlkDay->modify('+14 days');
		}
		else if ($dayOfWeek == self::TUESDAY)
		{
			$mlkDay->modify('+20 days');
		}
		else if ($dayOfWeek == self::WEDNESDAY)
		{
			$mlkDay->modify('+19 days');
		}
		else if ($dayOfWeek == self::THURSDAY)
		{
			$mlkDay->modify('+18 days');
		}
		else if ($dayOfWeek == self::FRIDAY)
		{
			$mlkDay->modify('+17 days');
		}
		else if ($dayOfWeek == self::SATURDAY)
		{
			$mlkDay->modify('+16 days');
		}
		else if ($dayOfWeek == self::SUNDAY)
		{
			$mlkDay->modify('+15 days');
		}

		return $mlkDay;
	}

	/**
	 * Get Thanksgiving Day: Fourth Thursday in November
	 *
	 * @param $year
	 * @return DateTime
	 */
	protected function getThanksgiving($year)
	{
		$thanksgiving = new DateTime('now', $this->timezone);
		$thanksgiving->setDate($year, 11, 1);
		$thanksgiving->setTime(0, 0, 0);
		$dayOfWeek = intval($thanksgiving->format('w'));

		// Add days from beginning of the month according to day of the week
		if ($dayOfWeek == self::MONDAY)
		{
			$thanksgiving->modify('+24 days');
		}
		else if ($dayOfWeek == self::TUESDAY)
		{
			$thanksgiving->modify('+23 days');
		}
		else if ($dayOfWeek == self::WEDNESDAY)
		{
			$thanksgiving->modify('+22 days');
		}
		else if ($dayOfWeek == self::THURSDAY)
		{
			$thanksgiving->modify('+21 days');
		}
		else if ($dayOfWeek == self::FRIDAY)
		{
			$thanksgiving->modify('+27 days');
		}
		else if ($dayOfWeek == self::SATURDAY)
		{
			$thanksgiving->modify('+26 days');
		}
		else if ($dayOfWeek == self::SUNDAY)
		{
			$thanksgiving->modify('+25 days');
		}

		return $thanksgiving;
	}
}