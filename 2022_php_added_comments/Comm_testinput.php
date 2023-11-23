<?php
//This may be a function to just format the data given in a specific way
//This may be a part of security such as injections
//This tests a given input which removes any possibility of injection when given back
function test_input($data){
    //trims any spaces from data
    $data = trim($data);
    //strips any slashes from data
    $data = stripslashes($data);
    //removes any html special characters from data
    $data = htmlspecialchars($data);
    //return the data back
    return $data;
}
?>