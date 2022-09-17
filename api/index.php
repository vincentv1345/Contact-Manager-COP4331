<?php
        //import controllers
        require_once '/var/www/html/api/controllers/controllers.php';

        //connect to db
        $serverName = "localhost";
        $username = "phpConnection";
        $password = "123456";
        $db = 'COP4331GR16';
        $conn = new mysqli($serverName, $username, $password, $db);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        //This gets the uri routes into an array
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri = explode( '/', $uri );

        //This gets the method type. Ex: GET, POST, DELETE, etc..
        $method = $_SERVER['REQUEST_METHOD'];

        //This gets the request body
        $body =  json_decode(file_get_contents('php://input'));

        //This gets all queries from the url
        $queries = array();
        parse_str($_SERVER['QUERY_STRING'], $queries);

        //validate the correct routs for this api
        if (isset($uri[1]) && $uri[1] === "api" && isset($uri[2]) && $uri[2] === "index.php" && isset($uri[3])){
                //users route
                if($uri[3] === "users"){

                    if($method === "GET"){
                        getOne("Users", "", $queries, $conn);
                    }
                    else if($method === "POST"){
                        create("Users", 1, $body, $conn);
                    }
                    else{
                        header("HTTP/1.1 404 Not Found");
                        echo "Invalid method. Only GET is allowed";
                    }

                }
                //contact route
                else if($uri[3] === "contacts"){

                    //contacts/:id  route
                    if(isset($uri[4]) && $uri[4] !== ""){

                        switch ($method) {
                            case "GET":
                                getOne("Contacts", $uri[4], $queries, $conn);
                                break;

                            case "POST":
                                create("Contacts", $uri[4], $body, $conn);
                                break;

                            case "PATCH":
                                //update("contacts", $body);
                                echo "Update contact";
                                break;

                            case "DELETE":
                                delete("Contacts", $uri[4], $body, $conn);
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
                            try {
                                getAll('Contacts', $queries, $conn);
                            } catch (\Throwable $th) {
                                echo $th;
                            }
                            
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