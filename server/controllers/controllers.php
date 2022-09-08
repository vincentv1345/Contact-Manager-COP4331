<?php

    function getAll(string $route, string $body, string $query, $db) {

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
    function getMany(string $route, string $id, $db) {

        if(!is_numeric($id)){
            //query
        }
        echo "get many or a single " . $route;

    }
    function create(string $route, string $id, string $body, $db){

    }
    function delete(string $route, string $id, $db){

    }
    function update(string $route, string $id, string $body, $db){
        
    }

?>