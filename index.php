<?php
//function calls to populate the database
include('database.php');
include('crawler.php');
include('isCrawlingAllowed.php');
$seedUrl = "https://en.wikipedia.org/wiki/JavaScript";
if (isCrawlingAllowed($seedUrl)){
    create_and_connect_to_database("localhost", "root", "");
    crawl_page($seedUrl, 2);
}
else{
    echo "Crawling disallowed.";
}
?>