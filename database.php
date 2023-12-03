<?php
function create_and_connect_to_database($servername, $username, $password){

    //create connection
    $conn = new mysqli($servername, $username,$password);

    //check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//create database - web_crawler
$sql_create_db = "CREATE DATABASE IF NOT EXISTS web_crawler";
if ($conn->query($sql_create_db) === TRUE) {
    echo "Database created successfully<br>";
} else {
    echo "Error creating database: " . $conn->error . "<br>";
}

//select the created database
$conn->select_db("web_crawler");

//create a table - crawled_pages to store crawled content
$sql = "CREATE TABLE IF NOT EXISTS crawled_pages(
    id INT AUTO_INCREMENT PRIMARY KEY,
    url VARCHAR(255) NOT NULL,
    title VARCHAR(100),
    meta_description TEXT NOT NULL,
    html_content TEXT NOT NULL
)";
if ($conn->query($sql) === TRUE) {
    echo "Table 'crawled_pages' created successfully<br>";
} else {
    echo "Error creating table 'crawled_pages': " . $conn->error . "<br>";
}
$conn->close();
}
?>