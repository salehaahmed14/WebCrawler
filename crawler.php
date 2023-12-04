<?php
// Function to fetch HTML content using cURL
function fetch_html_content($url) {

    //initialise the session
    $ch = curl_init($url);

    // Set cURL options
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);


    // Execute cURL session
    $htmlContent = curl_exec($ch);

    //Error Handling
    if (curl_errno($ch)) {
        echo 'cURL error: ' . curl_error($ch);
        curl_close($ch);
        return;
    }

    // Close cURL session
    curl_close($ch);

    return $htmlContent;
}

//function to Crawl URLs starting from the seed URL
function crawl_page($url, $depth = 3) {

    // Initialize a static array to track visited URLs
    static $visitedUrls = array();
    
    if($depth == 0 || in_array($url, $visitedUrls)){
        echo "Exiting: ". $url. "<br>";
        return;
    }else{
        // Add the current URL to the visited array
        $visitedUrls[] = $url;

        // Fetch the HTML content of the page using cURL
        $htmlContent = fetch_html_content($url);

        //enusre the contents of the page aren't empty
        if(!empty($htmlContent)){

            //using the DOM document class to parse HTML content
            $dom = new DOMDocument;
            @$dom->loadHTML($htmlContent);

            // Extract anchor tags
            $anchors = $dom->getElementsByTagName('a');
            //Extract Title
            $title = $dom->getElementsByTagName('title');
            //Extract Meta content
            $meta = $dom->getElementsByTagName('meta');

            // Save the HTML content to the database
            save_html_to_database($url, $title, $meta, $htmlContent);

            // Decrease depth by one
            $depth--;

            // Recursive call for each URL within the extracted Anchor Tags
            foreach ($anchors as $anchor) {
                $href = $anchor->getAttribute('href');

                // Ensure the link is not empty and is an absolute URL
                if (!empty($href) && filter_var($href, FILTER_VALIDATE_URL)) {
                    // Recursive call with the new URL
                    crawl_page($href, $depth);
                }
            }
        }
        else{
            echo "No HTML Content Found to Crawl.";
        }
    }
}

// Function to save HTML content to the database
function save_html_to_database($url, $title, $meta, $content) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "web_crawler";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Extract title text content from DOMNodeList
    $titleText = $title->item(0)->nodeValue;
    
    //Concatenate the content from the meta Tags into a string
    $metaContent = "";
    foreach ($meta as $metaTag) {
        $metaContent .= $metaTag->getAttribute('content') . "\n";
    }

    // Prepare and execute the SQL statement
    $stmt = $conn->prepare("INSERT INTO crawled_pages (url, title, meta_description, html_content) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $url, $titleText, $metaContent, $content);
    $stmt->execute();
    $stmt->close();
}
?>
