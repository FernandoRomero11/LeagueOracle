<?php
require 'LeagueOracle.php';
header('Access-Control-Allow-Origin: *');
$myApi = new LeagueOracle();
echo json_encode($myApi->getChampionInfo($_GET["championId"]));
