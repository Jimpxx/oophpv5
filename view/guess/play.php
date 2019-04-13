<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());




?><h1>Guess my number</h1>

<p>Guess a number between 1 and 100, you have <?= $tries ?> tries left</p>

<form action="" method="post">
    <input type="number" name="usrguess" id="">
    <input type="submit" value="Make a Guess" name="guess" <?= $inputDisabled ?>>
    <input type="submit" value="Reset game" name="reset">
    <input type="submit" value="Cheat" name="cheat" <?= $inputDisabled ?>>
</form>


<?php if ($doGuess) : ?>
    <?php if (!$noTries && !$youWon) : ?>
    <p>Your guess of <?= $usrguess ?> is <?= $guessRes ?></p>
    <?php elseif ($youWon) : ?>
    <p>You Won!</p>
    <?php elseif ($noTries) : ?>
    <p>You Lost!</p>
    <?php endif; ?>

<?php endif; ?>

<?php if ($doCheat) : ?>
<p>CHEATER! The correct number is <?= $cheatRes ?></p>
<?php endif; ?>


<?php
