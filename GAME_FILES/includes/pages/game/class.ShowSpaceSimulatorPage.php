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

class ShowSpaceSimulatorPage extends AbstractPage 
{
	public static $requireModule = MODULE_SIMULATOR_SPACE;

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
		
		/* $allowedArray = array(1,2);
		if(!in_array($USER['id'], $allowedArray)){
			$this->printMessage('This page is being repaired by the team. / Cette page et en reparation chez les administrateurs.', true, array('game.php?page=overview', 2));
			die();
		} */ 
		
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
		$DefenderId		= 0;
		
		$getDefenderI	= $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM ".PLANETS." WHERE id = ".$GLOBALS['DATABASE']->sql_escape($planetId).";");
		
		if(!empty($getDefenderI)){
			$getDefenderR	= $GLOBALS['DATABASE']->getFirstRow("SELECT ally_id, id FROM ".USERS." WHERE id = ".$getDefenderI['id_owner'].";");
			$getDefenderP	= $GLOBALS['DATABASE']->getFirstRow("SELECT total_points FROM ".STATPOINTS." WHERE id_owner = ".$getDefenderI['id_owner'].";");
			$DefenderUsid	= $getDefenderI['id_owner'];
			$DefenderUser	= $this->getUsername($getDefenderI['id_owner']);
			$DefenderPlan	= $getDefenderI['name']." [".$getDefenderI['system'].":".$getDefenderI['planet']."]";
			$DefenderPla2	= $getDefenderI['name'];
			$DefenderRank	= pretty_number($getDefenderP['total_points']);
			$DefenderTime	= $timeofRa;
			$DefenderId		= $getDefenderR['id'];
			$DefenderAlly	= $getDefenderR['ally_id'] != 0 ? "<span class=\"orange\">[".$this->getAllianceTag($getDefenderR['ally_id'])."]</span>" : "";
		}
		
		if($_SERVER['REQUEST_METHOD'] === 'POST'){
			
			if(!isset($_REQUEST['battleinput'])) {
				$this->redirectTo('game.php?page=battleSimulator');
			}
			
			$BattleArray			= $_REQUEST['battleinput'];
			$elements				= array(0, 0);
			$BattleCount			= 0;
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
					
					$BattleCount  = 0;
					foreach($BattleSlot[0] as $ID => $Count)
					{
						if($BattleSlot[0][$ID] <= 0)
						{
							unset($BattleSlot[0][$ID]);
							continue;
						}
						$BattleCount += $Count;
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
					foreach($BattleSlot[1] as $ID => $Count)
					{
						if($BattleSlot[1][$ID] <= 0)
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
				$Message = '<div id="attaquer_portail" class="formulaire_mission categorie"><h2>'.$LNG['NOUVEAUTE_547'].'</h2><div name="formulaire_envoyer"><!-- Les liens pour revenir sur le menu ou sur la mission --><div class="retour_menu"><< <a href="game.php?page=spaceSimulator">'.$LNG['NOUVEAUTE_833'].'</a></div><!-- On affiche le message renvoyé par le formulaire -->'.$Message.'</div></div>';
				$this->tplObj->assign_vars(array(
					'Message'		=> $Message,
				));
				
				$this->display('page.battleSimulator.default.tpl');   
				die();
			}
			
			$fleetIntoDebris	= $GLOBALS['CONFIG'][1]['Fleet_Cdr'];
			$defIntoDebris		= $GLOBALS['CONFIG'][1]['Defs_Cdr'];
		
			require_once('includes/classes/missions/calculateAttackSpace.php');
			$combatResult	= calculateAttackSpace($attackers, $defenders, $fleetIntoDebris, $defIntoDebris, 0);
			
			if($combatResult['won'] == "a")
			{
				require_once('includes/classes/missions/calculateSteal.php');
				$stealResource = calculateSteal($attackers, array(
					'metal' => $BattleArray[0][1][901],
					'crystal' => $BattleArray[0][1][902],
					'deuterium' => $BattleArray[0][1][903],
					'elyrium' => $BattleArray[0][1][904]
				), true);
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
			
			$debris	= array();
		
			foreach(array(901, 902, 903, 904) as $elementID)
			{
				$debris[$elementID]			= $combatResult['debris']['attacker'][$elementID] + $combatResult['debris']['defender'][$elementID];
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
				'debris'				=> $debris,
				'stealResource'			=> $stealResource,
				'moonChance'			=> 0,
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
			
			$userAlliance	 = $USER['ally_id'] == 0 ? "" : " <span class='orange'>[".$this->getAllianceTag($USER['ally_id'])."]</span>";
			$ennemieAlliance = (empty($getDefenderI) || $getDefenderR['ally_id'] == 0) ? "" : " <span class='orange'>[".$this->getAllianceTag($getDefenderR['ally_id'])."]</span>";
				
			if($attackStatus == "wons"){
				$Date		   = date("d F Y à H:i", TIMESTAMP);
				$messageHTML = sprintf($LNG['NOUVEAUTE_781'], $USER['username'], $userAlliance, $DefenderPla2, $raportInfo['thisFleet']['fleet_end_system'], $raportInfo['thisFleet']['fleet_end_planet'], $DefenderUser, $ennemieAlliance, $PLANET['name'], $PLANET['system'], $PLANET['planet'], $Date, $USER['username'], $TextToEcho, $DefenderUser, $TextToEcho2, count($combatResult['rw']), $USER['username'], $TextToEcho3, $DefenderUser, $TextToEcho4, sprintf($LNG['NOUVEAUTE_794'], $USER['username'], $DefenderUser, $USER['username'], $DefenderPla2, $raportInfo['thisFleet']['fleet_end_system'], $raportInfo['thisFleet']['fleet_end_planet'], $ResStealEcho), $DebrisEcho);
			}elseif($attackStatus == "draws"){
				$Date		   = date("d F Y à H:i", TIMESTAMP);
				$messageHTML = sprintf($LNG['NOUVEAUTE_781'], $USER['username'], $userAlliance, $DefenderPla2, $raportInfo['thisFleet']['fleet_end_system'], $raportInfo['thisFleet']['fleet_end_planet'], $DefenderUser, $ennemieAlliance, $PLANET['name'], $PLANET['system'], $PLANET['planet'], $Date, $USER['username'], $TextToEcho, $DefenderUser, $TextToEcho2, count($combatResult['rw']), $USER['username'], $TextToEcho3, $DefenderUser, $TextToEcho4, sprintf($LNG['NOUVEAUTE_812'], $DefenderUser, $USER['username']), $DebrisEcho);
			}elseif($attackStatus == "loos"){
				$Date		   = date("d F Y à H:i", TIMESTAMP);
				$messageHTML = sprintf($LNG['NOUVEAUTE_781'], $USER['username'], $userAlliance, $DefenderPla2, $raportInfo['thisFleet']['fleet_end_system'], $raportInfo['thisFleet']['fleet_end_planet'], $DefenderUser, $ennemieAlliance, $PLANET['name'], $PLANET['system'], $PLANET['planet'], $Date, $USER['username'], $TextToEcho, $DefenderUser, $TextToEcho2, count($combatResult['rw']), $USER['username'], $TextToEcho3, $DefenderUser, $TextToEcho4, sprintf($LNG['NOUVEAUTE_793'], $DefenderUser, $USER['username']), $DebrisEcho);
			}
			
			$MessageSend2 = $messageHTML;				
			$Message = "".sprintf($LNG['NOUVEAUTE_834'], $DefenderPla2, $raportInfo['thisFleet']['fleet_end_system'], $raportInfo['thisFleet']['fleet_end_planet'], $DefenderUser)."<b>Rapport de combat :</b><div name=\"rapport_attaque\" style=\"width : 90%; margin : 20px auto;\"><div name=\"attaque_spatial\" class=\"conteneur_message\">".$MessageSend2."</div></div>";
			$Message = '<div id="attaquer_portail" class="formulaire_mission categorie"><h2>'.$LNG['NOUVEAUTE_547'].'</h2><div name="formulaire_envoyer"><!-- Les liens pour revenir sur le menu ou sur la mission --><div class="retour_menu"><< <a href="game.php?page=spaceSimulator">'.$LNG['NOUVEAUTE_833'].'</a></div><!-- On affiche le message renvoyé par le formulaire -->'.$Message.'</div>';
			
		}
			
		
		$BattleArray	= array();
		$BattleArray[0][0][109]	= $USER[$resource[109]];
		$BattleArray[0][0][110]	= $USER[$resource[110]];
		$BattleArray[0][0][111]	= $USER[$resource[111]];
		
		$avaible_defs   = array(412,413,414,415,416,417,418);
		
		
		if(isset($_REQUEST['battleinput']))
		{
			$BattleArray	= $_REQUEST['battleinput'];
		}
		
		$specialships	= array();
		if(isset($_REQUEST['im']))
		{
			foreach($_REQUEST['im'] as $ID => $Count)
			{
				$BattleArray[0][1][$ID]	= floattostring($Count);
				
				if($ID > 1500)
					$specialships[$ID] = $Count;
			}
		}
		$OwnArray				= array();
		$OwnShipsOnPlanet		= array();
		$ownFleetCount			= 0;
		
		$OwnArrayB				= array();
		$OwnShipsOnPlanetB		= array();
		$ownFleetCountB			= 0;
		
		if(!empty($specialships)){
			foreach($specialships as $ID => $Count)
			{
				$ElementY   	= $ID;
				$Availables 	= $Count;
				$getShipInfo	= $GLOBALS['DATABASE']->getFirstRow("SELECT owerId, id_infrastructure, shipSpeed, shipFret, nom, image, shipAttack, shipBouclier, shipCoque FROM ".VARS_USER." WHERE varId = ".$ElementY.";");
				
				if($DefenderId != $getShipInfo['owerId'])
					continue;
				
				$ownFleetCountB	+= $Availables;
				$OwnShipsOnPlanetB[]	= array(
					'id'			=> $ElementY,
					'count'			=> floor($Availables),
					'fret'			=> pretty_number($getShipInfo['shipFret']),
					'fret2'			=> $getShipInfo['shipFret'],
					'Hyper'			=> 0,
					'nom'			=> $getShipInfo['nom'],
					'image'			=> $getShipInfo['image'],
					'infra'			=> $getShipInfo['id_infrastructure'],
					'shipAttack'	=> $getShipInfo['shipAttack'],
					'shipBouclier'	=> $getShipInfo['shipBouclier'],
					'shipCoque'		=> $getShipInfo['shipCoque'],
					'text'			=> sprintf($LNG['NOUVEAUTE_612'], floor($Availables)),
				);
			}
		}
			
		if(!empty($PLANET['specialships'])){
			$OwnShips			= explode(';', $PLANET['specialships']);		
			foreach($OwnShips as $Items)
			{
				$temp 			= explode(',', $Items);
				if($temp[1] == 0)
					continue;
				$OwnArray[]		= array($temp[0], $temp[1]);
			}
			
			foreach($OwnArray as $Items)
			{
				$ElementY   	= $Items[0];
				$Availables 	= $Items[1];
				$getShipInfo	= $GLOBALS['DATABASE']->getFirstRow("SELECT id_infrastructure, shipSpeed, shipFret, nom, image, shipAttack, shipBouclier, shipCoque FROM ".VARS_USER." WHERE owerId = ".$USER['id']." AND varId = ".$ElementY.";");
				$ownFleetCount	+= $Availables;
				$OwnShipsOnPlanet[]	= array(
					'id'			=> $ElementY,
					'count'			=> floor($Availables),
					'fret'			=> pretty_number($getShipInfo['shipFret']),
					'fret2'			=> $getShipInfo['shipFret'],
					'Hyper'			=> 0,
					'nom'			=> $getShipInfo['nom'],
					'image'			=> $getShipInfo['image'],
					'infra'			=> $getShipInfo['id_infrastructure'],
					'shipAttack'	=> $getShipInfo['shipAttack'],
					'shipBouclier'	=> $getShipInfo['shipBouclier'],
					'shipCoque'		=> $getShipInfo['shipCoque'],
					'text'			=> sprintf($LNG['NOUVEAUTE_612'], floor($Availables)),
				);
			}
		}

		
		$this->tplObj->loadscript('battlesim.js');
		
		$this->tplObj->assign_vars(array(
			'Slots'			=> $Slots,
			'battleinput'	=> $BattleArray,
			'defensiveList'	=> $avaible_defs,
			'DefenderUser'	=> $DefenderUser,
			'DefenderPlan'	=> $DefenderPlan,
			'DefenderRank'	=> $DefenderRank,
			'DefenderAlly'	=> $DefenderAlly,
			'Message'		=> $Message,
			'DefenderTime'	=> date('d/m/y à H:i', $DefenderTime),
			'ownFleetCount'	=> $ownFleetCount,
			'getDefenderI'	=> empty($getDefenderI) ? 0 : 1,
			'OwnShipsOnPlanet'	=> $OwnShipsOnPlanet,
			'OwnShipsOnPlanetB'	=> $OwnShipsOnPlanetB,
			'specialships'	=> $specialships,
			'ownFleetCountB'	=> $ownFleetCountB,
		));
		
		$this->display('page.spaceSimulator.default.tpl');   
	}
}
