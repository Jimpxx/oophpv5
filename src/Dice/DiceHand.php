<?php

namespace Jiad\Dice;

/**
* A dicehand, consisting of dices.
*/
class DiceHand
{
    /**
    * @var Dice $dices   Array consisting of dices.
    * @var int  $values  Array consisting of last roll of the dices.
    */
    private $dices;
    private $values;

    /**
    * Constructor to initiate the dicehand with a number of dices.
    *
    * @param int $dices Number of dices to create, defaults to two.
    * @param int $values The values of the dices.
    */
    public function __construct(int $dices = 2)
    {
        $this->dices  = [];
        $this->values = [];

        for ($i = 0; $i < $dices; $i++) {
            $this->dices[]  = new Dice();
            // $this->values[];
            // $this->values[] = null;
        }
    }

    /**
    * Roll all dices save their value.
    *
    * @return void.
    */
    public function roll()
    {
        // $dices = $this->dices;
        $this->values = [];
        foreach ($this->dices as $dice) {
            // echo "Rolling.." . $dice->getRoll();
            // array_push($this->values, $dice->getLastRoll());
            array_push($this->values, $dice->roll());
        }
    }

    /**
    * Get values of dices from last roll.
    *
    * @return array with values of the last roll.
    */
    public function values()
    {
        return $this->values;
    }

    /**
    * Get the sum of all dices.
    *
    * @return int as the sum of all dices.
    */
    public function sum()
    {
        return array_sum($this->values);
    }

    /**
    * Get the average of all dices.
    *
    * @return float as the average of all dices.
    */
    public function average()
    {
        return array_sum($this->values) / count($this->values);
    }
}
