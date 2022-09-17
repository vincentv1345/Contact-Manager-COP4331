<?php
    //import models
    require_once "/var/www/html/api/models/contact.php";
    require_once "/var/www/html/api/models/user.php";

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
            echo json_encode(array());
        }
    }

    function getAll(string $route, $query, $db) {

        //Validate id from request body
        if(validate($query["id"], "num") && validate($query["page"], "num")){

            if($query["page"] < 1){
                header("HTTP/1.1 500 Server Error");
                echo "Invalid request uri \n ''page' in uri cannot be less then 1";
                return;
            }

            $skip = 10;
            $start = (intval($query["page"]) === 1 ) ? 0 : (intval($query["page"]) - 1) * $skip;
            $stop = ($start === 0) ? $skip : $start + $skip;

            $DBquery = "Select * from ". $route . " where userID = " . $query['id'] . " limit " . $start . "," . $stop .";";
            $result = mysqli_query($db, $DBquery);
            $response = array();

            sendResponse($response, $result, $route);

        }

        else{
            header("HTTP/1.1 500 Server Error");
            echo "Invalid request uri \n 'id' and 'page' in uri required and they have to be integers";
        }
    }
    function getOne(string $route, string $id, $query, $db) {
            
            $DBquery = "";

            if ($route === 'Contacts'){
                if(validate($id, "num")){
                    if(validate($query["id"], "num")){
                        $DBquery = "select * from ". $route . " where userID = " . $query["id"] . " and contactID = ". $id . ";";
                    }
                    else{
                        header("HTTP/1.1 500 Server Error");
                        echo "Invalid request uri \n 'id' in queries required and it has to be an integer";
                        return;
                    }
                }
                else{
                    header("HTTP/1.1 500 Server Error");
                    echo "Invalid request \n 'id' in queries required and it has to be an integer";
                    return;
                }

            }
            else{
                if(validate($query['Login'], "str") && validate($query['Password'], "str")){
                    $DBquery = "select * from ". $route . " where Login = '" . $query['Login'] . "' and Password = '" . $query['Password'] . "';";
                }
                else{
                    header("HTTP/1.1 500 Server Error");
                    echo "Invalid request uri \n 'Login' and 'Password' in queries required";
                    return;
                }
            }

            $result = mysqli_query($db, $DBquery);
            $response = array();

            sendResponse($response, $result, $route);
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
                    return;
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
    function update(string $route, $id, $body, $db){
            
        if(validate($id, "num")){

            $DBquery = "Update Contacts Set" ;
            $body = get_object_vars($body);
            $keys = array_keys($body);

            if(count($keys) === 0){
                echo "empty body";
                return;
            }
            
            for($i = 0; $i < count($keys); $i++){
                if($i === count($keys) - 1) {
                    $DBquery = $DBquery . " " . $keys[$i] . " = '" . $body[$keys[$i]] . "'";
                }
                else{
                    $DBquery = $DBquery . " " . $keys[$i] . " = '" . $body[$keys[$i]] . "', ";
                }
                
            }
            $DBquery = $DBquery . " where contactID = " .$id .";"; 
            mysqli_query($db, $DBquery);
            $result = (mysqli_affected_rows($db) == 1) ? $route . " updated successfully" : "Error updating " . $route;
            echo json_encode($result);

        }
        else{
            header("HTTP/1.1 500 Server Error");
            echo "Invalid request uri \n 'id' in uri required and it has to be an integer";
        }
    }

    function validate($value, $type){
        if ($type === "num") return ( isset($value) && is_numeric($value) );

        return isset($value) && $value !== "";
    }

?>