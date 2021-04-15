<?php
require_once __DIR__  . "/vendor/autoload.php";

use RiotAPI\LeagueAPI\LeagueAPI;
use RiotAPI\DataDragonAPI\DataDragonAPI;
use RiotAPI\Base\Definitions\Region;

const API = 'RGAPI-b1949226-ff5d-4769-99ee-2dad5258c29c';

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

    function getChampionNameById($id){
        $staticChampion = $this->api->getStaticChampion($id);
        return $staticChampion->id;
    }

    function getGamesData($name){
        $accountId = $this->getSummonerId($name);
        $matchs = $this->getMatchList($accountId);
        $matchsResult = [];
        $i = 0;
        foreach($matchs AS $match){
            if($i == 2){
                break;
            }
            $myMatch = $this->api->getMatch($match->gameId);
            $matchData["type"] = $myMatch->gameMode;
            $matchData["duration"] = $myMatch->gameDuration;
            $matchData[100]["kills"] = 0;
            $matchData[200]["kills"] = 0;
            $teams = [];
            foreach($myMatch->participantIdentities AS $participant){
                $id = $participant->participantId;
                $team = ($id <= 5)?100:200;
                $teams[$team][$id]["identity"] = $participant->getData();
            }
            foreach($myMatch->participants AS $participant){
                $team = $participant->teamId;
                $id = $participant->participantId;
                $championName = $this->getChampionNameById($participant->championId);
                $teams[$team][$id]["identity"]["champIcon"] = DataDragonAPI::getChampionIcon($championName);
                $teams[$team][$id]["data"] = $participant->getData();

                unset($teams[$team][$id]["data"]["stats"]);
                unset($teams[$team][$id]["data"]["timeline"]);

                $teams[$team][$id]["data"]["stats"]["champLevel"] = $participant->stats->champLevel;
                $teams[$team][$id]["data"]["stats"]["kills"] = $participant->stats->kills;
                $teams[$team][$id]["data"]["stats"]["assists"] = $participant->stats->assists;
                $teams[$team][$id]["data"]["stats"]["deaths"] = $participant->stats->deaths;
                $teams[$team][$id]["data"]["stats"]["damage"] = $participant->stats->totalDamageDealtToChampions;
                $teams[$team][$id]["data"]["stats"]["goldEarned"] = $participant->stats->goldEarned;
                $teams[$team][$id]["data"]["stats"]["visionScore"] = $participant->stats->visionScore;
                $teams[$team][$id]["data"]["stats"]["item0"] = $participant->stats->item0;
                $teams[$team][$id]["data"]["stats"]["item1"] = $participant->stats->item1;
                $teams[$team][$id]["data"]["stats"]["item2"] = $participant->stats->item2;
                $teams[$team][$id]["data"]["stats"]["item3"] = $participant->stats->item3;
                $teams[$team][$id]["data"]["stats"]["item4"] = $participant->stats->item4;
                $teams[$team][$id]["data"]["stats"]["item5"] = $participant->stats->item5;
                $teams[$team][$id]["data"]["stats"]["item6"] = $participant->stats->item6;

                $matchData[$team]["kills"] += $participant->stats->kills;

            }
            $matchData["teams"] = $teams;
            array_push($matchsResult,$matchData);
            $i++;
        }
        return $matchsResult;

    }
}