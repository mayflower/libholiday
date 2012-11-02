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

const HOLIDAY        = 0x01;
const SCHOOL_HOLIDAY = 0x02;
const SPECIAL        = 0x04;
const ALL            = 0x07;

/**
 * Represents a holiday.
 *
 * A Holiday is defined by its time in a given timezone, a type and a weight.
 * Types define if the holiday is an actual holiday where people take a day off,
 * the weight defines how much of the day is free.
 */
class Holiday extends \DateTime
{
    public $type;
    public $name;
    public $weight;

    /**
     * Creates a new Holiday.
     *
     * @param mixed        $time     The day of the holiday
     * @param DateTimezone $timezone The timezone of the holiday
     * @param int          $type     HOLIDAY, SCHOOL_HOLIDAY or SPECIAL
     * @param float        $weight   Positive float.
     */
    public function __construct($time, $name, \DateTimeZone $timezone = null, $type = HOLIDAY, $weight = 1.0)
    {
        if ($time instanceof \DateTime) {
            parent::__construct($time->format("Y-m-d"), $time->getTimeZone());
        } else {
            parent::__construct($time, $timezone);
        }

        if ($weight < 0.0) {
            throw new \InvalidArgumentException("$weight parameter needs to be positive");
        }

        $this->weight = $weight;
        if ($type & HOLIDAY !== HOLIDAY) {
            $this->weight = 0.0;
        }

        $this->type = $type;
        $this->name = $name;
    }
}
