<?php

/**
 *  2Moons
 *  Copyright (C) 2012 Jan Kröpke
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
 *
 * @package 2Moons
 * @author Jan Kröpke <info@2moons.cc>
 * @copyright 2012 Jan Kröpke <info@2moons.cc>
 * @license http://www.gnu.org/licenses/gpl.html GNU GPLv3 License
 * @version 1.7.3 (2013-05-19)
 * @info $Id: class.ShowSearchPage.php 2632 2013-03-18 19:05:14Z slaver7 $
 * @link http://2moons.cc/
 */

class ShowSearchPage extends AbstractPage
{
	public static $requireModule = MODULE_SEARCH;
	
	function __construct() {
		parent::__construct();
	}

	
	static function _getSearchList($seachMode, $searchText, $maxResult)
	{
		global $UNI, $LNG, $USER;
				
		$Limit		= $maxResult === -1 ? "" : "LIMIT ".$maxResult;
		
		$searchList	= array();

		switch($seachMode) {
			case 'playername':
				$searchResult = $GLOBALS['DATABASE']->query("SELECT 
				a.id, a.username, a.planet_cloak, a.avatar, a.ally_id, a.galaxy, a.system, a.planet, b.name, c.total_rank, c.total_points, d.ally_name, d.ally_tag
				FROM ".USERS." as a 
				INNER JOIN ".PLANETS." as b ON b.id = a.id_planet 
				LEFT JOIN ".STATPOINTS." as c ON c.id_owner = a.id AND c.stat_type = 1
				LEFT JOIN ".ALLIANCE." as d ON d.id = a.ally_id
				WHERE a.universe = ".$UNI." AND a.username LIKE '%".$GLOBALS['DATABASE']->sql_escape($searchText, true)."%'
				ORDER BY (
				  IF(a.username = '".$GLOBALS['DATABASE']->sql_escape($searchText, true)."', 1, 0)
				  + IF(a.username LIKE '".$GLOBALS['DATABASE']->sql_escape($searchText, true)."%', 1, 0)
				) DESC, a.username ASC ".$Limit.";");
				
				while($searchRow = $GLOBALS['DATABASE']->fetch_array($searchResult))
				{
					$searchList[]	= array(
						'planetname'	=> $searchRow['name'],
						'username' 		=> $searchRow['username'],
						'userid' 		=> $searchRow['id'],
						'allyname'	 	=> $searchRow['ally_name'],
						'allytag'	 	=> $searchRow['ally_tag'],
						'total_points'	 	=> pretty_number($searchRow['total_points']),
						'allyid'		=> $searchRow['ally_id'],
						'galaxy' 		=> $searchRow['galaxy'],
						'system'		=> $searchRow['system'],
						'showdiapla'	=> sprintf($LNG['NOUVEAUTE_11'], $searchRow['system']),
						'planet'		=> $searchRow['planet'],
						'rank'			=> $searchRow['total_rank'],
						'planetcloak'	=> $searchRow['planet_cloak'],
						'avatar'	=> $searchRow['avatar'],
						'timer'			=> TIMESTAMP,
					);	
				}
				
				$LOG = new Logcheck(14);
				$LOG->username = $USER['username'];
				$LOG->pageLog  = "page=search";
				$LOG->info     = "The player searched for the player name: ".$GLOBALS['DATABASE']->sql_escape($searchText).".";
				$LOG->save();
				
				$GLOBALS['DATABASE']->free_result($searchResult);
			break;
			case 'planetname':
				$searchResult = $GLOBALS['DATABASE']->query("SELECT 
				a.name, a.galaxy, b.planet_cloak, b.avatar, a.planet, a.system,
				b.id, b.ally_id, b.username, 
				c.total_rank, c.total_points,
				d.ally_tag, d.ally_name 
				FROM ".PLANETS." as a 
				INNER JOIN ".USERS." as b ON b.id = a.id_owner 
				LEFT JOIN  ".STATPOINTS." as c ON c.id_owner = b.id AND c.stat_type = 1
				LEFT JOIN ".ALLIANCE." as d ON d.id = b.ally_id
				WHERE a.universe = ".$UNI." AND a.name LIKE '%".$GLOBALS['DATABASE']->sql_escape($searchText, true)."%'
				ORDER BY (
				  IF(a.name = '".$GLOBALS['DATABASE']->sql_escape($searchText, true)."', 1, 0)
				  + IF(a.name LIKE '".$GLOBALS['DATABASE']->sql_escape($searchText, true)."%', 1, 0)
				) DESC, a.name ASC ".$Limit.";");
				
				while($searchRow = $GLOBALS['DATABASE']->fetch_array($searchResult))
				{
					$searchList[]	= array(
						'planetname'	=> $searchRow['name'],
						'allytag'	=> $searchRow['ally_tag'],
						'username' 		=> $searchRow['username'],
						'userid' 		=> $searchRow['id'],
						'allyname'	 	=> $searchRow['ally_name'],
						'allyid'		=> $searchRow['ally_id'],
						'galaxy' 		=> $searchRow['galaxy'],
						'showdiapla'	=> sprintf($LNG['NOUVEAUTE_11'], $searchRow['system']),
						'system'		=> $searchRow['system'],
						'planet'		=> $searchRow['planet'],
						'rank'			=> $searchRow['total_rank'],
						'total_points'			=> pretty_number($searchRow['total_points']),
						'avatar'	=> $searchRow['avatar'],
						'planetcloak'	=> $searchRow['planet_cloak'],
						'timer'			=> TIMESTAMP,
					);	
				}
				
				$LOG = new Logcheck(14);
				$LOG->username = $USER['username'];
				$LOG->pageLog  = "page=search";
				$LOG->info     = "The player searched for the planet name: ".$GLOBALS['DATABASE']->sql_escape($searchText).".";
				$LOG->save();
				
				$GLOBALS['DATABASE']->free_result($searchResult);
			break;
			case "allytag":
				$searchResult = $GLOBALS['DATABASE']->query("SELECT 
				a.id, a.ally_request_notallow, a.ally_name, b.username, b.avatar, a.ally_tag, a.ally_owner, a.ally_members, 
				c.total_points, c.total_rank FROM ".ALLIANCE." as a 
				INNER JOIN ".USERS." as b ON b.id = a.ally_owner 
				LEFT JOIN ".STATPOINTS." as c ON c.stat_type = 1 AND c.id_ally = a.id 
				WHERE a.ally_universe = ".$UNI." AND a.ally_tag LIKE '%".$GLOBALS['DATABASE']->sql_escape($searchText, true)."%'
				ORDER BY (
				  IF(a.ally_tag = '".$GLOBALS['DATABASE']->sql_escape($searchText, true)."', 1, 0)
				  + IF(a.ally_tag LIKE '".$GLOBALS['DATABASE']->sql_escape($searchText, true)."%', 1, 0)
				) DESC, a.ally_tag ASC ".$Limit.";");
				
				while($searchRow = $GLOBALS['DATABASE']->fetch_array($searchResult))
				{
				
					$searchList[]	= array(
						'allypoints'	=> pretty_number($searchRow['total_points']),
						'allytag'		=> $searchRow['ally_tag'],
						'allymembers'	=> $searchRow['ally_members'],
						'allyname'		=> $searchRow['ally_name'],
						'allyowners'		=> $searchRow['ally_owner'],
						'allyowner'		=> $searchRow['username'],
						'allyid'		=> $searchRow['id'],
						'Myally'		=> $USER['ally_id'],
						'avatar'		=> $searchRow['avatar'],
						'total_rank'		=> $searchRow['total_rank'],
						'ally_request_notallow'		=> $searchRow['ally_request_notallow'],
					);
				}
				
				$LOG = new Logcheck(14);
				$LOG->username = $USER['username'];
				$LOG->pageLog  = "page=search";
				$LOG->info     = "The player searched for the alliance tag: ".$GLOBALS['DATABASE']->sql_escape($searchText).".";
				$LOG->save();
				 
				$GLOBALS['DATABASE']->free_result($searchResult);
			break;
			case "allyname":
				$searchResult = $GLOBALS['DATABASE']->query("SELECT 
				a.id, a.ally_name, a.ally_request_notallow, c.username, c.avatar, a.ally_tag, a.ally_owner, a.ally_members, 
				b.total_points, b.total_rank FROM ".ALLIANCE." as a
				INNER JOIN ".USERS." as c ON c.id = a.ally_owner 
				LEFT JOIN ".STATPOINTS." as b ON b.stat_type = 1 AND b.id_ally = a.id
				WHERE a.ally_universe = ".$UNI." AND a.ally_name LIKE '%".$GLOBALS['DATABASE']->sql_escape($searchText, true)."%'
				ORDER BY (
				  IF(a.ally_name = '".$GLOBALS['DATABASE']->sql_escape($searchText, true)."', 1, 0)
				  + IF(a.ally_name LIKE '".$GLOBALS['DATABASE']->sql_escape($searchText, true)."%', 1, 0)
				) DESC,a.ally_name ASC ".$Limit.";");
				
				while($searchRow = $GLOBALS['DATABASE']->fetch_array($searchResult))
				{
					$searchList[]	= array(
						'allypoints'	=> pretty_number($searchRow['total_points']),
						'allytag'		=> $searchRow['ally_tag'],
						'allymembers'	=> $searchRow['ally_members'],
						'allyname'		=> $searchRow['ally_name'],
						'allyowners'		=> $searchRow['ally_owner'],
						'allyowner'		=> $searchRow['username'],
						'allyid'		=> $searchRow['id'],
						'Myally'		=> $USER['ally_id'],
						'avatar'		=> $searchRow['avatar'],
						'total_rank'		=> $searchRow['total_rank'],
						'ally_request_notallow'		=> $searchRow['ally_request_notallow'],
					);
				}
				
				$LOG = new Logcheck(14);
				$LOG->username = $USER['username'];
				$LOG->pageLog  = "page=search";
				$LOG->info     = "The player searched for the alliance name: ".$GLOBALS['DATABASE']->sql_escape($searchText).".";
				$LOG->save();
				
				$GLOBALS['DATABASE']->free_result($searchResult);
			break;
		}
		
		return $searchList;
	}
	
	function autocomplete()
	{
		global $LNG;
		
		$this->setWindow('ajax');
		
		$seachMode 	= HTTP::_GP('type', 'playername');
		$searchText	= HTTP::_GP('term', '', UTF8_SUPPORT);
		
		$searchList	= array();
		
		$seachModes	= explode('|', $seachMode);
		
		if(empty($searchText)) {
			$this->sendJSON(array());
		}
		
		foreach($seachModes as $search)
		{
			$searchData	= self::_getSearchList($search, $searchText, 5);
			foreach($searchData as $data) {
				switch($search) {
					case 'playername':
						$searchList[]	= array('label' => str_replace($searchText, '<b>'.$searchText.'</b>', $data['username']), 'category' => $LNG['sh_player_name'], 'type' => 'playername');
					break;
					case 'planetname':
						$searchList[]	= array('label' => str_replace($searchText, '<b>'.$searchText.'</b>', $data['username']), 'category' => $LNG['sh_planet_name'], 'type' => 'planetname');
					break;
					case "allytag":
						$searchList[]	= array('label' => str_replace($searchText, '<b>'.$searchText.'</b>', $data['allytag']), 'category' => $LNG['sh_alliance_tag'], 'type' => 'allytag');
					break;
					case "allyname":
						$searchList[]	= array('label' => str_replace($searchText, '<b>'.$searchText.'</b>', $data['allyname']), 'category' => $LNG['sh_alliance_name'], 'type' => 'allyname');
					break;
				}
			}
		}
		
		$this->sendJSON($searchList);
	}
	
	function result()
	{
		global $THEME;
		
		$this->initTemplate();
		$this->setWindow('ajax');
		
		$seachMode 	= HTTP::_GP('type', 'playername');
		$searchText	= HTTP::_GP('search', '', UTF8_SUPPORT);
		
		$searchList	= array();
		
		if(!empty($searchText))
		{
			$searchList	= self::_getSearchList($seachMode, $searchText, SEARCH_LIMIT);
		}
		
		$this->tplObj->assign_vars(array(
			'searchList'	=> $searchList,
            'dpath'			=> $THEME->getTheme(),
		));
		
		$templateSuffix	= ($seachMode === "allyname" || $seachMode === "allytag") ? "ally" : "default";
		
		if($seachMode === "allyname"){
		$templateSuffix = "ally";
		}elseif($seachMode === "allytag"){
		$templateSuffix = "tag";
		}elseif($seachMode === "playername"){
		$templateSuffix = "default";
		}else{
		$templateSuffix = "planet";
		}
		
		$this->display('page.search.result.'.$templateSuffix.'.tpl');
	}
	
  
	
	function show()
	{
		global $LNG, $THEME;
		
		$seachMode 		= HTTP::_GP('type', 'playername');
		
		$modeSelector	= array('playername' => $LNG['sh_player_name'], 'planetname' => $LNG['sh_planet_name'], 'allyname' => $LNG['sh_alliance_name'], 'allytag' => $LNG['sh_alliance_tag']);
		$this->tplObj->assign_vars(array(
			'modeSelector'	=> $modeSelector,
			'seachMode'		=> $seachMode,
		));
		
		$this->display('page.search.default.tpl');
	}
}