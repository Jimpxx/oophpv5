<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

// $class = $class ?? null;
// $content = $content ?? null;

?>

<form action="new" method="post">
    <fieldset>
        <legend>New movie</legend>
        <!-- <input type="hidden" name="route" value="search-title"> -->
        <p>
            <label>Title:
                <input type="text" name="title"/>
            </label>
        </p>
        <p>
            <label>Year:
                <input type="number" name="year"/>
            </label>
        </p>
        <p>
            <label>Image:
                <input type="text" name="image"/>
            </label>
        </p>
        <p>
            <input type="submit" class="button btn-green" name="doSave" value="Save">
        </p>
    </fieldset>
</form>
<p><a href="../movie" class="button btn-blue">Show all</a></p>
