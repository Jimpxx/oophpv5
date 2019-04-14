<?php

namespace Jiad\Guess;

/**
 * Guess my number, a class supporting the game through GET, POST and SESSION.
 */
class Guess
{
    /**
     * @var int $number   The current secret number.
     * @var int $tries    Number of tries a guess has been made.
     */
    private $number;
    private $tries;


    /**
     * Constructor to initiate the object with current game settings,
     * if available. Randomize the current number if no value is sent in.
     *
     * @param int $number The current secret number, default -1 to initiate
     *                    the number from start.
     * @param int $tries  Number of tries a guess has been made,
     *                    default 6.
     */

    public function __construct(int $number = -1, int $tries = 6)
    {
        $this->number = $number;
        $this->tries = $tries;
    }




    /**
     * Randomize the secret number between 1 and 100 to initiate a new game.
     *
     * @return void
     */

    public function random()
    {
        $this->number = rand(1, 100);
    }




    /**
     * Get number of tries left.
     *
     * @return int as number of tries made.
     */

    public function tries()
    {
        return $this->tries;
    }




    /**
     * Get the secret number.
     *
     * @return int as the secret number.
     */

    public function number()
    {
        return $this->number;
    }




    /**
     * Make a guess, decrease remaining guesses and return a string stating
     * if the guess was correct, too low or to high or if no guesses remains.
     *
     * @throws GuessException when guessed number is out of bounds.
     *
     * @return string to show the status of the guess made.
     */

    public function makeGuess($number)
    {
        if ($number >= 1 && $number <= 100) {
            $string = "";
            // $this->tries -= 1;
            if ($this->tries() > 0) {
                if ($number == $this->number()) {
                    $string .= "CORRECT";
                } else if ($number < $this->number()) {
                    $string .= "TOO LOW..";
                } else if ($number > $this->number()) {
                    $string .= "TOO HIGH..";
                }
            } else {
                $string .= "No guesses left.";
            }
            $this->tries -= 1;
            return $string;
        } else {
            throw new GuessException("Number is only allowed to be between 1 and 100.");
        }
    }
}
