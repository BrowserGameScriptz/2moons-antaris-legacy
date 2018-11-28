<?php
function calculateAttackSpace(&$attackers, &$defenders, $FleetTF, $DefTF, $Handicap)
{
	global $pricelist, $CombatCaps, $resource;	
	$TRES 	= array('attacker' => 0, 'defender' => 0);
	$ARES 	= $DRES = array('metal' => 0, 'crystal' => 0, 'deuterium' => 0, 'elyrium' => 0);
	$ROUND	= array();
	$RF		= array();
	foreach ($attackers as $fleetID => $attacker) 
	{
		foreach ($attacker['unit'] as $element => $amount) 
		{
			$getUserShip = $GLOBALS['DATABASE']->getFirstRow("SELECT cost901, cost902, cost903, cost904 FROM ".VARS_USER." WHERE varId = ".$element.";");
			$ARES['metal'] 		+= $getUserShip['cost901'] * $amount;
			$ARES['crystal'] 	+= $getUserShip['cost902'] * $amount;
			$ARES['deuterium'] 	+= $getUserShip['cost903'] * $amount;
			$ARES['elyrium'] 	+= $getUserShip['cost904'] * $amount;
		}
	}
	foreach($CombatCaps as $e => $arr) {
		if(!isset($arr['sd'])) continue;
		foreach($arr['sd'] as $t => $sd) {
			if($sd == 0) continue;
			$RF[$t][$e] = $sd;
		}
	}
	
	$resourceArrayIds = array(901,902,903,904);
	$TRES['attacker']	= $ARES['metal'] + $ARES['crystal'] + $ARES['deuterium'] + $ARES['elyrium'];
	foreach ($defenders as $fleetID => $defender) 
	{
		foreach ($defender['unit'] as $element => $amount)
		{
			$getUserShip = $GLOBALS['DATABASE']->getFirstRow("SELECT cost901, cost902, cost903, cost904 FROM ".VARS_USER." WHERE varId = ".$element.";");
			if ($element < 300) {
				$DRES['metal'] 		+= $pricelist[$element]['cost'][901] * $amount;
				$DRES['crystal'] 	+= $pricelist[$element]['cost'][902] * $amount ;
				$DRES['deuterium'] 	+= $pricelist[$element]['cost'][903] * $amount ;
				$DRES['elyrium'] 	+= $pricelist[$element]['cost'][904] * $amount ;
				$TRES['defender'] 	+= $pricelist[$element]['cost'][901] * $amount;
				$TRES['defender'] 	+= $pricelist[$element]['cost'][902] * $amount;
				$TRES['defender'] 	+= $pricelist[$element]['cost'][903] * $amount;
				$TRES['defender'] 	+= $pricelist[$element]['cost'][904] * $amount;
			} elseif ($element > 400 && $element < 500) {
				if (!isset($STARTDEF[$element])) 
					$STARTDEF[$element] = 0;
				$STARTDEF[$element] += $amount;
				$TRES['defender']	+= $pricelist[$element]['cost'][901] * $amount;
				$TRES['defender']	+= $pricelist[$element]['cost'][902] * $amount;
				$TRES['defender']	+= $pricelist[$element]['cost'][903] * $amount;
				$TRES['defender']	+= $pricelist[$element]['cost'][904] * $amount;
			} else {
				$DRES['metal'] 		+= $getUserShip['cost901'] * $amount;
				$DRES['crystal'] 	+= $getUserShip['cost902'] * $amount ;
				$DRES['deuterium'] 	+= $getUserShip['cost903'] * $amount ;
				$DRES['elyrium'] 	+= $getUserShip['cost904'] * $amount ;
				$TRES['defender'] 	+= $getUserShip['cost901'] * $amount;
				$TRES['defender'] 	+= $getUserShip['cost902'] * $amount;
				$TRES['defender'] 	+= $getUserShip['cost903'] * $amount;
				$TRES['defender'] 	+= $getUserShip['cost904'] * $amount;
			}
		}
	}
		for ($ROUNDC = 0; $ROUNDC <= MAX_ATTACK_ROUNDS; $ROUNDC++) 
	{
		$attackDamage  = array('total' => 0);
		$attackShield  = array('total' => 0);
		$attackAmount  = array('total' => 0);
		$defenseDamage = array('total' => 0);
		$defenseShield = array('total' => 0);
		$defenseAmount = array('total' => 0);
		$attArray = array();
		$defArray = array();

		foreach ($attackers as $fleetID => $attacker) {
			$attackDamage[$fleetID] = 0;
			$attackShield[$fleetID] = 0;
			$attackAmount[$fleetID] = 0;

			$attTech	= (1 + (0.1 * $attacker['player']['military_tech']) + $attacker['player']['factor']['Attack']); //attaque
			$defTech	= (1 + (0.1 * $attacker['player']['defence_tech']) + $attacker['player']['factor']['Defensive']); //bouclier
			$shieldTech = (1 + (0.1 * $attacker['player']['shield_tech']) + $attacker['player']['factor']['Shield']); //coque
			$attackers[$fleetID]['techs'] = array($attTech, $defTech, $shieldTech);
				
			foreach ($attacker['unit'] as $element => $amount) {
				$getUserShip = $GLOBALS['DATABASE']->getFirstRow("SELECT shipAttack, shipCoque, shipBouclier FROM ".VARS_USER." WHERE varId = ".$element.";");
				if($element < 1500){
					if(!in_array($element, $resourceArrayIds)){
						$thisAtt	= $amount * ($CombatCaps[$element]['attack']) * $attTech; //attaque
						$thisDef	= $amount * ($CombatCaps[$element]['shield']) * $defTech ; //bouclier
						$thisShield	= $amount * ($CombatCaps[$element]['coque']) * $shieldTech; //coque
					}
				}else{
					$thisAtt	= $amount * ($getUserShip['shipAttack']) * $attTech; //attaque
					$thisDef	= $amount * ($getUserShip['shipBouclier']) * $defTech ; //bouclier
					$thisShield	= $amount * ($getUserShip['shipCoque']) * $shieldTech; //coque
				}
				$attArray[$fleetID][$element] = array('def' => $thisDef, 'shield' => $thisShield, 'att' => $thisAtt);

				$attackDamage[$fleetID] += $thisAtt;
				$attackDamage['total'] += $thisAtt;
				$attackShield[$fleetID] += $thisDef;
				$attackShield['total'] += $thisDef;
				$attackAmount[$fleetID] += $amount;
				$attackAmount['total'] += $amount;
			}
		}

		foreach ($defenders as $fleetID => $defender) {
			$defenseDamage[$fleetID] = 0;
			$defenseShield[$fleetID] = 0;
			$defenseAmount[$fleetID] = 0;

			$attTech	= (1 + (0.1 * $defender['player']['military_tech']) + $defender['player']['factor']['Attack']); //attaquue
			$defTech	= (1 + (0.1 * $defender['player']['defence_tech']) + $defender['player']['factor']['Defensive']); //bouclier
			$shieldTech = (1 + (0.1 * $defender['player']['shield_tech']) + $defender['player']['factor']['Shield']); //coque
			$defenders[$fleetID]['techs'] = array($attTech, $defTech, $shieldTech);

			foreach ($defender['unit'] as $element => $amount) {
				if($element < 1500){
					if(!in_array($element, $resourceArrayIds)){
						$thisAtt	= $amount * ($CombatCaps[$element]['attack']) * $attTech; //attaque
						$thisDef	= $amount * ($CombatCaps[$element]['shield']) * $defTech ; //bouclier
						$thisShield	= $amount * ($CombatCaps[$element]['coque']) * $shieldTech; //coque
					}
				}else{
					$thisAtt	= $amount * ((1-$Handicap/100)*$getUserShip['shipAttack']) * $attTech; //attaque
					$thisDef	= $amount * ($getUserShip['shipBouclier']) * $defTech ; //bouclier
					$thisShield	= $amount * ($getUserShip['shipCoque']) * $shieldTech; //coque
				}

				if ($element == 407 || $element == 408 || $element == 409) $thisAtt = 0;

				$defArray[$fleetID][$element] = array('def' => $thisDef, 'shield' => $thisShield, 'att' => $thisAtt);

				$defenseDamage[$fleetID] += $thisAtt;
				$defenseDamage['total'] += $thisAtt;
				$defenseShield[$fleetID] += $thisDef;
				$defenseShield['total'] += $thisDef;
				$defenseAmount[$fleetID] += $amount;
				$defenseAmount['total'] += $amount;
			}
		}
		
		$ROUND[$ROUNDC] = array('attackers' => $attackers, 'defenders' => $defenders, 'attackA' => $attackAmount, 'defenseA' => $defenseAmount, 'infoA' => $attArray, 'infoD' => $defArray);

		if ($ROUNDC >= MAX_ATTACK_ROUNDS || $defenseAmount['total'] <= 0 || $attackAmount['total'] <= 0) {
			break;
		}

		// Calculate hit percentages (ACS only but ok)
		$attackPct = array();
		foreach ($attackAmount as $fleetID => $amount) {
			if (!is_numeric($fleetID)) continue;
				$attackPct[$fleetID] = $amount / $attackAmount['total'];
		}

		$defensePct = array();
		foreach ($defenseAmount as $fleetID => $amount) {
			if (!is_numeric($fleetID)) continue;
				$defensePct[$fleetID] = $amount / $defenseAmount['total'];
		}

		// CALCUL DES PERTES !!!
		$attacker_n = array();
		$attacker_shield = 0;
		$defenderAttack	= 0;
		foreach ($attackers as $fleetID => $attacker) {
			$attacker_n[$fleetID] = array();

			foreach($attacker['unit'] as $element => $amount) {
				if ($amount <= 0) {
					$attacker_n[$fleetID][$element] = 0;
					continue;
				}

				$defender_moc = $amount * ($defenseDamage['total'] * $attackPct[$fleetID]) / $attackAmount[$fleetID];
			
				/* if(isset($RF[$element])) {
					foreach($RF[$element] as $shooter => $shots) {
						foreach($defArray as $fID => $rfdef) {
							if(empty($rfdef[$shooter]['att']) || $attackAmount[$fleetID] <= 0) continue;

							$defender_moc += $rfdef[$shooter]['att'] * $shots / ($amount / $attackAmount[$fleetID] * $attackPct[$fleetID]);
							$defenseAmount['total'] += $defenders[$fID]['unit'][$shooter] * $shots;
						}
					}
				} */
				
				$defenderAttack	+= $defender_moc;
				
				if (($attArray[$fleetID][$element]['def'] / $amount) >= $defender_moc) {
					$attacker_n[$fleetID][$element] = round($amount);
					$attacker_shield += $defender_moc;
					continue;
				}

				$max_removePoints = floor($amount * $defenseAmount['total'] / $attackAmount[$fleetID] * $attackPct[$fleetID]);

				$attacker_shield += min($attArray[$fleetID][$element]['def'], $defender_moc);
				$defender_moc 	 -= min($attArray[$fleetID][$element]['def'], $defender_moc);

				$ile_removePoints = max(min($max_removePoints, $amount * min($defender_moc / $attArray[$fleetID][$element]['shield'] * (rand(0, 200) / 100), 1)), 0);

				$attacker_n[$fleetID][$element] = max(ceil($amount - $ile_removePoints), 0);
			}
		}

		$defender_n = array();
		$defender_shield = 0;
		$attackerAttack	= 0;
		foreach ($defenders as $fleetID => $defender) {
			$defender_n[$fleetID] = array();

			foreach($defender['unit'] as $element => $amount) {
				if ($amount <= 0) {
					$defender_n[$fleetID][$element] = 0;
					continue;
				}

				$attacker_moc = $amount * ($attackDamage['total'] * $defensePct[$fleetID]) / $defenseAmount[$fleetID];
				/* if (isset($RF[$element])) {
					foreach($RF[$element] as $shooter => $shots) {
						foreach($attArray as $fID => $rfatt) {
							if (empty($rfatt[$shooter]['att']) || $defenseAmount[$fleetID] <= 0 ) continue;

							$attacker_moc += $rfatt[$shooter]['att'] * $shots / ($amount / $defenseAmount[$fleetID] * $defensePct[$fleetID]);
							$attackAmount['total'] += $attackers[$fID]['unit'][$shooter] * $shots;
						}
					}
				} */
				
				$attackerAttack	+= $attacker_moc;
				
				if (($defArray[$fleetID][$element]['def'] / $amount) >= $attacker_moc) {
					$defender_n[$fleetID][$element] = round($amount);
					$defender_shield += $attacker_moc;
					continue;
				}
	
				$max_removePoints = floor($amount * $attackAmount['total'] / $defenseAmount[$fleetID] * $defensePct[$fleetID]);
				$defender_shield += min($defArray[$fleetID][$element]['def'], $attacker_moc);
				$attacker_moc 	 -= min($defArray[$fleetID][$element]['def'], $attacker_moc);
				
				$ile_removePoints = max(min($max_removePoints, $amount * min($attacker_moc / $defArray[$fleetID][$element]['shield'] * (rand(0, 200) / 100), 1)), 0);

				$defender_n[$fleetID][$element] = max(ceil($amount - $ile_removePoints), 0);
			}
		}
		
		$ROUND[$ROUNDC]['attack'] 		= $attackerAttack;
		$ROUND[$ROUNDC]['defense'] 		= $defenderAttack;
		$ROUND[$ROUNDC]['attackShield'] = $attacker_shield;
		$ROUND[$ROUNDC]['defShield'] 	= $defender_shield;
		foreach ($attackers as $fleetID => $attacker) {
			$attackers[$fleetID]['unit'] = array_map('round', $attacker_n[$fleetID]);
		}

		foreach ($defenders as $fleetID => $defender) {
			$defenders[$fleetID]['unit'] = array_map('round', $defender_n[$fleetID]);
		}
	}
	
	if ($attackAmount['total'] <= 0 && $defenseAmount['total'] > 0) {
		$won = "r"; // defender
	} elseif ($attackAmount['total'] > 0 && $defenseAmount['total'] <= 0) {
		$won = "a"; // attacker
	} else {
		$won = "w"; // draw
	}

	// CDR
	foreach ($attackers as $fleetID => $attacker) {					   // flotte attaquant en CDR
		foreach ($attacker['unit'] as $element => $amount) {
			
			$getUserShip = $GLOBALS['DATABASE']->getFirstRow("SELECT cost901, cost902, cost903, cost904 FROM ".VARS_USER." WHERE varId = ".$element.";");
			
			if($element < 1500){
				$TRES['attacker'] -= $pricelist[$element]['cost'][901] * $amount ;
				$TRES['attacker'] -= $pricelist[$element]['cost'][902] * $amount ;
				$TRES['attacker'] -= $pricelist[$element]['cost'][903] * $amount ;
				$TRES['attacker'] -= $pricelist[$element]['cost'][904] * $amount ;

				$ARES['metal'] -= $pricelist[$element]['cost'][901] * $amount ;
				$ARES['crystal'] -= $pricelist[$element]['cost'][902] * $amount ;
				$ARES['deuterium'] -= $pricelist[$element]['cost'][903] * $amount ;
				$ARES['elyrium'] -= $pricelist[$element]['cost'][904] * $amount ;
			}else{
				$TRES['attacker'] -= $getUserShip['cost901'] * $amount ;
				$TRES['attacker'] -= $getUserShip['cost902'] * $amount ;
				$TRES['attacker'] -= $getUserShip['cost903'] * $amount ;
				$TRES['attacker'] -= $getUserShip['cost904'] * $amount ;

				$ARES['metal'] -= $getUserShip['cost901'] * $amount ;
				$ARES['crystal'] -= $getUserShip['cost902'] * $amount ;
				$ARES['deuterium'] -= $getUserShip['cost903'] * $amount ;
				$ARES['elyrium'] -= $getUserShip['cost904'] * $amount ;
			}
		}
	}

	$DRESDefs = array('metal' => 0, 'crystal' => 0, 'deuterium' => 0, 'elyrium' => 0);

	foreach ($defenders as $fleetID => $defender) {
		foreach ($defender['unit'] as $element => $amount) {
			$getUserShip = $GLOBALS['DATABASE']->getFirstRow("SELECT cost901, cost902, cost903, cost904 FROM ".VARS_USER." WHERE varId = ".$element.";");
			
			if ($element < 300) {							// flotte defenseur en CDR
				$DRES['metal'] 	 -= $pricelist[$element]['cost'][901] * $amount ;
				$DRES['crystal'] -= $pricelist[$element]['cost'][902] * $amount ;
				$DRES['deuterium'] -= $pricelist[$element]['cost'][903] * $amount ;
				$DRES['elyrium'] -= $pricelist[$element]['cost'][904]* $amount ;

				$TRES['defender'] -= $pricelist[$element]['cost'][901] * $amount ;
				$TRES['defender'] -= $pricelist[$element]['cost'][902] * $amount ;
				$TRES['defender'] -= $pricelist[$element]['cost'][903] * $amount ;
				$TRES['defender'] -= $pricelist[$element]['cost'][904] * $amount ;
			} elseif ($element > 400 && $element < 500) {							// flotte defenseur en CDR
				$TRES['defender'] -= $pricelist[$element]['cost'][901] * $amount ;
				$TRES['defender'] -= $pricelist[$element]['cost'][902] * $amount ;
				$TRES['defender'] -= $pricelist[$element]['cost'][903] * $amount ;
				$TRES['defender'] -= $pricelist[$element]['cost'][904] * $amount ;

				$lost = $STARTDEF[$element] - $amount;
				$giveback = round($lost * (50 / 100));
				$defenders[$fleetID]['unit'][$element] += $giveback;
				$DRESDefs['metal'] 	 += $pricelist[$element]['cost'][901] * ($lost - $giveback) ;
				$DRESDefs['crystal'] += $pricelist[$element]['cost'][902] * ($lost - $giveback) ;
				$DRESDefs['deuterium'] += $pricelist[$element]['cost'][903] * ($lost - $giveback) ;
				$DRESDefs['elyrium'] += $pricelist[$element]['cost'][904] * ($lost - $giveback) ;
			}else {									// defs defenseur en CDR + reconstruction
				$DRES['metal'] 	 -= $getUserShip['cost901'] * $amount ;
				$DRES['crystal'] -= $getUserShip['cost902'] * $amount ;
				$DRES['deuterium'] -= $getUserShip['cost903'] * $amount ;
				$DRES['elyrium'] -= $getUserShip['cost904']* $amount ;

				$TRES['defender'] -= $getUserShip['cost901'] * $amount ;
				$TRES['defender'] -= $getUserShip['cost902'] * $amount ;
				$TRES['defender'] -= $getUserShip['cost903'] * $amount ;
				$TRES['defender'] -= $getUserShip['cost904'] * $amount ;
			}
		}
	}
	
	$ARES['metal']		= max($ARES['metal'], 0);
	$ARES['crystal']	= max($ARES['crystal'], 0);
	$ARES['deuterium']	= max($ARES['deuterium'], 0);
	$ARES['elyrium']	= max($ARES['elyrium'], 0);
	$DRES['metal']		= max($DRES['metal'], 0);
	$DRES['crystal']	= max($DRES['crystal'], 0);
	$DRES['deuterium']	= max($DRES['deuterium'], 0);
	$DRES['elyrium']	= max($DRES['elyrium'], 0);
	$TRES['attacker']	= max($TRES['attacker'], 0);
	$TRES['defender']	= max($TRES['defender'], 0);
	
	$totalLost = array('attacker' => $TRES['attacker'], 'defender' => $TRES['defender']);
	$debAttMet = ($ARES['metal'] * ($FleetTF / 100));
	$debAttCry = ($ARES['crystal'] * ($FleetTF / 100));
	$debAttDeu = ($ARES['deuterium'] * ($FleetTF / 100));
	$debAttEly = ($ARES['elyrium'] * ($FleetTF / 100));
	$debDefMet = ($DRES['metal'] * ($FleetTF / 100)) + ($DRESDefs['metal'] * ($DefTF / 100));
	$debDefCry = ($DRES['crystal'] * ($FleetTF / 100)) + ($DRESDefs['crystal'] * ($DefTF / 100));
	$debDefCDeu = ($DRES['deuterium'] * ($FleetTF / 100)) + ($DRESDefs['deuterium'] * ($DefTF / 100));
	$debDefEly = ($DRES['elyrium'] * ($FleetTF / 100)) + ($DRESDefs['elyrium'] * ($DefTF / 100));

	return array('won' => $won, 'debris' => array('attacker' => array(901 => $debAttMet, 902 => $debAttCry, 903 => $debAttDeu, 904 => $debAttEly), 'defender' => array(901 => $debDefMet, 902 => $debDefCry, 903 => $debDefCDeu, 904 => $debDefEly)), 'rw' => $ROUND, 'unitLost' => $totalLost);
}