<?php
require 'myapi.php';
header('Access-Control-Allow-Origin: *');
$myApi = new MyApi();
$myItems = $myApi->getAllItems();
echo json_encode($myApi->getAllItems());
