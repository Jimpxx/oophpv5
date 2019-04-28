<?php

namespace Jiad\Dice;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A sample controller to show how a controller class can be implemented.
 * The controller will be injected with $app if implementing the interface
 * AppInjectableInterface, like this sample class does.
 * The controller is mounted on a particular route and can then handle all
 * requests for that mount point.
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class DiceController implements AppInjectableInterface
{
    use AppInjectableTrait;



    /**
     * @var string $db a sample member variable that gets initialised
     */
    // private $db = "not active";



    /**
     * The initialize method is optional and will always be called before the
     * target method/action. This is a convienient method where you could
     * setup internal properties that are commonly used by several methods.
     *
     * @return void
     */
    // public function initialize() : void
    // {
    //     // Use to initialise member variables.
    //     $this->db = "active";

    //     // Use $this->app to access the framework services.
    // }



    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function indexAction() : string
    {
        // Deal with the action and return a response.
        return "Index!";
    }



    /**
     * Initialize the game and redirect to the play route.
     * GET mountpoint/init
     *
     * @return object
     */
    public function initAction() : object
    {
        // init the session for the gamestart;
        $p1 = new Player("Player");
        $p2 = new Player("Computer");

        $this->app->session->set("player", $p1);
        $this->app->session->set("computer", $p2);
        $this->app->session->set("turn", "Player");
        return $this->app->response->redirect("dice100/play");
    }



    /**
     * The main play route, this is what the user see.
     * GET mountpoint/play
     *
     * @return object
     */
    public function playActionGet() : object
    {
        $title = "Play the game";

        $p1 = $this->app->session->get("player");
        $p2 = $this->app->session->get("computer");
        $turn = $this->app->session->get("turn");
        $dices = $this->app->session->get("dices") ?? null;
        $sum = $this->app->session->get("sum") ?? null;
        // $computerMsg = $this->app->session->get("computerMsg") ?? null;

        // $this->app->session->delete("computerMsg");
        $this->app->session->delete("dices");
        $this->app->session->delete("sum");

        $currentPlayer = null;

        if ($turn == "Player") {
            $currentPlayer = $p1;
        } elseif ($turn == "Computer") {
            $currentPlayer = $p2;
        }

        if ($dices == null) {
            $dices = [];
        }

        // var_dump($this->app->session);

        // var_dump($p1);
        // var_dump($p2);
        $win = false;

        if ($p1->totalScore() >= 100 || $p2->totalScore() >= 100) {
            $win = true;
        }

        $data = [
            "playerScore" => $p1->totalScore(),
            "computerScore" => $p2->totalScore(),
            "roundScore" => $currentPlayer->roundScore(),
            "dices" => $dices,
            "sum" => $sum,
            "turn" => $turn,
            "win" => $win,
            "histogram" => $p1->getAsText(),
            // "computerMsg" => $computerMsg
        ];

        $this->app->page->add("dice/play", $data);
        // $this->app->page->add("guess/debug");

        return $this->app->page->render([
            "title" => $title,
        ]);
    }



    /**
     * The user is rolling the dice and saving the result to session.
     * POST mountpoint/user
     *
     * @return string
     */
    public function userActionPost() : object
    {
        $title = "Play the game";

        $p1 = $this->app->session->get("player");
        $p2 = $this->app->session->get("computer");
        $turn = $this->app->session->get("turn");
        $this->app->session->set("player", null);

        $currentPlayer = null;
        $roundScore = 0;

        if ($turn == "Player") {
            $currentPlayer = $p1;
        } elseif ($turn == "Computer") {
            $currentPlayer = $p2;
        }

        $currentPlayer->roll();
        $currentPlayer->injectData();
        $dices = $currentPlayer->values();
        $sum = $currentPlayer->sum();

        if (in_array(1, $dices)) {
            $this->app->session->set("turn", "Computer");
            $currentPlayer->emptyRoundScore();
            $currentPlayer->resetHistogram();
        } else {
            $currentPlayer->addToRoundScore($sum);
        }
        
        $this->app->session->set("player", $currentPlayer);

        $this->app->session->set("sum", $sum);
        $this->app->session->set("dices", $dices);

        return $this->app->response->redirect("dice100/play");
    }



    /**
     * The computer is rolling the dice and saving the result to session.
     * POST mountpoint/computer
     *
     * @return object
     */
    public function computerActionPost() : object
    {
        $title = "Play the game";

        $p1 = $this->app->session->get("player");
        $p2 = $this->app->session->get("computer");

        // $computerMsg = "Nothing";

        $currentPlayer = $p2;
        $roundScore = 0;

        $compTurns = rand(1, 2);

        // Computer intellect
        if ($p2->totalScore() == 0) {
            // $computerMsg = "I'm on the board!";
            $compTurns = 1;
        } elseif (($p2->totalScore() - $p1->totalScore()) > 30) { // Computer is in the lead with atleast 30 = Chill
            // $computerMsg = "I'm in the lead, gonna chill now!";
            $compTurns = 1;
        } elseif (($p1->totalScore() - $p2->totalScore()) > 50) { // Player is leading with atleast 50 = Big gamble
            // $computerMsg = "Shiiieet, time to gamble!!";
            $compTurns = 3;
        } elseif (($p1->totalScore() - $p2->totalScore()) > 30) { // Player is leading with atleast 30 = Gamble a little
            // $computerMsg = "Got to pick this up if I'm gonna win..";
            $compTurns = 2;
        }


        for ($i = 0; $i < $compTurns; $i++) {
            $currentPlayer->roll();
            $dices = $currentPlayer->values();
            $sum = $currentPlayer->sum();
        
            if (in_array(1, $dices)) {
                $currentPlayer->emptyRoundScore();
                break;
            } else {
                $currentPlayer->addToRoundScore($sum);
            }
        }
        $currentPlayer->addToTotalScore($currentPlayer->roundScore());
        $currentPlayer->emptyRoundScore();
        $this->app->session->set("turn", "Player");
        // $this->app->session->set("computerMsg", $computerMsg);

        return $this->app->response->redirect("dice100/play");
    }



    /**
     * The user is saving his result from the current round.
     * POST mountpoint/computer
     *
     * @return object
     */
    public function saveActionPost() : object
    {
        $title = "Play the game";

        $this->app->session->set("turn", "Computer");

        $p1 = $this->app->session->get("player");
        $this->app->session->set("player", null);

        $currentPlayer = $p1;

        $currentPlayer->addToTotalScore($currentPlayer->roundScore());
        $currentPlayer->emptyRoundScore();
        $currentPlayer->resetHistogram();
        $this->app->session->set("turn", "Computer");

        $this->app->session->set("player", $currentPlayer);

        return $this->app->response->redirect("dice100/play");
    }



    /**
     * This sample method dumps the content of $app.
     * GET mountpoint/dump-app
     *
     * @return string
     */
    public function debugAction() : string
    {
        // Deal with the action and return a response.
        return "Debug my game!";
    }
}
