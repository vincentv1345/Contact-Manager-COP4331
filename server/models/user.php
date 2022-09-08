<?php
    function getUserModel( $FirstName, $LastName, $Login, $Password){
        return array(
            "FirstName" => $FirstName,
            "LastName" => $LastName ,
            "Email" => $Login ,
            "Phone" => $Password ,
        );
    }
?>