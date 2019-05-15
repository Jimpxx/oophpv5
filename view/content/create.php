<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

?>
<form method="post">
    <fieldset>
    <legend>Create</legend>

    <p>
        <label>Title:<br> 
        <input type="text" name="contentTitle" default="A Title"/>
        </label>
    </p>

    <p>
        <button type="submit" name="doCreate" value="Create"><i class="fas fa-plus" aria-hidden="true"></i> Create</button>
        <!-- <input type="submit" value="Create" name="doCreate"> -->
        <button type="reset"><i class="fa fa-undo" aria-hidden="true"></i> Reset</button>
    </p>
    </fieldset>
</form>
