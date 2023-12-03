<?php
include('database.php');
include('crawler.php');
$seedUrl = "https://en.wikipedia.org/wiki/JavaScript";
create_and_connect_to_database("localhost", "root", "");
crawlPage($seedUrl, 2);
?>