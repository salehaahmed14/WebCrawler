<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Content Search Module</title>
    <!--CDN Bootstrap CSS-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!--Internal CSS-->
    <style>
        body {
            padding: 20px;
        }

        .search-container {
            max-width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <!--Create a form to get User Input-->
    <div class="container">
        <div class="search-container">
            <h1 class="text-center mt-5">Content Search Module</h1>
            <form class="mt-4" action="getResults.php" method="post">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search..." aria-label="Search" aria-describedby="searchButton">
                        <button class="btn btn-primary" type="submit" id="searchButton">Search</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
<?php 

//PHP script to get matched Records from the Database

//string to be matched
$string = $_POST["search"]; 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "web_crawler";

//Create connection to the Database
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

//SQL query to retrieve matched records
$sql= "SELECT * FROM crawled_pages WHERE url LIKE '%$string%' OR title LIKE '%$string%' OR html_content LIKE '%$string%'";
$result = mysqli_query($conn, $sql);

//Display records (URLs)
if (mysqli_num_rows($result) > 0 && $string !=""){
    while($row = mysqli_fetch_assoc($result)){
        echo "<strong>URL:</strong> " . $row["url"] ."<br>";
    }
}else{
    echo "<strong>No Results Available.</strong>";
}

?>