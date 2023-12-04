# WebCrawler

# Overview 
This Web Crawler is a PHP based web application designed to crawl websites, parse and store the fetched HTML content from those websites and store it in a MySQL database. In addition, after the crawling has been successfully done, starting from the seed URL, the user is provided with a Bootstrap interface to search for a specific string, which is then compared with the crawled content stored in the database. If the string matches with any of the available content, the respective URLs are displayed on the screen.  
  
# Setting Up the Web Crawler  
**Requirements:**  
* XAMPP (or any similar stack that includes Apache, PHP, and MySQL) - Download and install XAMPP from https://www.apachefriends.org/index.html.  
* Git

**Cloning the Repository:**  
* Open your __Git Bash__ or __powershell__ and navigate to the __htdocs__ directory within your XAMPP installation directory. Type the follwing command and then copy and paste the URL for this repository.  
<pre>

git clone https://github.com/salehaahmed14/WebCrawler.git 

</pre>  
**Running the Web Spider:**  
Once you have cloned the repository, navigate to your __XAMPP Control Panel__  and start your Apache and MySQL server. Once Successful, copy and paste the following URLs in separate Tabs in your Web Browser;
* phpMyAdmin  
<pre>

http://localhost/phpmyadmin/

</pre>  
* Web Crawler (index.php)  
<pre>

http://localhost/WebCrawler/

</pre> 
__Note:__ You can edit the seed URL (https://en.wikipedia.org/wiki/JavaScript) before running the web spider by navigating to index.php after opening thr project in a code editor such as __Visual Studio Code__.   
* Content Search Engine  
<pre>

http://localhost/WebCrawler/contentSearchEngine.html

</pre>  
After following the above steps your web crawler is ready to use, you can leverage the Content Search Engine to search for your desired text in the crawled content.