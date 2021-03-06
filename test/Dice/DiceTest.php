<?php

namespace Jiad\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Guess.
 */
class DiceTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties. Use no arguments.
     */
    public function testCreateObjectNoArguments()
    {
        $dice = new Dice();
        $this->assertInstanceOf("\Jiad\Dice\Dice", $dice);
    }


    /**
     * Test the rolling function of the object
     */
    public function testRollDice()
    {
        $dice = new Dice();
        $this->assertInstanceOf("\Jiad\Dice\Dice", $dice);

        $rolled = null;
        $this->assertEmpty($rolled);
        $rolled = $dice->roll();
        $this->assertNotEmpty($rolled);
    }


    /**
     * Test the rolling function of the object
     */
    public function testGetLastRoll()
    {
        $dice = new Dice();
        $this->assertInstanceOf("\Jiad\Dice\Dice", $dice);

        $rolled = null;
        $this->assertEmpty($rolled);
        $dice->roll();
        $rolled = $dice->getLastRoll();
        $this->assertNotEmpty($rolled);
    }
}
