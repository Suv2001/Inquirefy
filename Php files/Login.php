<?php
//getting the connection
include "Connections.php";

//session start
session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $userName = filter_input(INPUT_POST, 'userName', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
     echo $userName, $password;
     $userData = fetchLoginDetails($userName, $password, $conn);
     echo "<pre>";
     print_r($userData);
     echo "</pre>";

     echo $userData['userName'];
     echo "<br>";
     echo $userData['password'];
    echo "<br>";
     if($userData == false){
         echo "<script>alert('Invalid Credentials')</script>";
         session_abort();
     }else{
         $_SESSION['userName'] = $userData['userName'];
         echo "<script>alert('Succesfully logged in')</script>";
     }
}

function fetchLoginDetails($userName, $password, $conn){
    $stmt = $conn->prepare("SELECT * FROM users WHERE userName = ?");
    if (!$stmt) {
        die("SQL statement preparation failed: " . $conn->error);
    }
    $stmt->bind_param("s", $userName);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    if($row == null){
        return false;
    }
    return $row;
}
$name = $_SESSION['userName'];
echo $name .  " this is from session variable";
?>