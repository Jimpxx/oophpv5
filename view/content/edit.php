<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

?>

<a href="<?= url("content/admin") ?>">Admin Dashboard</a>

<h1>Edit Content</h1>

<form method="post" action="<?= url("content/edit") ?>">
    <fieldset>
    <legend>Edit</legend>
    <input type="hidden" name="contentId" value="<?= htmlentities($res->id) ?>"/>

    <p>
        <label>Title:<br> 
        <input type="text" name="contentTitle" value="<?= htmlentities($res->title) ?>"/>
        </label>
    </p>

    <p>
        <label>Path:<br> 
        <input type="text" name="contentPath" value="<?= htmlentities($res->path) ?>"/>
    </p>

    <p>
        <label>Slug:<br> 
        <input type="text" name="contentSlug" value="<?= htmlentities($res->slug) ?>"/>
    </p>

    <p>
        <label>Text:<br> 
        <textarea name="contentData"><?= htmlentities($res->data) ?></textarea>
     </p>

     <p>
         <label>Type:<br> 
         <input type="text" name="contentType" value="<?= htmlentities($res->type) ?>"/>
     </p>

     <p>
         <label>Filter:<br> 
         <input type="text" name="contentFilter" value="<?= htmlentities($res->filter) ?>"/>
     </p>

     <p>
         <label>Publish:<br> 
         <input type="datetime" name="contentPublish" value="<?= htmlentities($res->published) ?>"/>
     </p>

    <p>
        <button name="doSave" value="Save"><i class="fas fa-save"></i> Save</button>
        <!-- <input type="submit" value="Save" name="doSave"> -->
        <button type="reset"><i class="fa fa-undo" aria-hidden="true"></i> Reset</button>
        <button type="submit" name="doDelete" value="Delete"><i class="fas fa-trash-alt" aria-hidden="true"></i> Delete</button>
        <!-- <input type="submit" value="Delete" name="doDelete"> -->
    </p>
    </fieldset>
</form>
