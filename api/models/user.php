<?php
    function getUserModel( $userID, $FirstName, $LastName, $Login, $Password, $DateCreated, $DateLastLoggedIn){
        return array(
            "userID" => $userID,
            "FirstName" => $FirstName,
            "LastName" => $LastName ,
            "Login" => $Login ,
            "Password" => $Password ,
            "DateCreated" => $DateCreated,
            "DateLastLoggedIn" => $DateLastLoggedIn
        );
    }
?>