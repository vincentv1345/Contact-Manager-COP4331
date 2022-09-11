<?php
    function getUserModel( $userID, $FirstName, $LastName, $Login, $Password, $DateCreated, $DateLastLoggedIn){
        return array(
            "userID" => $userID,
            "FirstName" => $FirstName,
            "LastName" => $LastName ,
            "Email" => $Login ,
            "Phone" => $Password ,
            "DateCreated" => $DateCreated,
            "DateLastLoggedIn" => $DateLastLoggedIn
        );
    }
?>