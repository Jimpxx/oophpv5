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
     * This is the GET route for new movie method
     * GET mountpoint/search
     *
     * @return object
     */
    public function newActionGet() : object
    {
        $title = "New Movie | oophp";

        $this->app->page->add("movie/new");

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
    public function newActionPost() : object
    {
        $title = $this->app->request->getPost("title");
        $image = $this->app->request->getPost("image");
        $year = $this->app->request->getPost("year");

        $this->app->db->connect();
        $sql = "INSERT INTO movie (title, year, image) VALUES (?, ?, ?);";
        $this->app->db->execute($sql, [$title, $year, $image]);

        return $this->app->response->redirect("movie/index");
    }


    /**
     * This is the GET route for edit movie method
     * GET mountpoint/search
     *
     * @param mixed $id
     *
     * @return object
     */
    public function editActionGet($id) : object
    {
        $title = "Edit Movie | oophp";

        $this->app->db->connect();
        $sql = "SELECT * FROM movie WHERE id = $id;";
        $res = $this->app->db->executeFetch($sql);

        $this->app->page->add("movie/edit", [
            "res" => $res,
        ]);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }


    /**
     * This is the POST route for edit movie method
     * POST mountpoint/search
     *
     * @return object
     */
    public function editActionPost() : object
    {
        $id = $this->app->request->getPost("id");
        $title = $this->app->request->getPost("title", "");
        $director = $this->app->request->getPost("director", "");
        $length = $this->app->request->getPost("length", "");
        $year = $this->app->request->getPost("year", "");
        $plot = $this->app->request->getPost("plot", "");
        $image = $this->app->request->getPost("image", "");
        $subtext = $this->app->request->getPost("subtext", "");
        $speech = $this->app->request->getPost("speech", "");
        $quality = $this->app->request->getPost("quality", "");
        $format = $this->app->request->getPost("format", "");

        $this->app->request->setBody(null);

        $this->app->db->connect();
        // $sql = "INSERT INTO movie (title, year, image) VALUES (?, ?, ?);";
        $sql = "UPDATE movie SET title = ?, director = ?, length = ?,year = ?,plot = ?, image = ?, ";
        $sql .= "subtext = ?, speech = ?, quality = ?, format = ? WHERE id = ?;";
        $this->app->db->execute($sql, [
            $title,
            $director,
            $length,
            $year,
            $plot,
            $image,
            $subtext,
            $speech,
            $quality,
            $format,
            $id
        ]);

        return $this->app->response->redirect("movie/index");
    }


    /**
     * This is the GET route for remove movie method
     * GET mountpoint/search
     *
     * @param mixed $id
     *
     * @return object
     */
    public function removeActionGet($id) : object
    {
        $title = "Edit Movie | oophp";

        $this->app->db->connect();
        $sql = "SELECT * FROM movie WHERE id = $id;";
        $res = $this->app->db->executeFetch($sql);

        $this->app->page->add("movie/remove", [
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
    public function removeActionPost() : object
    {
        $id = $this->app->request->getPost("id");
        // $title = $this->app->request->getPost("title");
        // $director = $this->app->request->getPost("director");
        // $length = $this->app->request->getPost("length");
        // $year = $this->app->request->getPost("year");
        // $plot = $this->app->request->getPost("plot");
        // $image = $this->app->request->getPost("image");
        // $subtext = $this->app->request->getPost("subtext");
        // $speech = $this->app->request->getPost("speech");
        // $quality = $this->app->request->getPost("quality");
        // $format = $this->app->request->getPost("format");

        // $this->app->request->setBody(null);
        // echo $id;

        $this->app->db->connect();
        // $sql = "INSERT INTO movie (title, year, image) VALUES (?, ?, ?);";
        $sql = "DELETE FROM movie WHERE id = ?;";
        $this->app->db->execute($sql, [$id]);

        return $this->app->response->redirect("movie/index");
    }


    /**
     * This is the GET route for search movie method
     * GET mountpoint/search
     *
     * @return object
     */
    public function searchActionGet() : object
    {
        $title = "Search Movie | oophp";
        $res = $this->app->session->get("res");
        $this->app->session->delete("res");

        $this->app->page->add("movie/search", [
            "res" => $res,
        ]);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }


    /**
     * This is the POST route for search movie method
     * POST mountpoint/search
     *
     * @return object
     */
    public function searchActionPost() : object
    {
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

        return $this->app->response->redirect("movie/search");
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
