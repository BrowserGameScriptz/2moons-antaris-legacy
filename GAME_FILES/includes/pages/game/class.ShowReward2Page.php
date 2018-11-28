<?php

class ShowReward2Page extends AbstractPage{
	 public static $requireModule = MODULE_REDEEM;

	function __construct() 
	{
		parent::__construct();
	}
	
	function historique(){
		global $USER, $PLANET, $LNG, $UNI, $CONF;
		$messageList = '';
		$messageRaw	= $GLOBALS['DATABASE']->query("SELECT * FROM ".REWARDSLOG." WHERE rewardUserId = ".$USER['id']." AND rewardTime > ".(TIMESTAMP - 15 * 24 * 60 * 60)." ORDER BY rewardTime DESC;");
	
		while($messageRow = $GLOBALS['DATABASE']->fetch_array($messageRaw)){
			$messageList[$messageRow['rewardIdLog']]	= array(
				'date'		=> str_replace(' ', '&nbsp;', _date($LNG['php_tdformat'], $messageRow['rewardTime']), $USER['timezone']),
				'rewardPrice'		=> $messageRow['rewardPrice'],
				'rewardIdLog'		=> $messageRow['rewardIdLog'],
				'rewardCode'		=> $this->redeemCode($messageRow['rewardIdLog']),
			);
		}
		$this->tplObj->assign_vars(array(
			'messageList' => $messageList,                        
		));
		$this->display("page.reward2.historique.tpl");
	}
	
	
	function show(){
            
		global $USER,$PLANET, $UNI, $LNG;
       	$Message = array();
		if($_SERVER['REQUEST_METHOD'] === 'POST'){	
			//verificarile de rigoare
			$TheCode = HTTP::_GP('voucher','');
			//1. see if code exists
			$CodeExist = $GLOBALS['DATABASE']->query("SELECT * from ".REWARDS." where universe = '".$UNI."' AND `rewardCode` = '".$GLOBALS['DATABASE']->sql_escape($TheCode)."' ;");
			if($GLOBALS['DATABASE']->numRows($CodeExist)==0){
				$Message[] = "<span class='rouge'>".$LNG['NOUVEAUTE_40']."</span>";
			}else{
				//code exists
				$CodeDb = $GLOBALS['DATABASE']->fetch_array($CodeExist);
				$CheckLog = $GLOBALS['DATABASE']->query("SELECT * from ".REWARDSLOG." where universe = '".$UNI."' AND `rewardIdLog` = ".$CodeDb['rewardId']." and `rewardUserId` = ".$USER['id']." ;");
				if($GLOBALS['DATABASE']->numRows($CheckLog)>0){
					$Message[] = "<span class='rouge'>".$LNG['NOUVEAUTE_39']."</span>";
				}else{
					$USER['darkmatter'] += $CodeDb['rewardDarkmatter'];
					$PLANET['metal'] += $CodeDb['rewardMetal'];
					$PLANET['crystal'] += $CodeDb['rewardCrystal'];
					$PLANET['deuterium'] += $CodeDb['rewardDeuterium'];

					//$GLOBALS['DATABASE']->query("Update ".REWARDS." set `rewardCount` = `rewardCount` - 1 where `rewardId` = ".$CodeDb['rewardId']." ;");
					$MessageBegin = array();
					$MessageUser = array();

					if(!empty($CodeDb['rewardMetal'])){
						$MessageBegin[] = $LNG['NOUVEAUTE_42']." <span style='color:#33FF00';>".$CodeDb['rewardMetal']." </span>".$LNG['tech'][901];
						$MessageUser[] = "<span style='color:#33FF00';>".$CodeDb['rewardMetal']." </span>".$LNG['tech'][901];
					}
					if(!empty($CodeDb['rewardCrystal'])){
						$MessageBegin[] = $LNG['NOUVEAUTE_42']." <span style='color:#33FF00';>".$CodeDb['rewardCrystal']." </span>".$LNG['tech'][902];
						$MessageUser[] = "<span style='color:#33FF00';>".$CodeDb['rewardCrystal']." </span>".$LNG['tech'][902];
					}
					if(!empty($CodeDb['rewardDeuterium'])){
						$MessageBegin[] = $LNG['NOUVEAUTE_42']." <span style='color:#33FF00';>".$CodeDb['rewardDeuterium']." </span>".$LNG['tech'][903];
						$MessageUser[] = "<span style='color:#33FF00';>".$CodeDb['rewardDeuterium']." </span>".$LNG['tech'][903];
					}
					if(!empty($CodeDb['rewardElyrium'])){
						$MessageBegin[] = $LNG['NOUVEAUTE_42']." <span style='color:#33FF00';>".$CodeDb['rewardElyrium']." </span>".$LNG['tech'][904];
						$MessageUser[] = "<span style='color:#33FF00';>".$CodeDb['rewardElyrium']." </span>".$LNG['tech'][904];
					}
					if(!empty($CodeDb['rewardDarkmatter'])){
						$MessageBegin[] = $LNG['NOUVEAUTE_42']." <span style='color:#33FF00';>".$CodeDb['rewardDarkmatter']." </span>".$LNG['tech'][921];
						$MessageUser[] = "<span style='color:#33FF00';>".$CodeDb['rewardDarkmatter']." </span>".$LNG['tech'][921];
					}
								
					$MessageBegin = implode("<br>\r\n", $MessageBegin);
					$MessageUser = implode(",\r\n", $MessageUser);
								
					$GLOBALS['DATABASE']->query("INSERT INTO ".REWARDSLOG." VALUES (".$CodeDb['rewardId'].",".$USER['id'].",".TIMESTAMP.", '".$UNI."', '".$GLOBALS['DATABASE']->escape($MessageBegin)."') ;");
									
									
					$Message[] = "<span class='vert'>".sprintf($LNG['NOUVEAUTE_41'], $TheCode, $MessageUser)."</span>";
				}

			}
		}
		
		$this->tplObj->assign_vars(array(
			'Message' 		=> implode("<br>\r\n", $Message),
		));
		$this->display('page.reward2.default.tpl');
	}
}