<?php

require __DIR__ . "/autoload.php";
require __DIR__ . "/config.php";

session_name("jiad18");
session_start();

$usrguess = $_POST["usrguess"] ?? null;
$doGuess = $POST["guess"] ?? null;
$doReset = $POST["reset"] ?? null;
$doCheat = $POST["cheat"] ?? null;
$noTries = null;
$youWon = null;


if (!isset($_SESSION["guess"]) || isset($_POST["reset"])) {
    $guess = new Guess();
    $guess->random();
    $_SESSION["guess"] = serialize($guess);
} else {
    $guess = unserialize($_SESSION["guess"]);
}

$noTries = $guess->tries() <= 1 ? true : null;

if (isset($_POST["guess"])) {
    $guessRes = $guess->makeGuess($usrguess);
    $_SESSION["guess"] = serialize($guess);
    $youWon = $guessRes == "CORRECT" ? true : null;
} else if (isset($_POST["cheat"])) {
    $cheatRes = $guess->number();
}

$inputDisabled = $noTries || $youWon ? 'disabled' : '';

require __DIR__ . "/view/header.php";
require __DIR__ . "/view/gameboard.php";
require __DIR__ . "/view/footer.php";
