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
 * @info $Id: class.PlanetRessUpdate.php 2632 2013-03-18 19:05:14Z slaver7 $
 * @link http://2moons.cc/
 */

class ResourceUpdate
{
	function __construct($Build = true, $Tech = true)
	{
		$this->Builded	= array();	
		$this->Build	= $Build;
		$this->Tech		= $Tech;
		$this->USER		= array();
		$this->PLANET	= array();	
	}
	
	public function ReturnVars() {
		if($this->GLOBALS)
		{
			$GLOBALS['USER']	= $this->USER;
			$GLOBALS['PLANET']	= $this->PLANET;
			return true;
		} else {
			return array($this->USER, $this->PLANET);
		}
	}
	
	public function CreateHash() {
		global $reslist, $resource;
		$Hash	= array();
		foreach($reslist['prod'] as $ID) {
			$Hash[]	= $this->PLANET[$resource[$ID]];
			$Hash[]	= $this->PLANET[$resource[$ID].'_porcent'];
		}
		
		$ressource	= array_merge(array(), $reslist['resstype'][1], $reslist['resstype'][2]);
		foreach($ressource as $ID) {
			$Hash[]	= $this->CONF[$resource[$ID].'_basic_income'];
		}
		
		$Hash[]	= $this->CONF['resource_multiplier'];
		$Hash[]	= $this->CONF['energySpeed'];
		$Hash[]	= $this->USER['factor']['Resource'];
		$Hash[]	= $this->USER['factor']['Energy'];
		$Hash[]	= $this->PLANET['civil'];
		$Hash[]	= $this->PLANET['technician'];
		$Hash[]	= $this->PLANET['scientist'];
		$Hash[]	= $this->PLANET['archaeologist'];
		$Hash[]	= $this->PLANET['diplomat'];
		$Hash[]	= $this->PLANET['soldier'];
		$Hash[]	= $this->PLANET['adv_soldier'];
		$Hash[]	= $this->PLANET['pilot'];
		$Hash[]	= $this->PLANET['colo_metal'];
		$Hash[]	= $this->PLANET['colo_crystal'];
		$Hash[]	= $this->PLANET['colo_deut'];
		$Hash[]	= $this->PLANET['colo_elyrium'];
		$Hash[]	= $this->PLANET['civilProd901'];
		$Hash[]	= $this->PLANET['civilProd902'];
		$Hash[]	= $this->PLANET['civilProd903'];
		$Hash[]	= $this->PLANET['civilProd904'];
		$Hash[]	= $this->PLANET[$resource[22]];
		$Hash[]	= $this->PLANET[$resource[23]];
		$Hash[]	= $this->PLANET[$resource[24]];
		$Hash[]	= $this->PLANET[$resource[25]];
		$Hash[]	= $this->USER[$resource[131]];
		$Hash[]	= $this->USER[$resource[132]];
		$Hash[]	= $this->USER[$resource[133]];
		return md5(implode("::", $Hash));
	}
	
	public function CalcResource($USER = NULL, $PLANET = NULL, $SAVE = false, $TIME = NULL, $HASH = true)
	{			
		$this->GLOBALS	= !isset($USER, $PLANET) ? true : false;
		$this->USER		= $this->GLOBALS ? $GLOBALS['USER'] : $USER;
		$this->PLANET	= $this->GLOBALS ? $GLOBALS['PLANET'] : $PLANET;
		$this->TIME		= is_null($TIME) ? TIMESTAMP : $TIME;
		$this->CONF		= Config::getAll(NULL, $this->USER['universe']);
#		$this->CONF['energySpeed']	= 1;
		
		if($this->USER['urlaubs_modus'] == 1)
			return $this->ReturnVars();
			
		if($this->Build)
		{
			$this->ShipyardQueue();
			$this->DefenseQueue();
			$this->OwnQueue();
			if($this->Tech == true && $this->USER['b_tech'] != 0 && $this->USER['b_tech'] < $this->TIME)
				$this->ResearchQueue();
			if($this->PLANET['b_building'] != 0)
				$this->BuildingQueue();
		}
		
		$this->UpdateRessource($this->TIME, $HASH);
			
		if($SAVE === true)
			$this->SavePlanetToDB($this->USER, $this->PLANET);
			
		return $this->ReturnVars();
	}
	
	public function UpdateRessource($TIME, $HASH = false)
	{
		$this->ProductionTime  			= ($TIME - $this->PLANET['last_update']);
		
		if($this->ProductionTime > 0)
		{
			$this->PLANET['last_update']	= $TIME;
			if($HASH === false) {
				$this->ReBuildCache();
			} else {
				$this->HASH		= $this->CreateHash();
				
				if($this->PLANET['eco_hash'] !== $this->HASH) {
					$this->PLANET['eco_hash'] = $this->HASH;
					$this->ReBuildCache();
				}
			}
			$this->ExecCalc();
		}
	}
	
	private function ExecCalc()
	{
		if($this->PLANET['planet_type'] == 3)
			return;
			
		$MaxMetalStorage		= $this->PLANET['metal_max']     * $this->CONF['max_overflow'];
		$MaxCristalStorage		= $this->PLANET['crystal_max']   * $this->CONF['max_overflow'];
		$MaxDeuteriumStorage	= $this->PLANET['deuterium_max'] * $this->CONF['max_overflow'];
		$MaxElyriumStorage		= $this->PLANET['elyrium_max']   * $this->CONF['max_overflow'];
		
		$MetalTheorical		= $this->ProductionTime * (($this->CONF['metal_basic_income'] * $this->CONF['resource_multiplier']) + $this->PLANET['metal_perhour']) / 3600;
		if($MetalTheorical < 0)
		{
			$this->PLANET['metal']      = max($this->PLANET['metal'] + $MetalTheorical, 0);
		} 
		elseif ($this->PLANET['metal'] <= $MaxMetalStorage)
		{
			$this->PLANET['metal']      = min($this->PLANET['metal'] + $MetalTheorical, $MaxMetalStorage);
		}
		
		$CristalTheorical	= $this->ProductionTime * (($this->CONF['crystal_basic_income'] * $this->CONF['resource_multiplier']) + $this->PLANET['crystal_perhour']) / 3600;
		if ($CristalTheorical < 0)
		{
			$this->PLANET['crystal']      = max($this->PLANET['crystal'] + $CristalTheorical, 0);
		} 
		elseif ($this->PLANET['crystal'] <= $MaxCristalStorage ) 
		{
			$this->PLANET['crystal']      = min($this->PLANET['crystal'] + $CristalTheorical, $MaxCristalStorage);
		}
		
		$DeuteriumTheorical	= $this->ProductionTime * (($this->CONF['deuterium_basic_income'] * $this->CONF['resource_multiplier']) + $this->PLANET['deuterium_perhour']) / 3600;
		if ($DeuteriumTheorical < 0)
		{
			$this->PLANET['deuterium']    = max($this->PLANET['deuterium'] + $DeuteriumTheorical, 0);
		} 
		elseif($this->PLANET['deuterium'] <= $MaxDeuteriumStorage) 
		{
			$this->PLANET['deuterium']    = min($this->PLANET['deuterium'] + $DeuteriumTheorical, $MaxDeuteriumStorage);
		}
		
		$ElyriumTheorical	= $this->ProductionTime * (($this->CONF['elyrium_basic_income'] * $this->CONF['resource_multiplier']) + $this->PLANET['elyrium_perhour']) / 3600;
		if ($ElyriumTheorical < 0)
		{
			$this->PLANET['elyrium']    = max($this->PLANET['elyrium'] + $ElyriumTheorical, 0);
		} 
		elseif($this->PLANET['elyrium'] <= $MaxElyriumStorage) 
		{
			$this->PLANET['elyrium']    = min($this->PLANET['elyrium'] + $ElyriumTheorical, $MaxElyriumStorage);
		}
	
		$CivilTheorical		= $this->ProductionTime * $this->PLANET['civil_prod'] / 3600;
		if($CivilTheorical < 0)
		{
			$this->PLANET['civil']      = max($this->PLANET['civil'] + $CivilTheorical, 0);
		} 
		elseif($this->PLANET['civil'] <= 200000000) 
		{
			$this->PLANET['civil']      = min($this->PLANET['civil'] + $CivilTheorical, 200000000);
		}
		$TechnicianTheorical		= $this->ProductionTime * $this->PLANET['technician_prod'] / 3600;
		if($TechnicianTheorical < 0)
		{
			$this->PLANET['technician']      = max($this->PLANET['technician'] + $TechnicianTheorical, 0);
		} 
		else
		{
			$this->PLANET['technician']      = $this->PLANET['technician'] + $TechnicianTheorical;
		}
		$ScientistTheorical		= $this->ProductionTime * $this->PLANET['scientist_prod'] / 3600;
		if($ScientistTheorical < 0)
		{
			$this->PLANET['scientist']      = max($this->PLANET['scientist'] + $ScientistTheorical, 0);
		} 
		else
		{
			$this->PLANET['scientist']      = $this->PLANET['scientist'] + $ScientistTheorical;
		}
		$ArchaeologistTheorical		= $this->ProductionTime * $this->PLANET['archaeologist_prod'] / 3600;
		if($ArchaeologistTheorical < 0)
		{
			$this->PLANET['archaeologist']      = max($this->PLANET['archaeologist'] + $ArchaeologistTheorical, 0);
		} 
		else
		{
			$this->PLANET['archaeologist']      = $this->PLANET['archaeologist'] + $ArchaeologistTheorical;
		}
		$DiplomatTheorical		= $this->ProductionTime * $this->PLANET['diplomat_prod'] / 3600;
		if($DiplomatTheorical < 0)
		{
			$this->PLANET['diplomat']      = max($this->PLANET['diplomat'] + $DiplomatTheorical, 0);
		} 
		else
		{
			$this->PLANET['diplomat']      = $this->PLANET['diplomat'] + $DiplomatTheorical;
		}
		$SoldierTheorical		= $this->ProductionTime * $this->PLANET['soldier_prod'] / 3600;
		if($SoldierTheorical < 0)
		{
			$this->PLANET['soldier']      = max($this->PLANET['soldier'] + $SoldierTheorical, 0);
		} 
		else
		{
			$this->PLANET['soldier']      = $this->PLANET['soldier'] + $SoldierTheorical;
		}
		$Adv_soldierTheorical		= $this->ProductionTime * $this->PLANET['adv_soldier_prod'] / 3600;
		if($Adv_soldierTheorical < 0)
		{
			$this->PLANET['adv_soldier']      = max($this->PLANET['adv_soldier'] + $Adv_soldierTheorical, 0);
		} 
		else
		{
			$this->PLANET['adv_soldier']      = $this->PLANET['adv_soldier'] + $Adv_soldierTheorical;
		}
		$PilotTheorical		= $this->ProductionTime * $this->PLANET['pilot_prod'] / 3600;
		if($PilotTheorical < 0)
		{
			$this->PLANET['pilot']      = max($this->PLANET['pilot'] + $PilotTheorical, 0);
		} 
		else
		{
			$this->PLANET['pilot']      = $this->PLANET['pilot'] + $PilotTheorical;
		}
		
		$this->PLANET['metal']		= max($this->PLANET['metal'], 0);
		$this->PLANET['crystal']	= max($this->PLANET['crystal'], 0);
		$this->PLANET['deuterium']	= max($this->PLANET['deuterium'], 0);
		$this->PLANET['elyrium']	= max($this->PLANET['elyrium'], 0);
		$this->PLANET['civil']	= max($this->PLANET['civil'], 0);
		$this->PLANET['technician']	= max($this->PLANET['technician'], 0);
		$this->PLANET['scientist']	= max($this->PLANET['scientist'], 0);
		$this->PLANET['archaeologist']	= max($this->PLANET['archaeologist'], 0);
		$this->PLANET['diplomat']	= max($this->PLANET['diplomat'], 0);
		$this->PLANET['soldier']	= max($this->PLANET['soldier'], 0);
		$this->PLANET['adv_soldier']	= max($this->PLANET['adv_soldier'], 0);
		$this->PLANET['pilot']	= max($this->PLANET['pilot'], 0);
	}
	
	public static function getProd($Calculation)
	{
		return 'return '.$Calculation.';';
	}
	
	public static function getNetworkLevel($USER, $PLANET)
	{
		global $resource;

		$lablevel	= array();
		if($USER[$resource[123]] == 0) {
			$lablevel[] = $PLANET[$resource[31]];
		} else {
			$LevelRow = $GLOBALS['DATABASE']->query("SELECT ".$resource[31]." FROM ".PLANETS." WHERE id != '".$PLANET['id']."' AND id_owner = '".$USER['id']."' AND destruyed = 0 ORDER BY ".$resource[31]." DESC LIMIT ".($USER[$resource[123]]).";");
			$lablevel[]	= $PLANET[$resource[31]];
			while($Levels = $GLOBALS['DATABASE']->fetch_array($LevelRow))
			{
				$lablevel[]	= $Levels[$resource[31]];
			}
			$GLOBALS['DATABASE']->free_result($LevelRow);
		}
		
		return $lablevel;
	}
	
	public function ReBuildCache()
	{
		global $ProdGrid, $resource, $reslist, $pricelist;
		
		if ($this->PLANET['planet_type'] == 3)
		{
			$this->CONF['metal_basic_income']     	= 0;
			$this->CONF['crystal_basic_income']   	= 0;
			$this->CONF['deuterium_basic_income'] 	= 0;
			$this->CONF['elyrium_basic_income'] 	= 0;
		}
		
		$temp	= array(
			901	=> array(
				'max'	=> 0,
				'plus'	=> 0,
				'minus'	=> 0,
			),
			902	=> array(
				'max'	=> 0,
				'plus'	=> 0,
				'minus'	=> 0,
			),
			903	=> array(
				'max'	=> 0,
				'plus'	=> 0,
				'minus'	=> 0,
			),
			904	=> array(
				'max'	=> 0,
				'plus'	=> 0,
				'minus'	=> 0,
			),
			905	=> array(
				'plus'	=> 0,
				'minus'	=> 0,
			),
			911	=> array(
				'plus'	=> 0,
				'minus'	=> 0,
			)
		);
		
		$BuildTemp		= $this->PLANET['temp_max'];
		$BuildEnergy	= $this->USER[$resource[113]];
		
		foreach($reslist['storage'] as $ProdID)
		{
			foreach($reslist['resstype'][1] as $ID) 
			{
				if(!isset($ProdGrid[$ProdID]['storage'][$ID]))
					continue;
					
				$BuildLevel 		= $this->PLANET[$resource[$ProdID]];
				$temp[$ID]['max']	+= round(eval(self::getProd($ProdGrid[$ProdID]['storage'][$ID])));
			}
		}
		
		$ressIDs	= array_merge(array(), $reslist['resstype'][1], $reslist['resstype'][2], $reslist['resstype'][4]);
		
		foreach($reslist['prod'] as $ProdID)
		{	
			$BuildLevelFactor	= $this->PLANET[$resource[$ProdID].'_porcent'];
			$BuildLevel 		= $this->PLANET[$resource[$ProdID]];
			
			foreach($ressIDs as $ID) 
			{
				if(!isset($ProdGrid[$ProdID]['production'][$ID]))
					continue;
				
				$Production	= eval(self::getProd($ProdGrid[$ProdID]['production'][$ID]));
				
				if($Production > 0) {					
					$temp[$ID]['plus']	+= $Production;
				} else {
					if(in_array($ID, $reslist['resstype'][1]) && $this->PLANET[$resource[$ID]] == 0) {
						 continue;
					}
					
					$temp[$ID]['minus']	+= $Production;
				}
			}
		}
		
		$this->PLANET['metal_max']			= $temp[901]['max'] * $this->CONF['resource_multiplier'] * STORAGE_FACTOR * (1 + $this->USER['factor']['ResourceStorage']);
		$this->PLANET['crystal_max']		= $temp[902]['max'] * $this->CONF['resource_multiplier'] * STORAGE_FACTOR * (1 + $this->USER['factor']['ResourceStorage']);
		$this->PLANET['deuterium_max']		= $temp[903]['max'] * $this->CONF['resource_multiplier'] * STORAGE_FACTOR * (1 + $this->USER['factor']['ResourceStorage']);
		$this->PLANET['elyrium_max']		= $temp[904]['max'] * $this->CONF['resource_multiplier'] * STORAGE_FACTOR * (1 + $this->USER['factor']['ResourceStorage']);

		$energylevel						= round($temp[911]['plus'] * $this->CONF['energySpeed']);
		for($i = 0; $i <= $this->USER[$resource[113]]; $i++) {
			$energylevel	+=  $energylevel/100*5;
		}
		$this->PLANET['energy']				= $energylevel;
		$this->PLANET['energy_used']		= $temp[911]['minus'];
		$this->PLANET['formation']				= round($temp[905]['plus']);
		$this->PLANET['formation_used']		= $temp[905]['minus'];
		if($this->PLANET['energy_used'] == 0) {
			$this->PLANET['metal_perhour']		= 0;
			$this->PLANET['crystal_perhour']	= 0;
			$this->PLANET['deuterium_perhour']	= 0;
			$this->PLANET['elyrium_perhour']	= 0;
			$this->PLANET['civilProd901']		= 0;
			$this->PLANET['civilProd902']		= 0;
			$this->PLANET['civilProd903']		= 0;
			$this->PLANET['civilProd904']		= 0;
			
		} else {
			$prodLevel	= min(1, $this->PLANET['energy'] / abs($this->PLANET['energy_used']));
			
			
			$this->PLANET['metal_perhour']		= (($temp[901]['plus'] * (1 + $this->USER['factor']['Resource'] + 0.02 * $this->USER[$resource[140]]) * $prodLevel + $temp[901]['minus']) * Config::get('resource_multiplier')) + ((($temp[901]['plus'] * (1 + $this->USER['factor']['Resource'] + 0.02 * $this->USER[$resource[140]]) * $prodLevel + $temp[901]['minus']) * Config::get('resource_multiplier')) / 100 * $this->PLANET['colo_metal']) + ((($temp[901]['plus'] * (1 + $this->USER['factor']['Resource'] + 0.02 * $this->USER[$resource[140]]) * $prodLevel + $temp[901]['minus']) * Config::get('resource_multiplier')) / 100 * (0.0002 * $this->PLANET['civil']));
			$this->PLANET['civilProd901']		= ((($temp[901]['plus'] * (1 + $this->USER['factor']['Resource'] + 0.02 * $this->USER[$resource[140]]) * $prodLevel + $temp[901]['minus']) * Config::get('resource_multiplier')) / 100 * (0.0002 * $this->PLANET['civil']));
			
			$this->PLANET['crystal_perhour']	= (($temp[902]['plus'] * (1 + $this->USER['factor']['Resource'] + 0.02 * $this->USER[$resource[140]]) * $prodLevel + $temp[902]['minus']) * Config::get('resource_multiplier')) + ((($temp[902]['plus'] * (1 + $this->USER['factor']['Resource'] + 0.02 * $this->USER[$resource[140]]) * $prodLevel + $temp[902]['minus']) * Config::get('resource_multiplier')) / 100 * $this->PLANET['colo_crystal']) + ((($temp[902]['plus'] * (1 + $this->USER['factor']['Resource'] + 0.02 * $this->USER[$resource[140]]) * $prodLevel + $temp[902]['minus']) * Config::get('resource_multiplier')) / 100 * (0.0002 * $this->PLANET['civil']));
			$this->PLANET['civilProd902']	= ((($temp[902]['plus'] * (1 + $this->USER['factor']['Resource'] + 0.02 * $this->USER[$resource[140]]) * $prodLevel + $temp[902]['minus']) * Config::get('resource_multiplier')) / 100 * (0.0002 * $this->PLANET['civil']));
			
			$this->PLANET['deuterium_perhour']	= (($temp[903]['plus'] * (1 + $this->USER['factor']['Resource'] + 0.02 * $this->USER[$resource[140]]) * $prodLevel + $temp[903]['minus']) * Config::get('resource_multiplier')) + ((($temp[903]['plus'] * (1 + $this->USER['factor']['Resource'] + 0.02 * $this->USER[$resource[140]]) * $prodLevel + $temp[903]['minus']) * Config::get('resource_multiplier')) / 100 * $this->PLANET['colo_deut']) + ((($temp[903]['plus'] * (1 + $this->USER['factor']['Resource'] + 0.02 * $this->USER[$resource[140]]) * $prodLevel + $temp[903]['minus']) * Config::get('resource_multiplier')) / 100 * (0.0002 * $this->PLANET['civil']));
			$this->PLANET['civilProd903']	= ((($temp[903]['plus'] * (1 + $this->USER['factor']['Resource'] + 0.02 * $this->USER[$resource[140]]) * $prodLevel + $temp[903]['minus']) * Config::get('resource_multiplier')) / 100 * (0.0002 * $this->PLANET['civil']));
			
			$this->PLANET['elyrium_perhour']	= (($temp[904]['plus'] * (1 + $this->USER['factor']['Resource'] + 0.02 * $this->USER[$resource[140]]) * $prodLevel + $temp[904]['minus']) * Config::get('resource_multiplier')) + ((($temp[904]['plus'] * (1 + $this->USER['factor']['Resource'] + 0.02 * $this->USER[$resource[140]]) * $prodLevel + $temp[904]['minus']) * Config::get('resource_multiplier')) / 100 * $this->PLANET['colo_elyrium']) + ((($temp[904]['plus'] * (1 + $this->USER['factor']['Resource'] + 0.02 * $this->USER[$resource[140]]) * $prodLevel + $temp[904]['minus']) * Config::get('resource_multiplier')) / 100 * (0.0002 * $this->PLANET['civil']));
			$this->PLANET['civilProd904']	= ((($temp[904]['plus'] * (1 + $this->USER['factor']['Resource'] + 0.02 * $this->USER[$resource[140]]) * $prodLevel + $temp[904]['minus']) * Config::get('resource_multiplier')) / 100 * (0.0002 * $this->PLANET['civil']));
		}
	}
	private function ShipyardQueue()
	{
		global $resource;

		$BuildQueue 	= unserialize($this->PLANET['b_hangar_id']);
		if (!$BuildQueue) {
			$this->PLANET['b_hangar'] = 0;
			$this->PLANET['b_hangar_id'] = '';
			return false;
		}
			
		$AcumTime					= 0;
		$this->PLANET['b_hangar'] 	+= ($this->TIME - $this->PLANET['last_update']);
		$BuildArray					= array();
		foreach($BuildQueue as $Item)
		{
			$AcumTime			= BuildFunctions::getBuildingTime($this->USER, $this->PLANET, $Item[0]);
			$BuildArray[] 		= array($Item[0], $Item[1], $AcumTime);
		}

		$NewQueue	= array();
		$Done		= false;
		foreach($BuildArray as $Item)
		{
			$Element   = $Item[0];
			$Count     = $Item[1];

			if($Done == false) {
				$BuildTime = $Item[2];
				$Element   = (int)$Element;
				if($BuildTime == 0) {			
					if(!isset($this->Builded[$Element]))
						$this->Builded[$Element] = 0;
						
					$this->Builded[$Element]			+= $Count;
					$this->PLANET[$resource[$Element]]	+= $Count;
					continue;					
				}
				
				$Build			= max(min(floor($this->PLANET['b_hangar'] / $BuildTime), $Count), 0);

				if($Build == 0) {
					$NewQueue[]	= array($Element, $Count);
					$Done		= true;
					continue;
				}
				
				if(!isset($this->Builded[$Element]))
					$this->Builded[$Element] = 0;
				
				$this->Builded[$Element]			+= $Build;
				$this->PLANET['b_hangar']			-= $Build * $BuildTime;
				$this->PLANET[$resource[$Element]]	+= $Build;
				$Count								-= $Build;
				
				if ($Count == 0)
					continue;
				else
					$Done	= true;
			}	
			$NewQueue[]	= array($Element, $Count);
		}
		$this->PLANET['b_hangar_id']	= !empty($NewQueue) ? serialize($NewQueue) : '';

	}
	
	private function OwnQueue()
	{
		global $resource;

		$getUserShip 		= $GLOBALS['DATABASE']->getFirstRow("SELECT ownCount FROM ".PLANETS." WHERE id = ".$this->PLANET['id'].";");
		$BuildQueue 		= explode(';', $getUserShip['ownCount']);
		if (!$BuildQueue || empty($getUserShip['ownCount'])) {
			$this->PLANET['b_vaisseau'] = 0;
			$this->PLANET['ownCount'] = '';
			return false;
		}
		
		$AcumTime					= 0;
		$this->PLANET['b_vaisseau'] += ($this->TIME - $this->PLANET['last_update']);
		$BuildArray					= array();
		
		$Fastmode = 0;
		if($this->USER['mode_rapide'] > TIMESTAMP){
			$Fastmode = 0.20;	
		}
		
		foreach($BuildQueue as $Item)
		{
			$temp 				= explode(',', $Item);
			$getUserShip 		= $GLOBALS['DATABASE']->getFirstRow("SELECT constructionTime, nom FROM ".VARS_USER." WHERE owerId = ".$this->USER['id']." AND varId = ".$Item[0].";");
			$AcumTime			= $getUserShip['constructionTime'];
			
			$Siege = 0;
			if($this->PLANET['siege_on'] > TIMESTAMP){
				$Siege = 1;	
			}
			
			if($Siege == 1){
				for ($i = 0; $i < $this->PLANET[$resource[5]]; $i++) {
					$AcumTime	/=  2;
				}
			}
			
			for ($i = 0; $i < $this->PLANET[$resource[14]]; $i++) {
				$AcumTime	/=  1.05;
			} 
			
			for ($i = 0; $i < $this->PLANET[$resource[21]]; $i++) {
				$AcumTime	/=  1.08;
			}
			
			$BuildArray[] 		= array($temp[0], $temp[1], $AcumTime);
		}	
		
		$NewQueue	= array();
		$Done		= false;
		foreach($BuildArray as $Item)
		{
			$Element   = $Item[0];
			$Count     = $Item[1];

			if($Done == false) {
				$getUserShip 		= $GLOBALS['DATABASE']->getFirstRow("SELECT constructionTime, nom FROM ".VARS_USER." WHERE owerId = ".$this->USER['id']." AND varId = ".$Element.";");
				$BuildTime = $getUserShip['constructionTime'] / (1 + $this->PLANET[$resource[14]] / 2) * (1 + $this->PLANET[$resource[21]] * 0.30);
				for ($i = 0; $i < $this->PLANET[$resource[5]]; $i++) {
					$BuildTime	/=  2;
				}
				
				for ($i = 0; $i < $this->PLANET[$resource[14]]; $i++) {
					$BuildTime	/=  1.05;
				}
				
				for ($i = 0; $i < $this->PLANET[$resource[21]]; $i++) {
					$BuildTime	/=  1.08;
				}
				$Element   = (int)$Element;
				if($BuildTime == 0) {			
					/* $this->PLANET[$resource[$Element]]	+= $Count; */
					$insideId	= 0;
					if(!empty($this->PLANET['specialships']))
					{
						$BuildQueueB		= explode(';', $this->PLANET['specialships']);
						$BuildArrayB		= array();
						
						foreach($BuildQueueB as $Items)
						{
							$temps = explode(',', $Items);
							$BuildArrayB[] 		= array($temps[0], $temps[1]);
						}
						
						foreach($BuildArrayB as $Items)
						{
							$ElementY   = $Items[0];
							$Availables = $Items[1];
							if($Element == $ElementY) {
								$Availables 	+= $Count;
								$insideId 		= 1;
							}	
							$GetShips[]	= $ElementY.','.$Availables;
						}
					} 
					if($insideId == 0)
						$GetShips[]	= $Element.','.$Count;
					continue;					
				}
				
				$Build			= max(min(floor($this->PLANET['b_vaisseau'] / $BuildTime), $Count), 0);

				if($Build == 0) {
					$NewQueue[]	= $Element.','.$Count;
					$Done		= true;
					continue;
				}

				$this->PLANET['b_vaisseau']			-= $Build * $BuildTime;
				//$this->PLANET[$resource[$Element]]	+= $Build;
				$insideId	= 0;
				if(!empty($this->PLANET['specialships']))
				{
					$BuildQueueB		= explode(';', $this->PLANET['specialships']);
					$BuildArrayB		= array();
						
					foreach($BuildQueueB as $Items)
					{
						$temps = explode(',', $Items);
						$BuildArrayB[] 		= array($temps[0], $temps[1]);
					}
						
					foreach($BuildArrayB as $Items)
					{
						$ElementY   = $Items[0];
						$Availables = $Items[1];
						if($Element == $ElementY) {
							$Availables 	+= $Build;
							$insideId 		= 1;
						}	
						$GetShips[]	= $ElementY.','.$Availables;
					}
				} 
				if($insideId == 0)
					$GetShips[]	= $Element.','.$Build;
					
				$Count								-= $Build;
				
				if ($Count == 0)
					continue;
				else
					$Done	= true;
			}	
			$NewQueue[]	= $Element.','.$Count;
		}
		$this->PLANET['ownCount']		= !empty($NewQueue) ? implode(';', $NewQueue) : '';
		$this->PLANET['specialships']	= !empty($GetShips) ? implode(';', $GetShips) : $this->PLANET['specialships'];
		
		
	}
	
	private function DefenseQueue()
	{
		global $resource;

		$BuildQueue 	= unserialize($this->PLANET['b_defense_id']);
		if (!$BuildQueue) {
			$this->PLANET['b_defense'] = 0;
			$this->PLANET['b_defense_id'] = '';
			return false;
		}
			
		$AcumTime					= 0;
		$this->PLANET['b_defense'] 	+= ($this->TIME - $this->PLANET['last_update']);
		$BuildArray					= array();
		foreach($BuildQueue as $Item)
		{
			$AcumTime			= BuildFunctions::getBuildingTime($this->USER, $this->PLANET, $Item[0]);
			$BuildArray[] 		= array($Item[0], $Item[1], $AcumTime);
		}

		$NewQueue	= array();
		$Done		= false;
		foreach($BuildArray as $Item)
		{
			$Element   = $Item[0];
			$Count     = $Item[1];

			if($Done == false) {
				$BuildTime = $Item[2];
				$Element   = (int)$Element;
				if($BuildTime == 0) {			
					if(!isset($this->Builded[$Element]))
						$this->Builded[$Element] = 0;
						
					$this->Builded[$Element]			+= $Count;
					$this->PLANET[$resource[$Element]]	+= $Count;
					continue;					
				}
				
				$Build			= max(min(floor($this->PLANET['b_defense'] / $BuildTime), $Count), 0);

				if($Build == 0) {
					$NewQueue[]	= array($Element, $Count);
					$Done		= true;
					continue;
				}
				
				if(!isset($this->Builded[$Element]))
					$this->Builded[$Element] = 0;
				
				$this->Builded[$Element]			+= $Build;
				$this->PLANET['b_defense']			-= $Build * $BuildTime;
				$this->PLANET[$resource[$Element]]	+= $Build;
				$Count								-= $Build;
				
				if ($Count == 0)
					continue;
				else
					$Done	= true;
			}	
			$NewQueue[]	= array($Element, $Count);
		}
		$this->PLANET['b_defense_id']	= !empty($NewQueue) ? serialize($NewQueue) : '';

	}
	
	private function BuildingQueue() 
	{
		while($this->CheckPlanetBuildingQueue())
			$this->SetNextQueueElementOnTop();
	}
	
	private function CheckPlanetBuildingQueue()
	{
		global $resource, $reslist;
		
		if (empty($this->PLANET['b_building_id']) || $this->PLANET['b_building'] > $this->TIME)
			return false;
		
		$CurrentQueue	= unserialize($this->PLANET['b_building_id']);

		$Element      	= $CurrentQueue[0][0];
		$Level      	= $CurrentQueue[0][1];
		$BuildEndTime 	= $CurrentQueue[0][3];
		$BuildMode    	= $CurrentQueue[0][4];
		
		if(!isset($this->Builded[$Element]))
			$this->Builded[$Element] = 0;
		
		if ($BuildMode == 'build')
		{
			$this->PLANET['field_current']		+= 1;
			$this->PLANET[$resource[$Element]]	+= 1;
			$this->Builded[$Element]			+= 1;
		}
		else
		{
			$this->PLANET['field_current'] 		-= 1;
			$this->PLANET[$resource[$Element]] 	-= 1;
			$this->Builded[$Element]			-= 1;
		}
	

		array_shift($CurrentQueue);
		$OnHash	= in_array($Element, $reslist['prod']);
		$this->UpdateRessource($BuildEndTime, !$OnHash);			
			
		if (count($CurrentQueue) == 0) {
			$this->PLANET['b_building']    	= 0;
			$this->PLANET['b_building_id'] 	= '';

			return false;
		} else {
			$this->PLANET['b_building_id'] 	= serialize($CurrentQueue);
			return true;
		}
	}	

	public function SetNextQueueElementOnTop()
	{
		global $resource, $LNG;

		if (empty($this->PLANET['b_building_id'])) {
			$this->PLANET['b_building']    = 0;
			$this->PLANET['b_building_id'] = '';
			return false;
		}

		$CurrentQueue 	= unserialize($this->PLANET['b_building_id']);
		$Loop       	= true;
		while ($Loop == true)
		{
			$ListIDArray		= $CurrentQueue[0];
			$Element			= $ListIDArray[0];
			$Level				= $ListIDArray[1];
			$BuildMode			= $ListIDArray[4];
			$ForDestroy			= ($BuildMode == 'destroy') ? true : false;
			$costRessources		= BuildFunctions::getElementPrice($this->USER, $this->PLANET, $Element, $ForDestroy);
			$BuildTime			= BuildFunctions::getBuildingTime($this->USER, $this->PLANET, $Element, $costRessources);
			$HaveRessources		= BuildFunctions::isElementBuyable($this->USER, $this->PLANET, $Element, $costRessources);
			$BuildEndTime		= $this->PLANET['b_building'] + $BuildTime;
			$CurrentQueue[0]	= array($Element, $Level, $BuildTime, $BuildEndTime, $BuildMode);
			$HaveNoMoreLevel	= false;
				
			if($ForDestroy && $this->PLANET[$resource[$Element]] == 0) {
				$HaveRessources  = false;
				$HaveNoMoreLevel = true;
			}

			if($BuildMode == 'destroy') {
				if(isset($costRessources[901])) { $this->PLANET[$resource[901]]	+= $costRessources[901]; }
				if(isset($costRessources[902])) { $this->PLANET[$resource[902]]	+= $costRessources[902]; }
				if(isset($costRessources[903])) { $this->PLANET[$resource[903]]	+= $costRessources[903]; }
				if(isset($costRessources[904])) { $this->PLANET[$resource[904]]	+= $costRessources[904]; }
				if(isset($costRessources[921])) { $this->USER[$resource[921]]	+= $costRessources[921]; }
				$NewQueue               	= serialize($CurrentQueue);
				$Loop                  		= false;
			}elseif($HaveRessources === true) {
				if(isset($costRessources[901])) { $this->PLANET[$resource[901]]	-= $costRessources[901]; }
				if(isset($costRessources[902])) { $this->PLANET[$resource[902]]	-= $costRessources[902]; }
				if(isset($costRessources[903])) { $this->PLANET[$resource[903]]	-= $costRessources[903]; }
				if(isset($costRessources[904])) { $this->PLANET[$resource[904]]	-= $costRessources[904]; }
				if(isset($costRessources[921])) { $this->USER[$resource[921]]	-= $costRessources[921]; }
				$NewQueue               	= serialize($CurrentQueue);
				$Loop                  		= false;
			} else {
				if($this->USER['hof'] == 1){
					if ($HaveNoMoreLevel) {
						$Message     = sprintf($LNG['sys_nomore_level'], $LNG['tech'][$Element]);
					} else {
						if(!isset($costRessources[901])) { $costRessources[901] = 0; }
						if(!isset($costRessources[902])) { $costRessources[902] = 0; }
						if(!isset($costRessources[903])) { $costRessources[903] = 0; }
						if(!isset($costRessources[904])) { $costRessources[904] = 0; }
						
						$Message     = sprintf($LNG['sys_notenough_money'], $this->PLANET['name'], $this->PLANET['id'], $this->PLANET['galaxy'], $this->PLANET['system'], $this->PLANET['planet'], $LNG['tech'][$Element], pretty_number ($this->PLANET['metal']), $LNG['tech'][901], pretty_number($this->PLANET['crystal']), $LNG['tech'][902], pretty_number ($this->PLANET['deuterium']), $LNG['tech'][903], pretty_number($costRessources[901]), $LNG['tech'][901], pretty_number ($costRessources[902]), $LNG['tech'][902], pretty_number ($costRessources[903]), $LNG['tech'][903], pretty_number ($costRessources[904]), $LNG['tech'][904]);
					}
					
					SendSimpleMessage($this->USER['id'], 0, $this->TIME, 99, $LNG['sys_buildlist'], $LNG['sys_buildlist_fail'], $Message);				
				}

				array_shift($CurrentQueue);
					
				if (count($CurrentQueue) == 0) {
					$BuildEndTime  = 0;
					$NewQueue      = '';
					$Loop          = false;
				} else {
					$BaseTime			= $BuildEndTime - $BuildTime;
					$NewQueue			= array();
					foreach($CurrentQueue as $ListIDArray)
					{
						$ListIDArray[2]		= BuildFunctions::getBuildingTime($this->USER, $this->PLANET, $ListIDArray[0], NULL, $ListIDArray[4] == 'destroy');
						$BaseTime			+= $ListIDArray[2];
						$ListIDArray[3]		= $BaseTime;
						$NewQueue[]			= $ListIDArray;
					}
					$CurrentQueue	= $NewQueue;
				}
			}
		}
			
		$this->PLANET['b_building']    = $BuildEndTime;
		$this->PLANET['b_building_id'] = $NewQueue;
	}
		
	private function ResearchQueue()
	{
		while($this->CheckUserTechQueue())
			$this->SetNextQueueTechOnTop();
	}
	
	private function CheckUserTechQueue()
	{
		global $resource;
		
		if (empty($this->USER['b_tech_id']) || $this->USER['b_tech'] > $this->TIME)
			return false;
		
		if(!isset($this->Builded[$this->USER['b_tech_id']]))
			$this->Builded[$this->USER['b_tech_id']]	= 0;
			
		$this->Builded[$this->USER['b_tech_id']]			+= 1;
		$this->USER[$resource[$this->USER['b_tech_id']]]	+= 1;
	

		$CurrentQueue	= unserialize($this->USER['b_tech_queue']);
		array_shift($CurrentQueue);		
			
		$this->USER['b_tech_id']		= 0;
		if (count($CurrentQueue) == 0) {
			$this->USER['b_tech'] 			= 0;
			$this->USER['b_tech_id']		= 0;
			$this->USER['b_tech_planet']	= 0;
			$this->USER['b_tech_queue']		= '';

			return false;
		} else {
			$this->USER['b_tech_queue'] 	= serialize(array_values($CurrentQueue));
			return true;
		}
	}	
	
	public function SetNextQueueTechOnTop()
	{
		global $resource, $LNG;

		if (empty($this->USER['b_tech_queue'])) {
			$this->USER['b_tech'] 			= 0;
			$this->USER['b_tech_id']		= 0;
			$this->USER['b_tech_planet']	= 0;
			$this->USER['b_tech_queue']		= '';
			return false;
		}

		$CurrentQueue 	= unserialize($this->USER['b_tech_queue']);
		$Loop       	= true;
		while ($Loop == true)
		{
			$ListIDArray        = $CurrentQueue[0];
			if($ListIDArray[4] != $this->PLANET['id'])
				$PLANET				= $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM ".PLANETS." WHERE id = '".$ListIDArray[4]."';");
			else
				$PLANET				= $this->PLANET;
			
			$PLANET[$resource[31].'_inter']	= self::getNetworkLevel($this->USER, $PLANET);
			
			$Element            = $ListIDArray[0];
			$Level              = $ListIDArray[1];
			$costRessources		= BuildFunctions::getElementPrice($this->USER, $PLANET, $Element);
			$BuildTime			= BuildFunctions::getBuildingTime($this->USER, $PLANET, $Element, $costRessources);
			$HaveRessources		= BuildFunctions::isElementBuyable($this->USER, $PLANET, $Element, $costRessources);
			$BuildEndTime       = $this->USER['b_tech'] + $BuildTime;
			$CurrentQueue[0]	= array($Element, $Level, $BuildTime, $BuildEndTime, $PLANET['id']);
			
			$isAnotherPlanet	= $ListIDArray[4] != $this->PLANET['id'];
			
			if($isAnotherPlanet) {
				$IsHash			= !in_array($Element, array(131, 132, 133));
				$RPLANET 		= new ResourceUpdate(true, false);
				list(, $PLANET)	= $RPLANET->CalcResource($this->USER, $PLANET, false, $this->USER['b_tech'], $IsHash);
			}
			
			if($HaveRessources == true) {
				if(isset($costRessources[901])) { $PLANET[$resource[901]]		-= $costRessources[901]; }
				if(isset($costRessources[902])) { $PLANET[$resource[902]]		-= $costRessources[902]; }
				if(isset($costRessources[903])) { $PLANET[$resource[903]]		-= $costRessources[903]; }
				if(isset($costRessources[904])) { $PLANET[$resource[904]]		-= $costRessources[904]; }
				if(isset($costRessources[921])) { $this->USER[$resource[921]]	-= $costRessources[921]; }
				$this->USER['b_tech_id']		= $Element;
				$this->USER['b_tech']      		= $BuildEndTime;
				$this->USER['b_tech_planet']	= $PLANET['id'];
				$this->USER['b_tech_queue'] 	= serialize($CurrentQueue);

				$Loop                  			= false;
			} else {
				if($this->USER['hof'] == 1){
					if(!isset($costRessources[901])) { $costRessources[901] = 0; }
					if(!isset($costRessources[902])) { $costRessources[902] = 0; }
					if(!isset($costRessources[903])) { $costRessources[903] = 0; }
					if(!isset($costRessources[904])) { $costRessources[904] = 0; }
					
					$Message     = sprintf($LNG['sys_notenough_money'], $PLANET['name'], $PLANET['id'], $PLANET['galaxy'], $PLANET['system'], $PLANET['planet'], $LNG['tech'][$Element], pretty_number ($PLANET['metal']), $LNG['tech'][901], pretty_number($PLANET['crystal']), $LNG['tech'][902], pretty_number ($PLANET['deuterium']), $LNG['tech'][903], pretty_number($costRessources[901]), $LNG['tech'][901], pretty_number ($costRessources[902]), $LNG['tech'][902], pretty_number ($costRessources[903]), $LNG['tech'][903], pretty_number ($costRessources[904]), $LNG['tech'][904]);
					SendSimpleMessage($this->USER['id'], 0, $this->USER['b_tech'], 99, $LNG['sys_techlist'], $LNG['sys_buildlist_fail'], $Message);				
				}

				array_shift($CurrentQueue);
					
				if (count($CurrentQueue) == 0) {
					$this->USER['b_tech'] 			= 0;
					$this->USER['b_tech_id']		= 0;
					$this->USER['b_tech_planet']	= 0;
					$this->USER['b_tech_queue']		= '';
					
					$Loop                  			= false;
				} else {
					$BaseTime						= $BuildEndTime - $BuildTime;
					$NewQueue						= array();
					foreach($CurrentQueue as $ListIDArray)
					{
						$ListIDArray[2]				= BuildFunctions::getBuildingTime($this->USER, $PLANET, $ListIDArray[0]);
						$BaseTime					+= $ListIDArray[2];
						$ListIDArray[3]				= $BaseTime;
						$NewQueue[]					= $ListIDArray;
					}
					$CurrentQueue					= $NewQueue;
				}
			}
				
			if($isAnotherPlanet)
				$RPLANET->SavePlanetToDB($this->USER, $PLANET);
			else
				$this->PLANET		= $PLANET;
		}

	}
	
	public function SavePlanetToDB($USER = NULL, $PLANET = NULL)
	{
		global $resource, $reslist;
		
		if(is_null($USER))
			global $USER;
			
		if(is_null($PLANET))
			global $PLANET;
			
		$Qry	= "LOCK TABLE ".PLANETS." as p WRITE, ".USERS." as u WRITE;
				   UPDATE ".PLANETS." as p, ".USERS." as u SET
				   p.civil = ".$PLANET['civil'].",
				   p.technician = ".$PLANET['technician'].",
				   p.scientist = ".$PLANET['scientist'].",
				   p.archaeologist = ".$PLANET['archaeologist'].",
				   p.diplomat = ".$PLANET['diplomat'].",
				   p.soldier = ".$PLANET['soldier'].",
				   p.adv_soldier = ".$PLANET['adv_soldier'].",
				   p.pilot = ".$PLANET['pilot'].",
				   p.metal = ".$PLANET['metal'].",
				   p.crystal = ".$PLANET['crystal'].",
				   p.deuterium = ".$PLANET['deuterium'].",
				   p.elyrium = ".$PLANET['elyrium'].",
				   p.formation = ".$PLANET['formation'].",
				   p.eco_hash = '".$PLANET['eco_hash']."',
				   p.last_update = ".$PLANET['last_update'].",
				   p.b_building = '".$PLANET['b_building']."',
				   p.b_building_id = '".$PLANET['b_building_id']."',
				   p.field_current = ".$PLANET['field_current'].",
				   p.b_hangar_id = '".$PLANET['b_hangar_id']."',
				   p.ownCount = '".$PLANET['ownCount']."',
				   p.specialships = '".$PLANET['specialships']."',
				   p.b_defense_id = '".$PLANET['b_defense_id']."',
				   p.metal_perhour = ".$PLANET['metal_perhour'].",
				   p.crystal_perhour = ".$PLANET['crystal_perhour'].",
				   p.deuterium_perhour = ".$PLANET['deuterium_perhour'].",
				   p.elyrium_perhour = ".$PLANET['elyrium_perhour'].",
				   p.civilProd901 = ".$PLANET['civilProd901'].",
				   p.civilProd902 = ".$PLANET['civilProd902'].",
				   p.civilProd903 = ".$PLANET['civilProd903'].",
				   p.civilProd904 = ".$PLANET['civilProd904'].",
				   p.metal_max = ".$PLANET['metal_max'].",
				   p.crystal_max = ".$PLANET['crystal_max'].",
				   p.deuterium_max = ".$PLANET['deuterium_max'].",
				   p.elyrium_max = ".$PLANET['elyrium_max'].",
				   p.energy_used = ".$PLANET['energy_used'].",
				   p.energy = ".$PLANET['energy'].",
				   p.b_hangar = ". $PLANET['b_hangar'] .", 
				   p.b_vaisseau = ". $PLANET['b_vaisseau'] .", 
				   p.b_defense = ". $PLANET['b_defense'] .", ";
		if (!empty($this->Builded))
		{
			foreach($this->Builded as $Element => $Count)
			{
				$Element	= (int) $Element;
				
				if(empty($resource[$Element]) || empty($Count)) {
					continue;
				}
				
				if(in_array($Element, $reslist['one'])) {
					$Qry	.= "p.".$resource[$Element]." = '1', ";					
				} elseif(isset($PLANET[$resource[$Element]])) {
					$Qry	.= "p.".$resource[$Element]." = p.".$resource[$Element]." + ".floattostring($Count).", ";
				} elseif(isset($USER[$resource[$Element]])) {
					$Qry	.= "u.".$resource[$Element]." = u.".$resource[$Element]." + ".floattostring($Count).", ";
				}
			}
		}
		$Qry	.= "u.darkmatter = ".$USER['darkmatter'].",
					u.b_tech = '".$USER['b_tech']."',
					u.b_tech_id = '".$USER['b_tech_id']."',
					u.b_tech_planet = '".$USER['b_tech_planet']."',
					u.b_tech_queue = '".$USER['b_tech_queue']."'
					WHERE
					p.id = ".$PLANET['id']." AND
					u.id = ".$USER['id'].";
					UNLOCK TABLES;";
		$GLOBALS['DATABASE']->multi_query($Qry);
		$this->Builded	= array();
		

		return array($USER, $PLANET);
	}
}