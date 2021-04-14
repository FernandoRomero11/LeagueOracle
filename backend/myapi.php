<?php
require_once __DIR__  . "/vendor/autoload.php";

use RiotAPI\LeagueAPI\LeagueAPI;
use RiotAPI\DataDragonAPI\DataDragonAPI;
use RiotAPI\Base\Definitions\Region;

const API = 'RGAPI-80cb4783-5aa5-4bb1-9e3f-e61d7ca2827b';

class MyApi{
    public $api;

    function __construct(){
        $this->api = new LeagueAPI([
            LeagueAPI::SET_KEY    => API,
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
            $item["id"] = $staticItem->id;
            $item["name"] = $staticItem->name;
            $item["htmltag"] = DataDragonAPI::getItemIcon($staticItem->id);
            array_push($items,$item);
        }
        return $items;
    }

    function getItemInfo($id){
        $staticItems = $this->api->getStaticItems();
        $item["id"] = $staticItems->data[$id]->id;
        $item["name"] = $staticItems->data[$id]->name;
        $item["description"] = $staticItems->data[$id]->description;
        $item["gold"] = $staticItems->data[$id]->gold->getData();
        $item["stats"] = $staticItems->data[$id]->stats->getData();
        $item["htmltag"] = DataDragonAPI::getItemIcon($staticItems->data[$id]->id);
        $item["from"] = [];
        foreach($staticItems->data[$id]->from AS $childItem){
            $item["from"][$childItem] = DataDragonAPI::getItemIcon($staticItems->data[$childItem]->id);
        }
        return $item;
    }

    function getAllChampions(){
        $champions = [];
        $staticChampions = $this->api->getStaticChampions();
        foreach ($staticChampions AS $staticChampion){
            $champion["id"] = $staticChampion->id;
            $champion["name"] = $staticChampion->name;
            $champion["title"] = $staticChampion->title;
            $champion["htmltag"] = DataDragonAPI::getChampionIcon($staticChampion->id);
            array_push($champions,$champion);
        }
        return $champions;
    }

    function getChampionInfo($id){
        $staticChampion = DataDragonAPI::getStaticChampionById($id);
        $champion["name"] = $staticChampion["name"];
        $champion["title"] = $staticChampion["title"];
        $champion["lore"] = $staticChampion["blurb"];
        $champion["info"] = $staticChampion["info"];
        $champion["tags"] = $staticChampion["tags"];
        $champion["stats"] = $staticChampion["stats"];
        $champion["icontag"] = DataDragonAPI::getChampionIcon($id);
        $champion["splashtag"] = DataDragonAPI::getChampionSplash($id);
        return $champion;
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
            $myMatch = $this->api->getMatch($match->gameId);
            $players = [];
            foreach($myMatch->participantIdentities AS $participant){
                $players[$participant->participantId]["participantsIdentitiesData"] = $participant->getData();
            }
            foreach($myMatch->participants AS $participant){
                $players[$participant->participantId]["participantsData"] = $participant->getData();
            }
            array_push($matchsResult,$players);
            $i++;
        }

    }
}