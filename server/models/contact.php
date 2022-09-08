<?php
    function getContactModel( $FirstName, $LastName, $Email, $Phone, $Address, $Status){
        return (
            '{"FirstName": ' . '"' . $FirstName . '"' . ', "LastName": ' . '"' . $LastName . '"' . ',"Email": ' . '"' . $Email . '"' . ', "Phone": ' . '"' . $Phone . '"' . ', "Address": ' . '"' . $Address . '"' . ', "Status": ' . '"' . $Status . '"' . '}'
        );
    }

?>