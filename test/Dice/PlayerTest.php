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
        $player = new Player("Jimmy");
        $this->assertInstanceOf("\Jiad\Dice\Player", $player);
    }


    // /**
    //  * Test the retrieval of name
    //  */
    // public function testName()
    // {
    //     $player = new Player("Jimmy");

    //     $this->assertEquals($player->name(), "Jimmy");
    // }


    /**
     * Test adding to totalScore and retrieving it
     */
    public function testTotalScore()
    {
        $player = new Player("Jimmy");

        $this->assertEquals($player->totalScore(), 0);
        $player->addToTotalScore(10);
        $this->assertEquals($player->totalScore(), 10);
    }


    /**
     * Test Rolling and adding the sum of the dices to
     * the roundScore and then empty the roundScore.
     */
    public function testRoundScore()
    {
        $player = new Player("Jimmy");

        $this->assertEquals($player->roundScore(), 0);
        $this->assertEmpty($player->values());
        $player->roll();
        $this->assertNotEmpty($player->values());
        $player->addToRoundScore($player->sum());
        $this->assertNotEquals($player->roundScore(), 0);
        $player->emptyRoundScore();
        $this->assertEquals($player->roundScore(), 0);
    }


    /**
     * Test Rolling and adding the sum of the dices to
     * the roundScore and then empty the roundScore.
     */
    public function testHistogram()
    {
        $player = new Player("Jimmy");

        $this->assertEquals($player->getAsText(), "");
        // $this->assertEmpty($player->values());
        $player->roll();
        // $this->assertNotEmpty($player->values());
        // $player->addToRoundScore($player->sum());
        $this->assertNotEquals($player->getAsText(), "");
        $player->resetHistogram();
        $this->assertEquals($player->getAsText(), "");
        // $player->emptyRoundScore();
        // $this->assertEquals($player->roundScore(), 0);
    }
}
