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
 * @info $Id$
 * @link http://2moons.cc/
 */

class MissionCaseAttack extends MissionFunctions
{
	function __construct($Fleet)
	{
		$this->_fleet	= $Fleet;
	}
	
	function TargetEvent()
	{	
		global $resource, $reslist, $pricelist;
		
		$fleetAttack	= array();
		$fleetDefend	= array();
		
		$userAttack		= array();
		$userDefend		= array();
		
		$stealResource	= array(
			901	=> 0,
			902	=> 0,
			903	=> 0,
			904	=> 0,
		);
		
		$debris			= array();
		$planetDebris	= array();
		
		$raportInfo		= array();
		
		$debrisRessource	= array(901, 902, 903, 904);
				
		$targetPlanet 	= $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM ".PLANETS." WHERE id = '".$this->_fleet['fleet_end_id']."';");
		$targetUser   	= $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM ".USERS." WHERE id = '".$targetPlanet['id_owner']."';");
		$senderUser   	= $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM ".USERS." WHERE id = '".$this->_fleet['fleet_owner']."';");
		$senderPlanet  = $GLOBALS['DATABASE']->getFirstRow("SELECT galaxy, system, planet, name FROM ".PLANETS." WHERE id = ".$this->_fleet['fleet_start_id'].";");
		
		$userAlliance  = $senderUser['ally_id'] == 0 ? "" : " <span class='orange'>[".$this->getAllianceTag($senderUser['ally_id'])."]</span>";
		$ennemAlliance = $targetUser['ally_id'] == 0 ? "" : " <span class='orange'>[".$this->getAllianceTag($targetUser['ally_id'])."]</span>";
		
		$targetUser['factor']	= getFactors($targetUser, 'basic', $this->_fleet['fleet_start_time']);
		$planetUpdater	= new ResourceUpdate();
		
		list($targetUser, $targetPlanet)	= $planetUpdater->CalcResource($targetUser, $targetPlanet, true, $this->_fleet['fleet_start_time']);
		
		if($this->_fleet['fleet_group'] != 0)
		{
			$GLOBALS['DATABASE']->query("DELETE FROM ".AKS." WHERE id = '".$this->_fleet['fleet_group']."';");
			$incomingFleetsResult = $GLOBALS['DATABASE']->query("SELECT * FROM ".FLEETS." WHERE fleet_group = '".$this->_fleet['fleet_group']."';");
		
			while ($incomingFleetsRow = $GLOBALS['DATABASE']->fetch_array($incomingFleetsResult))
			{
				$incomingFleets[$incomingFleetsRow['fleet_id']] = $incomingFleetsRow;
			}
			
			$GLOBALS['DATABASE']->free_result($incomingFleetsResult);
		}
		else
		{
			$incomingFleets = array($this->_fleet['fleet_id'] => $this->_fleet);
		}
		
		foreach($incomingFleets as $fleetID => $fleetDetail)
		{
			$fleetAttack[$fleetID]['fleetDetail']		= $fleetDetail;
			$fleetAttack[$fleetID]['player']			= $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM ".USERS." WHERE id = '".$fleetDetail['fleet_owner']."';");
			$fleetAttack[$fleetID]['player']['factor']	= getFactors($fleetAttack[$fleetID]['player'], 'attack', $this->_fleet['fleet_start_time']);
			$fleetAttack[$fleetID]['unit']				= fleetAmountToArray($fleetDetail['fleet_array']);
			
			$userAttack[$fleetAttack[$fleetID]['player']['id']]	= $fleetAttack[$fleetID]['player']['username'];
		}
				
		$targetFleetsResult = $GLOBALS['DATABASE']->query("SELECT * FROM ".FLEETS." WHERE fleet_mission = '5' AND fleet_end_id = '".$this->_fleet['fleet_end_id']."' AND fleet_start_time <= '".TIMESTAMP."' AND fleet_end_stay >= '".TIMESTAMP."';");
		while ($fleetDetail = $GLOBALS['DATABASE']->fetch_array($targetFleetsResult))
		{
			$fleetID	= $fleetDetail['fleet_id'];
			
			$fleetDefend[$fleetID]['fleetDetail']		= $fleetDetail;
			$fleetDefend[$fleetID]['player']			= $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM ".USERS." WHERE id = '".$fleetDetail['fleet_owner']."';");
			$fleetDefend[$fleetID]['player']['factor']	= getFactors($fleetDefend[$fleetID]['player'], 'attack', $this->_fleet['fleet_start_time']);
			$fleetDefend[$fleetID]['unit']				= fleetAmountToArray($fleetDetail['fleet_array']);
			
			$userDefend[$fleetDefend[$fleetID]['player']['id']]	= $fleetDefend[$fleetID]['player']['username'];
		}
			
		$GLOBALS['DATABASE']->free_result($targetFleetsResult);
		
		$fleetDefend[0]['player']			= $targetUser;
		$fleetDefend[0]['player']['factor']	= getFactors($fleetDefend[0]['player'], 'attack', $this->_fleet['fleet_start_time']);
		$fleetDefend[0]['fleetDetail']		= array(
			'fleet_start_galaxy'	=> $targetPlanet['galaxy'], 
			'fleet_start_system'	=> $targetPlanet['system'], 
			'fleet_start_planet'	=> $targetPlanet['planet'], 
			'fleet_start_type'		=> $targetPlanet['planet_type'], 
		);
		
		$fleetDefend[0]['unit']				= array();
		$SpecialShips						= explode(';', $targetPlanet['specialships']);
		$BuildArrayB						= array();
		
		$technicien							= 0;
		$scientifique						= 0;
		$soldat								= 0;
		$pilote								= 0;
		$antaris							= 0;
		
		$technicienR						= 0;
		$scientifiqueR						= 0;
		$soldatR							= 0;
		$piloteR							= 0;
		$antarisR							= 0;
		
		if(!empty($targetPlanet['specialships'])){
			foreach($SpecialShips as $Items)
			{
				$temps 				= explode(',', $Items);
				$BuildArrayB[] 		= array($temps[0], $temps[1]);
			}
			
			foreach($BuildArrayB as $Element)
			{
				$getUserShip   = $GLOBALS['DATABASE']->getFirstRow("SELECT id_infrastructure FROM ".VARS_USER." WHERE varId = ".$Element[0].";");
				$getUserPeople = $GLOBALS['DATABASE']->getFirstRow("SELECT soldier, technician, scientist, pilots FROM ".VARS_INFRA." WHERE id = ".$getUserShip['id_infrastructure'].";");
				
				$technicien				+= $getUserPeople['technician']*$Element[1];
				$scientifique			+= $getUserPeople['scientist']*$Element[1];
				$soldat					+= $getUserPeople['soldier']*$Element[1];
				$pilote					+= $getUserPeople['pilots']*$Element[1];
				
				$fleetDefend[0]['unit'][$Element[0]] = $Element[1];
			}
			
			if($targetPlanet[$resource[302]] < $technicien)
				$technicienR		+= $targetPlanet[$resource[302]];
			else
				$technicienR		+= $technicien;
			
			if($targetPlanet[$resource[303]] < $scientifique)
				$scientifiqueR		+= $targetPlanet[$resource[303]];
			else
				$scientifiqueR		+= $scientifique;
				
			if($targetPlanet[$resource[306]] < $soldat)
				$soldatR			+= $targetPlanet[$resource[306]];
			else
				$soldatR			+= $soldat;
				
			if($targetPlanet[$resource[308]] < $pilote)
				$piloteR			+= $targetPlanet[$resource[308]];
			else
				$piloteR			+= $pilote;
		}
		
		foreach($reslist['defense'] as $elementID)
		{
			if (empty($targetPlanet[$resource[$elementID]])) continue;

			$fleetDefend[0]['unit'][$elementID] = $targetPlanet[$resource[$elementID]];
		}
		
			
		$userDefend[$fleetDefend[0]['player']['id']]	= $fleetDefend[0]['player']['username'];
		
		require_once('calculateAttackSpace.php');
		
		$fleetIntoDebris	= $GLOBALS['CONFIG'][$this->_fleet['fleet_universe']]['Fleet_Cdr'];
		$defIntoDebris		= $GLOBALS['CONFIG'][$this->_fleet['fleet_universe']]['Defs_Cdr'];
		
		$Summary	= $technicien + $scientifique + $soldat + $pilote;
		$Summary1	= $technicienR + $scientifiqueR + $soldatR + $piloteR;
		
		$Handicap   = 0;
		if($Summary != 0)
			$Handicap	= ((1-$Summary1/$Summary)*100);
		
		$combatResult 		= calculateAttackSpace($fleetAttack, $fleetDefend, $fleetIntoDebris, $defIntoDebris, $Handicap);
		
		$sqlQuery			= "";
		
		foreach ($fleetAttack as $fleetID => $fleetDetail)
		{
			$fleetArray = '';
			$totalCount = 0;
			
			$fleetDetail['unit']	= array_filter($fleetDetail['unit']);
			foreach ($fleetDetail['unit'] as $elementID => $amount)
			{				
				$fleetArray .= $elementID.','.floattostring($amount).';';
				$totalCount += $amount;
			}
			
			if($totalCount == 0)
			{
				if($this->_fleet['fleet_id'] == $fleetID)
				{
					$this->KillFleet();
				}
				else
				{
					$sqlQuery .= "DELETE FROM ".FLEETS." WHERE fleet_id = ".$fleetID.";";
					$sqlQuery .= "DELETE FROM ".FLEETS_EVENT." WHERE fleetID = ".$fleetID.";";
				}
				
				$sqlQuery .= "UPDATE ".LOG_FLEETS." SET fleet_state = 2 WHERE fleet_id = '".$fleetID."';";
			}
			elseif($totalCount > 0)
			{
				$sqlQuery .= "UPDATE ".FLEETS." SET fleet_array = '".substr($fleetArray, 0, -1)."', fleet_amount = '".$totalCount."' WHERE fleet_id = '".$fleetID."';";
				$sqlQuery .= "UPDATE ".LOG_FLEETS." SET fleet_array = '".substr($fleetArray, 0, -1)."', fleet_amount = '".$totalCount."', fleet_state = 1 WHERE fleet_id = '".$fleetID."';";
			}
			else
			{
				throw new Exception("Negative Fleet amount ....");
			}
		}
		
		foreach ($fleetDefend as $fleetID => $fleetDetail)
		{
			if($fleetID != 0)
			{
				$fleetArray = '';
				$totalCount = 0;
				
				$fleetDetail['unit']	= array_filter($fleetDetail['unit']);
				
				foreach ($fleetDetail['unit'] as $elementID => $amount)
				{				
					$fleetArray .= $elementID.','.floattostring($amount).';';
					$totalCount += $amount;
				}
				
				if($totalCount == 0)
				{
					$sqlQuery .= "DELETE FROM ".FLEETS." WHERE fleet_id = ".$fleetID.";";
					$sqlQuery .= "DELETE FROM ".FLEETS_EVENT." WHERE fleetID = ".$fleetID.";";
					$sqlQuery .= "UPDATE ".LOG_FLEETS." SET fleet_state = 2 WHERE fleet_id = '".$fleetID."';";
				}
				elseif($totalCount > 0)
				{
					$sqlQuery .= "UPDATE ".FLEETS." SET fleet_array = '".substr($fleetArray, 0, -1)."', fleet_amount = '".$totalCount."' WHERE fleet_id = '".$fleetID."';";
					$sqlQuery .= "UPDATE ".LOG_FLEETS." SET fleet_array = '".substr($fleetArray, 0, -1)."', fleet_amount = '".$totalCount."', fleet_state = 1 WHERE fleet_id = '".$fleetID."';";
				}
				else
				{
					throw new Exception("Negative Fleet amount ....");
				}
			}
			else
			{
				$fleetArray = array();
				foreach ($fleetDetail['unit'] as $elementID => $amount)
				{	
					
					$QryUpdFleet2   = '';
					if(!isset($pricelist[$elementID])){
						$getPlanet	 	= $GLOBALS['DATABASE']->getFirstRow("SELECT specialships FROM ".PLANETS." WHERE id = ".$this->_fleet['fleet_end_id'].";");
						if(!empty($getPlanet['specialships']))
						{
							
							$getPlanet	 	= $GLOBALS['DATABASE']->getFirstRow("SELECT specialships FROM ".PLANETS." WHERE id = ".$this->_fleet['fleet_end_id'].";");
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

								if($elementID == $Element){
									$QryUpdFleet2[]	= $Element.','.floattostring(($Count + $amount));
									$insideId = 1;
								}else{
									$QryUpdFleet2[]	= $Element.','.floattostring($Count);
								}
							}
							if($insideId == 0)
								$QryUpdFleet2[]	= $elementID.','.floattostring($amount);
						}else{
							$QryUpdFleet2[]	= $elementID.','.floattostring($amount);
						}
						$SQL	= "UPDATE ".PLANETS." SET specialships = '".implode(";", $QryUpdFleet2)."' WHERE id = ".$this->_fleet['fleet_end_id'].";";
						$GLOBALS['DATABASE']->query($SQL);
					}elseif(isset($pricelist[$elementID])){
						$fleetArray[] = $resource[$elementID]." = ".$amount;
					}
				}
				
				if(!empty($fleetArray))
				{
					$sqlQuery .= "UPDATE ".PLANETS." SET ".implode(', ', $fleetArray)." WHERE id = '".$this->_fleet['fleet_end_id']."';";
				}
			}
		}
		
		$GLOBALS['DATABASE']->multi_query($sqlQuery);
		
		if ($combatResult['won'] == "a")
		{
			require_once('calculateSteal.php');
			$stealResource = calculateSteal($fleetAttack, $targetPlanet);
		}
		
		if($this->_fleet['fleet_end_type'] == 3)
		{
			// Use planet debris, if attack on moons
			$targetPlanet 		= array_merge(
				$targetPlanet,
				$GLOBALS['DATABASE']->getFirstRow("SELECT der_metal, der_crystal, der_deuterium, der_elyrium FROM ".PLANETS." WHERE id_luna = ".$this->_fleet['fleet_end_id'].";")
			);
		}
		
		foreach($debrisRessource as $elementID)
		{
			$debris[$elementID]			= $combatResult['debris']['attacker'][$elementID] + $combatResult['debris']['defender'][$elementID];
			$planetDebris[$elementID]	= $targetPlanet['der_'.$resource[$elementID]] + $debris[$elementID];
		}
		
		$debrisTotal		= array_sum($debris);
		
		$moonFactor			= $GLOBALS['CONFIG'][$this->_fleet['fleet_universe']]['moon_factor'];
		$maxMoonChance		= $GLOBALS['CONFIG'][$this->_fleet['fleet_universe']]['moon_chance'];
		
		if($targetPlanet['id_luna'] == 0 && $targetPlanet['planet_type'] == 1)
		{
			$chanceCreateMoon	= round($debrisTotal / 100000 * $moonFactor);
			$chanceCreateMoon	= min($chanceCreateMoon, $maxMoonChance);
		}
		else
		{
			$chanceCreateMoon	= 0;
		}

		$raportInfo	= array(
			'thisFleet'				=> $this->_fleet,
			'debris'				=> $debris,
			'stealResource'			=> $stealResource,
			'moonChance'			=> $chanceCreateMoon,
			'moonDestroy'			=> false,
			'moonName'				=> null,
			'moonDestroyChance'		=> null,
			'moonDestroySuccess'	=> null,
			'fleetDestroyChance'	=> null,
			'fleetDestroySuccess'	=> null,
		);
		
		require_once('GenerateReport.php');
		$raportData	= GenerateReport($combatResult, $raportInfo);
		
		switch($combatResult['won'])
		{
			case "a":
				$attackStatus	= 'wons';
				$defendStatus	= 'loos';
				$attackClass	= 'raportWin';
				$defendClass	= 'raportLose';
			break;
			case "w":
				$attackStatus	= 'draws';
				$defendStatus	= 'draws';
				$attackClass	= 'raportDraw';
				$defendClass	= 'raportDraw';
			break;
			case "r":
				$attackStatus	= 'loos';
				$defendStatus	= 'wons';
				$attackClass	= 'raportLose';
				$defendClass	= 'raportWin';
			break;
		}
		
		$raportID	= md5(uniqid('', true).TIMESTAMP);
		
		$sqlQuery	= "INSERT INTO ".RW." SET 
		rid = '".$raportID."',
		raport = '".serialize($raportData)."',
		time = '".$this->_fleet['fleet_start_time']."',
		attacker = '".implode(',', array_keys($userAttack))."',
		defender = '".implode(',', array_keys($userDefend))."';";
		$GLOBALS['DATABASE']->query($sqlQuery);
		
		$RID		= $raportID;
		
		$Raport		= $GLOBALS['DATABASE']->getFirstRow("SELECT 
		raport, time,
		(
			SELECT 
			GROUP_CONCAT(username SEPARATOR ' & ') as attacker
			FROM ".USERS." 
			WHERE id IN (SELECT uid FROM ".TOPKB_USERS." WHERE ".TOPKB_USERS.".rid = ".RW.".rid AND role = 1)
		) as attacker,
		(
			SELECT 
			GROUP_CONCAT(username SEPARATOR ' & ') as defender
			FROM ".USERS." 
			WHERE id IN (SELECT uid FROM ".TOPKB_USERS." WHERE ".TOPKB_USERS.".rid = ".RW.".rid AND role = 2)
		) as defender
		FROM ".RW."
		WHERE rid = '".$GLOBALS['DATABASE']->escape($RID)."';");
		
		$Info		= array($Raport["attacker"], $Raport["defender"]);
			
		$CombatRaport			= unserialize($Raport['raport']);
				
		$sqlQuery		= "";
		foreach($userAttack as $userID => $userName)
		{
			$LNG		= $this->getLanguage(NULL, $userID);
			
			//$CombatRaport['time']	= date("d F Y à H:i", $CombatRaport['time']);
			$CombatRaport			= $this->BCWrapperPreRev2321($CombatRaport);
			$Raport					= $CombatRaport;
			$TextToEcho  = "";
			$TextToEcho2 = "";
			$TextToEcho3 = "";
			$TextToEcho4 = "";
			foreach($Raport['rounds'] as $Round => $RoundInfo){
				$i = key(end($RoundInfo));
				$total1 = 0;
				$total2 = 0;
				$total3 = 0;
				$total4 = 0;
				$total5 = 0;
				$total6 = 0;
				$total7 = 0;
				$total8 = 0;
				if($Round == 0){
					foreach($RoundInfo['attacker'] as $Player){
						$PlayerInfo = $Raport['players'][$Player['userID']];
						if(!empty($Player['ships'])){
							foreach($Player['ships'] as $ShipID => $ShipData){
								$getUserShip = $GLOBALS['DATABASE']->getFirstRow("SELECT nom FROM ".VARS_USER." WHERE varId = ".$ShipID.";");
								$getShipName = $ShipID < 1500 ? $LNG['tech'][$ShipID] : $getUserShip['nom'];
								$TextToEcho .= "<tr style=\"cursor : help;\">
													<td>".$getShipName."</td>
													<td>".pretty_number($ShipData[1])."</td>
													<td>".pretty_number($ShipData[2])."</td>
													<td>".pretty_number($ShipData[3])."</td>
													<td>".pretty_number($ShipData[0])."</td>
												</tr>";
								$total1 += $ShipData[1];
								$total2 += $ShipData[2];
								$total3 += $ShipData[3];
								$total4 += $ShipData[0];
							}
							$TextToEcho .= "<tr class=\"total\">
                                        <td>".$LNG['lm_achat_total']." :</td>
                                        <td>".pretty_number($total1)."</td>
                                        <td>".pretty_number($total2)."</td>
                                        <td>".pretty_number($total3)."</td>
                                        <td>".pretty_number($total4)."</td>
                                    </tr>";
						}else{
							$TextToEcho = "<tr><td colspan='5'><center>".$LNG['NOUVEAUTE_791']."</center></td></tr>";
						}
					}
							
					foreach($RoundInfo['defender'] as $Player){
						$PlayerInfo = $Raport['players'][$Player['userID']];
						if(!empty($Player['ships'])){
							foreach($Player['ships'] as $ShipID => $ShipData){
								$getUserShip = $GLOBALS['DATABASE']->getFirstRow("SELECT nom FROM ".VARS_USER." WHERE varId = ".$ShipID.";");
								$getShipName = $ShipID < 1500 ? $LNG['tech'][$ShipID] : $getUserShip['nom'];
								$TextToEcho2 .= "<tr style=\"cursor : help;\">
													<td>".$getShipName."</td>
													<td>".pretty_number($ShipData[1])."</td>
													<td>".pretty_number($ShipData[2])."</td>
													<td>".pretty_number($ShipData[3])."</td>
													<td>".pretty_number($ShipData[0])."</td>
												</tr>";
								$total5 += $ShipData[1];
								$total6 += $ShipData[2];
								$total7 += $ShipData[3];
								$total8 += $ShipData[0];
							}
							$TextToEcho2 .= "<tr class=\"total\">
                                        <td>".$LNG['lm_achat_total']." :</td>
                                        <td>".pretty_number($total5)."</td>
                                        <td>".pretty_number($total6)."</td>
                                        <td>".pretty_number($total7)."</td>
                                        <td>".pretty_number($total8)."</td>
                                    </tr>";
						}else{
							$TextToEcho2 = "<tr><td colspan='5'><center>".$LNG['NOUVEAUTE_777']."</center></td></tr>";
						}
								
					}
				}
				$total1 = 0;
				$total2 = 0;
				$total3 = 0;
				$total4 = 0;
				$total5 = 0;
				$total6 = 0;
				$total7 = 0;
				$total8 = 0;
				if($Round == (count($combatResult['rw']) -1)){
					foreach($RoundInfo['attacker'] as $Player){
						$PlayerInfo = $Raport['players'][$Player['userID']];
						if(!empty($Player['ships'])){
							foreach($Player['ships'] as $ShipID => $ShipData){
								$getUserShip = $GLOBALS['DATABASE']->getFirstRow("SELECT nom FROM ".VARS_USER." WHERE varId = ".$ShipID.";");
								$getShipName = $ShipID < 1500 ? $LNG['tech'][$ShipID] : $getUserShip['nom'];
								$TextToEcho3 .= "<tr style=\"cursor : help;\">
													<td>".$getShipName."</td>
													<td>".pretty_number($ShipData[1])."</td>
													<td>".pretty_number($ShipData[2])."</td>
													<td>".pretty_number($ShipData[3])."</td>
													<td>".pretty_number($ShipData[0])."</td>
												</tr>";
								$total1 += $ShipData[1];
								$total2 += $ShipData[2];
								$total3 += $ShipData[3];
								$total4 += $ShipData[0];
							}
							$TextToEcho3 .= "<tr class=\"total\">
                                        <td>".$LNG['lm_achat_total']." :</td>
                                        <td>".pretty_number($total1)."</td>
                                        <td>".pretty_number($total2)."</td>
                                        <td>".pretty_number($total3)."</td>
                                        <td>".pretty_number($total4)."</td>
                                    </tr>";
						}else{
							$TextToEcho3 = "<tr><td colspan='5'><center>".sprintf($LNG['NOUVEAUTE_790'], count($combatResult['rw']))."</center></td></tr>";
						}
					}
							
					foreach($RoundInfo['defender'] as $Player){
						$PlayerInfo = $Raport['players'][$Player['userID']];
						if(!empty($Player['ships'])){
							foreach($Player['ships'] as $ShipID => $ShipData){
								$getUserShip = $GLOBALS['DATABASE']->getFirstRow("SELECT nom FROM ".VARS_USER." WHERE varId = ".$ShipID.";");
								$getShipName = $ShipID < 1500 ? $LNG['tech'][$ShipID] : $getUserShip['nom'];
								$TextToEcho4 .= "<tr style=\"cursor : help;\">
													<td>".$getShipName."</td>
													<td>".pretty_number($ShipData[1])."</td>
													<td>".pretty_number($ShipData[2])."</td>
													<td>".pretty_number($ShipData[3])."</td>
													<td>".pretty_number($ShipData[0])."</td>
												</tr>";
								$total5 += $ShipData[1];
								$total6 += $ShipData[2];
								$total7 += $ShipData[3];
								$total8 += $ShipData[0];
							}
							$TextToEcho4 .= "<tr class=\"total\">
                                        <td>".$LNG['lm_achat_total']." :</td>
                                        <td>".pretty_number($total5)."</td>
                                        <td>".pretty_number($total6)."</td>
                                        <td>".pretty_number($total7)."</td>
                                        <td>".pretty_number($total8)."</td>
                                    </tr>";
						}else{
							$TextToEcho4 = "<tr><td colspan='5'><center>".sprintf($LNG['NOUVEAUTE_792'], count($combatResult['rw']))."</center></td></tr>";
						}
								
					}
				}
			}
			
			$DebrisEcho 	= "";
			$ResStealEcho 	= "";
			
			if(($debris[901] + $debris[902] + $debris[903] + $debris[904]) > 0)
				$DebrisEcho .= $LNG['NOUVEAUTE_789'];
			if(($stealResource[901] + $stealResource[902] + $stealResource[903] + $stealResource[904]) > 0)
				$ResStealEcho .= "<ul>";
			
			foreach($debris as $id => $Count){
				if($Count == 0) continue;
				
				$DebrisEcho .= "<li>".$LNG['tech'][$id]." : <span class=\"marron\">".pretty_number($Count)."</span> unités</li>";
			}
			
			foreach($stealResource as $id => $Count){
				if($Count == 0) continue;
				
				$ResStealEcho .= "<li>".$LNG['tech'][$id]." : <span class=\"orange\">".pretty_number($Count)."</span> unités</li>";
			}
			
			if(($debris[901] + $debris[902] + $debris[903] + $debris[904]) > 0)
				$DebrisEcho .= "</ul>";
			if(($stealResource[901] + $stealResource[902] + $stealResource[903] + $stealResource[904]) > 0)
				$ResStealEcho .= "</ul>";
			
			if($attackStatus == "wons"){
				$Date		   = date("d F Y à H:i", TIMESTAMP);
				$Message = sprintf($LNG['NOUVEAUTE_783'], $targetPlanet['name'], $targetPlanet['system'], $targetPlanet['planet']);
				$messageHTML = sprintf($LNG['NOUVEAUTE_781'], $senderUser['username'], $userAlliance, $targetPlanet['name'], $targetPlanet['system'], $targetPlanet['planet'], $targetUser['username'], $ennemAlliance, $senderPlanet['name'], $senderPlanet['system'], $senderPlanet['planet'], $Date, $senderUser['username'], $TextToEcho, $targetUser['username'], $TextToEcho2, count($combatResult['rw']), $senderUser['username'], $TextToEcho3, $targetUser['username'], $TextToEcho4, sprintf($LNG['NOUVEAUTE_794'], $senderUser['username'], $targetUser['username'], $senderUser['username'], $targetPlanet['name'], $targetPlanet['system'], $targetPlanet['planet'], $ResStealEcho), $DebrisEcho);
			}elseif($attackStatus == "draws"){
				$Date		   = date("d F Y à H:i", TIMESTAMP);
				$Message = sprintf($LNG['NOUVEAUTE_784'], $targetPlanet['name'], $targetPlanet['system'], $targetPlanet['planet']);
				$messageHTML = sprintf($LNG['NOUVEAUTE_781'], $senderUser['username'], $userAlliance, $targetPlanet['name'], $targetPlanet['system'], $targetPlanet['planet'], $targetUser['username'], $ennemAlliance, $senderPlanet['name'], $senderPlanet['system'], $senderPlanet['planet'], $Date, $senderUser['username'], $TextToEcho, $targetUser['username'], $TextToEcho2, count($combatResult['rw']), $senderUser['username'], $TextToEcho3, $targetUser['username'], $TextToEcho4, sprintf($LNG['NOUVEAUTE_812'], $targetUser['username'], $senderUser['username']), $DebrisEcho);
			}elseif($attackStatus == "loos"){
				$Date		   = date("d F Y à H:i", TIMESTAMP);
				$Message = sprintf($LNG['NOUVEAUTE_782'], $targetPlanet['name'], $targetPlanet['system'], $targetPlanet['planet']);
				$messageHTML = sprintf($LNG['NOUVEAUTE_781'], $senderUser['username'], $userAlliance, $targetPlanet['name'], $targetPlanet['system'], $targetPlanet['planet'], $targetUser['username'], $ennemAlliance, $senderPlanet['name'], $senderPlanet['system'], $senderPlanet['planet'], $Date, $senderUser['username'], $TextToEcho, $targetUser['username'], $TextToEcho2, count($combatResult['rw']), $senderUser['username'], $TextToEcho3, $targetUser['username'], $TextToEcho4, sprintf($LNG['NOUVEAUTE_793'], $targetUser['username'], $senderUser['username']), $DebrisEcho);
				
			}
			
			$message	= $messageHTML;
			
			SendSimpleMessage($userID, $targetUser['id'], TIMESTAMP, 3, $Message, sprintf($LNG['NOUVEAUTE_785'], $targetUser['username']), $message);
			
			$sqlQuery	.= "INSERT INTO ".TOPKB_USERS." SET ";
			$sqlQuery	.= "rid = '".$raportID."', ";
			$sqlQuery	.= "role = 1, ";
			$sqlQuery	.= "username = '".$GLOBALS['DATABASE']->escape($userName)."', ";
			$sqlQuery	.= "uid = ".$userID.";";
		}
		
		
		foreach($userDefend as $userID => $userName)
		{
			$LNG		= $this->getLanguage(NULL, $userID);
			
			
			//$CombatRaport['time']	= date("d F Y à H:i", $CombatRaport['time']);
			$CombatRaport			= $this->BCWrapperPreRev2321($CombatRaport);
			$Raport					= $CombatRaport;
			$TextToEcho  = "";
			$TextToEcho2 = "";
			$TextToEcho3 = "";
			$TextToEcho4 = "";
			foreach($Raport['rounds'] as $Round => $RoundInfo){
				$i = key(end($RoundInfo));
				$total1 = 0;
				$total2 = 0;
				$total3 = 0;
				$total4 = 0;
				$total5 = 0;
				$total6 = 0;
				$total7 = 0;
				$total8 = 0;
				if($Round == 0){
					foreach($RoundInfo['attacker'] as $Player){
						$PlayerInfo = $Raport['players'][$Player['userID']];
						if(!empty($Player['ships'])){
							foreach($Player['ships'] as $ShipID => $ShipData){
								$getUserShip = $GLOBALS['DATABASE']->getFirstRow("SELECT nom FROM ".VARS_USER." WHERE varId = ".$ShipID.";");
								$getShipName = $ShipID < 1500 ? $LNG['tech'][$ShipID] : $getUserShip['nom'];
								$TextToEcho .= "<tr style=\"cursor : help;\">
													<td>".$getShipName."</td>
													<td>".pretty_number($ShipData[1])."</td>
													<td>".pretty_number($ShipData[2])."</td>
													<td>".pretty_number($ShipData[3])."</td>
													<td>".pretty_number($ShipData[0])."</td>
												</tr>";
								$total1 += $ShipData[1];
								$total2 += $ShipData[2];
								$total3 += $ShipData[3];
								$total4 += $ShipData[0];
							}
							$TextToEcho .= "<tr class=\"total\">
                                        <td>".$LNG['lm_achat_total']." :</td>
                                        <td>".pretty_number($total1)."</td>
                                        <td>".pretty_number($total2)."</td>
                                        <td>".pretty_number($total3)."</td>
                                        <td>".pretty_number($total4)."</td>
                                    </tr>";
						}else{
							$TextToEcho = "<tr><td colspan='5'><center>".$LNG['NOUVEAUTE_791']."</center></td></tr>";
						}
					}
							
					foreach($RoundInfo['defender'] as $Player){
						$PlayerInfo = $Raport['players'][$Player['userID']];
						if(!empty($Player['ships'])){
							foreach($Player['ships'] as $ShipID => $ShipData){
								$getUserShip = $GLOBALS['DATABASE']->getFirstRow("SELECT nom FROM ".VARS_USER." WHERE varId = ".$ShipID.";");
								$getShipName = $ShipID < 1500 ? $LNG['tech'][$ShipID] : $getUserShip['nom'];
								$TextToEcho2 .= "<tr style=\"cursor : help;\">
													<td>".$getShipName."</td>
													<td>".pretty_number($ShipData[1])."</td>
													<td>".pretty_number($ShipData[2])."</td>
													<td>".pretty_number($ShipData[3])."</td>
													<td>".pretty_number($ShipData[0])."</td>
												</tr>";
								$total5 += $ShipData[1];
								$total6 += $ShipData[2];
								$total7 += $ShipData[3];
								$total8 += $ShipData[0];
							}
							$TextToEcho2 .= "<tr class=\"total\">
                                        <td>".$LNG['lm_achat_total']." :</td>
                                        <td>".pretty_number($total5)."</td>
                                        <td>".pretty_number($total6)."</td>
                                        <td>".pretty_number($total7)."</td>
                                        <td>".pretty_number($total8)."</td>
                                    </tr>";
						}else{
							$TextToEcho2 = "<tr><td colspan='5'><center>".$LNG['NOUVEAUTE_777']."</center></td></tr>";
						}
								
					}
				}
				$total1 = 0;
				$total2 = 0;
				$total3 = 0;
				$total4 = 0;
				$total5 = 0;
				$total6 = 0;
				$total7 = 0;
				$total8 = 0;
				if($Round == (count($combatResult['rw']) -1)){
					foreach($RoundInfo['attacker'] as $Player){
						$PlayerInfo = $Raport['players'][$Player['userID']];
						if(!empty($Player['ships'])){
							foreach($Player['ships'] as $ShipID => $ShipData){
								$getUserShip = $GLOBALS['DATABASE']->getFirstRow("SELECT nom FROM ".VARS_USER." WHERE varId = ".$ShipID.";");
								$getShipName = $ShipID < 1500 ? $LNG['tech'][$ShipID] : $getUserShip['nom'];
								$TextToEcho3 .= "<tr style=\"cursor : help;\">
													<td>".$getShipName."</td>
													<td>".pretty_number($ShipData[1])."</td>
													<td>".pretty_number($ShipData[2])."</td>
													<td>".pretty_number($ShipData[3])."</td>
													<td>".pretty_number($ShipData[0])."</td>
												</tr>";
								$total1 += $ShipData[1];
								$total2 += $ShipData[2];
								$total3 += $ShipData[3];
								$total4 += $ShipData[0];
							}
							$TextToEcho3 .= "<tr class=\"total\">
                                        <td>".$LNG['lm_achat_total']." :</td>
                                        <td>".pretty_number($total1)."</td>
                                        <td>".pretty_number($total2)."</td>
                                        <td>".pretty_number($total3)."</td>
                                        <td>".pretty_number($total4)."</td>
                                    </tr>";
						}else{
							$TextToEcho3 = "<tr><td colspan='5'><center>".sprintf($LNG['NOUVEAUTE_790'], count($combatResult['rw']))."</center></td></tr>";
						}
					}
							
					foreach($RoundInfo['defender'] as $Player){
						$PlayerInfo = $Raport['players'][$Player['userID']];
						if(!empty($Player['ships'])){
							foreach($Player['ships'] as $ShipID => $ShipData){
								$getUserShip = $GLOBALS['DATABASE']->getFirstRow("SELECT nom FROM ".VARS_USER." WHERE varId = ".$ShipID.";");
								$getShipName = $ShipID < 1500 ? $LNG['tech'][$ShipID] : $getUserShip['nom'];
								$TextToEcho4 .= "<tr style=\"cursor : help;\">
													<td>".$getShipName."</td>
													<td>".pretty_number($ShipData[1])."</td>
													<td>".pretty_number($ShipData[2])."</td>
													<td>".pretty_number($ShipData[3])."</td>
													<td>".pretty_number($ShipData[0])."</td>
												</tr>";
								$total5 += $ShipData[1];
								$total6 += $ShipData[2];
								$total7 += $ShipData[3];
								$total8 += $ShipData[0];
							}
							$TextToEcho4 .= "<tr class=\"total\">
                                        <td>".$LNG['lm_achat_total']." :</td>
                                        <td>".pretty_number($total5)."</td>
                                        <td>".pretty_number($total6)."</td>
                                        <td>".pretty_number($total7)."</td>
                                        <td>".pretty_number($total8)."</td>
                                    </tr>";
						}else{
							$TextToEcho4 = "<tr><td colspan='5'><center>".sprintf($LNG['NOUVEAUTE_792'], count($combatResult['rw']))."</center></td></tr>";
						}
								
					}
				}
			}
			
			$DebrisEcho = "";
			$ResStealEcho = "";
			
			if(($debris[901] + $debris[902] + $debris[903] + $debris[904]) > 0)
				$DebrisEcho .= $LNG['NOUVEAUTE_789'];
			if(($stealResource[901] + $stealResource[902] + $stealResource[903] + $stealResource[904]) > 0)
				$ResStealEcho .= "<ul>";
			
			foreach($debris as $id => $Count){
				if($Count == 0) continue;
				
				$DebrisEcho .= "<li>".$LNG['tech'][$id]." : <span class=\"marron\">".pretty_number($Count)."</span> unités</li>";
			}
			
			foreach($stealResource as $id => $Count){
				if($Count == 0) continue;
				
				$ResStealEcho .= "<li>".$LNG['tech'][$id]." : <span class=\"marron\">".pretty_number($Count)."</span> unités</li>";
			}
			
			if(($debris[901] + $debris[902] + $debris[903] + $debris[904]) > 0)
				$DebrisEcho .= "</ul>";
			if(($stealResource[901] + $stealResource[902] + $stealResource[903] + $stealResource[904]) > 0)
				$ResStealEcho .= "</ul>";
			
			if($defendStatus == "wons"){
				$Date		   = date("d F Y à H:i", TIMESTAMP);
				$Message = sprintf($LNG['NOUVEAUTE_783'], $targetPlanet['name'], $targetPlanet['system'], $targetPlanet['planet']);
				$messageHTML = sprintf($LNG['NOUVEAUTE_781'], $senderUser['username'], $userAlliance, $targetPlanet['name'], $targetPlanet['system'], $targetPlanet['planet'], $targetUser['username'], $ennemAlliance, $senderPlanet['name'], $senderPlanet['system'], $senderPlanet['planet'], $Date, $senderUser['username'], $TextToEcho, $targetUser['username'], $TextToEcho2, count($combatResult['rw']), $senderUser['username'], $TextToEcho3, $targetUser['username'], $TextToEcho4, sprintf($LNG['NOUVEAUTE_793'], $targetUser['username'], $senderUser['username']), $DebrisEcho);
			}elseif($defendStatus == "draws"){
				$Date		   = date("d F Y à H:i", TIMESTAMP);
				$Message = sprintf($LNG['NOUVEAUTE_784'], $targetPlanet['name'], $targetPlanet['system'], $targetPlanet['planet']);
				$messageHTML = sprintf($LNG['NOUVEAUTE_781'], $senderUser['username'], $userAlliance, $targetPlanet['name'], $targetPlanet['system'], $targetPlanet['planet'], $targetUser['username'], $ennemAlliance, $senderPlanet['name'], $senderPlanet['system'], $senderPlanet['planet'], $Date, $senderUser['username'], $TextToEcho, $targetUser['username'], $TextToEcho2, count($combatResult['rw']), $senderUser['username'], $TextToEcho3, $targetUser['username'], $TextToEcho4, sprintf($LNG['NOUVEAUTE_812'], $targetUser['username'], $senderUser['username']), $DebrisEcho);
			}elseif($defendStatus == "loos"){
				$Date		   = date("d F Y à H:i", TIMESTAMP);
				$Message = sprintf($LNG['NOUVEAUTE_782'], $targetPlanet['name'], $targetPlanet['system'], $targetPlanet['planet']);
				$messageHTML = sprintf($LNG['NOUVEAUTE_781'], $senderUser['username'], $userAlliance, $targetPlanet['name'], $targetPlanet['system'], $targetPlanet['planet'], $targetUser['username'], $ennemAlliance, $senderPlanet['name'], $senderPlanet['system'], $senderPlanet['planet'], $Date, $senderUser['username'], $TextToEcho, $targetUser['username'], $TextToEcho2, count($combatResult['rw']), $senderUser['username'], $TextToEcho3, $targetUser['username'], $TextToEcho4, sprintf($LNG['NOUVEAUTE_794'], $senderUser['username'], $targetUser['username'], $senderUser['username'], $targetPlanet['name'], $targetPlanet['system'], $targetPlanet['planet'], $ResStealEcho), $DebrisEcho);
			}
			
			$message	= $messageHTML;
			
			SendSimpleMessage($userID, $targetUser['id'], TIMESTAMP, 3, $Message, sprintf($LNG['NOUVEAUTE_786'], $senderUser['username']), $message);
			
			$sqlQuery	.= "INSERT INTO ".TOPKB_USERS." SET ";
			$sqlQuery	.= "rid = '".$raportID."', ";
			$sqlQuery	.= "role = 2, ";
			$sqlQuery	.= "username = '".$GLOBALS['DATABASE']->escape($userName)."', ";
			$sqlQuery	.= "uid = ".$userID.";";
		}
		
		if($this->_fleet['fleet_end_type'] == 3)
		{
			$debrisType	= 'id_luna';
		}
		else
		{
			$debrisType	= 'id';
		}
		
		$sqlQuery	.= "UPDATE ".PLANETS." SET
						der_metal = ".$planetDebris[901].",
						der_crystal = ".$planetDebris[902]."
						WHERE
						".$debrisType." = ".$this->_fleet['fleet_end_id'].";
						UPDATE ".PLANETS." SET
						metal = metal - ".$stealResource[901].",
						crystal = crystal - ".$stealResource[902].",
						deuterium = deuterium - ".$stealResource[903]."
						WHERE
						id = ".$this->_fleet['fleet_end_id'].";
						INSERT INTO ".TOPKB." SET
						units = ".($combatResult['unitLost']['attacker'] + $combatResult['unitLost']['defender']).",
						rid = '".$raportID."',
						time = ".$this->_fleet['fleet_start_time'].",
						universe = ".$this->_fleet['fleet_universe'].",
						result = '".$combatResult['won'] ."';
						UPDATE ".USERS." SET
						".$attackStatus." = ".$attackStatus." + 1,
						kbmetal = kbmetal + ".$debris[901].",
						kbcrystal = kbcrystal + ".$debris[902].",
						lostunits = lostunits + ".$combatResult['unitLost']['attacker'].",
						desunits = desunits + ".$combatResult['unitLost']['defender']."
						WHERE
						id IN (".implode(',', array_keys($userAttack)).");
						UPDATE ".USERS." SET
						".$defendStatus." = ".$defendStatus." + 1,
						kbmetal = kbmetal + ".$debris[901].",
						kbcrystal = kbcrystal + ".$debris[902].",
						lostunits = lostunits + ".$combatResult['unitLost']['defender'].",
						desunits = desunits + ".$combatResult['unitLost']['attacker']."
						WHERE
						id IN (".implode(',', array_keys($userDefend)).");";
						
		$GLOBALS['DATABASE']->multi_query($sqlQuery);
		
		$this->setState(FLEET_RETURN);
		$this->SaveFleet();
	}
	
	function EndStayEvent()
	{
		return;
	}
	
	function ReturnEvent()
	{
		global $resource;
		
		$senderUser	   = $GLOBALS['DATABASE']->getFirstRow("SELECT lang, ally_id FROM ".USERS." WHERE id = ".$this->_fleet['fleet_owner'].";");
		$targetUser	   = $GLOBALS['DATABASE']->getFirstRow("SELECT ally_id, id FROM ".USERS." WHERE id = ".$this->_fleet['fleet_target_owner'].";");
		$senderPlanet  = $GLOBALS['DATABASE']->getFirstRow("SELECT galaxy, system, planet, name FROM ".PLANETS." WHERE id = ".$this->_fleet['fleet_start_id'].";");
		$targetPlanet  = $GLOBALS['DATABASE']->getFirstRow("SELECT galaxy, system, planet, name, id_owner FROM ".PLANETS." WHERE id = ".$this->_fleet['fleet_end_id'].";");
		$userAlliance  = $senderUser['ally_id'] == 0 ? "" : " <span class='orange'>[".$this->getAllianceTag($senderUser['ally_id'])."]</span>";
		$ennemAlliance = $targetUser['ally_id'] == 0 ? "" : " <span class='orange'>[".$this->getAllianceTag($targetUser['ally_id'])."]</span>";
		$fleetData	   = explode(";", $this->_fleet['fleet_array']);
		$fleetData2	   = explode(";", $this->_fleet['specialized_array']);
		$ResourceArray = array(901,902,903,904);
		$PopulatiArray = array(301,302,303,304,305,306,307,308,309);
		
		$LNG		   = new Language($senderUser['lang']);
		$LNG->includeData(array('L18N', 'INGAME', 'TECH', 'CUSTOM'));
		$Var 		   = "<span class=\"vert\">".$LNG['ls_answer_1']."</span>";
		if($this->_fleet['hasCanceled'] != 0)
			$Var = "<span class=\"rouge\">".$LNG['ls_answer_2']."</span>";
		
		$Date		   = date("d F Y à H:i", TIMESTAMP);
		
		$HTML1			= "";
		$HTML2			= "";
		$HTML3			= "";
		
		foreach ($fleetData as $fleetRow)
		{
			if (empty($fleetRow)) continue;
			$temp        = explode (",", $fleetRow);
			$getUserShip = $GLOBALS['DATABASE']->getFirstRow("SELECT nom, image FROM ".VARS_USER." WHERE owerId = ".$this->_fleet['fleet_owner']." AND varId = ".$temp[0].";");
			
			$HTML1 .= "<div class=\"element_item\"><img src=\"".$getUserShip['image']."\">".$getUserShip['nom']." : <span class=\"orange\">".pretty_number($temp[1])."</span> unités</div>";
		}
		
		foreach($PopulatiArray as $popId){
			if($this->_fleet['fleet_population_'.$popId] > 0)
				$HTML2 .= " <div class=\"element_item\"><img src=\"/media/ingame/population/".$popId.".jpg\">".$LNG['tech'][$popId]." : <span class=\"orange\">".pretty_number($this->_fleet['fleet_population_'.$popId])."</span> unités</div>";
		}
		
		foreach ($fleetData2 as $fleetRow)
		{
			if (empty($fleetRow)) continue;
			$temp        = explode (",", $fleetRow);			
			$HTML3 .= "<div class=\"element_item\"><img src=\"/styles/theme/gow/gebaeude/".$temp[0].".gif\">".$LNG['tech'][$temp[0]]." : <span class=\"orange\">".pretty_number($temp[1])."</span> unités</div>";
		}
		
		
		$ReturnMessage = sprintf($LNG['NOUVEAUTE_788'], $senderPlanet['name'], $senderPlanet['system'], $senderPlanet['planet'], $targetPlanet['name'], $targetPlanet['system'], $targetPlanet['planet'], $this->getUsername($targetUser['id']), $ennemAlliance, $Var, $Date, $senderPlanet['name'], $senderPlanet['system'], $senderPlanet['planet'], $HTML1, $HTML2, $HTML3);
		
		SendSimpleMessage($this->_fleet['fleet_owner'], $this->_fleet['fleet_target_owner'], TIMESTAMP, 5, $LNG['NOUVEAUTE_787'], sprintf($LNG['NOUVEAUTE_714'], $senderPlanet['name'], $senderPlanet['system'], $senderPlanet['planet']), $ReturnMessage); 
			
		$this->RestoreFleet();
	}
}
	