<?php

namespace Jiad\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Guess.
 */
class HistogramTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties. Use no arguments.
     */
    public function testCreateObjectNoArguments()
    {
        $histogram = new Histogram();
        $this->assertInstanceOf("\Jiad\Dice\Histogram", $histogram);
    }


    // /**
    //  * Test the rolling function of the object
    //  */
    // public function testSerie()
    // {
    //     $dice = new DiceHistogram();
    //     $histogram = new Histogram();
    //     // $this->assertInstanceOf("\Jiad\Dice\Dice", $dice);

    //     // $rolled = null;
    //     $this->assertEmpty($histogram->getSerie());
    //     $dice->roll();
    //     $this->assertNotEmpty($histogram->getSerie());
    //     // $this->assertNotEmpty($rolled);
    // }


    // /**
    //  * Test the rolling function of the object
    //  */
    // public function testGetLastRoll()
    // {
    //     $dice = new Dice();
    //     $this->assertInstanceOf("\Jiad\Dice\Dice", $dice);

    //     $rolled = null;
    //     $this->assertEmpty($rolled);
    //     $dice->roll();
    //     $rolled = $dice->getLastRoll();
    //     $this->assertNotEmpty($rolled);
    // }
}
