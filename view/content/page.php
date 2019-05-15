<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

?>

<a href="<?= url("content/index") ?>">Index</a>
<a href="<?= url("content/pages") ?>">Back</a>

<article>
    <header>
        <h1><?= htmlentities($res->title) ?></h1>
        <p><i>Latest update: <time datetime="<?= htmlentities($res->modified_iso8601) ?>" pubdate><?= htmlentities($res->modified) ?></time></i></p>
    </header>
    <p>
    <?= $html ?>
    </p>
</article>
