<?php

namespace Jiad\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Guess.
 */
class PlayerTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties. Use no arguments.
     */
    public function testCreateObjectNoArguments()
    {
        $p = new Player("Jimmy");
        $this->assertInstanceOf("\Jiad\Dice\Player", $p);
    }


    /**
     * Test the retrieval of name
     */
    public function testName()
    {
        $p = new Player("Jimmy");

        $this->assertEquals($p->name(), "Jimmy");
    }


    /**
     * Test adding to totalScore and retrieving it
     */
    public function testTotalScore()
    {
        $p = new Player("Jimmy");

        $this->assertEquals($p->totalScore(), 0);
        $p->addToTotalScore(10);
        $this->assertEquals($p->totalScore(), 10);
    }


    /**
     * Test Rolling and adding the sum of the dices to
     * the roundScore and then empty the roundScore.
     */
    public function testRoundScore()
    {
        $p = new Player("Jimmy");

        $this->assertEquals($p->roundScore(), 0);
        $this->assertEmpty($p->values());
        $p->roll();
        $this->assertNotEmpty($p->values());
        $p->addToRoundScore($p->sum());
        $this->assertNotEquals($p->roundScore(), 0);
        $p->emptyRoundScore();
        $this->assertEquals($p->roundScore(), 0);
    }
}
