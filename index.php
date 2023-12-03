<?php
//function calls to populate the database
include('database.php');
include('crawler.php');
$seedUrl = "https://en.wikipedia.org/wiki/JavaScript";
create_and_connect_to_database("localhost", "root", "");
crawl_page($seedUrl, 2);
?>