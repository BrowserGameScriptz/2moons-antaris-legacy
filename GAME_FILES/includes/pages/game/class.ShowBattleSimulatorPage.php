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
 * @info $Id: class.ShowBattleSimulatorPage.php 2640 2013-03-23 19:23:26Z slaver7 $
 * @link http://2moons.cc/
 */

class ShowBattleSimulatorPage extends AbstractPage 
{
	public static $requireModule = MODULE_SIMULATOR_PORTAL;

	function __construct() 
	{
		parent::__construct();
	}
	
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

	function show()
	{
		global $USER, $PLANET, $reslist, $pricelist, $resource, $LNG, $CONF;
		
		require_once('includes/classes/class.FleetFunctions.php');
		
		$Message 		= "";
		$action			= HTTP::_GP('action', '');
		$Slots			= HTTP::_GP('slots', 1);
		$planetId		= HTTP::_GP('planetId', 0);
		$timeofRa		= HTTP::_GP('timeofRa', 0);
		
		$DefenderUsid	= 2000;
		$DefenderUser	= "Antaris_Bot";
		$DefenderPlan	= "(Planete libre) [***:**]";
		$DefenderPla2	= "(Planete libre)";
		$DefenderRank	= "0";
		$DefenderTime	= TIMESTAMP;
		$DefenderAlly	= "";
		
		$getDefenderI	= $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM ".PLANETS." WHERE id = ".$GLOBALS['DATABASE']->sql_escape($planetId).";");
		
		if(!empty($getDefenderI)){
			$getDefenderR	= $GLOBALS['DATABASE']->getFirstRow("SELECT ally_id FROM ".USERS." WHERE id = ".$getDefenderI['id_owner'].";");
			$getDefenderP	= $GLOBALS['DATABASE']->getFirstRow("SELECT total_points FROM ".STATPOINTS." WHERE id_owner = ".$getDefenderI['id_owner'].";");
			$DefenderUsid	= $getDefenderI['id_owner'];
			$DefenderUser	= $this->getUsername($getDefenderI['id_owner']);
			$DefenderPlan	= $getDefenderI['name']." [".$getDefenderI['system'].":".$getDefenderI['planet']."]";
			$DefenderPla2	= $getDefenderI['name'];
			$DefenderRank	= pretty_number($getDefenderP['total_points']);
			$DefenderTime	= $timeofRa;
			$DefenderAlly	= $getDefenderR['ally_id'] != 0 ? "<span class=\"orange\">[".$this->getAllianceTag($getDefenderR['ally_id'])."]</span>" : "";
		}
		
		if($_SERVER['REQUEST_METHOD'] === 'POST'){
			
			if(!isset($_REQUEST['battleinput'])) {
				$this->redirectTo('game.php?page=battleSimulator');
			}
			
			$BattleArray			= $_REQUEST['battleinput'];
			$elements				= array(0, 0);
			$Sendarray[202]			= 0;
			$Sendarray[203]			= 0;
			
			foreach($BattleArray as $BattleSlotID => $BattleSlot)
			{
				if(isset($BattleSlot[0]) && (array_sum($BattleSlot[0]) > 0 || $BattleSlotID == 0))
				{
					$attacker	= array();
					$attacker['fleetDetail'] 		= array(
						'fleet_start_galaxy' => $PLANET['galaxy'],
						'fleet_start_system' => $PLANET['system'],
						'fleet_start_planet' => $PLANET['planet'], 
						'fleet_start_type' => 1, 
						'fleet_end_galaxy' => empty($getDefenderI) ? 1 : $getDefenderI['galaxy'], 
						'fleet_end_system' => empty($getDefenderI) ? 33 : $getDefenderI['system'], 
						'fleet_end_planet' => empty($getDefenderI) ? 7 : $getDefenderI['planet'],
						'fleet_end_type' => 1, 
						'fleet_resource_metal' => 0,
						'fleet_resource_crystal' => 0,
						'fleet_resource_deuterium' => 0,
						'fleet_resource_elyrium' => 0
					);
					
					$attacker['player']				= array(
						'id' => $USER['id'],
						'username'	=> $USER['username'],
						'military_tech' => $BattleSlot[0][109],
						'defence_tech' => $BattleSlot[0][110],
						'shield_tech' => $BattleSlot[0][111],
						'dm_defensive' => 0,
						'dm_attack' => 0
					); 
					
					$attacker['player']['factor']	= getFactors($attacker['player'], 'attack');
					
					$allowedArray = array(225,306,307);
					$BattleCount  = 0;
					foreach($BattleSlot[0] as $ID => $Count)
					{
						if($ID == 202)
							$Sendarray[202]	+= $Count;
						elseif($ID == 203)
							$Sendarray[203]	+= $Count;
						
						if($ID > 220)
							$BattleCount	   += $Count;
					
						if(!in_array($ID, $allowedArray) || $BattleSlot[0][$ID] <= 0)
						{
							unset($BattleSlot[0][$ID]);
						}
					}
					
					$attacker['unit'] 	= $BattleSlot[0];
					
					$attackers[]	= $attacker;
				}
					
				if(isset($BattleSlot[1]) && (array_sum($BattleSlot[1]) > 0 || $BattleSlotID == 0))
				{
					$defender	= array();
					$defender['fleetDetail'] 		= array(
						'fleet_start_galaxy' => $PLANET['galaxy'],
						'fleet_start_system' => $PLANET['system'],
						'fleet_start_planet' => $PLANET['planet'], 
						'fleet_start_type' => 1, 
						'fleet_end_galaxy' => empty($getDefenderI) ? 1 : $getDefenderI['galaxy'],
						'fleet_end_system' => empty($getDefenderI) ? 33 : $getDefenderI['galaxy'],
						'fleet_end_planet' => empty($getDefenderI) ? 7 : $getDefenderI['galaxy'],
						'fleet_end_type' => 1, 
						'fleet_resource_metal' => 0,
						'fleet_resource_crystal' => 0,
						'fleet_resource_deuterium' => 0,
						'fleet_resource_elyrium' => 0
					);
					
					$defender['player']				= array(
						'id' => $DefenderUsid,
						'username'	=> $DefenderUser,
						'military_tech' => $BattleSlot[1][109],
						'defence_tech' => $BattleSlot[1][110],
						'shield_tech' => $BattleSlot[1][111],
						'dm_attack' => 0,
						'dm_defensive' => 0,
					); 
					
					$defender['player']['factor']	= getFactors($defender['player'], 'attack');
					$allowedArray = array(225,306,307);
					foreach($BattleSlot[1] as $ID => $Count)
					{
						if((!in_array($ID, $allowedArray)) || $BattleSlot[1][$ID] <= 0)
						{
							unset($BattleSlot[1][$ID]);
						}
					}
					
					$defender['unit'] 	= $BattleSlot[1];
					$defenders[]	= $defender;
				}
			}
			
			if($BattleCount == 0){
				$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_708']."</span>";
				$Message = '<div id="attaquer_portail" class="formulaire_mission categorie"><h2>'.$LNG['NOUVEAUTE_547'].'</h2><div name="formulaire_envoyer"><!-- Les liens pour revenir sur le menu ou sur la mission --><div class="retour_menu"><< <a href="game.php?page=battleSimulator">'.$LNG['NOUVEAUTE_833'].'</a></div><!-- On affiche le message renvoyé par le formulaire -->'.$Message.'</div></div>';
				$this->tplObj->assign_vars(array(
					'Message'		=> $Message,
				));
				
				$this->display('page.battleSimulator.default.tpl');   
				die();
			}
				
			require_once('includes/classes/missions/calculateAttack.php');
			$combatResult	= calculateAttack($attackers, $defenders, 0, 0, $Sendarray[202], $Sendarray[203]);
			
			if($combatResult['won'] == "a")
			{
				require_once('includes/classes/missions/calculateStealPortal.php');
				$stealResource = calculateStealPortal($attackers, array(
					'metal' => $BattleArray[0][1][901],
					'crystal' => $BattleArray[0][1][902],
					'deuterium' => $BattleArray[0][1][903],
					'elyrium' => $BattleArray[0][1][904]
				), true, $combatResult['Small'], $combatResult['Large']);
			}
			else
			{
				$stealResource = array(
					901 => 0,
					902 => 0,
					903 => 0,
					904 => 0
				);
			}
			
			$raportInfo	= array(
				'thisFleet'				=> array(
					'fleet_start_galaxy'	=> $PLANET['galaxy'],
					'fleet_start_system'	=> $PLANET['system'],
					'fleet_start_planet'	=> $PLANET['planet'],
					'fleet_start_type'		=> 1,
					'fleet_end_galaxy' => empty($getDefenderI) ? 1 : $getDefenderI['galaxy'],
					'fleet_end_system' => empty($getDefenderI) ? 33 : $getDefenderI['galaxy'],
					'fleet_end_planet' => empty($getDefenderI) ? 7 : $getDefenderI['galaxy'],
					'fleet_end_type'		=> 1,
					'fleet_start_time'		=> TIMESTAMP,
				),
				'stealResource'			=> $stealResource,
				'moonDestroy'			=> false,
				'moonName'				=> null,
				'moonDestroyChance'		=> null,
				'moonDestroySuccess'	=> null,
				'fleetDestroyChance'	=> null,
				'fleetDestroySuccess'	=> null,
			);
			
			require_once('includes/classes/missions/GenerateReport.php');
			$raportData	= GenerateReport($combatResult, $raportInfo);	
				
			switch($combatResult['won'])
			{
				case "a":
					$attackStatus	= 'wons';
					$defendStatus	= 'loos';
					$attackClass	= $LNG['NOUVEAUTE_773'];
					$defendClass	= $LNG['NOUVEAUTE_774'];
					$attackColor	= "vert";
					$defendColor	= "rouge";
					$WinnerId		= $attacker['player']['id'];
					$LoserId		= $defender['player']['id'];
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
					$attackClass	= $LNG['NOUVEAUTE_774'];
					$defendClass	= $LNG['NOUVEAUTE_773'];
					$WinnerId		= $defender['player']['id'];
					$LoserId		= $attacker['player']['id'];
					$attackColor	= "rouge";
					$defendColor	= "vert";
				break;
			}
			
			$raportID	= md5(uniqid('', true).TIMESTAMP);
				
			$sqlQuery	= "INSERT INTO ".RW." SET rid = '".$raportID."', raport = '".$GLOBALS['DATABASE']->sql_escape(serialize($raportData))."', time = ".TIMESTAMP.";";
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
				
			if(!isset($Raport)) {
				$this->printMessage($LNG['sys_raport_not_found']);
			}
			
			$CombatRaport			= unserialize($Raport['raport']);
			$CombatRaport['time']	= _date($LNG['php_tdformat'], $CombatRaport['time'], $USER['timezone']);
			$CombatRaport			= $this->BCWrapperPreRev2321($CombatRaport);
			$Raport					= $CombatRaport;
			$TextToEcho				= "";			
			$TextToEcho2			= "";			
			$TextToEcho3			= "";
			$TextToEcho4			= "";
			$TextToEcho5			= "";
			$TextToEcho6			= "";
			
			$UserOShips[225]		= 0;
			$UserOShips[306]		= 0;
			$UserOShips[307]		= 0;
			
			$TargetShips[225]		= 0;
			$TargetShips[306]		= 0;
			$TargetShips[307]		= 0;
			if ($combatResult['won'] == "a"){
				//WIN 0 ROUND MESSAGE		
				foreach($stealResource as $ResId => $Count){
					$TextToEcho3 .= "- <span style=\"display : inline-block; width : 80px; text-align : left;\">".$LNG['tech'][$ResId]." :</span> 
					<span style=\"display : inline-block; width : 120px; text-align : left;\" class=\"orange\">".pretty_number($Count)."</span><br>";
				}
				
				foreach($Raport['rounds'] as $Round => $RoundInfo){
					$i = key(end($RoundInfo));
					if($Round == 0){
						foreach($RoundInfo['attacker'] as $Player){
							$PlayerInfo = $Raport['players'][$Player['userID']];
							if(!empty($Player['ships'])){
								foreach($Player['ships'] as $ShipID => $ShipData){
									$TextToEcho .= "<tr>
										<td>".$LNG['shortNames'][$ShipID]."</td>
										<td>".pretty_number($ShipData[1])."</td>
										<td>".pretty_number($ShipData[2])."</td>
										<td>".pretty_number($ShipData[3])."</td>
										<td>".pretty_number($ShipData[0])."</td>
									</tr>";
									$UserOShips[$ShipID] = $ShipData[0];
								}
							}else{
								$TextToEcho = "<tr><td colspan='5'>The attacker has no army on this planet</td></tr>";
							}
							
						}
						
						foreach($RoundInfo['defender'] as $Player){
							$PlayerInfo = $Raport['players'][$Player['userID']];
							if(!empty($Player['ships'])){
								foreach($Player['ships'] as $ShipID => $ShipData){
									$TextToEcho2 .= "<tr>
										<td>".$LNG['shortNames'][$ShipID]."</td>
										<td>".pretty_number($ShipData[1])."</td>
										<td>".pretty_number($ShipData[2])."</td>
										<td>".pretty_number($ShipData[3])."</td>
										<td>".pretty_number($ShipData[0])."</td>
									</tr>";
									$TargetShips[$ShipID] = $ShipData[0];
								}
							}else{
								$TextToEcho2 = "<tr><td colspan='5'><center>".$LNG['NOUVEAUTE_777']."</center></td></tr>";
							}
							
						}
					}
					
					if($Round == (count($combatResult['rw']) -1)){
						foreach($RoundInfo['attacker'] as $Player){
							$PlayerInfo = $Raport['players'][$Player['userID']];
							if(!empty($Player['ships'])){
								$ShipsArray = array(225,306,307);
								foreach($ShipsArray as $Ship){
									$insideId = 0;
									foreach($Player['ships'] as $ShipID => $ShipData){
										if($ShipID == $Ship){
											$insideId = 1;
											$TextColor	= ($UserOShips[$ShipID] - $ShipData[0]) > 0 ? "rouge" : "orange";
											$TextSign	= $TextColor == "rouge" ? "-" : "";
											$TextToEcho5 .= "<tr>
																<td>".$LNG['shortNames'][$ShipID]."</td>
																<td>".pretty_number($ShipData[0])."</td>
																<td class=\"".$TextColor."\">".$TextSign."".pretty_number($UserOShips[$ShipID] - $ShipData[0])."</td>
															</tr>";
										}
									}
									if($insideId == 0){
										$TextToEcho5 .= "<tr>
																<td>".$LNG['shortNames'][$Ship]."</td>
																<td>0</td>
																<td class=\"orange\">0</td>
															</tr>";
									}
								}
							}else{
								$ShipsArray = array(225,306,307);
								foreach($ShipsArray as $ShipID){
									$TextColor	= $UserOShips[$ShipID] > 0 ? "rouge" : "orange";
									$TextSign	= $TextColor == "rouge" ? "-" : "";
									$TextToEcho5 .= "<tr>
														<td>".$LNG['shortNames'][$ShipID]."</td>
														<td>0</td>
														<td class=\"".$TextColor."\">".$TextSign."".pretty_number($UserOShips[$ShipID])."</td>
													</tr>";
								}
							}
						}
							
						foreach($RoundInfo['defender'] as $Player){
							$PlayerInfo = $Raport['players'][$Player['userID']];
							if(!empty($Player['ships'])){
								$ShipsArray = array(225,306,307);
								foreach($ShipsArray as $Ship){
									$insideId = 0;
									foreach($Player['ships'] as $ShipID => $ShipData){
										if($ShipID == $Ship){
											$insideId = 1;
											$TextColor	= ($TargetShips[$ShipID] - $ShipData[0]) > 0 ? "rouge" : "orange";
											$TextSign	= $TextColor == "rouge" ? "-" : "";
											$TextToEcho6 .= "<tr>
																<td>".$LNG['shortNames'][$ShipID]."</td>
																<td>".pretty_number($ShipData[0])."</td>
																<td class=\"".$TextColor."\">".$TextSign."".pretty_number($TargetShips[$ShipID] - $ShipData[0])."</td>
															</tr>";
										}
									}
									if($insideId == 0){
										$TextToEcho6 .= "<tr>
																<td>".$LNG['shortNames'][$Ship]."</td>
																<td>0</td>
																<td class=\"orange\">0</td>
															</tr>";
									}
								}
							}else{
								$ShipsArray = array(225,306,307);
								foreach($ShipsArray as $ShipID){
									$TextColor	= $TargetShips[$ShipID] > 0 ? "rouge" : "orange";
									$TextSign	= $TextColor == "rouge" ? "-" : "";
									$TextToEcho6 .= "<tr>
														<td>".$LNG['shortNames'][$ShipID]."</td>
														<td>0</td>
														<td class=\"".$TextColor."\">".$TextSign."".pretty_number($TargetShips[$ShipID])."</td>
													</tr>";
								}
							}
						}
					}
				}
				
				$userAlliance	 = $USER['ally_id'] == 0 ? "" : " <span class='orange'>[".$this->getAllianceTag($USER['ally_id'])."]</span>";
				$ennemieAlliance = (empty($getDefenderI) || $getDefenderR['ally_id'] == 0) ? "" : " <span class='orange'>[".$this->getAllianceTag($getDefenderR['ally_id'])."]</span>";
				
				$MessageSend = sprintf($LNG['NOUVEAUTE_772'], $USER['username'], $userAlliance, $DefenderPla2, $raportInfo['thisFleet']['fleet_end_system'], $raportInfo['thisFleet']['fleet_end_planet'], $DefenderUser, $ennemieAlliance, $PLANET['name'], $PLANET['system'], $PLANET['planet'], $USER['username'], $TextToEcho, $DefenderUser, $TextToEcho2, $this->getUsername($WinnerId), $this->getUsername($LoserId), $attackColor, $USER['username'], $attackClass, $defendColor, $DefenderUser, $defendClass, sprintf($LNG['NOUVEAUTE_775'], $USER['username']), $TextToEcho3, "", "", $USER['username'], $TextToEcho5, $DefenderUser, $TextToEcho6);
				$MessageSend2 = $MessageSend;				
				$Message = "".sprintf($LNG['NOUVEAUTE_834'], $DefenderPla2, $raportInfo['thisFleet']['fleet_end_system'], $raportInfo['thisFleet']['fleet_end_planet'], $DefenderUser)."<b>Rapport de combat :</b><div name=\"rapport_attaque\" style=\"width : 90%; margin : 20px auto;\"><div name=\"attaque_portail\" class=\"conteneur_message\">".$MessageSend2."</div></div>";
				$Message = '<div id="attaquer_portail" class="formulaire_mission categorie"><h2>'.$LNG['NOUVEAUTE_547'].'</h2><div name="formulaire_envoyer"><!-- Les liens pour revenir sur le menu ou sur la mission --><div class="retour_menu"><< <a href="game.php?page=battleSimulator">'.$LNG['NOUVEAUTE_833'].'</a></div><!-- On affiche le message renvoyé par le formulaire -->'.$Message.'</div></div>';
			}elseif ($combatResult['won'] == "w"){
				//DRAW 0 ROUND MESSAGE		
				foreach($stealResource as $ResId => $Count){
					$TextToEcho3 .= "- <span style=\"display : inline-block; width : 80px; text-align : left;\">".$LNG['tech'][$ResId]." :</span> 
					<span style=\"display : inline-block; width : 120px; text-align : left;\" class=\"orange\">".pretty_number($Count)."</span><br>";
				}
				
				foreach($Raport['rounds'] as $Round => $RoundInfo){
					$i = key(end($RoundInfo));
					if($Round == 0){
						foreach($RoundInfo['attacker'] as $Player){
							$PlayerInfo = $Raport['players'][$Player['userID']];
							if(!empty($Player['ships'])){
								foreach($Player['ships'] as $ShipID => $ShipData){
									$TextToEcho .= "<tr>
										<td>".$LNG['shortNames'][$ShipID]."</td>
										<td>".pretty_number($ShipData[1])."</td>
										<td>".pretty_number($ShipData[2])."</td>
										<td>".pretty_number($ShipData[3])."</td>
										<td>".pretty_number($ShipData[0])."</td>
									</tr>";
									$UserOShips[$ShipID] = $ShipData[0];
								}
							}else{
								$TextToEcho = "<tr><td colspan='5'>The attacker has no army on this planet</td></tr>";
							}
							
						}
						
						foreach($RoundInfo['defender'] as $Player){
							$PlayerInfo = $Raport['players'][$Player['userID']];
							if(!empty($Player['ships'])){
								foreach($Player['ships'] as $ShipID => $ShipData){
									$TextToEcho2 .= "<tr>
										<td>".$LNG['shortNames'][$ShipID]."</td>
										<td>".pretty_number($ShipData[1])."</td>
										<td>".pretty_number($ShipData[2])."</td>
										<td>".pretty_number($ShipData[3])."</td>
										<td>".pretty_number($ShipData[0])."</td>
									</tr>";
									$TargetShips[$ShipID] = $ShipData[0];
								}
							}else{
								$TextToEcho2 = "<tr><td colspan='5'><center>".$LNG['NOUVEAUTE_777']."</center></td></tr>";
							}
							
						}
					}
					
					if($Round == (count($combatResult['rw']) -1)){
						foreach($RoundInfo['attacker'] as $Player){
							$PlayerInfo = $Raport['players'][$Player['userID']];
							if(!empty($Player['ships'])){
								$ShipsArray = array(225,306,307);
								foreach($ShipsArray as $Ship){
									$insideId = 0;
									foreach($Player['ships'] as $ShipID => $ShipData){
										if($ShipID == $Ship){
											$insideId = 1;
											$TextColor	= ($UserOShips[$ShipID] - $ShipData[0]) > 0 ? "rouge" : "orange";
											$TextSign	= $TextColor == "rouge" ? "-" : "";
											$TextToEcho5 .= "<tr>
																<td>".$LNG['shortNames'][$ShipID]."</td>
																<td>".pretty_number($ShipData[0])."</td>
																<td class=\"".$TextColor."\">".$TextSign."".pretty_number($UserOShips[$ShipID] - $ShipData[0])."</td>
															</tr>";
										}
									}
									if($insideId == 0){
										$TextToEcho5 .= "<tr>
																<td>".$LNG['shortNames'][$Ship]."</td>
																<td>0</td>
																<td class=\"orange\">0</td>
															</tr>";
									}
								}
							}else{
								$ShipsArray = array(225,306,307);
								foreach($ShipsArray as $ShipID){
									$TextColor	= $UserOShips[$ShipID] > 0 ? "rouge" : "orange";
									$TextSign	= $TextColor == "rouge" ? "-" : "";
									$TextToEcho5 .= "<tr>
														<td>".$LNG['shortNames'][$ShipID]."</td>
														<td>0</td>
														<td class=\"".$TextColor."\">".$TextSign."".pretty_number($UserOShips[$ShipID])."</td>
													</tr>";
								}
							}
							
						}
						
						foreach($RoundInfo['defender'] as $Player){
							$PlayerInfo = $Raport['players'][$Player['userID']];
							if(!empty($Player['ships'])){
								$ShipsArray = array(225,306,307);
								foreach($ShipsArray as $Ship){
									$insideId = 0;
									foreach($Player['ships'] as $ShipID => $ShipData){
										if($ShipID == $Ship){
											$insideId = 1;
											$TextColor	= ($TargetShips[$ShipID] - $ShipData[0]) > 0 ? "rouge" : "orange";
											$TextSign	= $TextColor == "rouge" ? "-" : "";
											$TextToEcho6 .= "<tr>
																<td>".$LNG['shortNames'][$ShipID]."</td>
																<td>".pretty_number($ShipData[0])."</td>
																<td class=\"".$TextColor."\">".$TextSign."".pretty_number($TargetShips[$ShipID] - $ShipData[0])."</td>
															</tr>";
										}
									}
									
									if($insideId == 0){
										$TextToEcho6 .= "<tr>
																<td>".$LNG['shortNames'][$Ship]."</td>
																<td>0</td>
																<td class=\"orange\">0</td>
															</tr>";
									}
								}
							}else{
								$ShipsArray = array(225,306,307);
								foreach($ShipsArray as $ShipID){
									$TextColor	= $TargetShips[$ShipID] > 0 ? "rouge" : "orange";
									$TextSign	= $TextColor == "rouge" ? "-" : "";
									$TextToEcho6 .= "<tr>
														<td>".$LNG['shortNames'][$ShipID]."</td>
														<td>0</td>
														<td class=\"".$TextColor."\">".$TextSign."".pretty_number($TargetShips[$ShipID])."</td>
													</tr>";
								}
							}
							
						}
					}
					//$i++;
				}
				
				$userAlliance	 = $USER['ally_id'] == 0 ? "" : " <span class='orange'>[".$this->getAllianceTag($USER['ally_id'])."]</span>";
				$ennemieAlliance = (empty($getDefenderI) || $getDefenderR['ally_id'] == 0) ? "" : " <span class='orange'>[".$this->getAllianceTag($getDefenderR['ally_id'])."]</span>";
				
				$MessageSend = sprintf($LNG['NOUVEAUTE_779'], $USER['username'], $userAlliance, $DefenderPla2, $raportInfo['thisFleet']['fleet_end_system'], $raportInfo['thisFleet']['fleet_end_planet'], $DefenderUser, $ennemieAlliance, $PLANET['name'], $PLANET['system'], $PLANET['planet'], $USER['username'], $TextToEcho, $DefenderUser, $TextToEcho2, $USER['username'], $USER['username'], $DefenderUser, $USER['username'], $TextToEcho5, $DefenderUser, $TextToEcho6);
				$MessageSend2 = $MessageSend;
				$Message = "".sprintf($LNG['NOUVEAUTE_834'], $DefenderPla2, $raportInfo['thisFleet']['fleet_end_system'], $raportInfo['thisFleet']['fleet_end_planet'], $DefenderUser)."<b>Rapport de combat :</b><div name=\"rapport_attaque\" style=\"width : 90%; margin : 20px auto;\"><div name=\"attaque_portail\" class=\"conteneur_message\">".$MessageSend2."</div></div>";
				$Message = '<div id="attaquer_portail" class="formulaire_mission categorie"><h2>'.$LNG['NOUVEAUTE_547'].'</h2><div name="formulaire_envoyer"><!-- Les liens pour revenir sur le menu ou sur la mission --><div class="retour_menu"><< <a href="game.php?page=battleSimulator">'.$LNG['NOUVEAUTE_833'].'</a></div><!-- On affiche le message renvoyé par le formulaire -->'.$Message.'</div></div>';
			}elseif ($combatResult['won'] == "r"){
				//LOSE 0 ROUND MESSAGE
				$userAlliance	 = $USER['ally_id'] == 0 ? "" : " <span class='orange'>[".$this->getAllianceTag($USER['ally_id'])."]</span>";
				$ennemieAlliance = (empty($getDefenderI) || $getDefenderR['ally_id'] == 0) ? "" : " <span class='orange'>[".$this->getAllianceTag($getDefenderR['ally_id'])."]</span>";
				
				$TextToEcho				= "";			
				$TextToEcho2			= "";	
				$TextToEcho5			= "";
				$TextToEcho6			= "";	
				
				foreach($Raport['rounds'] as $Round => $RoundInfo){
					$i = key(end($RoundInfo));
					if($Round == 0){
						foreach($RoundInfo['attacker'] as $Player){
							$PlayerInfo = $Raport['players'][$Player['userID']];
							if(!empty($Player['ships'])){
								
								foreach($Player['ships'] as $ShipID => $ShipData){
									$TextToEcho .= "<tr>
										<td>".$LNG['shortNames'][$ShipID]."</td>
										<td>".pretty_number($ShipData[1])."</td>
										<td>".pretty_number($ShipData[2])."</td>
										<td>".pretty_number($ShipData[3])."</td>
										<td>".pretty_number($ShipData[0])."</td>
									</tr>";
									$UserOShips[$ShipID] = $ShipData[0];
								}
							}else{
								$TextToEcho = "<tr><td colspan='5'>The attacker has no army on this planet</td></tr>";
							}
							
						}
						
						foreach($RoundInfo['defender'] as $Player){
							$PlayerInfo = $Raport['players'][$Player['userID']];
							if(!empty($Player['ships'])){
								
								foreach($Player['ships'] as $ShipID => $ShipData){
									$TextToEcho2 .= "<tr>
										<td>".$LNG['shortNames'][$ShipID]."</td>
										<td>".pretty_number($ShipData[1])."</td>
										<td>".pretty_number($ShipData[2])."</td>
										<td>".pretty_number($ShipData[3])."</td>
										<td>".pretty_number($ShipData[0])."</td>
									</tr>";
									$TargetShips[$ShipID] = $ShipData[0];
								}
							}else{
								$TextToEcho2 = "<tr><td colspan='5'><center>".$LNG['NOUVEAUTE_777']."</center></td></tr>";
							}
							
						}
					}
					
					if($Round == (count($combatResult['rw']) -1)){
						foreach($RoundInfo['attacker'] as $Player){
							$PlayerInfo = $Raport['players'][$Player['userID']];
							if(!empty($Player['ships'])){
								
								$ShipsArray = array(225,306,307);
								foreach($ShipsArray as $Ship){
									$insideId = 0;
									foreach($Player['ships'] as $ShipID => $ShipData){
										if($ShipID == $Ship){
											$insideId = 1;
											$TextColor	= ($UserOShips[$ShipID] - $ShipData[0]) > 0 ? "rouge" : "orange";
											$TextSign	= $TextColor == "rouge" ? "-" : "";
											$TextToEcho5 .= "<tr>
																<td>".$LNG['shortNames'][$ShipID]."</td>
																<td>".pretty_number($ShipData[0])."</td>
																<td class=\"".$TextColor."\">".$TextSign."".pretty_number($UserOShips[$ShipID] - $ShipData[0])."</td>
															</tr>";
										}
									}
									
									if($insideId == 0){
										$TextToEcho5 .= "<tr>
																<td>".$LNG['shortNames'][$Ship]."</td>
																<td>0</td>
																<td class=\"orange\">0</td>
															</tr>";
									}
								}
							}else{
								$ShipsArray = array(225,306,307);
								foreach($ShipsArray as $ShipID){
									$TextColor	= $UserOShips[$ShipID] > 0 ? "rouge" : "orange";
									$TextSign	= $TextColor == "rouge" ? "-" : "";
									$TextToEcho5 .= "<tr>
														<td>".$LNG['shortNames'][$ShipID]."</td>
														<td>0</td>
														<td class=\"".$TextColor."\">".$TextSign."".pretty_number($UserOShips[$ShipID])."</td>
													</tr>";
								}
							}
							
						}
						
						foreach($RoundInfo['defender'] as $Player){
							$PlayerInfo = $Raport['players'][$Player['userID']];
							if(!empty($Player['ships'])){
								
								$ShipsArray = array(225,306,307);
								foreach($ShipsArray as $Ship){
									$insideId = 0;
									foreach($Player['ships'] as $ShipID => $ShipData){
										if($ShipID == $Ship){
											$insideId = 1;
											$TextColor	= ($TargetShips[$ShipID] - $ShipData[0]) > 0 ? "rouge" : "orange";
											$TextSign	= $TextColor == "rouge" ? "-" : "";
											$TextToEcho6 .= "<tr>
																<td>".$LNG['shortNames'][$ShipID]."</td>
																<td>".pretty_number($ShipData[0])."</td>
																<td class=\"".$TextColor."\">".$TextSign."".pretty_number($TargetShips[$ShipID] - $ShipData[0])."</td>
															</tr>";
										}
									}
									if($insideId == 0){
										$TextToEcho6 .= "<tr>
																<td>".$LNG['shortNames'][$Ship]."</td>
																<td>0</td>
																<td class=\"orange\">0</td>
															</tr>";
									}
								}
							}else{
								$ShipsArray = array(225,306,307);
								foreach($ShipsArray as $ShipID){
									
									$TextColor	= $TargetShips[$ShipID] > 0 ? "rouge" : "orange";
									$TextSign	= $TextColor == "rouge" ? "-" : "";
									$TextToEcho6 .= "<tr>
														<td>".$LNG['shortNames'][$ShipID]."</td>
														<td>0</td>
														<td class=\"".$TextColor."\">".$TextSign."".pretty_number($TargetShips[$ShipID])."</td>
													</tr>";
								}
							}
							
						}
					}
					//$i++;
				}
				
				$TransporterId = array(202,203);
					
				foreach($TransporterId as $id){
					$TextToEcho4 .= "- <span style=\"display : inline-block; width : 140px; text-align : left;\">".$LNG['tech'][$id]." :</span> 
					<span style=\"display : inline-block; width : 60px; text-align : left;\" class=\"orange\">".pretty_number($Sendarray[$id])."</span><br>";
				}
				
				$MessageSend = sprintf($LNG['NOUVEAUTE_772'], $USER['username'], $userAlliance, $DefenderPla2, $raportInfo['thisFleet']['fleet_end_system'], $raportInfo['thisFleet']['fleet_end_planet'], $DefenderUser, $ennemieAlliance, $PLANET['name'], $PLANET['system'], $PLANET['planet'], $USER['username'], $TextToEcho, $DefenderUser, $TextToEcho2, $this->getUsername($WinnerId), $this->getUsername($LoserId), $attackColor, $USER['username'], $attackClass, $defendColor, $DefenderUser, $defendClass, "", $TextToEcho3, sprintf($LNG['NOUVEAUTE_776'], $DefenderUser), $TextToEcho4, $USER['username'], $TextToEcho5, $DefenderUser, $TextToEcho6);
				$MessageSend2 = $MessageSend;
				$Message = "".sprintf($LNG['NOUVEAUTE_834'], $DefenderPla2, $raportInfo['thisFleet']['fleet_end_system'], $raportInfo['thisFleet']['fleet_end_planet'], $DefenderUser)."<b>Rapport de combat :</b><div name=\"rapport_attaque\" style=\"width : 90%; margin : 20px auto;\"><div name=\"attaque_portail\" class=\"conteneur_message\">".$MessageSend2."</div></div>";
				$Message = '<div id="attaquer_portail" class="formulaire_mission categorie"><h2>'.$LNG['NOUVEAUTE_547'].'</h2><div name="formulaire_envoyer"><!-- Les liens pour revenir sur le menu ou sur la mission --><div class="retour_menu"><< <a href="game.php?page=battleSimulator">'.$LNG['NOUVEAUTE_833'].'</a></div><!-- On affiche le message renvoyé par le formulaire -->'.$Message.'</div></div>';
					
			}
		}
		
		$BattleArray	= array();
		$BattleArray[0][0][109]	= $USER[$resource[109]];
		$BattleArray[0][0][110]	= $USER[$resource[110]];
		$BattleArray[0][0][111]	= $USER[$resource[111]];
		
		$avaible_fleets = array(202,203,225,306,307);
		if(empty($_REQUEST['battleinput']))
		{
			$avaible_fleets = array(202,203,225,306,307);
			foreach($avaible_fleets as $ID)
			{
				if(FleetFunctions::GetFleetMaxSpeed($ID, $USER) > 0)
				{
					// Add just flyable elements
					$BattleArray[0][0][$ID]	= $PLANET[$resource[$ID]];
				}
			}
		}
		
		if(isset($_REQUEST['battleinput']))
		{
			$BattleArray	= $_REQUEST['battleinput'];
		}
		
		if(isset($_REQUEST['im']))
		{
			foreach($_REQUEST['im'] as $ID => $Count)
			{
				$BattleArray[0][1][$ID]	= floattostring($Count);
			}
		}

		
		$this->tplObj->loadscript('battlesim.js');
		
		$this->tplObj->assign_vars(array(
			'Slots'			=> $Slots,
			'battleinput'	=> $BattleArray,
			'fleetList'		=> $avaible_fleets,
			'DefenderUser'	=> $DefenderUser,
			'DefenderPlan'	=> $DefenderPlan,
			'DefenderRank'	=> $DefenderRank,
			'DefenderAlly'	=> $DefenderAlly,
			'Message'		=> $Message,
			'DefenderTime'	=> date('d/m/y à H:i', $DefenderTime),
		));
		
		$this->display('page.battleSimulator.default.tpl');   
	}
}
