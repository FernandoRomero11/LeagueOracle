<?php
require 'LeagueOracle.php';
header('Access-Control-Allow-Origin: *');
$myApi = new LeagueOracle();
echo json_encode($myApi->getGamesData($_GET["summonerName"],$_GET["init"],$_GET["end"]));
