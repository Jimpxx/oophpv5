<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

if (!$res) {
    return;
}
?>

<a href="<?= url("content/index") ?>">Index</a>

<h1>All Pages</h1>

<table>
    <tr class="first">
        <th>Id</th>
        <th>Title</th>
        <th>Type</th>
        <th>Status</th>
        <th>Published</th>
        <th>Deleted</th>
    </tr>
<?php $id = -1; foreach ($res as $row) :
    $id++; ?>
    <tr>
        <td><?= $row->id ?></td>
        <td><a href="<?= url("content/page/$row->path") ?>"><?= $row->title ?></a></td>
        <td><?= $row->type ?></td>
        <td><?= $row->status ?></td>
        <td><?= $row->published ?></td>
        <td><?= $row->deleted ?></td>
    </tr>
<?php endforeach; ?>
</table>
