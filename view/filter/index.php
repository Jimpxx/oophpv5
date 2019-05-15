<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

// $class = $class ?? null;
// $content = $content ?? null;


// if (!$resultset) {
//     return;
// }

?>

<h1>Filter</h1>

<h2>BBCode</h2>

<p><?= $html_bbcode ?></p>

<h2>Clickable</h2>

<p><?= $html_link ?></p>

<h2>Markdown</h2>

<p><?= $html_markdown ?></p>
