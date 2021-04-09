<?php
require_once __DIR__  . "/vendor/autoload.php";

use RiotAPI\LeagueAPI\LeagueAPI;
use RiotAPI\DataDragonAPI\DataDragonAPI;
use RiotAPI\Base\Definitions\Region;

class MyApi{
    public $api;

    function __construct(){
        $this->api = new LeagueAPI([
            LeagueAPI::SET_KEY    => 'RGAPI-bfda020c-8f1f-40ab-964d-f79026447da4',
            LeagueAPI::SET_REGION => Region::EUROPE_WEST,
        ]);
        DataDragonAPI::initByCdn();
    }

    function getSummonerId($name){
        return $this->api->getSummonerByName($name)->accountId;
    }

    function getMatchList($accountId){
        return $this->api->getMatchlistByAccount($accountId);
    }

    function getAllItems(){
        $items = [];
        $staticItems = $this->api->getStaticItems();
        foreach ($staticItems AS $staticItem){
            $item["name"] = $staticItem->name;
            $item["htmltag"] = DataDragonAPI::getItemIcon($staticItem->id);
            $items = array_push($item);
        }
        return $items;
    }

    function getAllChampions(){
        $champions = [];
        $staticChampions = $this->api->getStaticChampions();
        foreach ($staticChampions AS $staticChampion){
            $champion["name"] = $staticChampion->name;
            $champion["htmltag"] = DataDragonAPI::getChampionIcon($staticChampion->id);
            $champions = array_push($champion);
        }
        return $champions;
    }

    function getGamesData($name){
        $accountId = $this->getSummonerId($name);
        $matchs = $this->getMatchList($accountId);
        $matchsResult = [];
        $i = 0;
        foreach($matchs AS $match){
            if($i == 1){
                break;
            }
            $match = $this->api->getMatch($match->gameId);
            echo("<pre>");
            var_dump($match);
            echo("</pre>");

            $i++;
        }

        $team1 = [];
        $team2 = [];


        $match["teams"] = [$team1,$team2];
    }
}