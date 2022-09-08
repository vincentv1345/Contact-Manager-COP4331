<?php

    function getAll(string $route, string $body, string $query, $db) {

        //Validate id from request body
        echo "1";
        if(isset($body["id"]) && is_numeric($body["id"])){
            echo "2";
            $DBquery = "Select * from ". $route . " where userID = " . $body["id"] . ";";
            echo "3";
            $result = mysqli_query($db, $DBquery);
            echo "4";

            $response = array();
            echo "5";

            if (mysqli_num_rows($result) > 0) {
                echo "6";

                while($row = mysqli_fetch_assoc($result)) {
                    echo "7";
                    array_push($response, "FirstName: " . $row["FirstName"] . ", 
                                        LastName: " . $row["LastName"] . ",
                                        Email: " . $row["Email"] . ", 
                                        Phone: " . $row["Phone"] . ", 
                                        Address: " . $row["Address"] . ", 
                                        Status: " . $row["Status"]);
                }
                echo "8";
                echo json_encode($response);
            } 
            else {
                echo "0 results";
            }
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