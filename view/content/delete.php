<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

?>

<a href="<?= url("content/admin") ?>">Admin Dashboard</a>

<h1>Delete Content</h1>

<form method="post" action="<?= url("content/delete") ?>">
    <fieldset>
    <legend>Delete</legend>

    <input type="hidden" name="contentId" value="<?= htmlentities($res->id) ?>"/>

    <p>
        <label>Title:<br> 
            <input type="text" name="contentTitle" value="<?= htmlentities($res->title) ?>" readonly/>
        </label>
    </p>

    <p>
        <button type="submit" name="doDelete" value="Delete"><i class="fas fa-trash-alt" aria-hidden="true"></i> Delete</button>
        <!-- <input type="submit" value="Delete" name="doDelete"> -->
    </p>
    </fieldset>
</form>
