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

<form action="../remove" method="post">
    <fieldset>
        <legend>Remove movie</legend>
        <!-- <input type="hidden" name="route" value="search-title"> -->
        <p>
            <label>Id:
                <input type="text" name="id" value="<?= $res->id ?>" readonly />
            </label>
        </p>
        <p>
            <label>Title:
                <input type="text" name="title" value="<?= $res->title ?>" readonly />
            </label>
        </p>
        <p>
            <label>Director:
                <input type="text" name="director" value="<?= $res->director ?>" readonly />
            </label>
        </p>
        <p>
            <label>Length:
                <input type="number" name="length" value="<?= $res->length ?>" readonly />
            </label>
        </p>
        <p>
            <label>Year:
                <input type="number" name="year" value="<?= $res->year ?>" readonly />
            </label>
        </p>
        <p>
            <label>Plot:
                <input type="text" name="plot" value="<?= $res->plot ?>" readonly />
            </label>
        </p>
        <p>
            <label>Image:
                <input type="text" name="image" value="<?= $res->image ?>" readonly />
            </label>
        </p>
        <p>
            <label>Subtext:
                <input type="text" name="subtext" value="<?= $res->subtext ?>" readonly />
            </label>
        </p>
        <p>
            <label>Speech:
                <input type="text" name="speech" value="<?= $res->speech ?>" readonly />
            </label>
        </p>
        <p>
            <label>Quality:
                <input type="text" name="quality" value="<?= $res->quality ?>" readonly />
            </label>
        </p>
        <p>
            <label>Format:
                <input type="text" name="format" value="<?= $res->format ?>" readonly />
            </label>
        </p>
        <p>
            <input type="submit" name="doRemove" value="Remove">
        </p>
    </fieldset>
</form>
<p><a href="../../movie" class="button">Show all</a></p>
