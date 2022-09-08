<?php

    $servername = "localhost";
    $username = "root";
    $password = "abc123W(k";
    $conn = new mysqli($servername, $username, $password);

    // Check connection
    if ($conn->connect_error) {
        echo("Connection failed: " . $conn->connect_error);
    }
    echo "Connected successfully";

    function getAll(string $route, string $body, string $query) {

        //Get id from request body
        if(isset($body['id']) && is_numeric($body['id'])){
            //query
            echo "get all " . $route;
        }

        else{
            header("HTTP/1.1 500 Server Error");
            echo "Invalid request body \n 'id' in body required";
        }
    }
    function getMany(string $route, string $id) {

        if(!is_numeric($id)){
            //query
        }
        echo "get many or a single " . $route;

    }
    function create(string $route, string $id, string $body){

    }
    function delete(string $route, string $id){

    }
    function update(string $route, string $id, string $body){
        
    }

?>