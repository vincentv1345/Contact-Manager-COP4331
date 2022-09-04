<?php
        //This gets the uri routes into an array
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri = explode( '/', $uri );

        //This gets the method type. Ex: GET, POST, DELETE, etc..
        $method = $_SERVER['REQUEST_METHOD'];

        //This gets the request body
        $body =  file_get_contents('php://input');

        //validate the correct routs for this api
        if (isset($uri[1]) && $uri[1] === "index.php" && isset($uri[2])){

                //users route
                if($uri[2] === "users"){
                    echo "This is the users end point";
                }
        
                //contact route
                else if($uri[2] === "contacts"){

                    //contacts/:id  route
                    if(isset($uri[3])){

                    }
            
                    //contacts/  route
                    else{
                        
                        //The method only should be contact
                        if($method === "GET"){

                            //Get id from request body
                            if(isset($body['id']) && is_numeric($body['id'])){
                                //getAll(contacts, $body['id']);
                                echo "get all contacts";
                            }

                            else{
                                header("HTTP/1.1 500 Server Error");
                                echo "Invalid request body \n 'id' in body required";
                            }
                        }

                        else{
                            header("HTTP/1.1 500 Server Error");
                            echo "Invalid request method " . $method . "\n Only GET method allow for this route";
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