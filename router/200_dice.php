<?php
/**
 * Create routes using $app programming style.
 */
//var_dump(array_keys(get_defined_vars()));



/**
 * Init the game and redirect to play the game.
 */
$app->router->get("dice/init", function () use ($app) {
    // init the session for the gamestart;
    $p1 = new Jiad\Dice\Player("Player");
    $p2 = new Jiad\Dice\Player("Computer");
    // $guess->random();
    // $_SESSION["guess"] = serialize($guess);
    $app->session->set("player", $p1);
    $app->session->set("computer", $p2);
    $app->session->set("turn", "Player");
    return $app->response->redirect("dice/play");
});



/**
 * Play the game - Status.
 */
$app->router->get("dice/play", function () use ($app) {
    // echo "Some debugging information";
    $title = "Play the game";

    $p1 = $app->session->get("player");
    $p2 = $app->session->get("computer");
    $turn = $app->session->get("turn");
    $dices = $app->session->get("dices") ?? null;
    $sum = $app->session->get("sum") ?? null;

    $app->session->delete("dices");
    $app->session->delete("sum");

    $currentPlayer = null;

    if ($turn == "Player") {
        $currentPlayer = $p1;
    } elseif ($turn == "Computer") {
        $currentPlayer = $p2;
    }

    if ($dices == null) {
        $dices = [];
    }

    // var_dump($app->session);

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
        "win" => $win
    ];

    $app->page->add("dice/play", $data);
    // $app->page->add("guess/debug");

    return $app->page->render([
        "title" => $title,
    ]);
});



/**
 * Play the game - User roll.
 */
$app->router->post("dice/user", function () use ($app) {
    // echo "Some debugging information";
    $title = "Play the game";

    $p1 = $app->session->get("player");
    $p2 = $app->session->get("computer");
    $turn = $app->session->get("turn");

    $currentPlayer = null;
    $roundScore = 0;

    if ($turn == "Player") {
        $currentPlayer = $p1;
    } elseif ($turn == "Computer") {
        $currentPlayer = $p2;
    }

    $currentPlayer->roll();
    $dices = $currentPlayer->values();
    $sum = $currentPlayer->sum();

    if (in_array(1, $dices)) {
        $app->session->set("turn", "Computer");
        $currentPlayer->emptyRoundScore();
    } else {
        $currentPlayer->addToRoundScore($sum);
    }

    $app->session->set("sum", $sum);
    $app->session->set("dices", $dices);

    return $app->response->redirect("dice/play");
});



/**
 * Play the game - Computer roll.
 */
$app->router->post("dice/computer", function () use ($app) {
    // echo "Some debugging information";
    $title = "Play the game";

    $p2 = $app->session->get("computer");

    $currentPlayer = $p2;
    $roundScore = 0;

    $compTurns = rand(1, 3);

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
    $app->session->set("turn", "Player");

    return $app->response->redirect("dice/play");
});



/**
 * Play the game - Save.
 */
$app->router->post("dice/save", function () use ($app) {
    // echo "Some debugging information";
    $title = "Play the game";

    $app->session->set("turn", "Computer");

    $p1 = $app->session->get("player");

    $currentPlayer = $p1;

    $currentPlayer->addToTotalScore($currentPlayer->roundScore());
    $currentPlayer->emptyRoundScore();
    $app->session->set("turn", "Computer");

    return $app->response->redirect("dice/play");
});
