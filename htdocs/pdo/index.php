<?php
// Get essentials
require "src/autoload.php";
require "src/config.php";
require "src/function.php";

$db = new Database();
$db->connect($databaseConfig);

$sql = "SELECT * FROM movie;";
$resultset = $db->executeFetchAll($sql);


// Render the page
require "view/header.php";
require "view/show-all.php";
require "view/footer.php";
