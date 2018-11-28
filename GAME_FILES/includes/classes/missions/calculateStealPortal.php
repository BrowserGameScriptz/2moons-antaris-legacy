<?php
function calculateStealPortal($attackFleets, $defenderPlanet, $simMode = false, $Small = 0, $Large = 0)
{	
	//Steal-Math by Slaver for 2Moons(http://www.2moons.cc) based on http://www.owiki.de/Beute
	global $pricelist, $resource;
	$firstResource	= 901;
	$secondResource	= 902;
	$thirdResource	= 903;
	$ForthResource	= 904;
	$SortFleets 	= array();
	$capacity  	= 0;
	$stealResource	= array(
		$firstResource => 0,
		$secondResource => 0,
		$thirdResource => 0,
		$ForthResource => 0
	);
	foreach($attackFleets as $FleetID => $Attacker)
	{
		$SortFleets[$FleetID]		= 0;
		
		foreach($Attacker['unit'] as $Element => $amount)	
		{
			$SortFleets[$FleetID]		+= $pricelist[$Element]['capacity'] * $amount;
		}
		$SortFleets[$FleetID]	*= (1 + $Attacker['player']['factor']['ShipStorage']);
		$capacity				+= $SortFleets[$FleetID];
	}		$capacity				+= $pricelist[202]['capacity'] * $Small;	$capacity				+= $pricelist[203]['capacity'] * $Large;
	$AllCapacity		= $capacity;
	if($AllCapacity <= 0)
	{
		return $stealResource;
	}
	// tep 1
	$stealResource[$firstResource]		= min($capacity / 4, $defenderPlanet[$resource[$firstResource]] / 2);
	$capacity	-= $stealResource[$firstResource];
	// Step 2
	$stealResource[$secondResource] 	= min($capacity / 3, $defenderPlanet[$resource[$secondResource]] / 2);
	$capacity	-= $stealResource[$secondResource];
	// Step 3
	$stealResource[$thirdResource] 		= min($capacity / 2, $defenderPlanet[$resource[$thirdResource]] / 2);
	$capacity	-= $stealResource[$thirdResource];
	// Step 4
	$stealResource[$ForthResource] 		= min($capacity, $defenderPlanet[$resource[$ForthResource]] / 2);
	$capacity	-= $stealResource[$ForthResource];
	// Step 5
	$oldMetalBooty  					= $stealResource[$firstResource];
	$stealResource[$firstResource] 		+= min($capacity / 2, $defenderPlanet[$resource[$firstResource]] / 2 - $stealResource[$firstResource]);
	$capacity	-= $stealResource[$firstResource] - $oldMetalBooty; 
	// Step 6
	$stealResource[$secondResource] 	+= min($capacity, $defenderPlanet[$resource[$secondResource]] / 2 - $stealResource[$secondResource]);
	// Step 6
	$stealResource[$thirdResource] 	+= min($capacity, $defenderPlanet[$resource[$thirdResource]] / 2 - $stealResource[$thirdResource]);
	if($simMode)
	{
		return $stealResource;
	}
	return $stealResource;
}