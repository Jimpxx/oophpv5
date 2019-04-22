<?php

namespace Jiad\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Guess.
 */
class DiceHandTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties. Use no arguments.
     */
    public function testCreateObjectNoArguments()
    {
        $hand = new DiceHand();
        $this->assertInstanceOf("\Jiad\Dice\DiceHand", $hand);
    }


    /**
     * Test the rolling function
     */
    public function testRoll()
    {
        $hand = new DiceHand();
        $this->assertInstanceOf("\Jiad\Dice\DiceHand", $hand);

        $values = $hand->values();
        $this->assertEmpty($values);
        $hand->roll();
        $values = $hand->values();
        $this->assertNotEmpty($values);
    }


    /**
     * Test the sum method
     */
    public function testSum()
    {
        $hand = new DiceHand();
        $this->assertInstanceOf("\Jiad\Dice\DiceHand", $hand);

        $this->assertEquals($hand->sum(), 0);
        $hand->roll();
        $this->assertNotEquals($hand->sum(), 0);
    }


    /**
     * Test the average method
     */
    public function testAverage()
    {
        $hand = new DiceHand();
        $this->assertInstanceOf("\Jiad\Dice\DiceHand", $hand);

        $this->assertEmpty($hand->values());
        // $this->assertEquals($hand->average(), 0);
        $hand->roll();
        $this->assertNotEmpty($hand->average());
        // $this->assertNotEquals($hand->average(), 0);
    }
}
