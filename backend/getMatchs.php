<?php
require 'myapi.php';
header('Access-Control-Allow-Origin: *');
$myApi = new MyApi();
echo json_encode($myApi->getGamesData($_GET["summonerName"],$_GET["init"],$_GET["end"]));
