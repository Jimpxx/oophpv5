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

<form action="search" method="post">
    <fieldset>
        <legend>Search</legend>
        <!-- <input type="hidden" name="route" value="search-title"> -->
        <p>
            Only one field can be searched at one time!
        </p>
        <p>
            <label>Title (use % as wildcard):
                <input type="search" name="searchTitle"/>
            </label>
        </p>
        <p>
            <label>Year:
                <input type="search" name="searchYear"/>
            </label>
        </p>
        <p>
            <input type="submit" name="doSearch" value="Search">
        </p>
        <p><a href="index" class="button">Show all</a></p>
    </fieldset>
</form>

<?php
if ($res) {
?>
<div class="searchRes">
    <table>
        <tr class="first">
            <th>Rad</th>
            <th>Id</th>
            <th>Bild</th>
            <th>Titel</th>
            <th>År</th>
        </tr>
    <?php $id = -1; foreach ($res as $row) :
        $id++; ?>
        <tr>
            <td><?= $id ?></td>
            <td><?= $row->id ?></td>
            <td><img class="thumb" src="<?= $row->image ?>"></td>
            <td><?= $row->title ?></td>
            <td><?= $row->year ?></td>
        </tr>
    <?php endforeach; ?>
    </table>
</div>
<?php
}
?>
