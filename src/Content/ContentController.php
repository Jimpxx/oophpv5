<?php

namespace Jiad\Content;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A sample controller to show how a controller class can be implemented.
 * The controller will be injected with $app if implementing the interface
 * AppInjectableInterface, like this sample class does.
 * The controller is mounted on a particular route and can then handle all
 * requests for that mount point.
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class ContentController implements AppInjectableInterface
{
    use AppInjectableTrait;



    /**
     * @var string $db a sample member variable that gets initialised
     */
    // private $db = "not active";



    /**
     * The initialize method is optional and will always be called before the
     * target method/action. This is a convienient method where you could
     * setup internal properties that are commonly used by several methods.
     *
     * @return void
     */
    // public function initialize() : void
    // {
    //     // Use to initialise member variables.
    //     $this->db = "active";

    //     // Use $this->app to access the framework services.
    // }



    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint/index
     *
     * @return object
     */
    public function indexAction() : object
    {
        $title = "Content | oophp";

        $this->app->page->add("content/index", [
            // "resultset" => $res,
        ]);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }



    /**
     * This is the GET route for admin method action
     * GET mountpoint/search
     *
     * @return object
     */
    public function adminActionGet() : object
    {
        $title = "Admin | oophp";

        $this->app->db->connect();
        $sql = "SELECT * FROM content;";
        $res = $this->app->db->executeFetchAll($sql);

        $this->app->page->add("content/admin", [
            "res" => $res,
        ]);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }


    /**
     * This is the GET route for create method action
     * GET mountpoint/create
     *
     * @return object
     */
    public function createActionGet() : object
    {
        $title = "Create Content | oophp";

        $this->app->page->add("content/create");

        return $this->app->page->render([
            "title" => $title,
        ]);
    }


    /**
     * This is the POST route for create method action
     * POST mountpoint/create
     *
     * @return object
     */
    public function createActionPost() : object
    {
        $title = $this->app->request->getPost("contentTitle");
        $doCreate = $this->app->request->getPost("doCreate");

        if ($doCreate) {
            $this->app->db->connect();
            $sql = "INSERT INTO content (title) VALUES (?);";
            $this->app->db->execute($sql, [$title]);
            $id = $this->app->db->lastInsertId();
        }

        return $this->app->response->redirect("content/edit/$id");
    }


    /**
     * This is the GET route for edit content method
     * GET mountpoint/edit
     *
     * @param mixed $id
     *
     * @return object
     */
    public function editActionGet($id) : object
    {
        $title = "Edit Content | oophp";

        $this->app->db->connect();
        $sql = "SELECT * FROM content WHERE id = $id;";
        $res = $this->app->db->executeFetch($sql);

        $this->app->page->add("content/edit", [
            "res" => $res,
        ]);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }


    /**
     * This is the POST route for edit content method
     * POST mountpoint/edit
     *
     * @return object
     */
    public function editActionPost() //: object
    {
        $id = $this->app->request->getPost("contentId");
        $title = $this->app->request->getPost("contentTitle");
        $path = $this->app->request->getPost("contentPath");
        $slug = $this->app->request->getPost("contentSlug");
        $data = $this->app->request->getPost("contentData");
        $type = $this->app->request->getPost("contentType");
        $filter = $this->app->request->getPost("contentFilter");
        $publish = $this->app->request->getPost("contentPublish");
        $doSave = $this->app->request->getPost("doSave");
        $doDelete = $this->app->request->getPost("doDelete");

        if ($doSave) {
            if (!$slug) {
                $slug = slugify($title);
            }
            if (!$path) {
                $path = null;
            }
            $this->app->db->connect();
            $sql = "UPDATE content SET title = ?, path = ?, slug = ?, data = ?, type = ?, filter = ? ";
            $sql .= "WHERE id = ?;";
            $this->app->db->execute($sql, [
                $title,
                $path,
                $slug,
                $data,
                $type,
                $filter,
                $id
            ]);
        }

        if ($doDelete) {
            return $this->app->response->redirect("content/delete/$id");
        }

        return $this->app->response->redirect("content/admin");
    }


    /**
     * This is the GET route for delete content method
     * GET mountpoint/delete
     *
     * @param mixed $id
     *
     * @return object
     */
    public function deleteActionGet($id) : object
    {
        $title = "Delete Content | oophp";

        $this->app->db->connect();
        $sql = "SELECT * FROM content WHERE id = $id;";
        $res = $this->app->db->executeFetch($sql);

        $this->app->page->add("content/delete", [
            "res" => $res,
        ]);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }


    /**
     * This is the POST route for delete content method
     * POST mountpoint/delete
     *
     * @return object
     */
    public function deleteActionPost() : object
    {
        $id = $this->app->request->getPost("contentId");
        $doDelete = $this->app->request->getPost("doDelete");

        if ($doDelete) {
            $this->app->db->connect();
            $sql = "UPDATE content SET deleted=NOW() WHERE id=?;";
            $this->app->db->execute($sql, [$id]);
        }

        return $this->app->response->redirect("content/admin");
    }

    

    /**
     * This is the GET route for pages method
     * GET mountpoint/pages
     *
     *
     * @return object
     */
    public function pagesActionGet() : object
    {
        $title = "Delete Content | oophp";

        $this->app->db->connect();
        $sql = <<<EOD
SELECT 
    *,
    CASE 
        WHEN (deleted <= NOW()) THEN "isDeleted"
        WHEN (published <= NOW()) THEN "isPublished"
        ELSE "notPublished"
    END AS status
FROM content 
WHERE type = ?
;
EOD;
        $res = $this->app->db->executeFetchAll($sql, ["page"]);

        $this->app->page->add("content/pages", [
            "res" => $res,
        ]);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }




    /**
     * This is the page action method
     * GET mountpoint/page
     *
     * @param mixed $route
     *
     * @return object
     */
    public function pageActionGet($route) : object
    {
        $title = "Content | oophp";
        // // Deal with the action and return a response.
        $this->app->db->connect();
        $sql = <<<EOD
SELECT
    *,
    DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%dT%TZ') AS modified_iso8601,
    DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%d') AS modified
FROM content
WHERE
    path = ?
    AND type = ?
    AND (deleted IS NULL OR deleted > NOW())
    AND published <= NOW()
;
EOD;
        // $sql = "SELECT * FROM movie;";
        $res = $this->app->db->executeFetch($sql, [$route, "page"]);

        if (!$res) {
            header("HTTP/1.0 404 Not Found");
            $title = "404";
            $this->app->page->add("content/404", [
                // "resultset" => $res,
            ]);
            return $this->app->page->render([
                "title" => $title,
            ]);
        }

        $filter = new \Jiad\TextFilter\MyTextFilter();
        $html = $filter->parse($res->data, $res->filter);

        $this->app->page->add("content/page", [
            "res" => $res,
            "html" => $html,
        ]);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }



    /**
     * This is the blog method action
     * GET mountpoint/blog
     *
     * @return object
     */
    public function blogActionGet() : object
    {
        $title = "Blog | oophp";
        // // Deal with the action and return a response.
        $this->app->db->connect();
        $sql = <<<EOD
SELECT
    *,
    DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%dT%TZ') AS published_iso8601,
    DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%d') AS published
FROM content
WHERE
    type = ?
ORDER BY published DESC
;
EOD;
        // $sql = "SELECT * FROM movie;";
        $res = $this->app->db->executeFetchAll($sql, ["post"]);

        $this->app->page->add("content/blog", [
            "res" => $res,
            // "html" => $html,
        ]);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }



    /**
     * This is the blogpost action method
     * GET mountpoint/blogpost
     *
     * @param mixed $slug
     *
     * @return object
     */
    public function blogpostActionGet($slug) : object
    {
        $title = "Blogpost | oophp";
        // // Deal with the action and return a response.
        $this->app->db->connect();
        $sql = <<<EOD
SELECT
    *,
    DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%dT%TZ') AS published_iso8601,
    DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%d') AS published
FROM content
WHERE
    slug = ?
    AND type = ?
    AND (deleted IS NULL OR deleted > NOW())
    AND published <= NOW()
ORDER BY published DESC
;
EOD;
        // $sql = "SELECT * FROM movie;";
        $res = $this->app->db->executeFetch($sql, [$slug, "post"]);


        if (!$res) {
            header("HTTP/1.0 404 Not Found");
            $title = "404";
            $this->app->page->add("content/404", [
                // "resultset" => $res,
            ]);
            return $this->app->page->render([
                "title" => $title,
            ]);
        }

        $this->app->page->add("content/blogpost", [
            "res" => $res,
            // "html" => $html,
        ]);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }

}
