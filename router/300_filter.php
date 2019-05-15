<?php


/**
 * Show all filters.
 */
$app->router->get("filter", function () use ($app) {
    $title = "Filter | oophp";

    // $filter = new MyTextFilter();
    $filter = new \Jiad\TextFilter\MyTextFilter();

    $text_bbcode = file_get_contents(__DIR__ . "/../htdocs/text/bbcode.txt");
    $text_link = file_get_contents(__DIR__ . "/../htdocs/text/clickable.txt");
    $text_markdown = file_get_contents(__DIR__ . "/../htdocs/text/sample.md");
    // $text = file_get_contents(__DIR__ . "/../text/clickable.txt");
    // $text = file_get_contents(__DIR__ . "/../text/sample.md");
    // $text = "En [b]fet[/b] moped.";

    $html_bbcode = $filter->parse($text_bbcode, "bbcode, nl2br");
    $html_link = $filter->parse($text_link, "link");
    $html_markdown = $filter->parse($text_markdown, "markdown");
    // $html = $filter->parse($text, ["bbcode", "link", "markdown", "nl2br"]);

    $app->page->add("filter/index", [
        "html_bbcode" => $html_bbcode,
        "html_link" => $html_link,
        "html_markdown" => $html_markdown,
    ]);

    return $app->page->render([
        "title" => $title,
    ]);
});
