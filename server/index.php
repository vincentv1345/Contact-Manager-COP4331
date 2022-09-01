<?php
        //This gets the uri routes into an array
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri = explode( '/', $uri );
    
        //validate the correct routs for this api
        if (isset($uri[1]) && $uri[1] === "index.php" && isset($uri[2])){
    
        }

        //throw an 404 error the routes are not valid
        else{
            header("HTTP/1.1 404 Not Found");
            echo "HTTP/1.1 404 Not Found";
        }
?>