<?php
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
        $this->assertCount(5,
            $de->between(
                new \DateTime("1.4.2012"),
                new \DateTime("30.4.2012")));

        $this->assertCount(20, $de->between(
            new \DateTime("1.5.2012"),
            new \DateTime("1.5.2013")));

        $res = $de->between(
                new \DateTime("1.5.2012"),
                new \DateTime("1.5.2012"));

        $this->assertEquals(
            new Holiday\Holiday("01.05.2012", "Tag der Arbeit"),
            array_pop($res));
;
    }
}
