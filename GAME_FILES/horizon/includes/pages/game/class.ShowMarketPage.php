<?php

class ShowMarketPage extends AbstractPage
{
    
	public static $requireModule = MODULE_MARKET;
	function __construct() 
	{
		parent::__construct();
	}
	
	function show(){
		global $USER, $PLANET, $LNG, $UNI, $CONF,$resource,$pricelist;
		
		$Message		 = "";
		$MsgColor		 = "";
		$id	 			 = HTTP::_GP('id', 0);
		if($_SERVER['REQUEST_METHOD'] === 'GET' && $id != 0){
			$action	 		= HTTP::_GP('action', 'accept', UTF8_SUPPORT);
			$actioArray		= array('accept', 'delete', 'end');
			$sender			= $GLOBALS['DATABASE']->getFirstRow("SELECT sender, owner, state FROM ".BUDDY." WHERE id = ".$id.";");
			
			if(!in_array($action, $actioArray)){
				$Message = $LNG['NOUVEAUTE_753'];
				$MsgColor = "rouge";
			}else{
				switch($action) {
					case "accept":
						if(empty($sender)){
							$Message = $LNG['NOUVEAUTE_754'];
							$MsgColor = "rouge";
						}elseif(($sender['owner'] != $USER['id'] && $sender['sender'] != $USER['id'])){
							$Message = $LNG['NOUVEAUTE_754'];
							$MsgColor = "rouge";
						}elseif($sender['owner'] != $USER['id']){
							$Message = $LNG['NOUVEAUTE_760'];
							$MsgColor = "rouge";
						}else{
							$senderUser	   = $GLOBALS['DATABASE']->getFirstRow("SELECT lang, ally_id, username, id FROM ".USERS." WHERE id = ".$sender['sender'].";");
							$targetUser	   = $GLOBALS['DATABASE']->getFirstRow("SELECT ally_id, lang, id, username FROM ".USERS." WHERE id = ".$sender['owner'].";");
							$userAlliance  = $senderUser['ally_id'] == 0 ? "" : " <span class='orange'>[".$this->getAllianceTag($senderUser['ally_id'])."]</span>";
							$ennemAlliance = $targetUser['ally_id'] == 0 ? "" : " <span class='orange'>[".$this->getAllianceTag($targetUser['ally_id'])."]</span>";
							$GLOBALS['DATABASE']->query("UPDATE ".BUDDY." SET state = 1, time = ".(TIMESTAMP)." WHERE id = ".$id.";");	
							$Message = sprintf($LNG['NOUVEAUTE_762'], $senderUser['username']);
							$MsgColor = "vert";
							$message = sprintf($LNG['NOUVEAUTE_756'], $senderUser['username'], $userAlliance, $targetUser['username'], $ennemAlliance, $senderUser['username'], $userAlliance);
							SendSimpleMessage($sender['owner'], $sender['sender'], TIMESTAMP, 7, sprintf($LNG['NOUVEAUTE_755'], $this->getUsername($sender['sender'])), sprintf($LNG['NOUVEAUTE_121'], $USER['username'], $this->getUsername($sender['sender'])), $message);
							$LNG		   = new Language($senderUser['lang']);
							$LNG->includeData(array('L18N', 'INGAME', 'TECH', 'CUSTOM'));
							$message = sprintf($LNG['NOUVEAUTE_756'], $senderUser['username'], $userAlliance, $targetUser['username'], $ennemAlliance, $targetUser['username'], $ennemAlliance);
							SendSimpleMessage($sender['sender'], $sender['owner'], TIMESTAMP, 7, sprintf($LNG['NOUVEAUTE_755'], $this->getUsername($sender['owner'])), sprintf($LNG['NOUVEAUTE_121'], $USER['username'], $this->getUsername($sender['sender'])), $message);
						}
					break;
					case "delete":
						if(empty($sender)){
							$Message = $LNG['NOUVEAUTE_754'];
							$MsgColor = "rouge";
						}elseif(($sender['owner'] != $USER['id'] && $sender['sender'] != $USER['id'])){
							$Message = $LNG['NOUVEAUTE_754'];
							$MsgColor = "rouge";
						}elseif($sender['owner'] != $USER['id']){
							$Message = $LNG['NOUVEAUTE_761'];
							$MsgColor = "rouge";
						}else{
							$senderUser	   = $GLOBALS['DATABASE']->getFirstRow("SELECT lang, ally_id, username, id FROM ".USERS." WHERE id = ".$sender['sender'].";");
							$targetUser	   = $GLOBALS['DATABASE']->getFirstRow("SELECT ally_id, lang, id, username FROM ".USERS." WHERE id = ".$sender['owner'].";");
							$userAlliance  = $senderUser['ally_id'] == 0 ? "" : " <span class='orange'>[".$this->getAllianceTag($senderUser['ally_id'])."]</span>";
							$ennemAlliance = $targetUser['ally_id'] == 0 ? "" : " <span class='orange'>[".$this->getAllianceTag($targetUser['ally_id'])."]</span>";
							$GLOBALS['DATABASE']->query("DELETE FROM ".BUDDY." WHERE id = ".$id.";");	
							$Message = sprintf($LNG['NOUVEAUTE_763'], $senderUser['username']);
							$MsgColor = "vert";
							$message = sprintf($LNG['NOUVEAUTE_765'], $senderUser['username'], $userAlliance, $targetUser['username'], $ennemAlliance, $targetUser['username'], $ennemAlliance);
							SendSimpleMessage($sender['owner'], $sender['sender'], TIMESTAMP, 7, sprintf($LNG['NOUVEAUTE_764'], $this->getUsername($sender['sender'])), sprintf($LNG['NOUVEAUTE_127'], $USER['username'], $this->getUsername($sender['sender'])), $message);
							$LNG		   = new Language($senderUser['lang']);
							$LNG->includeData(array('L18N', 'INGAME', 'TECH', 'CUSTOM'));
							$message = sprintf($LNG['NOUVEAUTE_765'], $senderUser['username'], $userAlliance, $targetUser['username'], $ennemAlliance, $targetUser['username'], $ennemAlliance);
							SendSimpleMessage($sender['sender'], $sender['owner'], TIMESTAMP, 7, sprintf($LNG['NOUVEAUTE_764'], $this->getUsername($sender['owner'])), sprintf($LNG['NOUVEAUTE_121'], $USER['username'], $this->getUsername($sender['sender'])), $message);
						}	
					break;
					case "end":
						if(empty($sender) || ($sender['owner'] != $USER['id'] && $sender['sender'] != $USER['id'])){
							$Message = $LNG['NOUVEAUTE_754'];
							$MsgColor = "rouge";
						}else{
							$WhoIsSender = $USER['id'] == $sender['sender'] ? $sender['owner'] : $sender['sender'];
							$userAlliance= $USER['ally_id'] == 0 ? "" : " <span class='orange'>[".$this->getAllianceTag($USER['ally_id'])."]</span>";
							$targetUser	   = $GLOBALS['DATABASE']->getFirstRow("SELECT ally_id, lang, id, username FROM ".USERS." WHERE id = ".$WhoIsSender.";");
							$ennemAlliance = $targetUser['ally_id'] == 0 ? "" : " <span class='orange'>[".$this->getAllianceTag($targetUser['ally_id'])."]</span>";
							$GLOBALS['DATABASE']->query("UPDATE ".BUDDY." SET state = 2, time = ".(TIMESTAMP + 24*3600)." WHERE id = ".$id.";");
							$AdverseUsername = $USER['id'] == $sender['sender'] ? $this->getUsername($sender['owner']) : $this->getUsername($sender['sender']);
							$Message = sprintf($LNG['NOUVEAUTE_757'], $AdverseUsername);
							$MsgColor = "vert";
							$message = sprintf($LNG['NOUVEAUTE_759'], $USER['username'], $userAlliance, $targetUser['username'], $ennemAlliance);
							SendSimpleMessage($USER['id'], $WhoIsSender, TIMESTAMP, 7, sprintf($LNG['NOUVEAUTE_758'], $this->getUsername($WhoIsSender)), sprintf($LNG['NOUVEAUTE_125'], $this->getUsername($WhoIsSender), $USER['username']), $message);
							$LNG		   = new Language($targetUser['lang']);
							$LNG->includeData(array('L18N', 'INGAME', 'TECH', 'CUSTOM'));
							$message = sprintf($LNG['NOUVEAUTE_759'], $USER['username'], $userAlliance, $targetUser['username'], $ennemAlliance);
							SendSimpleMessage($WhoIsSender, $USER['id'], TIMESTAMP, 7, sprintf($LNG['NOUVEAUTE_758'], $USER['username']), sprintf($LNG['NOUVEAUTE_125'], $USER['username'], $this->getUsername($WhoIsSender)), $message);
						}
					break;
				}
			}
		}
		
		
		$BuddyListResult	= $GLOBALS['DATABASE']->query("SELECT 
		a.sender, a.state, a.time, a.id as buddyid, 
		b.id, b.username, b.avatar, b.onlinetime, b.galaxy, b.system, b.planet, b.ally_id,
		c.ally_name, c.ally_tag,
		d.text
		FROM (".BUDDY." as a, ".USERS." as b) 
		LEFT JOIN ".ALLIANCE." as c ON c.id = b.ally_id
		LEFT JOIN ".BUDDY_REQUEST." as d ON a.id = d.id
		WHERE 
		(a.sender = ".$USER['id']." AND a.owner = b.id AND a.state = 0) OR 
		(a.owner = ".$USER['id']." AND a.sender = b.id AND a.state = 0);");
		
		$BuddyListResult1	= $GLOBALS['DATABASE']->query("SELECT 
		a.sender, a.state, a.time, a.id as buddyid, 
		b.id, b.username, b.avatar, b.onlinetime, b.galaxy, b.system, b.planet, b.ally_id,
		c.ally_name, c.ally_tag,
		d.text
		FROM (".BUDDY." as a, ".USERS." as b) 
		LEFT JOIN ".ALLIANCE." as c ON c.id = b.ally_id
		LEFT JOIN ".BUDDY_REQUEST." as d ON a.id = d.id
		WHERE 
		(a.sender = ".$USER['id']." AND a.owner = b.id AND a.state = 1) OR 
		(a.owner = ".$USER['id']." AND a.sender = b.id AND a.state = 1);");
		
		$BuddyListResult2	= $GLOBALS['DATABASE']->query("SELECT 
		a.sender, a.state, a.time, a.id as buddyid, 
		b.id, b.username, b.avatar, b.onlinetime, b.galaxy, b.system, b.planet, b.ally_id,
		c.ally_name, c.ally_tag,
		d.text
		FROM (".BUDDY." as a, ".USERS." as b) 
		LEFT JOIN ".ALLIANCE." as c ON c.id = b.ally_id
		LEFT JOIN ".BUDDY_REQUEST." as d ON a.id = d.id
		WHERE 
		(a.sender = ".$USER['id']." AND a.owner = b.id AND a.state = 2 AND a.time > ".TIMESTAMP.") OR 
		(a.owner = ".$USER['id']." AND a.sender = b.id AND a.state = 2 AND a.time > ".TIMESTAMP.");");
				
		$myRequestList		= array();
		$otherRequestList	= array();
		$myBuddyList		= array();	
		$myRequestList1		= array();
		$otherRequestList1	= array();
		$myBuddyList1		= array();	
		$myRequestList2		= array();
		$otherRequestList2	= array();
		$myBuddyList2		= array();	
		
		while($BuddyList = $GLOBALS['DATABASE']->fetch_array($BuddyListResult))
		{
			$BuddyList['onlinetime']			= $LNG['NOUVEAUTE_163'];
			$BuddyList['signtime']			= date('d/m/Y H:i:s', $BuddyList['time']);
			$BuddyList['rank']			= $this->getUserRank($BuddyList['id']);
			$myBuddyList[$BuddyList['buddyid']]	= $BuddyList;
		}
		
		while($BuddyList1 = $GLOBALS['DATABASE']->fetch_array($BuddyListResult1))
		{
			$BuddyList1['onlinetime']			= floor((TIMESTAMP - $BuddyList1['onlinetime']) / 60);
			$BuddyList1['signtime']			= date('d/m/Y H:i:s', $BuddyList1['time']);
			$BuddyList1['rank']			= $this->getUserRank($BuddyList1['id']);
			$myBuddyList1[$BuddyList1['buddyid']]	= $BuddyList1;
		}
		
		while($BuddyList2 = $GLOBALS['DATABASE']->fetch_array($BuddyListResult2))
		{
			$BuddyList['onlinetime']			= $LNG['NOUVEAUTE_163'];
			$BuddyList2['signtime']			= date('d/m/Y H:i:s', $BuddyList2['time']);
			$BuddyList2['rank']			= $this->getUserRank($BuddyList2['id']);
			$myBuddyList2[$BuddyList2['buddyid']]	= $BuddyList2;
		}
		
		$GLOBALS['DATABASE']->free_result($BuddyListResult);
		$multiData = array();
		$sender	= $GLOBALS['DATABASE']->query("SELECT owner_1, owner_2 FROM ".DIPLO." WHERE (accept = 1 AND owner_1 = ".$USER['ally_id'].") OR (accept = 1 AND owner_2 = ".$USER['ally_id'].") OR (accept = -1 AND validUntil > ".TIMESTAMP." AND owner_1 = ".$USER['ally_id'].") OR (accept = -1 AND validUntil > ".TIMESTAMP." AND owner_2 = ".$USER['ally_id'].");");
		
		
		while($xb = $GLOBALS['DATABASE']->fetch_array($sender)){
			$Statement = 0;
			if($xb['owner_1'] == $USER['ally_id']){
				$Statement = $xb['owner_2'];
			}else{
				$Statement = $xb['owner_1'];	
			}
			
			$sender	= $GLOBALS['DATABASE']->query("SELECT id FROM ".USERS." WHERE ally_id = ".$Statement.";");
			while($xb = $GLOBALS['DATABASE']->fetch_array($sender)){
			$multiData[$xb['id']]	= array(
				'change_nick'		=> $this->getUsername($xb['id']),
				'avatar'		=> $this->getAvataris($xb['id']),
				'allyid'		=> $Statement,
				'nickname_ally'		=> '['.$this->getAllianceTag($Statement).']',
			);	
			}
		}
		
		$this->tplObj->assign_vars(array(	
			'myBuddyList'		=> $myBuddyList,
			'multiData'			=> $multiData,
			'myBuddyList1'		=> $myBuddyList1,
			'myBuddyList2'		=> $myBuddyList2,
			'Message'			=> $Message,
			'MsgColor'			=> $MsgColor,
		));
		
		$this->display("page.market.default.tpl");
	}
	
	function converter(){
		global $USER, $PLANET, $LNG, $UNI, $CONF,$resource,$pricelist;
		
		$ShowSummary   = 0;
		$ShowMessage   = "";
		$PusshValue	   = 1;
		
		$var901 	   = 1;
		$var902 	   = 1;
		$var903 	   = 1;
		$var904 	   = 1;
		$var302 	   = 1;
		$var303 	   = 1;
		$var304 	   = 1;
		$var305 	   = 1;
		$var306 	   = 1;
		$var307 	   = 1;
		$var308 	   = 1;
		$var202 	   = 1;
		$var203 	   = 1;
		$var210 	   = 1;
		$var224 	   = 1;
		$var225 	   = 1;
		$var226 	   = 1;
		$var221 	   = 1;
		$var222 	   = 1;
		
		$quantite	   = HTTP::_GP('quantite', 0);
		$entite		   = HTTP::_GP('entite', "", UTF8_SUPPORT);
		if($_SERVER['REQUEST_METHOD'] === 'POST'){
			$AllowedArray  		= array('ressource_901', 'ressource_902', 'ressource_903', 'ressource_904', 'appareil_202', 'appareil_203', 'appareil_210', 'appareil_224', 'appareil_225', 'appareil_226', 'appareil_221', 'appareil_222', 'population_301', 'population_302', 'population_303', 'population_304', 'population_305', 'population_306', 'population_307', 'population_308');
			$entiteDetails 		= explode('_', $entite);	
			if(!in_array($entite, $AllowedArray)){
				$ShowMessage   = $LNG['NOUVEAUTE_22'];
			}else{
				switch ($entiteDetails[0]) {
					case "ressource":
						if($entiteDetails[1] == 901){
							$PusshValue = $quantite;
						}elseif($entiteDetails[1] == 902){
							$PusshValue = $quantite * 1.33;
						}elseif($entiteDetails[1] == 903){
							$PusshValue = $quantite * 2;
						}elseif($entiteDetails[1] == 904){
							$PusshValue = $quantite * 4;
						}
					break;
					case "population":
						$PusshValue		= $pricelist[$entiteDetails[1]]['cost'][905] * 20 * $quantite;
					break;
					case "appareil":
						$PusshValue		= ($pricelist[$entiteDetails[1]]['cost'][901] + ($pricelist[$entiteDetails[1]]['cost'][902] * 1.33) + ($pricelist[$entiteDetails[1]]['cost'][903] * 2) + ($pricelist[$entiteDetails[1]]['cost'][904] * 4)) * $quantite;
					break;
				}
				$ShowSummary   = 1;
			}
			// Ressource : 4 unités de Fer = 3 unités d’Or = 2 unités de Cristal = 1 unités de Elyrium.
			// Appareil : il suffit de convertir le prix de l’appareil selon le taux ci-dessus.
			// Population : 1 unité de formation = 20 unités de Fer.
		}
		
		
		$ResourceArray = array(901,902,903,904);
		$PopulataArray = array(302,303,304,305,306,307,308);
		$SpecialiArray = array(202,203,210,224,225,226,221,222);
		$resourceList  = array();
		$PopulataList  = array();
		$SpecialiList  = array();
		
		foreach($ResourceArray as $resId)
		{	
			$resourceList[]	= array(
				'id'		=> $resId,
			);
		}
		
		foreach($PopulataArray as $popId)
		{	
			$PopulataList[]	= array(
				'id'		=> $popId,
				'name'		=> $LNG['tech'][$popId],
				
			);
		}
		
		foreach($SpecialiArray as $specId)
		{	
			$SpecialiList[]	= array(
				'id'		=> $specId,
				'name'		=> $LNG['tech'][$specId],
			);
		}
		
		$entiteDetails1 		= explode('_', $entite);
		$this->tplObj->assign_vars(array(
			'resourceList'		=> $resourceList,
			'PopulataList'		=> $PopulataList,
			'SpecialiList'		=> $SpecialiList,
			'ShowSummary'		=> $ShowSummary,
			'ShowMessage'		=> $ShowMessage,
			'HiddenText'		=> empty($entite) ? "" : sprintf($LNG['NOUVEAUTE_826'], pretty_number($quantite), $LNG['tech'][$entiteDetails1[1]], pretty_number($PusshValue)),
			'valueInput'		=> $quantite,
			'var901' 	 	 	=> pretty_number($PusshValue),
			'var902' 	 	 	=> pretty_number(round(($PusshValue/1.33),2)),
			'var903' 	 		=> pretty_number(round(($PusshValue/2),2)),
			'var904' 			=> pretty_number(round(($PusshValue/4),2)),
			'var302' 	 		=> pretty_number(round(($PusshValue/($pricelist[302]['cost'][905] * 20)),2)),
			'var303' 	 		=> pretty_number(round(($PusshValue/($pricelist[303]['cost'][905] * 20)),2)),
			'var304' 			=> pretty_number(round(($PusshValue/($pricelist[304]['cost'][905] * 20)),2)),
			'var305' 	   		=> pretty_number(round(($PusshValue/($pricelist[305]['cost'][905] * 20)),2)),
			'var306' 	   		=> pretty_number(round(($PusshValue/($pricelist[306]['cost'][905] * 20)),2)),
			'var307' 	   		=> pretty_number(round(($PusshValue/($pricelist[307]['cost'][905] * 20)),2)),
			'var308' 	   		=> pretty_number(round(($PusshValue/($pricelist[308]['cost'][905] * 20)),2)),
			'var202' 	   		=> pretty_number(round(($PusshValue/($pricelist[202]['cost'][901] + ($pricelist[202]['cost'][902] * 1.33) + ($pricelist[202]['cost'][903] * 2) + ($pricelist[202]['cost'][904] * 4))),2)),
			'var203' 	   		=> pretty_number(round(($PusshValue/($pricelist[203]['cost'][901] + ($pricelist[203]['cost'][902] * 1.33) + ($pricelist[203]['cost'][903] * 2) + ($pricelist[203]['cost'][904] * 4))),2)),
			'var210' 	   		=> pretty_number(round(($PusshValue/($pricelist[210]['cost'][901] + ($pricelist[210]['cost'][902] * 1.33) + ($pricelist[210]['cost'][903] * 2) + ($pricelist[210]['cost'][904] * 4))),2)),
			'var224' 	   		=> pretty_number(round(($PusshValue/($pricelist[224]['cost'][901] + ($pricelist[224]['cost'][902] * 1.33) + ($pricelist[224]['cost'][903] * 2) + ($pricelist[224]['cost'][904] * 4))),2)),
			'var225' 	   		=> pretty_number(round(($PusshValue/($pricelist[225]['cost'][901] + ($pricelist[225]['cost'][902] * 1.33) + ($pricelist[225]['cost'][903] * 2) + ($pricelist[225]['cost'][904] * 4))),2)),
			'var226' 	   		=> pretty_number(round(($PusshValue/($pricelist[226]['cost'][901] + ($pricelist[226]['cost'][902] * 1.33) + ($pricelist[226]['cost'][903] * 2) + ($pricelist[226]['cost'][904] * 4))),2)),
			'var221' 	   		=> pretty_number(round(($PusshValue/($pricelist[221]['cost'][901] + ($pricelist[221]['cost'][902] * 1.33) + ($pricelist[221]['cost'][903] * 2) + ($pricelist[221]['cost'][904] * 4))),2)),
			'var222' 	   		=> pretty_number(round(($PusshValue/($pricelist[222]['cost'][901] + ($pricelist[222]['cost'][902] * 1.33) + ($pricelist[222]['cost'][903] * 2) + ($pricelist[222]['cost'][904] * 4))),2)),
		));
		$this->display("page.market.converter.tpl");
	} 
	
	function detail(){
		global $USER, $PLANET, $LNG, $UNI, $CONF,$resource,$pricelist;
		$id	= HTTP::_GP('id', 0);
		
		$GeTransport = $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM ".TRANSORTLOG." WHERE transportID = ".$id.";");
		
		if($GeTransport['senderID'] != $USER['id'] && $GeTransport['receiverID'] != $USER['id'] || empty($GeTransport)){
			$this->redirectTo('game.php?page=market&mode=push');
			return false;
		}
		
		$times 			= str_replace(' ', '&nbsp;', _date('d F Y à H:i', ($GeTransport['time'])), $USER['timezone']);
		$times2 		= str_replace(' ', '&nbsp;', _date('d F Y à H:i', ($GeTransport['time'] + 48*3600)), $USER['timezone']);
		
		$usernameOne 	= $GeTransport['senderID'] == $USER['id'] ? $USER['username'] : $this->getUsername($GeTransport['receiverID']);
		$usernameTWo 	= $GeTransport['senderID'] == $USER['id'] ? $this->getUsername($GeTransport['receiverID']) : $USER['username'];
		$StrongColor1 	= $GeTransport['strongest'] == $USER['id'] ? "rouge" : "vert";
		$StrongColor2 	= $GeTransport['strongest'] == $USER['id'] ? "vert" : "rouge";
		$userIdOne	 	= $GeTransport['senderID'] == $USER['id'] ? $USER['id'] : $GeTransport['receiverID'];
		$userIdTwo	 	= $GeTransport['senderID'] == $USER['id'] ? $GeTransport['receiverID'] : $USER['id'];
		$PushValue1		= 0;
		$PushValue2		= 0;
		$GeTotalSend = $GLOBALS['DATABASE']->query("SELECT * FROM ".TRANSORTLOG." WHERE senderID = ".$userIdOne." AND receiverID = ".$userIdTwo." AND time > ".$GeTransport['time']." AND time <= ".($GeTransport['time'] + 48*3600).";");
		
		$GeTotalSendN = $GLOBALS['DATABASE']->query("SELECT * FROM ".TRANSORTLOG." WHERE senderID = ".$userIdTwo." AND receiverID = ".$userIdOne." AND time > ".$GeTransport['time']." AND time <= ".($GeTransport['time'] + 48*3600).";");
		
		foreach($GeTotalSend as $SendTo){
			$ResourceSendArray		= array();
			$PopulatiSendArray		= array();
			$SDevicesSendArray		= array();
			$ResourceSend			= empty($SendTo['transportRes']) ? array() : explode(';', $SendTo['transportRes']);
			$PopulatiSend			= empty($SendTo['transportPop']) ? array() : explode(';', $SendTo['transportPop']);
			$SDevicesSend			= empty($SendTo['transportDevice']) ? array() : explode(';', $SendTo['transportDevice']);
			
			foreach($ResourceSend as $SendRes)
			{
				$temp 			= explode(',', $SendRes);
				if($temp[1] == 0)
					continue;
				
				$ResourceSendArray[$temp[0]]		= $temp[1];
				
				$Factor 							= 1;
				if($temp[0] == 902)
					$Factor 						= 1.33;
				elseif($temp[0] == 903)
					$Factor 						= 2;
				elseif($temp[0] == 904)
					$Factor 						= 4;
				$PushValue1							+= $temp[1] * $Factor;
			}
			
			foreach($PopulatiSend as $SendPop)
			{
				$temp 			= explode(',', $SendPop);
				if($temp[1] == 0)
					continue;
				
				$PopulatiSendArray[$temp[0]]		= $temp[1];
				$PushValue1							+= $pricelist[$temp[0]]['cost'][905] * 20 * $temp[1];
			}
			
			foreach($SDevicesSend as $SendDev)
			{
				$temp 			= explode(',', $SendDev);
				if($temp[1] == 0)
					continue;
				
				$SDevicesSendArray[$temp[0]]		= $temp[1];
				$PushValue1							+= ($pricelist[$temp[0]]['cost'][901] + ($pricelist[$temp[0]]['cost'][902] * 1.33) + ($pricelist[$temp[0]]['cost'][903] * 2) + ($pricelist[$temp[0]]['cost'][904] * 4)) * $temp[1];
			}
			
		}
		
		foreach($GeTotalSendN as $SendTo){
			$ResourceSendArray		= array();
			$PopulatiSendArray		= array();
			$SDevicesSendArray		= array();
			$ResourceSend			= empty($SendTo['transportRes']) ? array() : explode(';', $SendTo['transportRes']);
			$PopulatiSend			= empty($SendTo['transportPop']) ? array() : explode(';', $SendTo['transportPop']);
			$SDevicesSend			= empty($SendTo['transportDevice']) ? array() : explode(';', $SendTo['transportDevice']);
			
			foreach($ResourceSend as $SendRes)
			{
				$temp 			= explode(',', $SendRes);
				if($temp[1] == 0)
					continue;
				
				$ResourceSendArray[$temp[0]]		= $temp[1];
				
				$Factor 							= 1;
				if($temp[0] == 902)
					$Factor 						= 1.33;
				elseif($temp[0] == 903)
					$Factor 						= 2;
				elseif($temp[0] == 904)
					$Factor 						= 4;
				$PushValue2							+= $temp[1] * $Factor;
			}
			
			foreach($PopulatiSend as $SendPop)
			{
				$temp 			= explode(',', $SendPop);
				if($temp[1] == 0)
					continue;
				
				$PopulatiSendArray[$temp[0]]		= $temp[1];
				$PushValue2							+= $pricelist[$temp[0]]['cost'][905] * 20 * $temp[1];
			}
			
			foreach($SDevicesSend as $SendDev)
			{
				$temp 			= explode(',', $SendDev);
				if($temp[1] == 0)
					continue;
				
				$SDevicesSendArray[$temp[0]]		= $temp[1];
				$PushValue2							+= ($pricelist[$temp[0]]['cost'][901] + ($pricelist[$temp[0]]['cost'][902] * 1.33) + ($pricelist[$temp[0]]['cost'][903] * 2) + ($pricelist[$temp[0]]['cost'][904] * 4)) * $temp[1];
			}
			
		}
		
		
		$PushValue1		+= $GeTransport['senderID'] == $USER['id'] ? $GeTransport['push'] : 0;
		$PushValue2		= $PushValue2;
		$this->tplObj->assign_vars(array(
			'times'			=>	$times,            
			'times2'		=>	$times2,              
			'usernameOne'	=>	$usernameOne,              
			'usernameTWo'	=>	$usernameTWo,              
			'StrongColor1'	=>	$StrongColor1,              
			'StrongColor2'	=>	$StrongColor2,              
			'PushValue1'	=>	pretty_number($PushValue1),              
			'PushValue2'	=>	pretty_number($PushValue2),    
			'PushValue11'	=>	$PushValue1,              
			'PushValue22'	=>	$PushValue2,    
		));
		$this->display("page.market.detail.tpl");
	} 
	
	function push(){
		global $USER, $PLANET, $LNG, $UNI, $CONF,$resource,$pricelist;
		$transportData 	= array();
		$GeTransport 	= $GLOBALS['DATABASE']->query("SELECT * FROM ".TRANSORTLOG." WHERE senderID = ".$USER['id']." AND legal = 1 OR receiverID = ".$USER['id']." AND legal = 1 GROUP BY strongest HAVING time<time + ".(48*3600).";");
		
		foreach($GeTransport as $TransportRow){
			
			$transportData[$TransportRow['transportID']]	= array(
				'avatar'		=> $TransportRow['senderID'] == $USER['id'] ? $this->getAvataris($TransportRow['receiverID']) : $this->getAvataris($TransportRow['senderID']),
				'infouser'		=> $TransportRow['senderID'] == $USER['id'] ? $TransportRow['receiverID'] : $TransportRow['senderID'],
				'change_nick'	=> $TransportRow['senderID'] == $USER['id'] ? $this->getUsername($TransportRow['receiverID']) : $this->getUsername($TransportRow['senderID']),
				'isInDeletion'	=> $TransportRow['delete'] == 0 ? 0 : 1,
			);	
		}

		$this->tplObj->assign_vars(array(
            'transportData' => $transportData,                       
		));
		$this->display("page.market.push.tpl");
	}
	
	function echange(){
		global $USER, $PLANET, $LNG, $UNI, $CONF,$resource,$pricelist;
		$transportData 		= array();
		$GeTransport 		= $GLOBALS['DATABASE']->query("SELECT * FROM ".TRANSORTLOG." WHERE senderID = ".$USER['id']." OR receiverID = ".$USER['id']." ORDER BY time DESC;");
		$GeTransportCount 	= $GLOBALS['DATABASE']->getFirstCell("SELECT COUNT(*) FROM ".TRANSORTLOG." WHERE senderID = ".$USER['id']." OR receiverID = ".$USER['id'].";");
		foreach($GeTransport as $TransportRow){
			$PushValue				= 0;
			$ResourceSendArray		= array();
			$PopulatiSendArray		= array();
			$SDevicesSendArray		= array();
			$ResourceSend			= empty($TransportRow['transportRes']) ? array() : explode(';', $TransportRow['transportRes']);
			$PopulatiSend			= empty($TransportRow['transportPop']) ? array() : explode(';', $TransportRow['transportPop']);
			$SDevicesSend			= empty($TransportRow['transportDevice']) ? array() : explode(';', $TransportRow['transportDevice']);
			
			foreach($ResourceSend as $SendRes)
			{
				$temp 			= explode(',', $SendRes);
				if($temp[1] == 0)
					continue;
				
				$ResourceSendArray[$temp[0]]		= $temp[1];
				
				$Factor 							= 1;
				if($temp[0] == 902)
					$Factor 						= 1.33;
				elseif($temp[0] == 903)
					$Factor 						= 2;
				elseif($temp[0] == 904)
					$Factor 						= 4;
				$PushValue							+= $temp[1] * $Factor;
			}
			
			foreach($PopulatiSend as $SendPop)
			{
				$temp 			= explode(',', $SendPop);
				if($temp[1] == 0)
					continue;
				
				$PopulatiSendArray[$temp[0]]		= $temp[1];
				$PushValue							+= $pricelist[$temp[0]]['cost'][905] * 20 * $temp[1];
			}
			
			foreach($SDevicesSend as $SendDev)
			{
				$temp 			= explode(',', $SendDev);
				if($temp[1] == 0)
					continue;
				
				$SDevicesSendArray[$temp[0]]		= $temp[1];
				$PushValue							+= ($pricelist[$temp[0]]['cost'][901] + ($pricelist[$temp[0]]['cost'][902] * 1.33) + ($pricelist[$temp[0]]['cost'][903] * 2) + ($pricelist[$temp[0]]['cost'][904] * 4)) * $temp[1];
			}
			
			$GLOBALS['DATABASE']->query("UPDATE ".TRANSORTLOG." SET push = ".$PushValue." WHERE transportID = ".$TransportRow['transportID'].";");	
			$transportData[$TransportRow['transportID']]	= array(
				'status'			=> $TransportRow['senderID'] == $USER['id'] ? 'expedition' : 'reception',
				'statusbis'			=> $TransportRow['senderID'] == $USER['id'] ? $LNG['ls_answer_3'] : $LNG['ls_answer_4'],
				'avatar'			=> $TransportRow['senderID'] == $USER['id'] ? $this->getAvataris($TransportRow['receiverID']) : $this->getAvataris($TransportRow['senderID']),
				'infouser'			=> $TransportRow['senderID'] == $USER['id'] ? $TransportRow['receiverID'] : $TransportRow['senderID'],
				'strongest'			=> $TransportRow['strongest'] == $USER['id'] ? 'vert' : 'rouge',
				'change_nick'		=> $TransportRow['senderID'] == $USER['id'] ? $this->getUsername($TransportRow['receiverID']) : $this->getUsername($TransportRow['senderID']),
				'timeoftransport'	=> str_replace(' ', '&nbsp;', _date('d F Y à H:i:s', ($TransportRow['time'])), $USER['timezone']),
				'ResourceSendArray'	=> $ResourceSendArray,
				'PopulatiSendArray'	=> $PopulatiSendArray,
				'SDevicesSendArray'	=> $SDevicesSendArray,
				'PushValue'			=> pretty_number($PushValue),
			);
		}
		$this->tplObj->loadscript('commerce.js');
		$this->tplObj->assign_vars(
		array(
        'transportData' => $transportData,                                
        'GeTransportCount' => pretty_number($GeTransportCount),                                
                                        )
		);
		$this->display("page.market.echange.tpl");
	}
	
	function multi(){
		global $USER, $PLANET, $LNG, $UNI, $CONF,$resource,$pricelist;
		$GetIp = $GLOBALS['DATABASE']->query("SELECT DISTINCT ipaddress FROM ".IPLOG." WHERE userID = ".$USER['id'].";");
		$message = '';
		$multiData = array();

		$messageList = array();
		foreach($GetIp as $xy){
			$multi_sniffer = isset($xy['ipaddress']) ? $xy['ipaddress'] : ''; 
			if(isset($multi_sniffer)){
				$GetendIp = $GLOBALS['DATABASE']->query("SELECT DISTINCT userID, timestamp, logID, ipaddress FROM ".IPLOG." WHERE userID != ".$USER['id']." AND ipaddress = '".$multi_sniffer."' AND timestamp > '".(TIMESTAMP - 7*24*60*60)."';");
				foreach($GetendIp as $xb){
					$getuserAlly = $GLOBALS['DATABASE']->query("SELECT ally_id FROM `uni1_users` WHERE id = ".$xb['userID'].";");
					$getuserAlly = $GLOBALS['DATABASE']->fetch_array($getuserAlly);
						
					$getuserRank = $GLOBALS['DATABASE']->query("SELECT total_rank FROM `uni1_statpoints` WHERE id_owner = ".$xb['userID'].";");
					$getuserRank = $GLOBALS['DATABASE']->fetch_array($getuserRank);
						
						
					$multiData[$xb['logID']]	= array(
						'multi_nickname'		=> $this->getUsername($xb['userID']),
						'avatar'		=> $this->getAvataris($xb['userID']),
						'multi_nickname_ally'		=> $getuserAlly['ally_id'] != 0 ? '['.$this->getAllianceTag($getuserAlly['ally_id']).']' : '',
						'multi_id'		=> $xb['logID'],
						'ally_idtr'		=> $getuserAlly['ally_id'],
						'getuserRank'		=> $getuserRank['total_rank'],
						'multi_ip'		=> $xb['ipaddress'],
						'multi_uid'		=> $xb['userID'],
						'delete_date'		=> str_replace(' ', '&nbsp;', _date($LNG['php_tdformat'], ($xb['timestamp'] + 7*24*60*60)), $USER['timezone']),
					);
				}
				
			}
		}
		$GetAll = $GLOBALS['DATABASE']->query("SELECT * FROM ".IPLOG." WHERE userID = ".$USER['id']." ORDER BY timestamp desc LIMIT 15 ;");
		if($GLOBALS['DATABASE']->numRows($GetAll)>0){
			while($messageRow = $GLOBALS['DATABASE']->fetch_array($GetAll))
			{
				$messageList[$messageRow['logID']]	= array(
					'ipaddress'		=> $messageRow['ipaddress'],
					'date'		=> str_replace(' ', '&nbsp;', _date($LNG['php_tdformat'], $messageRow['timestamp']), $USER['timezone']),
					'browser'		=> $messageRow['browser'],
					'os'		=> $messageRow['os'],
					'version'		=> $messageRow['version'],
				);
			}	
		}
			$this->tplObj->assign_vars(array(
			'messageList' => $messageList,                   
			'multiData' => $multiData,                   
		));
		$this->display("page.market.multi.tpl");
	}
}
	
	
