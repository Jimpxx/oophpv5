<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// var_dump($res);

if (!$res) {
    return;
}
?>

<a href="<?= url("content/index") ?>">Index</a>

<h1>Blogg</h1>

<article>

<?php foreach ($res as $row) : ?>
<section>
    <header>
        <h1><a href="<?= url("content/blogpost/$row->slug") ?>"><?= htmlentities($row->title) ?></a></h1>
        <p><i>Published: <time datetime="<?= htmlentities($row->published_iso8601) ?>" pubdate><?= htmlentities($row->published) ?></time></i></p>
    </header>

</section>
<?php endforeach; ?>

</article>
