<?php

// Database connection
try{
    $conn=mysqli_connect("localhost","root","","inquirefy");
    if(!$conn){
        die( "Connection failed: " . mysqli_connect_error());
    }
    return $conn;
}catch (Exception $e){
    echo $e;
}

?>