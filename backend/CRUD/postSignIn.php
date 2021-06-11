<?php
require 'AuthCRUD.php';
$_POST = json_decode(file_get_contents("php://input"), true);
$authCRUD = new AuthCRUD();
$email = $_POST["email"];
$password = $_POST["password"];
echo $authCRUD->login($email,$password);
