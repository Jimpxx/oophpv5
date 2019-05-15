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
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return object
     */
    public function indexAction() : object
    {
        $title = "Content | oophp";
        // // Deal with the action and return a response.
        // $this->app->db->connect();
        // $sql = "SELECT * FROM movie;";
        // $res = $this->app->db->executeFetchAll($sql);

        $this->app->page->add("content/index", [
            // "resultset" => $res,
        ]);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }


    /**
     * This is the GET route for new movie method
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
     * This is the GET route for new movie method
     * GET mountpoint/search
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
     * This is the POST route for new movie method
     * POST mountpoint/search
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

        // $this->app->request->setBody(null);

        // var_dump($_POST);

        if ($doSave) {
            echo "SAVING..";
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
        } else {
            echo "NOT SAVING..";
        }

        if ($doDelete) {
            return $this->app->response->redirect("content/delete/$id");
        }

        return $this->app->response->redirect("content/admin");
    }


    /**
     * This is the GET route for remove content method
     * GET mountpoint/content
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
     * This is the POST route for remove movie method
     * POST mountpoint/search
     *
     * @return object
     */
    public function deleteActionPost() : object
    {
        $id = $this->app->request->getPost("contentId");
        $doDelete = $this->app->request->getPost("doDelete");

        echo $doDelete;

        if ($doDelete) {
            $this->app->db->connect();
            $sql = "UPDATE content SET deleted=NOW() WHERE id=?;";
            $this->app->db->execute($sql, [$id]);
        }
        

        return $this->app->response->redirect("content/admin");
    }


    // /**
    //  * This is the GET route for search movie method
    //  * GET mountpoint/search
    //  *
    //  * @return object
    //  */
    // public function searchActionGet() : object
    // {
    //     $title = "Search Movie | oophp";
    //     $res = $this->app->session->get("res");
    //     $this->app->session->delete("res");

    //     $this->app->page->add("movie/search", [
    //         "res" => $res,
    //     ]);

    //     return $this->app->page->render([
    //         "title" => $title,
    //     ]);
    // }


    // /**
    //  * This is the POST route for search movie method
    //  * POST mountpoint/search
    //  *
    //  * @return object
    //  */
    // public function searchActionPost() : object
    // {
    //     $searchTitle = $this->app->request->getPost("searchTitle");
    //     $searchYear = $this->app->request->getPost("searchYear");
    //     if ($searchTitle) {
    //         $this->app->db->connect();
    //         $sql = "SELECT * FROM movie WHERE title LIKE ?;";
    //         $res = $this->app->db->executeFetchAll($sql, [$searchTitle]);
    //     }
    //     if ($searchYear) {
    //         $this->app->db->connect();
    //         $sql = "SELECT * FROM movie WHERE year = ?;";
    //         $res = $this->app->db->executeFetchAll($sql, [$searchYear]);
    //     }

    //     $this->app->session->set("res", $res);

    //     return $this->app->response->redirect("movie/search");
    // }



    // /**
    //  * This sample method dumps the content of $app.
    //  * GET mountpoint/dump-app
    //  *
    //  * @return string
    //  */
    // public function debugAction() : string
    // {
    //     // Deal with the action and return a response.
    //     return "Debug my game!";
    // }
}
