<?php

/**
 * Copyright (C) 2016-2020  Daniel Dolejška
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace RiotAPI\LeagueAPI\Objects;


/**
 *   Class Participant
 *
 * Used in:
 *   spectator (v4)
 *     @link https://developer.riotgames.com/apis#spectator-v4/GET_getFeaturedGames
 *
 * @linkable getStaticChampion($championId)
 *
 * @package RiotAPI\LeagueAPI\Objects
 */
class Participant extends ApiObjectLinkable
{
	/**
	 *   Flag indicating whether or not this participant is a bot.
	 *
	 * @var bool $bot
	 */
	public $bot;

	/**
	 *   The ID of the second summoner spell used by this participant.
	 *
	 * @var int $spell2Id
	 */
	public $spell2Id;

	/**
	 *   The ID of the profile icon used by this participant.
	 *
	 * @var int $profileIconId
	 */
	public $profileIconId;

	/**
	 *   The summoner name of this participant.
	 *
	 * @var string $summonerName
	 */
	public $summonerName;

	/**
	 *   The ID of the champion played by this participant.
	 *
	 * @var int $championId
	 */
	public $championId;

	/**
	 *   The team ID of this participant, indicating the participant's team.
	 *
	 * @var int $teamId
	 */
	public $teamId;

	/**
	 *   The ID of the first summoner spell used by this participant.
	 *
	 * @var int $spell1Id
	 */
	public $spell1Id;
}
