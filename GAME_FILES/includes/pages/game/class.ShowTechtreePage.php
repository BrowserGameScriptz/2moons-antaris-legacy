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
 * @info $Id: class.ShowTechtreePage.php 2632 2013-03-18 19:05:14Z slaver7 $
 * @link http://2moons.cc/
 */


class ShowTechtreePage extends AbstractPage
{
	public static $requireModule = MODULE_TECHTREE;

	function __construct() 
	{
		parent::__construct();
	}
	
	function show()
	{
		global $resource, $requeriments, $LNG, $reslist, $USER, $PLANET;
		
		$RequeriList	= array();

		$elementID		= array(0,4,10,1,2,3,48,7,8,9,11,22,23,24,25,45,21,46,14,31,5,33,47);
			
		foreach($elementID as $Element)
		{			
			if(!isset($resource[$Element])) {
				$TechTreeList[$Element]	= $Element;
			
			} else {
				$RequeriList	= array();
				if(isset($requeriments[$Element]))
				{
					foreach($requeriments[$Element] as $requireID => $RedCount)
					{
						$RequeriList[$requireID]	= array('count' => $RedCount, 'own' => (isset($PLANET[$resource[$requireID]])) ? $PLANET[$resource[$requireID]] : $USER[$resource[$requireID]]);
					}
				}
				
				$TechTreeList[$Element]	= $RequeriList;
			}
		}
		
		$this->tplObj->assign_vars(array(
			'TechTreeList'		=> $TechTreeList,
		));

		$this->display('page.techtree.default.tpl');
	}
	function buildings()
	{
		global $resource, $requeriments, $LNG, $reslist, $USER, $PLANET;
		
		$RequeriList	= array();

		$elementID		= array(0,4,10,1,2,3,48,7,8,9,11,22,23,24,25,45,21,46,14,5,33,47); 
			
		foreach($elementID as $Element)
		{			
			if(!isset($resource[$Element])) {
				$TechTreeList[$Element]	= $Element;
			
			} else {
				$RequeriList	= array();
				if(isset($requeriments[$Element]))
				{
					foreach($requeriments[$Element] as $requireID => $RedCount)
					{
						$RequeriList[$requireID]	= array('count' => $RedCount, 'own' => (isset($PLANET[$resource[$requireID]])) ? $PLANET[$resource[$requireID]] : $USER[$resource[$requireID]]);
					}
				}
				
				$TechTreeList[$Element]	= $RequeriList;
			}
		}
		
		$this->tplObj->assign_vars(array(
			'TechTreeList'		=> $TechTreeList,
		));

		$this->display('page.techtree.default.tpl');
	}
	
	function research()
	{
		global $resource, $requeriments, $LNG, $reslist, $USER, $PLANET;
		
		$RequeriList	= array();

		$elementID		= array(100,113,140,141,142,143,144,109,110,111,115,117,118,124,145,106,146,147,148,149);
			
		foreach($elementID as $Element)
		{			
			if(!isset($resource[$Element])) {
				$TechTreeList[$Element]	= $Element;
			
			} else {
				$RequeriList	= array();
				if(isset($requeriments[$Element]))
				{
					foreach($requeriments[$Element] as $requireID => $RedCount)
					{
						$RequeriList[$requireID]	= array('count' => $RedCount, 'own' => (isset($PLANET[$resource[$requireID]])) ? $PLANET[$resource[$requireID]] : $USER[$resource[$requireID]]);
					}
				}
				
				$TechTreeList[$Element]	= $RequeriList;
			}
		}
		
		$this->tplObj->assign_vars(array(
			'TechTreeList'		=> $TechTreeList,
		));

		$this->display('page.techtree.default.tpl');
	}
	function ships()
	{
		global $resource, $requeriments, $LNG, $reslist, $USER, $PLANET;
		
		$RequeriList	= array();

		$elementID		= array(200,202,203,210,224,225,226,209,223,219,221,222);
			
		foreach($elementID as $Element)
		{			
			if(!isset($resource[$Element])) {
				$TechTreeList[$Element]	= $Element;
			
			} else {
				$RequeriList	= array();
				if(isset($requeriments[$Element]))
				{
					foreach($requeriments[$Element] as $requireID => $RedCount)
					{
						$RequeriList[$requireID]	= array('count' => $RedCount, 'own' => (isset($PLANET[$resource[$requireID]])) ? $PLANET[$resource[$requireID]] : $USER[$resource[$requireID]]);
					}
				}
				
				$TechTreeList[$Element]	= $RequeriList;
			}
		}
		
		$this->tplObj->assign_vars(array(
			'TechTreeList'		=> $TechTreeList,
		));

		$this->display('page.techtree.default.tpl');
	}
	
	function defense()
	{
		global $resource, $requeriments, $LNG, $reslist, $USER, $PLANET;
		
		$RequeriList	= array();

		$elementID		= array(400,412,413,414,415,416,417,418);
			
		foreach($elementID as $Element)
		{			
			if(!isset($resource[$Element])) {
				$TechTreeList[$Element]	= $Element;
			
			} else {
				$RequeriList	= array();
				if(isset($requeriments[$Element]))
				{
					foreach($requeriments[$Element] as $requireID => $RedCount)
					{
						$RequeriList[$requireID]	= array('count' => $RedCount, 'own' => (isset($PLANET[$resource[$requireID]])) ? $PLANET[$resource[$requireID]] : $USER[$resource[$requireID]]);
					}
				}
				
				$TechTreeList[$Element]	= $RequeriList;
			}
		}
		
		$this->tplObj->assign_vars(array(
			'TechTreeList'		=> $TechTreeList,
		));

		$this->display('page.techtree.default.tpl');
	}
	
	function infra()
	{
		global $resource, $requeriments, $LNG, $reslist, $USER, $PLANET;
		
		$RequeriList	= array();

		$elementID		= array(1100,1101,1102,1103,1104,1105,1106,1107,1108,1109);
			
		foreach($elementID as $Element)
		{			
			if(!isset($resource[$Element])) {
				$TechTreeList[$Element]	= $Element;
			
			} else {
				$RequeriList	= array();
				if(isset($requeriments[$Element]))
				{
					foreach($requeriments[$Element] as $requireID => $RedCount)
					{
						$RequeriList[$requireID]	= array('count' => $RedCount, 'own' => (isset($PLANET[$resource[$requireID]])) ? $PLANET[$resource[$requireID]] : $USER[$resource[$requireID]]);
					}
				}
				
				$TechTreeList[$Element]	= $RequeriList;
			}
		}
		
		$this->tplObj->assign_vars(array(
			'TechTreeList'		=> $TechTreeList,
		));

		$this->display('page.techtree.default.tpl');
	}
	
	function compo()
	{
		global $resource, $requeriments, $LNG, $reslist, $pricelist, $USER, $PLANET;
		
		$RequeriList	= array();

		$elementID		= array(1200,1201,1202,1203,1204,1205,1206,1207,1208,1209,1210,1211,1212,1213,1214,1215,1216,1217,1218,1219,1220,1221,1222,1223,1224,1225,1226,1227,1228,1229,1230,1231,1232,1233,1234,1235,1236);
			
		foreach($elementID as $Element)
		{			
			if(!isset($resource[$Element])) {
				$TechTreeList[$Element]	= $Element;
			} else {
				$RequeriList	= array();
				if(isset($requeriments[$Element]))
				{
					foreach($requeriments[$Element] as $requireID => $RedCount)
					{
						$RequeriList[$requireID]	= array('count' => $RedCount, 'own' => (isset($PLANET[$resource[$requireID]])) ? $PLANET[$resource[$requireID]] : $USER[$resource[$requireID]]);
					}
				}
				
				$TechTreeList[$Element]	= $RequeriList;
				

			}
		}
		
		$this->tplObj->assign_vars(array(
			'TechTreeList'		=> $TechTreeList,
		));

		$this->display('page.techtree.default.tpl');
	}
	
	function population()
	{
		global $resource, $requeriments, $LNG, $reslist, $USER, $PLANET;
		
		$RequeriList	= array();

		$elementID		= array(300,301,302,303,306,307,308,309,304,305);
			
		foreach($elementID as $Element)
		{			
			if(!isset($resource[$Element])) {
				$TechTreeList[$Element]	= $Element;
			
			} else {
				$RequeriList	= array();
				if(isset($requeriments[$Element]))
				{
					foreach($requeriments[$Element] as $requireID => $RedCount)
					{
						$RequeriList[$requireID]	= array('count' => $RedCount, 'own' => (isset($PLANET[$resource[$requireID]])) ? $PLANET[$resource[$requireID]] : $USER[$resource[$requireID]]);
					}
				}
				
				$TechTreeList[$Element]	= $RequeriList;
			}
		}
		
		$this->tplObj->assign_vars(array(
			'TechTreeList'		=> $TechTreeList,
		));

		$this->display('page.techtree.default.tpl');
	}
}