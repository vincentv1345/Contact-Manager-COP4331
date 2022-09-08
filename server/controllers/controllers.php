<?php

    function getAll(string $route, $body, string $query, $db) {

        //Validate id from request body
        if(isset($body->id) && is_numeric($body->id)){

            $DBquery = "Select * from ". $route . " where userID = " . $body->id . ";";
            $result = mysqli_query($db, $DBquery);
            $response = array();

            if (mysqli_num_rows($result) > 0) {

                while($row = mysqli_fetch_assoc($result)) {
                    array_push($response, '{"FirstName": ' . '"' . $row["FirstName"] . '"' . ', "LastName": ' . '"' . $row["LastName"] . '"' . ',"Email": ' . '"' . $row["Email"] . '"' . ', "Phone": ' . '"' . $row["Phone"] . '"' . ', "Address": ' . '"' . $row["Address"] . '"' . ', "Status": ' . '"' . $row["Status"] . '"' . '}');
                }
                echo json_encode($response);
            } 
            else {
                echo json_encode("0 results");
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