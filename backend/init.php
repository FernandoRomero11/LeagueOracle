<?php
require_once __DIR__  . "/vendor/autoload.php";

use RiotAPI\LeagueAPI\LeagueAPI;
use RiotAPI\DataDragonAPI\DataDragonAPI;
use RiotAPI\Base\Definitions\Region;

DataDragonAPI::initByCdn();

//  Initialize the library
$api = new LeagueAPI([
    //  Your API key, you can get one at https://developer.riotgames.com/
    LeagueAPI::SET_KEY    => 'RGAPI-615bef3c-26dd-4c0a-bd0b-fa35919749df',
    //  Target region (you can change it during lifetime of the library instance)
    LeagueAPI::SET_REGION => Region::EUROPE_WEST,
]);

//  And now you are ready to rock
    $summoner = $api->getSummonerByName("Gonziz");

echo $summoner->id."<br>";             //  KnNZNuEVZ5rZry3I...
echo $summoner->puuid."<br>";          //  rNmb6Rq8CQUqOHzM...
echo $summoner->name."<br>";           //  I am TheKronnY
echo $summoner->summonerLevel."<br>";  //  69

$matchlist = $api->getMatchlistByAccount($summoner->accountId);

$i = 0;
foreach ($matchlist AS $match){
    if($i == 1 ){
        break;
    }
    echo($match->gameId."<br>");
    echo($match->role."<br>");
    echo($match->lane."<br>");
    echo($match->champion."<br>");
    echo($match->gameId."<br>");

    $myMatch = $api->getMatch($match->gameId);
    print("<pre>".print_r($myMatch,true)."</pre>");
    $i++;
    $players = [];
    foreach($myMatch->participantIdentities AS $participant){
        $players[$participant->participantId]["participantsIdentitiesData"] = $participant->getData();
    }

    foreach($myMatch->participants AS $participant){
        $players[$participant->participantId]["participantsData"] = $participant->getData();
    }
    echo("Array players");
    echo("<pre>");
    var_dump($players);
    echo("</pre>");


}

/*
echo("<pre>");
    //echo(DataDragonAPI::getChampionIcon("Garen"));
    $champion = DataDragonAPI::getStaticChampionById('Malzahar');
    var_dump($champion);
echo("</pre>");
*/

//  And now you are ready to rock!



/*Player tiene que tener:
    - Nombre jugador.
    - ID cuenta.
    - ID Champion. (Para el icono).
    - ID Summoner Spells
    - ID Items.
    - Minions matados.
    - KDA.
*/

/*Match tiene que tener:
    Resultado de la partida.
    Duración.
*/

/*
 * La biblioteca de items necesitará un array de items:
 * $items
 *
 */