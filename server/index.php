<?php
        //import controllers
        require_once './controllers/controllers.php';

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
        $queries = $_SERVER['QUERY_STRING'];

        //validate the correct routs for this api
        if (isset($uri[1]) && $uri[1] === "index.php" && isset($uri[2])){
                //users route
                if($uri[2] === "users"){
                    if(isset($uri[3]) && $uri[3] !== ""){
                        switch ($method) {
                            case "GET":
                                getOne("Users", $uri[3], $body, $conn);
                                break;

                            case "POST":
                                create("Users", $uri[3], $body, $conn);
                                break;

                            case "PATCH":
                                update("Users", $uri[3], $body, $conn);
                                break;

                            case "DELETE":
                                delete("Users", $uri[3], $conn);
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
                    if(isset($uri[3]) && $uri[3] !== ""){

                        switch ($method) {
                            case "GET":
                                getOne("Contacts", $uri[3], $body, $conn);
                                break;

                            case "POST":
                                create("Contacts", $uri[3], $body, $conn);
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
                            try {
                                getAll('Contacts', $body, $queries, $conn);
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