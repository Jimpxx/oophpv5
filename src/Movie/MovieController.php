<?php

namespace Jiad\Movie;

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
class MovieController implements AppInjectableInterface
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
        $title = "Movie database | oophp";
        // Deal with the action and return a response.
        $this->app->db->connect();
        $sql = "SELECT * FROM movie;";
        $res = $this->app->db->executeFetchAll($sql);

        $this->app->page->add("movie/index", [
            "resultset" => $res,
        ]);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }


    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return object
     */
    public function searchActionGet() : object
    {
        $title = "Search | oophp";
        // Deal with the action and return a response.
        // $this->app->db->connect();
        // $sql = "SELECT * FROM movie;";
        // $res = $this->app->db->executeFetchAll($sql);

        $res = $this->app->session->get("res");
        // $this->app->session->delete("res");
        // $res = $this->app->request->getPost("res");

        $this->app->page->add("movie/search", [
            "res" => $res,
        ]);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }


    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return object
     */
    public function searchActionPost() : object
    {
        // $title = "Search | oophp";
        // // Deal with the action and return a response.

        $searchTitle = $this->app->request->getPost("searchTitle");
        $searchYear = $this->app->request->getPost("searchYear");
        if ($searchTitle) {
            $this->app->db->connect();
            $sql = "SELECT * FROM movie WHERE title LIKE ?;";
            $res = $this->app->db->executeFetchAll($sql, [$searchTitle]);
        }
        if ($searchYear) {
            $this->app->db->connect();
            $sql = "SELECT * FROM movie WHERE year = ?;";
            $res = $this->app->db->executeFetchAll($sql, [$searchYear]);
        }

        // var_dump($res);

        $this->app->session->set("res", $res);
        // $this->app->request->setPost("res", $res);

        
        // $sql = "SELECT * FROM movie;";
        // $res = $this->app->db->executeFetchAll($sql);

        // $this->app->page->add("movie/search", [
        //     "res" => $res,
        // ]);

        return $this->app->response->redirect("movie/search");

        // return $this->app->page->render([
        //     "title" => $title,
        // ]);
    }


    // /**
    //  * This is the index method action, it handles:
    //  * ANY METHOD mountpoint
    //  * ANY METHOD mountpoint/
    //  * ANY METHOD mountpoint/index
    //  *
    //  * @return object
    //  */
    // public function resetActionPost() : object
    // {
    //     $title = "Movie database | oophp";
    //     // Deal with the action and return a response.
    //     $this->app->db->connect();
    //     $sql = "SELECT * FROM movie;";
    //     $res = $this->app->db->executeFetchAll($sql);

    //     $this->app->page->add("movie/index", [
    //         "resultset" => $res,
    //     ]);

    //     return $this->app->page->render([
    //         "title" => $title,
    //     ]);
    // }




    /**
     * This sample method dumps the content of $app.
     * GET mountpoint/dump-app
     *
     * @return string
     */
    public function debugAction() : string
    {
        // Deal with the action and return a response.
        return "Debug my game!";
    }
}
