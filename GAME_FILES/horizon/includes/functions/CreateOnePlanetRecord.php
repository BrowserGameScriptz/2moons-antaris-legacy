<?php

/**
 *  2Moons
 *  Copyright (C) 2012 Jan Kr�pke
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
 * @author Jan Kr�pke <info@2moons.cc>
 * @copyright 2012 Jan Kr�pke <info@2moons.cc>
 * @license http://www.gnu.org/licenses/gpl.html GNU GPLv3 License
 * @version 1.7.3 (2013-05-19)
 * @info $Id: CreateOnePlanetRecord.php 2640 2013-03-23 19:23:26Z slaver7 $
 * @link http://2moons.cc/
 */

function CreateOnePlanetRecord($Galaxy, $System, $Position, $Universe, $PlanetOwnerID, $PlanetName, $HomeWorld = false, $AuthLevel = 0, $Iron, $Gold, $Crystal, $Elyrium, $iPlanetCount)
{
	global $LNG;

	$CONF	= Config::getAll(NULL, $Universe);
	if (Config::get('max_galaxy') < $Galaxy || 1 > $Galaxy) {
		throw new Exception("Access denied for CreateOnePlanetRecord.php.<br>Try to create a planet at position:".$Galaxy.":".$System.":".$Position);
	}	
	
	if (1000 < $System || 1 > $System) {
		throw new Exception("Access denied for CreateOnePlanetRecord.php.<br>Try to create a planet at position:".$Galaxy.":".$System.":".$Position);
	}	
	
	if (10 < $Position || 1 > $Position) {
		throw new Exception("Access denied for CreateOnePlanetRecord.php.<br>Try to create a planet at position:".$Galaxy.":".$System.":".$Position);
	}
	
	if (CheckPlanetIfExist($Galaxy, $System, $Position, $Universe)) {
		return false;
	}
	
	$isAllowed = $GLOBALS['DATABASE']->query("SELECT * FROM ".PLANETS." WHERE id_owner = ".$PlanetOwnerID." AND teleport_portal = '0';");
	
	$tp = 0;
	if($GLOBALS['DATABASE']->numRows($isAllowed) >= 3){
		$tp = 1;
	}

	$FieldFactor		= Config::get('planet_factor');
	require('includes/PlanetData.php');
	$Pos                = ceil($Position / (10 / count($PlanetData))); 
	$TMax				= $PlanetData[$Pos]['temp'];
	$TMin				= $TMax - 40;
	$Fields				= $PlanetData[$Pos]['fields'] * Config::get('planet_factor');
	$Types				= $PlanetData[$Pos]['image'];
	$Name				= !empty($PlanetName) ? $GLOBALS['DATABASE']->sql_escape($PlanetName) : $LNG['type_planet'][1];
	
	$GLOBALS['DATABASE']->query("INSERT INTO ".PLANETS." SET
				name = '".$Name."',
				universe = ".$Universe.",
				id_owner = ".$PlanetOwnerID.",
				galaxy = ".$Galaxy.",
				system = ".$System.",
				planet = ".$Position.",
				last_update = ".TIMESTAMP.",
				planet_type = '1',
				colo_metal = ".$Iron.",
				colo_crystal = ".$Gold.",
				colo_deut = ".$Crystal.",
				colo_elyrium = ".$Elyrium.",
				teleport_portal = ".$tp.",
				image = '".$Types."',
				diameter = ".floor(1000 * sqrt($Fields)).",
				field_max = ".(($HomeWorld) ? Config::get('initial_fields') : floor($Fields)).",
				temp_min = ".$TMin.",
				temp_max = ".$TMax.",
				metal = ".Config::get('metal_start').",
				metal_perhour = ".Config::get('metal_basic_income').",
				crystal = ".Config::get('crystal_start').",
				crystal_perhour = ".Config::get('crystal_basic_income').",
				deuterium = ".Config::get('deuterium_start').",
				deuterium_perhour = ".Config::get('deuterium_basic_income').",
				elyrium = ".Config::get('deuterium_start').",
				elyrium_perhour = ".Config::get('deuterium_basic_income').";");

	return $GLOBALS['DATABASE']->GetInsertID();
}