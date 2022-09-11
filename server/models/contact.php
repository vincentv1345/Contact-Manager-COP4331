<?php
    function getContactModel( $userID, $contactID, $FirstName, $LastName, $Email, $Phone, $Address, $Status, $DateCreated){
        return array(
            "userID" => $userID,
            "contactID" => $contactID,
            "FirstName" => $FirstName,
            "LastName" => $LastName ,
            "Email" => $Email ,
            "Phone" => $Phone ,
            "Address" => $Address ,
            "Status" => $Status,
            "DateCreated" => $DateCreated
        );
    }

?>