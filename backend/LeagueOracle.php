<?php
require_once __DIR__  . "/vendor/autoload.php";

use RiotAPI\LeagueAPI\LeagueAPI;
use RiotAPI\DataDragonAPI\DataDragonAPI;
use RiotAPI\Base\Definitions\Region;

const API = 'RGAPI-71fa0b3d-1a0a-4afb-9d98-4562faf5581a';

class LeagueOracle{
    public $api;

    public function __construct(){
        $this->api = new LeagueAPI([
            LeagueAPI::SET_KEY    => API,
            LeagueAPI::SET_REGION => Region::EUROPE_WEST,
        ]);
        DataDragonAPI::initByCdn();

    }

    public function getAllItems(){
        $items = [];
        $staticItems = $this->api->getStaticItems();
        foreach ($staticItems AS $staticItem){
            $item["id"] = $staticItem->id;
            $item["name"] = $staticItem->name;
            $item["requiredAlly"] = "";
            if(property_exists($staticItem,"requiredAlly") && $staticItem->requiredAlly === "Ornn"){
                $item["requiredAlly"] = $staticItem->requiredAlly;
            }
            $item["htmltag"] = DataDragonAPI::getItemIcon($staticItem->id);
            $items[] = $item;
        }
        return $items;
    }

    public function getItemInfo($id){
        $staticItems = $this->api->getStaticItems();
        $item["id"] = $staticItems->data[$id]->id;
        $item["name"] = $staticItems->data[$id]->name;
        $item["description"] = $staticItems->data[$id]->description;
        $item["gold"] = $staticItems->data[$id]->gold->getData();
        $item["stats"] = $staticItems->data[$id]->stats->getData();
        $item["htmltag"] = DataDragonAPI::getItemIcon($staticItems->data[$id]->id);
        $item["requiredAlly"] = "";
        if(property_exists($staticItems->data[$id],"requiredAlly") && $staticItems->data[$id]->requiredAlly === "Ornn"){
            $item["requiredAlly"] = $staticItems->data[$id]->requiredAlly;
        }
        $item["from"] = [];
        $item["into"] = [];
        if($staticItems->data[$id]->from){
            foreach($staticItems->data[$id]->from AS $childItem){
                $item["from"][$childItem]["icon"] = DataDragonAPI::getItemIcon($staticItems->data[$childItem]->id);
            }
        }
        if($staticItems->data[$id]->into) {
            foreach ($staticItems->data[$id]->into as $parentItem) {
                $item["into"][$parentItem]["icon"] = DataDragonAPI::getItemIcon($staticItems->data[$parentItem]->id);
            }
        }
        return $item;
    }

    public function getAllChampions(){
        $champions = [];
        $staticChampions = $this->api->getStaticChampions();
        foreach ($staticChampions AS $staticChampion){
            $champion["id"] = $staticChampion->id;
            $champion["name"] = $staticChampion->name;
            $champion["title"] = $staticChampion->title;
            $champion["htmltag"] = DataDragonAPI::getChampionIcon($staticChampion->id);
            $champions[] = $champion;
        }
        return $champions;
    }

    public function getChampionInfo($id){
        $dragonChampion = DataDragonAPI::getStaticChampionById($id);
        $apiChampion = $this->api->getStaticChampion($dragonChampion["key"],true);
        $champion["id"] = $apiChampion->key;
        $champion["name"] = $dragonChampion["name"];
        $champion["title"] = $dragonChampion["title"];
        $champion["lore"] = $dragonChampion["blurb"];
        $champion["info"] = $dragonChampion["info"];
        $champion["tags"] = $dragonChampion["tags"];
        $champion["stats"] = $dragonChampion["stats"];
        $champion["icontag"] = DataDragonAPI::getChampionIcon($id);
        $champion["splashtag"] = DataDragonAPI::getChampionSplash($id);
        $champion["splash2tag"] = DataDragonAPI::getChampionSplash($id,1);
        $champion["spells"]["passive"]["name"] = $apiChampion->passive->name;
        $champion["spells"]["passive"]["description"] = $apiChampion->passive->description;
        $champion["spells"]["passive"]["icon"] = DataDragonAPI::getChampionPassiveIconO($apiChampion);
        foreach($apiChampion->spells AS $spell){
            $champion["spells"][$spell->id]["name"] = $spell->name;
            $champion["spells"][$spell->id]["description"] = $spell->description;
            $champion["spells"][$spell->id]["icon"] = DataDragonAPI::getChampionSpellIconO($spell);
        }
        return $champion;
    }

    private function getChampionNameById($id){
        return $this->api->getStaticChampion($id)->id;
    }

    private function getSpellNameById($id){
        return $this->api->getStaticSummonerSpell($id);
    }

    public function getGamesData($name,$init,$end){
        $accountId = $this->getSummonerId($name);
        $matchs = $this->getMatchList($accountId,$init,$end);
        $runes = $this->api->getStaticReforgedRunes()->runes;
        $paths = $this->api->getStaticReforgedRunePaths()->paths;
        $matchsResult = [];
        foreach($matchs AS $match){
            $myMatch = $this->api->getMatch($match->gameId);
            $matchData["data"] = $this->setMatchData($myMatch);
            $myParticipantId = 0;
            $teams = [];
            foreach($myMatch->participantIdentities AS $participant){
                $id = "p".$participant->participantId;
                $team = ($participant->participantId <= 5)?"t100":"t200";
                if($participant->player->accountId === $accountId){
                    $myParticipantId = $participant->participantId;
                }
                $teams[$team][$id]["identity"] = $participant->getData();
            }
            foreach($myMatch->participants AS $participant){
                $championName = $this->getChampionNameById($participant->championId);
                $spell1 = $this->getSpellNameById($participant->spell1Id);
                $spell2 = $this->getSpellNameById($participant->spell2Id);
                $rune = DataDragonAPI::getReforgedRuneIconO($runes[$participant->stats->perk0]);
                $path = DataDragonAPI::getReforgedRunePathIconO($paths[$participant->stats->perkSubStyle]);
                $team = "t".$participant->teamId;
                $id = "p".$participant->participantId;

                $teams[$team][$id]["identity"]["champId"] = $championName;
                $teams[$team][$id]["identity"]["champIcon"] = DataDragonAPI::getChampionIcon($championName);
                $teams[$team][$id]["identity"]["spell1Icon"] = DataDragonAPI::getSummonerSpellIconO($spell1);
                $teams[$team][$id]["identity"]["spell2Icon"] = DataDragonAPI::getSummonerSpellIconO($spell2);
                $teams[$team][$id]["identity"]["rune1Icon"] = $rune;
                $teams[$team][$id]["identity"]["rune2Icon"] = $path;
                $teams[$team][$id]["data"] = $participant->getData();
                unset($teams[$team][$id]["data"]["timeline"], $teams[$team][$id]["data"]["stats"]);
                $teams[$team][$id]["data"]["stats"] = $this->getParticipantStats($participant);
                $matchData["data"][$team]["kills"] += $participant->stats->kills;
            }
            $matchData["teams"] = $teams;
            $matchData["participantId"] = $myParticipantId;
            $matchsResult[] = $matchData;
        }
        return $matchsResult;
    }

    private function getSummonerId($name){
        return $this->api->getSummonerByName($name)->accountId;
    }

    private function getMatchList($accountId, $init = 0, $end = 3){
        return $this->api->getMatchlistByAccount($accountId,null,null,null,null,null,$init,$end);
    }

    private function setMatchData($match){
        $matchData = [];

        $matchData["type"] = $match->gameMode;
        $matchData["duration"] = $match->gameDuration;
        $matchData["date"] = $match->gameCreation;
        $matchData["t100"]["kills"] = 0;
        $matchData["t200"]["kills"] = 0;

        return $matchData;
    }

    private function getParticipantStats($participant){
        $stats = [];

        $stats["champLevel"] = $participant->stats->champLevel;
        $stats["kills"] = $participant->stats->kills;
        $stats["assists"] = $participant->stats->assists;
        $stats["deaths"] = $participant->stats->deaths;
        $stats["damage"] = $participant->stats->totalDamageDealtToChampions;
        $stats["towerdamage"] =$participant->stats->damageDealtToTurrets;
        $stats["goldEarned"] = $participant->stats->goldEarned;
        $stats["visionScore"] = $participant->stats->visionScore;
        $stats["minionsKilled"] = $participant->stats->totalMinionsKilled;
        $stats["result"] = $participant->stats->win;
        $stats["item0tag"] = $this->getItemIcon($participant->stats->item0);
        $stats["item1tag"] = $this->getItemIcon($participant->stats->item1);
        $stats["item2tag"] = $this->getItemIcon($participant->stats->item2);
        $stats["item3tag"] = $this->getItemIcon($participant->stats->item3);
        $stats["item4tag"] = $this->getItemIcon($participant->stats->item4);
        $stats["item5tag"] = $this->getItemIcon($participant->stats->item5);
        $stats["item6tag"] = $this->getItemIcon($participant->stats->item6);
        $stats["item0"] = $participant->stats->item1;
        $stats["item1"] = $participant->stats->item1;
        $stats["item2"] = $participant->stats->item2;
        $stats["item3"] = $participant->stats->item3;
        $stats["item4"] = $participant->stats->item4;
        $stats["item5"] = $participant->stats->item5;
        $stats["item6"] = $participant->stats->item6;

        return $stats;
    }

    public function getItemIcon($id){
        if($id != 0){
            return DataDragonAPI::getItemIcon($id);
        }
        $item = DataDragonAPI::getItemIcon($id);
        $item->attrs["src"] = "";
        $item->attrs["alt"] = "";
        $item->attrs["class"] = "";
        return $item;
    }



}