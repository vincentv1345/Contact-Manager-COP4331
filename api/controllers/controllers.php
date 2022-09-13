<?php
    //import models
    require_once "/var/www/html/models/contact.php";
    require_once "/var/www/html/models/user.php";

    function sendResponse($response, $result, $route){
        if (mysqli_num_rows($result) > 0) {

            while($row = mysqli_fetch_assoc($result)) {

                if($route === "Contacts"){
                    array_push($response, getContactModel($row["userID"], $row["contactID"], $row["FirstName"], $row["LastName"], $row["Email"], $row["Phone"], $row["Address"], $row["Status"], $row["DateCreated"]));
                }
                else{
                    array_push($response, getUserModel($row["userID"], $row["FirstName"], $row["LastName"], $row["Login"], $row["Password"], $row["DateCreated"], $row["DateLastLoggedIn"]));
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
        if(validate($body->id, "num")){

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
    function getOne(string $route, string $id, $body, $db) {

        if(validate($id, "num")){
            
            $DBquery = "";

            if ($route === 'Contacts'){
                if(validate($body->id, "num")){
                    $DBquery = "select * from ". $route . " where userID = " . $body->id . " and contactID = ". $id . ";";
                }
                else{
                    header("HTTP/1.1 500 Server Error");
                    echo "Invalid request body \n 'id' in body required and it has to be an integer";
                    return;
                }
            }
            else{
                if(validate($body->Email, "str") && validate($body->Password, "str")){
                    $DBquery = "select * from ". $route . " where Login = " . $body->Email . " and Password = " . $body->Password . ";";
                }
            }

            $result = mysqli_query($db, $DBquery);
            $response = array();

            sendResponse($response, $result, $route);
        }

        else{
            header("HTTP/1.1 500 Server Error");
            echo "Invalid request \n 'id' in URL required and it has to be an integer";
        }

    }
    function create(string $route, string $id, $body, $db){

        if(validate($id, "num")){
            $DBquery = "";

            if($route === "Users" ){

                if (validate($body->FirstName, "str") && validate($body->LastName, "str") && validate($body->Login, "str") && validate($body->Password, "str")) {
                    
                    $DBquery = "insert into Users (FirstName,LastName,Login,Password) VALUES ('".$body->FirstName ."','". $body->LastName . "','" . $body->Login . "','" . $body->Password . "');";              
                }
                else{
                    header("HTTP/1.1 500 Server Error");
                    echo "Invalid request body \n";
                }
            }
            else{

                if (validate($id, "num") && validate($body->FirstName, "str") && validate($body->LastName, "str") && validate($body->Email, "str") && validate($body->Phone, "str") && validate($body->Address, "str") && validate($body->Status, "str")) {
                    
                    $DBquery = "insert into Contacts (userId, FirstName, LastName, Email, Phone, Address, Status)
                    VALUES ('".$id ."', '".$body->FirstName."', '".$body->LastName."', '".$body->Email."', '".$body->Phone."', '".$body->Address."', '".$body->Status."');";        
                }
            }
            mysqli_query($db, $DBquery);
            $result = (mysqli_affected_rows($db) == 1) ? $route . " created successfully" : "Error creating " . $route;
            echo json_encode($result);

        }

        else{
            header("HTTP/1.1 500 Server Error");
            echo "Invalid request body \n 'id' in body required and it has to be an integer";
        }
    }
    function delete(string $route, string $id, $body, $db){

        if(validate($id, "num")){

            $table = ($route === 'Contacts') ? "Contacts" : "Users";
            $tableID = ($route === 'Contacts') ? "contactID" : "userID";

            $DBquery = "Delete from " . $table . " where " . $tableID . " = " . $id . ";";
            mysqli_query($db, $DBquery);
            $result = (mysqli_affected_rows($db) == 1) ? $route . " deleted successfully" : "Error deleting " . $route;

            echo json_encode($result);

        }
        else{
            header("HTTP/1.1 500 Server Error");
            echo "Invalid request body \n 'id' in body required and it has to be an integer";
        }
    }
    function update(string $route, string $id, string $body, $db){
    //     if(isset($id) && is_numeric($id)){
    //         if (isset($body["FirstName"]) && $body["LastName"] && $body["Login"] && $body["Password"]) {
                
    //             //$DBquery = "Update Contacts Set Status='Is Totally Batman' and  where ContactID "=";

    //             $result = mysqli_query($db, $DBquery);
    //             $response() = array();
    //             sendResponse($response, $result, $route);
    //         }
    //     }
    }

    function validate($value, $type){
        if ($type === "num") return ( isset($value) && is_numeric($value) );

        return isset($value) && $value !== "";
    }

?>