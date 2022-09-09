<?php
    //import models
    require_once "/var/www/html/models/contact.php";
    require_once "/var/www/html/models/user.php";

    function sendResponse($response, $result, $route){
        if (mysqli_num_rows($result) > 0) {

            while($row = mysqli_fetch_assoc($result)) {

                if($route === "Contacts"){
                    array_push($response, getContactModel($row["FirstName"], $row["LastName"], $row["Email"], $row["Phone"], $row["Address"], $row["Status"]));
                }
                else{
                    array_push($response, getUserModel($row["FirstName"], $row["LastName"], $row["Login"], $row["Password"]));
                }

            }
            echo json_encode($response);
        } 
        else {
            echo json_encode("0 results");
        }
    }

    function getAll(string $route, $body, string $query, $db) {

        //Validate id from request body
        if(isset($body->id) && is_numeric($body->id)){

            $DBquery = "Select * from ". $route . " where userID = " . $body->id . ";";
            $result = mysqli_query($db, $DBquery);
            $response = array();

            sendResponse($response, $result, $route);

        }

        else{
            header("HTTP/1.1 500 Server Error");
            echo "Invalid request body \n 'id' in body required and it has to be an integer";
        }
    }
    function getMany(string $route, string $id, $db) {

        if(!is_numeric($id)){
            header("HTTP/1.1 500 Server Error");
            echo "Invalid request body \n 'id' in body required and it has to be an integer";
        }
        $DBquery = "Select * from ". $route . " where userID = " . $id . ";";
        $result = mysqli_query($db, $DBquery);
        $response = array();

        sendResponse($response, $result, $route);

    }
    function create(string $route, string $id, string $body, $db){
        if(!is_numeric($id)){
            header("HTTP/1.1 500 Server Error");
            echo "Invalid request body \n 'id' in body required and it has to be an integer";
        }

        if($route === "users" ){
            if (isset($body["FirstName"]) && isset($body["LastName"]) && isset($body["Login"]) && isset($body["Password"])) {
                $DBquery = "insert into Users (FirstName,LastName,Login,Password) VALUES ('".$body["FirstName"] ."','". $body["LastName"] . "','" . $body["Login"] . "','" . $body["Password"] . "');";
                $result = mysqli_query($db, $DBquery);
                $response = array();

                sendResponse($response, $result, $route);
            }
            else{
                header("HTTP/1.1 500 Server Error");
                echo "Invalid request body \n";
            }
        }

        else{

        }
    }
    function delete(string $route, string $id, $db){

    }
    function update(string $route, string $id, string $body, $db){
        
    }

?>