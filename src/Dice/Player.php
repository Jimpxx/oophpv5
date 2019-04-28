<?php

namespace Jiad\Dice;

/**
* A player
*/
class Player
{
    /**
    * @var integer  $totalScore   The total score in the game.
    * @var integer  $roundScore   The score of the current round.
    * @var string  $name   The name of the player.
    * @var object  $hand   the player's hand containing a dicehand containing dices.
    */
    private $totalScore;
    private $roundScore;
    private $name;
    private $hand;



    /**
    * Constructor to create a Dice.
    *
    * @param string $name The name of the player.
    */
    public function __construct($name = "John Doe")
    {
        $this->totalScore = 0;
        $this->roundScore = 0;
        $this->name = $name;
        $this->hand = new DiceHand();
        $this->histogram = new Histogram();
    }


    /**
    * Get the histogram.
    *
    * @return string as the histogram.
    */
    public function getAsText()
    {
        return $this->histogram->getAsText();
    }


    /**
    * Resets the histogram.
    *
    * @return void
    */
    public function resetHistogram()
    {
        // $this->histogram->resetSerie();
        $this->histogram = new Histogram();
        $this->hand->resetDice();
    }


    /**
    * Get the total score the player have in the game.
    *
    * @return int as the the total score.
    */
    public function totalScore()
    {
        return $this->totalScore;
    }


    /**
    * Add to the total score the player have in the game.
    *
    * @param int $number as the the score to be added to $totalScore.
    * @return void
    */
    public function addToTotalScore($number)
    {
        $this->totalScore += $number;
    }


    /**
    * Get the score the player have in the current round.
    *
    * @return int as the the score in the current round.
    */
    public function roundScore()
    {
        return $this->roundScore;
    }


    /**
    * Add to the score the player have for this round.
    *
    * @param int $number as the the score to be added to $roundScore.
    * @return void
    */
    public function addToRoundScore($number)
    {
        $this->roundScore += $number;
    }


    /**
    * Remove all points from this round.
    *
    * @return void
    */
    public function emptyRoundScore()
    {
        $this->roundScore = 0;
    }


    // /**
    // * Get the name of the player.
    // *
    // * @return string as the the name of the player.
    // */
    // public function name()
    // {
    //     return $this->name;
    // }


    /**
    * Roll the dices and inject data into histogram.
    *
    * @return void
    */
    public function roll()
    {
        $this->hand->roll();
        $this->histogram->injectData($this->hand->getDice());
    }


    // /**
    // * Inject data.
    // *
    // * @return void
    // */
    // public function injectData()
    // {
    //     $this->histogram->injectData($this->hand->getDice());
    // }


    /**
    * Returns values of the dices.
    *
    * @return array with the values of all dices.
    */
    public function values()
    {
        return $this->hand->values();
    }


    /**
    * Returns sum of the values of the dices.
    *
    * @return int with the total values of all dices.
    */
    public function sum()
    {
        return $this->hand->sum();
    }
}
