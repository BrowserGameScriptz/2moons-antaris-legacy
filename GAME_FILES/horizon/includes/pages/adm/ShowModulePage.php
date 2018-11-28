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
 * @version 1.7.2 (2013-03-18)
 * @info $Id$
 * @link http://2moons.cc/
 */

if (!allowedTo(str_replace(array(dirname(__FILE__), '\\', '/', '.php'), '', __FILE__))) throw new Exception("Permission error!");

function ShowModulePage()
{
	global $CONF, $LNG, $USER;
	
	$module	= Config::get('moduls');
	
	if($_GET['mode']) {
		$module[HTTP::_GP('id', 0)]	= ($_GET['mode'] == 'aktiv') ? 1 : 0;
		Config::update(array('moduls' => implode(";", $module)));
	}
	
	$IDs	= range(0, MODULE_AMOUNT - 1);
	
	foreach($IDs as $ID => $Name) {
		$Modules[$ID]	= array(
			'name'	=> $LNG['modul'][$ID], 
			'url'	=> $LNG['modulurl'][$ID], 
			'state'	=> isset($module[$ID]) ? $module[$ID] : 1,
		);
	}
	
	asort($Modules);
	
	$free = shell_exec('free');
	$free = (string)trim($free);
	$free_arr = explode("\n", $free);
	$mem = explode(" ", $free_arr[1]);
	$mem = array_filter($mem);
	$mem = array_merge($mem);
	$memory_usage = $mem[2]/$mem[1]*100;
		
	$QueryCSearch	 = "SELECT COUNT(id) AS total FROM ".USERS." ";
	$QueryCSearch	.= "WHERE onlinetime >= '".(TIMESTAMP - 15 * 60)."';";
	$CountQuery		= $GLOBALS['DATABASE']->getFirstRow($QueryCSearch);
	
	$template	= new template();
	$template->assign_vars(array(
		'Modules'				=> $Modules,
		'mod_module'			=> $LNG['mod_module'],
		'mod_info'				=> $LNG['mod_info'],
		'mod_active'			=> $LNG['mod_active'],
		'mod_deactive'			=> $LNG['mod_deactive'],
		'mod_change_active'		=> $LNG['mod_change_active'],
		'mod_change_deactive'	=> $LNG['mod_change_deactive'],
		'adminName'				=> $USER['username'],
		'domainHost'			=> $_SERVER['HTTP_HOST'],
		'membersOnline'			=> pretty_number($CountQuery['total']),
		'serverLoad'			=> round($memory_usage,2),
	));
	
	$template->show('ModulePage.tpl');
}