<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

// $class = $class ?? null;
// $content = $content ?? null;


if (!$resultset) {
    return;
}

?>

<!-- <form action="movie/reset" method="post">
    <input type="submit" value="Återställ databas" name="reset" class="button">
</form> -->
<!-- <a href="movie/reset" class="button">Återställ databasen</a> -->

<table>
    <tr class="first">
        <th>Rad</th>
        <th>Id</th>
        <th>Bild</th>
        <th>Titel</th>
        <th>År</th>
        <th></th>
        <th></th>
    </tr>
<?php $id = -1; foreach ($resultset as $row) :
    $id++; ?>
    <tr>
        <td><?= $id ?></td>
        <td><?= $row->id ?></td>
        <td><img class="thumb" src="<?= $row->image ?>"></td>
        <td><?= $row->title ?></td>
        <td><?= $row->year ?></td>
        <td><a href="movie/edit/<?= $row->id ?>">Redigera</a></td>
        <td><a href="movie/remove/<?= $row->id ?>">Ta bort</a></td>
    </tr>
<?php endforeach; ?>
</table>

<a href="movie/new" class="button">Ny film</a>
<a href="movie/search" class="button">sök film</a>
