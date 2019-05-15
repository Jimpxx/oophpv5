<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// var_dump($res);

if (!$res) {
    return;
}

$filter = new \Jiad\TextFilter\MyTextFilter();
// $html = $filter->parse($res->data, $res->filter);

?>

<a href="<?= url("content/index") ?>">Index</a>
<a href="<?= url("content/blog") ?>">Back</a>

<article>
    <header>
        <h1><?= htmlentities($res->title) ?></h1>
        <p><i>Published: <time datetime="<?= htmlentities($res->published_iso8601) ?>" pubdate><?= htmlentities($res->published) ?></time></i></p>
    </header>
    <?= $filter->parse($res->data, $res->filter) ?>
</article>
