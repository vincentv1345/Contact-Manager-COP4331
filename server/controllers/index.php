<?php

    return [
        'getAll' => function (string $route, object $body, string $query) {

            //Get id from request body
            if(isset($body['id']) && is_numeric($body['id'])){
                //query
                echo "get all " . $route;
            }

            else{
                header("HTTP/1.1 500 Server Error");
                echo "Invalid request body \n 'id' in body required";
            }
        },
        'getMany' => function (string $route, string $id) {

            if(!is_numeric($id)){
                //query
            }
            echo "get many or a single " . $route;

        }
    ]

?>