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
 * @info $Id: class.MissionFunctions.php 2632 2013-03-18 19:05:14Z slaver7 $
 * @link http://2moons.cc/
 */

class MissionFunctions
{	
	public $kill	= 0;
	public $_fleet	= array();
	public $_upd	= array();
	
	
	function BCWrapperPreRev2321($CombatRaport)
	{
		
		if(isset($CombatRaport['simu']))
		{
			$CombatRaport['additionalInfo'] = $CombatRaport['simu'];
		}
			
		if (!empty($CombatRaport['steal']['metal']))
		{
			$CombatRaport['steal'] = array(
				901	=> $CombatRaport['steal']['metal'],
				902	=> $CombatRaport['steal']['crystal'],
				903	=> $CombatRaport['steal']['deuterium'],
				904	=> $CombatRaport['steal']['elyrium']
			);
		}
			
		return $CombatRaport;
	}

	function getUsername($ID) 
	{
		global $UNI;
		$username = '';
		$stats_sql	=	'SELECT username FROM '.USERS.' WHERE `universe` = '.$UNI.' AND `id` = '.$ID.';';
		$query = $GLOBALS['DATABASE']->query($stats_sql);
		while ($StatRow = $GLOBALS['DATABASE']->fetch_array($query))
		{
		  $username = $StatRow['username'];
		}
		return $username;
	}
	public function getPlanetName($ID) {
		global $UNI;
		$planetname = '';
		$stats_sql	=	'SELECT name FROM '.PLANETS.' WHERE `universe` = '.$UNI.' AND `id` = '.$ID.';';
		$query = $GLOBALS['DATABASE']->query($stats_sql);
		while ($StatRow = $GLOBALS['DATABASE']->fetch_array($query))
		{
		  $planetname = $StatRow['name'];
		}
		return $planetname;
	}
	
	public function getAllianceTag($allianceID)
	{
		global $UNI;
		$diploRow = '';
		$stats_sql	=	'SELECT ally_tag FROM '.ALLIANCE.' WHERE `id` = '.$allianceID.';';
		$query = $GLOBALS['DATABASE']->query($stats_sql);
		while ($StatRow = $GLOBALS['DATABASE']->fetch_array($query))
		{
		  $diploRow = $StatRow['ally_tag'];
		}
		return $diploRow;
	}
	
	function GenerateName() 
	{
		global $LNG, $PLANET;
		$Names		= file('botnames.txt');
		$NamesCount	= count($Names);
		$Rand		= mt_rand(0, $NamesCount);
		$UserName 	= trim($Names[$Rand]);
		return $UserName;
	}
	
	function UpdateFleet($Option, $Value)
	{
		$this->_fleet[$Option] = $Value;
		$this->_upd[$Option] = $Value;
	}

	function setState($Value)
	{
		$this->_fleet['fleet_mess'] = $Value;
		$this->_upd['fleet_mess']	= $Value;
		
		switch($Value)
		{
			case FLEET_OUTWARD:
				$this->eventTime = $this->_fleet['fleet_start_time'];
			break;
			case FLEET_RETURN:
				$this->eventTime = $this->_fleet['fleet_end_time'];
			break;
			case FLEET_HOLD:
				$this->eventTime = $this->_fleet['fleet_end_stay'];
			break;
		}
	}
	
	function SaveFleet()
	{
		if($this->kill == 1)
			return;
			
		$Qry	= array();
		
		foreach($this->_upd as $Opt => $Val)
		{
			$Qry[]	= "`".$Opt."` = '".$Val."'";
		}
		
		if(!empty($Qry)) {
			$GLOBALS['DATABASE']->multi_query("UPDATE ".FLEETS." SET ".implode(', ',$Qry)." WHERE `fleet_id` = ".$this->_fleet['fleet_id'].";UPDATE ".FLEETS_EVENT." SET time = ".$this->eventTime." WHERE `fleetID` = ".$this->_fleet['fleet_id'].";");
		}
	}
		
	function RestoreFleet($Start = true)
	{
		global $resource, $pricelist;

		$FleetRecord         = explode(';', $this->_fleet['fleet_array']);
		$FleetRecord2        = explode(';', $this->_fleet['specialized_array']);
		$QryUpdFleet         = '';
		$plaId				 = ($Start == true ? $this->_fleet['fleet_start_id'] : $this->_fleet['fleet_end_id']);
		$checkRound	= 0;
		foreach ($FleetRecord as $Item => $Group)
		{
			if (empty($Group)) continue;
			
			$QryUpdFleet2   = '';
			$Class			= explode(',', $Group);
			$getPlanet	 		 = $GLOBALS['DATABASE']->getFirstRow("SELECT specialships FROM ".PLANETS." WHERE id = ".$plaId.";");
			
			if(!isset($pricelist[$Class[0]])){
				if(!empty($getPlanet['specialships']))
				{
					$getPlanet	 	= $GLOBALS['DATABASE']->getFirstRow("SELECT specialships FROM ".PLANETS." WHERE id = ".$plaId.";");
					$OwnQueue		= explode(';', $getPlanet['specialships']);
					$buildArray		= array();
					foreach($OwnQueue as $OwnShip)
					{
						$temp = explode(',', $OwnShip);
						$buildArray[]	= array($temp[0], $temp[1]);
					}
					$insideId = 0;
					foreach($buildArray as $Item)
					{
						$Element   = $Item[0];
						$Count     = $Item[1];
						
						if($Class[0] == $Element){
							$QryUpdFleet2[]	= $Element.','.floattostring(($Count + $Class[1]));
							$insideId = 1;
						}else{
							$QryUpdFleet2[]	= $Element.','.floattostring($Count);
						}
					}
					if($insideId == 0)
						$QryUpdFleet2[]	= $Class[0].','.floattostring($Class[1]);
				}else{
					$QryUpdFleet2[]	= $Class[0].','.floattostring($Class[1]);
				}
				$SQL	= "UPDATE ".PLANETS." SET specialships = '".implode(";", $QryUpdFleet2)."' WHERE id = ".$plaId.";";
				$GLOBALS['DATABASE']->query($SQL);
			}elseif(isset($pricelist[$Class[0]])){
				$QryUpdFleet	.= "p.`".$resource[$Class[0]]."` = p.`".$resource[$Class[0]]."` + ".$Class[1].", ";
			}
		}
		
		foreach ($FleetRecord2 as $Item => $Group)
		{
			if (empty($Group)) continue;
			$Class			= explode(',', $Group);
			$QryUpdFleet	.= "p.`".$resource[$Class[0]]."` = p.`".$resource[$Class[0]]."` + ".$Class[1].", ";
		}

		$Qry   = "UPDATE ".PLANETS." as p, ".USERS." as u SET ";
		if (!empty($QryUpdFleet))
			$Qry  .= $QryUpdFleet;
		/* if (!empty($QryUpdFleet2))
			$Qry  .= "p.`specialships` = '".implode(";", $QryUpdFleet2)."', "; */

		$Qry  .= "p.`metal` = p.`metal` + ".$this->_fleet['fleet_resource_metal'].", ";
		$Qry  .= "p.`crystal` = p.`crystal` + ".$this->_fleet['fleet_resource_crystal'].", ";
		$Qry  .= "p.`deuterium` = p.`deuterium` + ".$this->_fleet['fleet_resource_deuterium'].", ";
		$Qry  .= "p.`elyrium` = p.`elyrium` + ".$this->_fleet['fleet_resource_elyrium'].", ";
		$Qry  .= "p.`civil` = p.`civil` + ".$this->_fleet['fleet_population_301'].", ";
		$Qry  .= "p.`technician` = p.`technician` + ".$this->_fleet['fleet_population_302'].", ";
		$Qry  .= "p.`scientist` = p.`scientist` + ".$this->_fleet['fleet_population_303'].", ";
		$Qry  .= "p.`archaeologist` = p.`archaeologist` + ".$this->_fleet['fleet_population_304'].", ";
		$Qry  .= "p.`diplomat` = p.`diplomat` + ".$this->_fleet['fleet_population_305'].", ";
		$Qry  .= "p.`soldier` = p.`soldier` + ".$this->_fleet['fleet_population_306'].", ";
		$Qry  .= "p.`adv_soldier` = p.`adv_soldier` + ".$this->_fleet['fleet_population_307'].", ";
		$Qry  .= "`pilot` = `pilot` + ".$this->_fleet['fleet_population_308'].", ";
		$Qry  .= "p.`antaris` = p.`antaris` + ".$this->_fleet['fleet_population_309'].", ";
		$Qry  .= "u.`darkmatter` = u.`darkmatter` + ".$this->_fleet['fleet_resource_darkmatter']." ";
		$Qry  .= "WHERE ";
		$Qry  .= "p.`id` = '".($Start == true ? $this->_fleet['fleet_start_id'] : $this->_fleet['fleet_end_id'])."' ";
		$Qry  .= "AND u.id = p.id_owner;";
		$GLOBALS['DATABASE']->multi_query($Qry);
		$this->KillFleet();
	}
	
	function TransportGoodsToPlanet($Start = false)
	{
		
		$technicien							= 0;
		$scientifique						= 0;
		$soldat								= 0;
		$pilote								= 0;
		$antaris							= 0;
		$FleetRecord        				= explode(';', $this->_fleet['fleet_array']);
		
		foreach ($FleetRecord as $Item => $Group)
		{
			if (empty($Group)) continue;
			
			$Class			= explode(',', $Group);
			$getUserShip   = $GLOBALS['DATABASE']->getFirstRow("SELECT id_infrastructure FROM ".VARS_USER." WHERE varId = ".$Class[0].";");
			$getUserPeople = $GLOBALS['DATABASE']->getFirstRow("SELECT soldier, technician, scientist, pilots FROM ".VARS_INFRA." WHERE id = ".$getUserShip['id_infrastructure'].";");
			
			$technicien				+= $getUserPeople['technician']*$Class[1];
			$scientifique			+= $getUserPeople['scientist']*$Class[1];
			$soldat					+= $getUserPeople['soldier']*$Class[1];
			$pilote					+= $getUserPeople['pilots']*$Class[1];
		}
		
		$FleetRecord2        = explode(';', $this->_fleet['specialized_array']);
		foreach ($FleetRecord2 as $Item => $Group)
		{
			if (empty($Group)) continue;
			$Class			= explode(',', $Group);
			$QryUpdFleet	.= "`".$resource[$Class[0]]."` = `".$resource[$Class[0]]."` + ".$Class[1].", ";
		}
		
		$Qry   = "UPDATE ".PLANETS." SET ";
		if (!empty($QryUpdFleet))
			$Qry  .= $QryUpdFleet;
		
		$Qry  .= "`metal` = `metal` + ".$this->_fleet['fleet_resource_metal'].", ";
		$Qry  .= "`crystal` = `crystal` + ".$this->_fleet['fleet_resource_crystal'].", ";
		$Qry  .= "`deuterium` = `deuterium` + ".$this->_fleet['fleet_resource_deuterium'].", ";
		$Qry  .= "`elyrium` = `elyrium` + ".$this->_fleet['fleet_resource_elyrium'].", ";
		$Qry  .= "`civil` = `civil` + ".$this->_fleet['fleet_population_301'].", ";
		$Qry  .= "`technician` = `technician` + ".($this->_fleet['fleet_population_302']-$technicien).", ";
		$Qry  .= "`scientist` = `scientist` + ".($this->_fleet['fleet_population_303']-$scientifique).", ";
		$Qry  .= "`archaeologist` = `archaeologist` + ".$this->_fleet['fleet_population_304'].", ";
		$Qry  .= "`diplomat` = `diplomat` + ".$this->_fleet['fleet_population_305'].", ";
		$Qry  .= "`soldier` = `soldier` + ".($this->_fleet['fleet_population_306']-$soldat).", ";
		$Qry  .= "`adv_soldier` = `adv_soldier` + ".$this->_fleet['fleet_population_307'].", ";
		$Qry  .= "`pilot` = `pilot` + ".($this->_fleet['fleet_population_308']-$pilote).", ";
		$Qry  .= "`antaris` = `antaris` + ".$this->_fleet['fleet_population_309']." ";
		$Qry  .= "WHERE ";
		$Qry  .= "`id` = ".($Start == true ? $this->_fleet['fleet_start_id'] : $this->_fleet['fleet_end_id']).";";
		$GLOBALS['DATABASE']->query($Qry);
		
		$this->UpdateFleet('fleet_resource_metal', '0');
		$this->UpdateFleet('fleet_resource_crystal', '0');
		$this->UpdateFleet('fleet_resource_deuterium', '0');
		$this->UpdateFleet('fleet_resource_elyrium', '0');
		$this->UpdateFleet('fleet_population_301', '0');
		$this->UpdateFleet('fleet_population_302', $technicien);
		$this->UpdateFleet('fleet_population_303', $scientifique);
		$this->UpdateFleet('fleet_population_304', '0');
		$this->UpdateFleet('fleet_population_305', '0');
		$this->UpdateFleet('fleet_population_306', $soldat);
		$this->UpdateFleet('fleet_population_307', '0');
		$this->UpdateFleet('fleet_population_308', $pilote);
		$this->UpdateFleet('fleet_population_309', '0');
		$this->UpdateFleet('specialized_array', '');
	}
	
	function StoreGoodsToPlanet($Start = false)
	{
		
		$FleetRecord2        = explode(';', $this->_fleet['specialized_array']);
		foreach ($FleetRecord2 as $Item => $Group)
		{
			if (empty($Group)) continue;
			$Class			= explode(',', $Group);
			$QryUpdFleet	.= "`".$resource[$Class[0]]."` = `".$resource[$Class[0]]."` + ".$Class[1].", ";
		}
		
		$Qry   = "UPDATE ".PLANETS." SET ";
		if (!empty($QryUpdFleet))
			$Qry  .= $QryUpdFleet;
		
		$Qry  .= "`metal` = `metal` + ".$this->_fleet['fleet_resource_metal'].", ";
		$Qry  .= "`crystal` = `crystal` + ".$this->_fleet['fleet_resource_crystal'].", ";
		$Qry  .= "`deuterium` = `deuterium` + ".$this->_fleet['fleet_resource_deuterium'].", ";
		$Qry  .= "`elyrium` = `elyrium` + ".$this->_fleet['fleet_resource_elyrium'].", ";
		$Qry  .= "`civil` = `civil` + ".$this->_fleet['fleet_population_301'].", ";
		$Qry  .= "`technician` = `technician` + ".$this->_fleet['fleet_population_302'].", ";
		$Qry  .= "`scientist` = `scientist` + ".$this->_fleet['fleet_population_303'].", ";
		$Qry  .= "`archaeologist` = `archaeologist` + ".$this->_fleet['fleet_population_304'].", ";
		$Qry  .= "`diplomat` = `diplomat` + ".$this->_fleet['fleet_population_305'].", ";
		$Qry  .= "`soldier` = `soldier` + ".$this->_fleet['fleet_population_306'].", ";
		$Qry  .= "`adv_soldier` = `adv_soldier` + ".$this->_fleet['fleet_population_307'].", ";
		$Qry  .= "`pilot` = `pilot` + ".$this->_fleet['fleet_population_308'].", ";
		$Qry  .= "`antaris` = `antaris` + ".$this->_fleet['fleet_population_309']." ";
		$Qry  .= "WHERE ";
		$Qry  .= "`id` = ".($Start == true ? $this->_fleet['fleet_start_id'] : $this->_fleet['fleet_end_id']).";";
		$GLOBALS['DATABASE']->query($Qry);
		
		$this->UpdateFleet('fleet_resource_metal', '0');
		$this->UpdateFleet('fleet_resource_crystal', '0');
		$this->UpdateFleet('fleet_resource_deuterium', '0');
		$this->UpdateFleet('fleet_resource_elyrium', '0');
		$this->UpdateFleet('fleet_population_301', '0');
		$this->UpdateFleet('fleet_population_302', '0');
		$this->UpdateFleet('fleet_population_303', '0');
		$this->UpdateFleet('fleet_population_304', '0');
		$this->UpdateFleet('fleet_population_305', '0');
		$this->UpdateFleet('fleet_population_306', '0');
		$this->UpdateFleet('fleet_population_307', '0');
		$this->UpdateFleet('fleet_population_308', '0');
		$this->UpdateFleet('fleet_population_309', '0');
		$this->UpdateFleet('specialized_array', '');
	}
	
	function StoreResourceToPlanet($Start = false)
	{
		$Qry   = "UPDATE ".PLANETS." SET ";
		$Qry  .= "`metal` = `metal` + ".$this->_fleet['fleet_resource_metal'].", ";
		$Qry  .= "`crystal` = `crystal` + ".$this->_fleet['fleet_resource_crystal'].", ";
		$Qry  .= "`deuterium` = `deuterium` + ".$this->_fleet['fleet_resource_deuterium'].", ";
		$Qry  .= "`elyrium` = `elyrium` + ".$this->_fleet['fleet_resource_elyrium']." ";
		$Qry  .= "WHERE ";
		$Qry  .= "`id` = ".($Start == true ? $this->_fleet['fleet_start_id'] : $this->_fleet['fleet_end_id']).";";
		$GLOBALS['DATABASE']->query($Qry);
		
		$this->UpdateFleet('fleet_resource_metal', '0');
		$this->UpdateFleet('fleet_resource_crystal', '0');
		$this->UpdateFleet('fleet_resource_deuterium', '0');
		$this->UpdateFleet('fleet_resource_elyrium', '0');
	}
	
	function StorePopulationToPlanet($Start = false)
	{
		$Qry   = "UPDATE ".PLANETS." SET ";
		$Qry  .= "`civil` = `civil` + ".$this->_fleet['fleet_population_301'].", ";
		$Qry  .= "`technician` = `technician` + ".$this->_fleet['fleet_population_302'].", ";
		$Qry  .= "`scientist` = `scientist` + ".$this->_fleet['fleet_population_303'].", ";
		$Qry  .= "`archaeologist` = `archaeologist` + ".$this->_fleet['fleet_population_304'].", ";
		$Qry  .= "`diplomat` = `diplomat` + ".$this->_fleet['fleet_population_305'].", ";
		$Qry  .= "`soldier` = `soldier` + ".$this->_fleet['fleet_population_306'].", ";
		$Qry  .= "`adv_soldier` = `adv_soldier` + ".$this->_fleet['fleet_population_307'].", ";
		$Qry  .= "`pilot` = `pilot` + ".$this->_fleet['fleet_population_308'].", ";
		$Qry  .= "`antaris` = `antaris` + ".$this->_fleet['fleet_population_309']." ";
		$Qry  .= "WHERE ";
		$Qry  .= "`id` = ".($Start == true ? $this->_fleet['fleet_start_id'] : $this->_fleet['fleet_end_id']).";";
		$GLOBALS['DATABASE']->query($Qry);
		
		$this->UpdateFleet('fleet_population_301', '0');
		$this->UpdateFleet('fleet_population_302', '0');
		$this->UpdateFleet('fleet_population_303', '0');
		$this->UpdateFleet('fleet_population_304', '0');
		$this->UpdateFleet('fleet_population_305', '0');
		$this->UpdateFleet('fleet_population_306', '0');
		$this->UpdateFleet('fleet_population_307', '0');
		$this->UpdateFleet('fleet_population_308', '0');
		$this->UpdateFleet('fleet_population_309', '0');
	}
	
	
	function KillFleet()
	{
		$this->kill	= 1;
		$GLOBALS['DATABASE']->multi_query("DELETE FROM ".FLEETS." WHERE `fleet_id` = ".$this->_fleet['fleet_id'].";
		DELETE FROM ".FLEETS_EVENT." WHERE `fleetID` = ".$this->_fleet['fleet_id'].";");
	}
	
	function getLanguage($language = NULL, $userID = NULL)
	{
		if(is_null($language) && !is_null($userID))
		{
			$language = $GLOBALS['DATABASE']->getFirstCell("SELECT lang FROM ".USERS." WHERE id = ".$this->_fleet['fleet_owner'].";");
		}
		
		$LNG		= new Language($language);
		$LNG->includeData(array('L18N', 'FLEET', 'TECH', 'CUSTOM'));
		
		return $LNG;
	}
}