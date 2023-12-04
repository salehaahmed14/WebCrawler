<?php
function isCrawlingAllowed($url){
    // Add a trailing slash to the URL if it's missing
    $url = rtrim($url, '/') . '/';

    // Construct the full URL for the robots.txt file by appending robots.txt at the end
    $robotsUrl = $url . 'robots.txt';

    // Get the content of the robots.txt file
    $robotsContent = @file_get_contents($robotsUrl);

    // Check if the robots.txt file exists and crawling is disallowed (user-agent: * & disallow: /)
    if($robotsContent !== false && preg_match('/User-agent:.*\nDisallow:/i', $robotsContent)){
        return false;
    }
    else{
        return true;
    }


}
?>