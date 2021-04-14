<?php
require 'myapi.php';
header('Access-Control-Allow-Origin: *');
$myApi = new MyApi();
echo json_encode($myApi->getChampionInfo($_GET["championId"]));
