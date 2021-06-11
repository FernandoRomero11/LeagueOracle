<?php
require 'AuthCRUD.php';
$message = "Failed!";
if($_POST !== []){
    $userCRUD = new AuthCRUD();
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $userCRUD->registry($username,$email,$password);
    $message = "User created!";
}
echo json_encode($message);