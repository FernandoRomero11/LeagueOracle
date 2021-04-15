<?php
require 'myapi.php';
header('Access-Control-Allow-Origin: *');
$myApi = new MyApi();
echo("<pre>");
echo(\RiotAPI\DataDragonAPI\DataDragonAPI::getChampionIcon("Chogath"));
echo("</pre>");