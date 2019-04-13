<?php
/**
 * Create routes using $app programming style.
 */
//var_dump(array_keys(get_defined_vars()));



/**
 * Init the game and redirect to play the game.
 */
$app->router->get("guess/init", function () use ($app) {
    // init the session for the gamestart;
    $guess = new Jiad\Guess\Guess();
    $guess->random();
    $_SESSION["guess"] = serialize($guess);
    return $app->response->redirect("guess/play");
});



/**
 * Play the game - Status.
 */
$app->router->get("guess/play", function () use ($app) {
    // echo "Some debugging information";
    $title = "Play the game";

    $guess = unserialize($_SESSION["guess"]);

    $usrguess = $_SESSION["usrguess"] ?? null;
    $guessRes = $_SESSION["guessRes"] ?? null;
    $youWon = $_SESSION["youWon"] ?? null;
    $doGuess = $_SESSION["doGuess"] ?? null;
    $doCheat = $_SESSION["doCheat"] ?? null;
    $inputDisabled = $_SESSION["inputDisabled"] ?? null;

    $_SESSION["usrguess"] = null;
    $_SESSION["youWon"] = null;
    $_SESSION["doGuess"] = null;
    $_SESSION["doCheat"] = null;
    $_SESSION["inputDisabled"] = null;
    
    $noTries = $guess->tries() == 0 ? true : null;

    $inputDisabled = $noTries || $youWon ? 'disabled' : '';

    $data = [
        "usrguess" => $usrguess ?? null,
        "tries" => $guess->tries(),
        "inputDisabled" => $inputDisabled ?? null,
        "cheatRes" => $guess->number(),
        "youWon" => $youWon ?? null,
        "noTries" => $noTries,
        "guessRes" => $guessRes ?? null,
        "doGuess" => $doGuess ?? null,
        "doCheat" => $doCheat ?? null
    ];

    $app->page->add("guess/play", $data);
    // $app->page->add("guess/debug");

    return $app->page->render([
        "title" => $title,
    ]);
});



/**
 * Play the game - Make a guess.
 */
$app->router->post("guess/play", function () use ($app) {
    // echo "Some debugging information";
    $title = "Play the game";

    $usrguess = $_POST["usrguess"] ?? null;
    $doGuess = $_POST["guess"] ?? null;
    $doReset = $_POST["reset"] ?? null;
    $doCheat = $_POST["cheat"] ?? null;
    $noTries = null;
    $youWon = null;
    $guessRes = null;

    if (!isset($_SESSION["guess"]) || isset($_POST["reset"])) {
        $guess = new Jiad\Guess\Guess();
        $guess->random();
        $_SESSION["guess"] = serialize($guess);
        return $app->response->redirect("guess/play");
    } else {
        $guess = unserialize($_SESSION["guess"]);
    }

    if (isset($_POST["guess"])) {
        $guessRes = $guess->makeGuess($usrguess);
        $_SESSION["guess"] = serialize($guess);
        $youWon = $guessRes == "CORRECT" ? true : null;
    } else if (isset($_POST["cheat"])) {
        $cheatRes = $guess->number();
    }

    $_SESSION["usrguess"] = $usrguess;
    $_SESSION["guessRes"] = $guessRes;
    $_SESSION["youWon"] = $youWon;
    $_SESSION["doGuess"] = $doGuess;
    $_SESSION["doCheat"] = $doCheat;
    $_SESSION["inputDisabled"] = $inputDisabled;


    return $app->response->redirect("guess/play");
});
