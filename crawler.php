<?php
// Function to fetch HTML content using cURL
function fetchHtmlContent($url) {

    //initialise the session
    $ch = curl_init($url);

    // Set cURL options
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 500);


    // Execute cURL session
    $htmlContent = curl_exec($ch);
    // Close cURL session
    curl_close($ch);

    return $htmlContent;
}
?>
