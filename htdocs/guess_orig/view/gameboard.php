<h1>Guess my number</h1>

<p>Guess a number between 1 and 100, you have <?= $guess->tries() ?> tries left</p>

<form action="" method="post">
    <input type="number" name="usrguess" id="">
    <input type="submit" value="Make a Guess" name="guess" <?= $inputDisabled ?>>
    <input type="submit" value="Reset game" name="reset">
    <input type="submit" value="Cheat" name="cheat">
</form>

<?php if (isset($_POST["guess"])) : ?>
    <?php if (!$noTries) : ?>
    <p>Your guess of <?= $usrguess ?> is <?= $guessRes ?></p>
    <?php elseif ($noTries) : ?>
    <p>You Lost!</p>
    <?php elseif ($youWon) : ?>
    <p>You Won!</p>
    <?php endif; ?>

<?php endif; ?>

<?php if (isset($_POST["cheat"])) : ?>
<p>CHEATER! The correct number is <?= $cheatRes ?></p>
<?php endif; ?>


<?php
