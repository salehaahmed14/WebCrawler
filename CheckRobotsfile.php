<?php
function parseRobotsTxt($url) {
    //append robots.txt to the end of the URL to get the file
    $cleanUrl = rtrim($url, '/');
    $robotsTxtUrl = $cleanUrl . '/robots.txt';
    $robotsTxtContent = file_get_contents($robotsTxtUrl);

    // Check if the robots.txt file exists for the particular URL
    if ($robotsTxtContent === false) {
        die("Failed to fetch robots.txt file.");
    }

    // Initialize an array to store disallowed URLs
    $disallowedUrls = [];

    // Split the content into lines
    $lines = explode("\n", $robotsTxtContent);

    // Flag to indicate whether the user agents are applicable to our crawler
    $relevantUserAgent = false;

    // Iterate through each line
    foreach ($lines as $line) {
        // Remove leading and trailing whitespaces
        $line = trim($line);

        // Skip empty lines
        if (empty($line)) {
            continue;
        }

        // Check if the line starts with "User-agent"
        if (strpos($line, 'User-agent:') === 0) {
            // Check if the user agent is applicable to our crawler (value is * i.e. applicable to all crawlers)
            $relevantUserAgent = (strpos($line, '*') !== false);

        } elseif ($relevantUserAgent && strpos($line, 'Disallow:') === 0) {
            // If the line starts with "Disallow:" and is applicable to our crawler, extract the disallowed path
            $disallowedPath = trim(substr($line, 9));

            // append the disallowed URL to root URL to get the complete path
            $disallowedUrl = $url . $disallowedPath;

            // Add the disallowed URL to the array
            $disallowedUrls[] = $disallowedUrl;
        }
    }

    return $disallowedUrls;
}
?>
