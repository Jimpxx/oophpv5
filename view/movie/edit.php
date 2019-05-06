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

<form action="" method="post">
    <fieldset>
        <legend>Edit movie</legend>
        <!-- <input type="hidden" name="route" value="search-title"> -->
        <p>
            <label>Id:
                <input type="text" name="id" value="<?= $res->id ?>" readonly />
            </label>
        </p>
        <p>
            <label>Title:
                <input type="text" name="title" value="<?= $res->title ?>"/>
            </label>
        </p>
        <p>
            <label>Director:
                <input type="text" name="director" value="<?= $res->director ?>"/>
            </label>
        </p>
        <p>
            <label>Length:
                <input type="number" name="length" value="<?= $res->length ?>"/>
            </label>
        </p>
        <p>
            <label>Year:
                <input type="number" name="year" value="<?= $res->year ?>"/>
            </label>
        </p>
        <p>
            <label>Plot:
                <input type="text" name="plot" value="<?= $res->plot ?>"/>
            </label>
        </p>
        <p>
            <label>Image:
                <input type="text" name="image" value="<?= $res->image ?>"/>
            </label>
        </p>
        <p>
            <label>Subtext:
                <input type="text" name="subtext" value="<?= $res->subtext ?>"/>
            </label>
        </p>
        <p>
            <label>Speech:
                <input type="text" name="speech" value="<?= $res->speech ?>"/>
            </label>
        </p>
        <p>
            <label>Quality:
                <input type="text" name="quality" value="<?= $res->quality ?>"/>
            </label>
        </p>
        <p>
            <label>Format:
                <input type="text" name="format" value="<?= $res->format ?>"/>
            </label>
        </p>
        <p>
            <input type="submit" name="doSave" value="Save">
        </p>
        <p><a href="index" class="button">Show all</a></p>
    </fieldset>
</form>
