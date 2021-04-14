<?php
require 'myapi.php';
header('Access-Control-Allow-Origin: *');
$myApi = new MyApi();
echo json_encode($myApi->getItemInfo($_GET["itemId"]));
