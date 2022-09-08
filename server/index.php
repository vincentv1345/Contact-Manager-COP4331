<?php
        //import controllers
       require_once './controllers/controllers.php';

       $serverName = "localhost";
       $username = "root";
       $password = "abc123W(k";
       $db = 'COP4331GR16';
       $conn=mysqli_connect($serverName,$username,$password,$db);

        if($conn)
        {
            echo "Connection Successful";
        }
        else
        {
            echo "Could not connect";
        }

        //This gets the uri routes into an array
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri = explode( '/', $uri );

        //This gets the method type. Ex: GET, POST, DELETE, etc..
        $method = $_SERVER['REQUEST_METHOD'];

        //This gets the request body
        $body =  file_get_contents('php://input');

        //This gets all queries from the url
        $queries = $_SERVER['QUERY_STRING'];

        //validate the correct routs for this api
        if (isset($uri[1]) && $uri[1] === "index.php" && isset($uri[2])){
                //users route
                if($uri[2] === "users"){
                    if(isset($uri[3])){
                        switch ($method) {
                            case "GET":
                                getMany("contacts", $uri[3]);
                                break;

                            case "POST":
                                create("contacts", $uri[3], $body);
                                break;

                            case "PATCH":
                                update("contacts", $uri[3], $body);
                                break;

                            case "DELETE":
                                delete("contacts", $uri[3]);
                                break;

                            default:
                                header("HTTP/1.1 500 Server Error");
                                echo 
                                    "Invalid request method " . $method . 
                                    "\n Only GET, POST, PATCH, and DELETE methods are allowed for this route";
                                break;
                        }
                    }else{
                            header("HTTP/1.1 404 Not Found");
                            echo "HTTP/1.1 404 Not Found";
                    }
                }
                //contact route
                else if($uri[2] === "contacts"){

                    //contacts/:id  route
                    if(isset($uri[3])){

                        switch ($method) {
                            case "GET":
                                //getMany("contacts", $body);
                                echo "Get many contacts";
                                break;

                            case "POST":
                                //new("contacts", $body);
                                echo "Post new contact";
                                break;

                            case "PATCH":
                                //update("contacts", $body);
                                echo "Update contact";
                                break;

                            case "DELETE":
                                //delete("contacts", $body);
                                echo "delete contact";
                                break;

                            default:
                                header("HTTP/1.1 500 Server Error");
                                echo 
                                    "Invalid request method " . $method . 
                                    "\n Only GET, POST, PATCH, and DELETE methods are allowed for this route";
                                break;
                        }
                    }
            
                    //contacts/  route
                    else{
                        
                        //The method only should be contact
                        if($method === "GET"){
                            $getAll('contacts', $body, $queries);
                        }

                        else{
                            header("HTTP/1.1 500 Server Error");
                            echo "Invalid request method " . $method . "\n Only GET method is allowed for this route";
                        }
                    }
                }
                
                //throw error for invalid routes
                else{
                    header("HTTP/1.1 404 Not Found");
                    echo "HTTP/1.1 404 Not Found";
                }
        }

        //throw an 404 error the routes are not valid
        else{
            header("HTTP/1.1 404 Not Found");
            echo "HTTP/1.1 404 Not Found";
        }
?>