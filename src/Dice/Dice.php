<?php

namespace Jiad\Dice;

class Dice
{
    /**
    * @var integer  $roll   The value of the Dice.
    * @var integer  $sides   The number of sides of the Dice.
    */
    private $lastRoll;
    // private $roll;
    private $sides;



    /**
    * Constructor to create a Dice.
    *
    * @param null|integer $sides The number of sides of the Dice.
    */
    public function __construct($sides = 6)
    {
        $this->lastRoll = null;
        $this->sides = $sides;
    }

    /**
    * Get the roll of the Dice.
    *
    * @return int as the roll of the Dice.
    */
    public function roll()
    {
        $rand = rand(1, 6);
        $this->lastRoll = $rand;
        return $rand;
    }

    /**
    * Get the roll of the Dice.
    *
    * @return int as the roll of the Dice.
    */
    public function getLastRoll()
    {
        return $this->lastRoll;
    }
}
