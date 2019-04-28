<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

?>
<h1>Dice 100</h1>

<div class="scoreboard">
    <div class="player">
        <h2>Player Score:</h2>
        <p>
            <?= $playerScore ?> <?= $playerScore >= 100 ? "Winner!" : null ?>
        </p>
    </div>
    <div class="computer">
        <h2>Computer Score:</h2>
        <p>
            <?= $computerScore ?> <?= $computerScore >= 100 ? "Winner!" : null ?>
        </p>
    </div>
</div>

<h2><?= $turn ?>'s turn!</h2>


<?php if ($turn == "Player" && $dices != []) : ?>
<div class="diceBox">
    <p>Dices: <?= implode(", ", $dices) ?></p>
    <p>Sum is: <?= $sum ?>.</p>
    <p>Your score this round: <?= $roundScore ?> - Your total score would be <?= $playerScore + $roundScore ?></p>
</div>
<?php endif; ?>

<div class="buttons">
    <form action="user" method="post">
        <input type="submit" value="User Roll" name="usrRoll" <?= $turn == "Computer" || $win ? "disabled" : null ?>>
    </form>
    <form action="computer" method="post">
        <input type="submit" value="Computer Roll" name="compRoll" <?= $turn == "Player" || $win ? "disabled" : null ?>>
    </form>
    <form action="save" method="post">
        <input type="submit" value="Save" name="save" <?= $turn == "Computer" || $win ? "disabled" : null ?>>
    </form>
</div>
<div class="histogram">
    <h2>Histogram</h2>
    <pre><?= $histogram ?></pre>
</div>
