<?php
class ShowLotteryPage extends AbstractPage
{	
	public static $requireModule = MODULE_LOTTERY;
	
	function __construct() {
		parent::__construct();
	}
	
	function show()
	{
		global  $USER, $PLANET, $LNG, $LANG,$CONF,$UNI;
		$Message = "";
		
		if($USER['urlaubs_modus'] == 1){
			$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_20']."</span>";
			$diferent_users = $GLOBALS['DATABASE']->query("SELECT DISTINCT `id` from ".LOTTERIE." WHERE universe = '".$UNI."' ORDER BY RAND() LIMIT 3 ;");
				if($GLOBALS['DATABASE']->numRows($diferent_users) > 0){
					$lista = '  <table>
					<tr>
					<th class="logo"></th>
					<th class="date_operation">'.$LNG['ti_userna'].'</th>
					<th class="description">'.$LNG['lm_lotto_2'].'</th>
					<th class="description">'.$LNG['lm_lotto_3'].'</th>
					</tr>';
					while($s = $GLOBALS['DATABASE']->fetch_array($diferent_users)){
					$total_user = $GLOBALS['DATABASE']->query("SELECT user, timestamp from ".LOTTERIE." where `id` = '".$s['id']."' AND universe = '".$UNI."' ;");
					$total_user = $GLOBALS['DATABASE']->fetch_array($total_user);
					$lista .= '<tr>
					<td class="logo"></td>
					<td class="date_operation">'.$total_user['user'].'</td>
					<td class="description">'. gmdate('M d Y H:i:s',$total_user['timestamp']).'</td>
					<td class="description">1 <img src="media/image/ticket-icon.png" width="16px" height="16px"/></td>
					</tr>';	 
					}
					$lista .= '</table>';
				}else{
					$lista = "<table>
					<tr>
					<th class='logo'></th>
					<th class='date_operation'>".$LNG['ti_userna']."</th>
					<th class='description'>".$LNG['lm_lotto_2']."</th>
					<th class='description'>".$LNG['lm_lotto_2']."</th>
					</tr>";
					$lista .= "<tr>
					<td class='description' colspan='4'><center><font color='red'>".$LNG['lm_lotto_4']."</font></center></td>
					</tr>";
					$lista .= "</table>";
				}

				$castigatori = $GLOBALS['DATABASE']->query("SELECT *FROM ".LOTTERIELOG." WHERE universe = '".$UNI."' ORDER BY `time` DESC LIMIT 5");
				if($GLOBALS['DATABASE']->numRows($castigatori) >0){
					$lista_winners = "<table>
					<tr>
					<th class='logo'></th>
					<th class='date_operation'>".$LNG['ti_userna']."</th>
					<th class='description'>".$LNG['lm_lotto_2']."</th>
					<th class='description'>".$LNG['lm_lotto_2']."</th>
					</tr>";
					while($x = $GLOBALS['DATABASE']->fetch_array($castigatori)){
						$lista_winners .= " <tr>
						<td class='logo'></td>
						<td class='date_operation'>".$x['username']."</td>
						<td class='description'>". gmdate("M d Y H:i:s",$x['time'] )."</td>
						<td class='description'>".$x['prize']." <img src='/media/ingame/image/credit.png' width='16px' height='16px'/></td>
						</tr>";
					}
					$lista_winners .= "</table>";
				}else{
					$lista_winners = "<table>
					<tr>
					<th class='logo'></th>
					<th class='date_operation'>".$LNG['ti_userna']."</th>
					<th class='description'>".$LNG['lm_lotto_5']."</th>
					<th class='description'>".$LNG['lm_lotto_6']."</th>
					</tr>";
					$lista_winners .= "<tr>
					<td class='description' colspan='4'><center><font color='red'>".$LNG['lm_lotto_7']."</font></center></td>
					</tr>";
					$lista_winners .= "</table>";
				}
			$this->tplObj->assign_vars(array(
				'user_lists' => $lista,
				'winners'	=> $lista_winners,
				'Message' 		=> $Message,
			));
			$this->display("page.lottery.default.tpl");
		}else{
			$max_users_tickets = 1;
			$ticket_price = 20000000;
			
			$this->tplObj->loadscript('jquery.countdown.js');
		
			if($_SERVER['REQUEST_METHOD'] === 'POST'){
				$tickets = HTTP::_GP('tickets', 0);
				$cautare = $GLOBALS['DATABASE']->query("SELECT * from ".LOTTERIE." where `id` = '".$USER['id']."' AND universe = '".$UNI."' ;");
				$cost['metal'] = $tickets * $ticket_price;
				$cost['crystal'] = $tickets * $ticket_price;
				$cost['deuterium'] = $tickets * $ticket_price;
				$cost['elyrium'] = $tickets * $ticket_price;
				
				if(empty($tickets)){
					$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_26']."</span>";
				}elseif($tickets != 1){
					$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_22']."</span>";
				}elseif($USER['urlaubs_modus'] == 1){
					$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_20']."</span>";
				}elseif($GLOBALS['DATABASE']->numRows($cautare) > 0){
					$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_31']."</span>";
				}elseif($PLANET['metal'] < $cost['metal'] || $PLANET['crystal'] < $cost['crystal'] || $PLANET['deuterium'] < $cost['deuterium'] || $PLANET['elyrium'] < $cost['elyrium']){
					$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_32']."</span>";
				}else{
					$PLANET['metal'] -= $cost['metal'];
					$PLANET['crystal'] -= $cost['crystal'];
					$PLANET['deuterium'] -= $cost['deuterium'];
					$PLANET['elyrium'] -= $cost['elyrium'];
					$GLOBALS['DATABASE']->query("INSERT INTO ".LOTTERIE." VALUES ('".$USER['id']."','".$USER['username']."','".$tickets."', '".$UNI."', '".TIMESTAMP."') ;");
					$LOG = new Logcheck(10);
					$LOG->username = $USER['username'];
					$LOG->pageLog  = "page=Lottery";
					$LOG->info     = "The player bought one lottery ticket.";
					$LOG->save();
					$Message = "<span class='vert'>".$LNG['NOUVEAUTE_33']."</span>";
				}
			}

			$total_users = $GLOBALS['DATABASE']->query("SELECT DISTINCT `id` from ".LOTTERIE." WHERE universe = '".$UNI."' ;");
			$total_users = $GLOBALS['DATABASE']->numRows($total_users);
			if($CONF['lottery_time'] < TIMESTAMP){
				if($total_users < 15){
					$lista = "<table>
					<tr>
					<th class='logo'></th>
					<th class='date_operation'>".$LNG['ti_userna']."</th>
					<th class='description'>".$LNG['lm_lotto_2']."</th>
					<th class='description'>".$LNG['lm_lotto_2']."</th>
					</tr>";
					$lista .= "<tr>
					<td class='description' colspan='4'><center><font color='red'>".$LNG['lm_lotto_4']."</font></center></td>
					</tr>";
					$lista .= "</table>";
					$lista_winners = "<table>
					<tr>
					<th class='logo'></th>
					<th class='date_operation'>".$LNG['ti_userna']."</th>
					<th class='description'>".$LNG['lm_lotto_5']."</th>
					<th class='description'>".$LNG['lm_lotto_6']."</th>
					</tr>";
					$lista_winners .= "<tr>
					<td class='description' colspan='4'><center><font color='red'>".$LNG['lm_lotto_7']."</font></center></td>
					</tr>";
					$lista_winners .= "</table>";
					$time = TIMESTAMP+24*60*60;
					$GLOBALS['DATABASE']->query("UPDATE ".CONFIG." SET `lottery_time` = ". $time ." where `uni` = ".$UNI.";");
					$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_36']."</span>";
				}else{

					$get_tickets = $GLOBALS['DATABASE']->query("SELECT *FROM ".C." where universe = '".$UNI."'");
					if($GLOBALS['DATABASE']->numRows($get_tickets) >0){
						$user_array = array();
						$diferent_users = $GLOBALS['DATABASE']->query("SELECT DISTINCT `id` from ".LOTTERIE." where universe = '".$UNI."';");
						while($s = $GLOBALS['DATABASE']->fetch_array($diferent_users)){
							$user_array[] = $s['id'];
						}
						$random = rand(0,count($user_array)-1);
						do{
							$random1 = rand(0,count($user_array)-1);
						}while($random1==$random);
						do{
							$random2 = rand(0,count($user_array)-1);
						}while($random2==$random1 || $random2==$random);

						$total_user  = $GLOBALS['DATABASE']->query("SELECT SUM(tickets) as sum_tickets, user from ".LOTTERIE." where `id` = '".$user_array[$random]."' AND universe = '".$UNI."';");
						$total_user1 = $GLOBALS['DATABASE']->query("SELECT SUM(tickets) as sum_tickets, user from ".LOTTERIE." where `id` = '".$user_array[$random1]."' AND universe = '".$UNI."' ;");
						$total_user2 = $GLOBALS['DATABASE']->query("SELECT SUM(tickets) as sum_tickets, user from ".LOTTERIE." where `id` = '".$user_array[$random2]."' AND universe = '".$UNI."' ;");
						
						$total_user  = $GLOBALS['DATABASE']->fetch_array($total_user);
						$total_user1 = $GLOBALS['DATABASE']->fetch_array($total_user1);
						$total_user2 = $GLOBALS['DATABASE']->fetch_array($total_user2);
					
						$total_user_prize = 3;
						$total_user_prize1 = 2;
						$total_user_prize2 = 1;
					
						$GLOBALS['DATABASE']->query("INSERT INTO ".TRACKING." SET userId = ".$GLOBALS['DATABASE']->escape($user_array[$random]).", userName = '".$this->getUsername($user_array[$random])."', pageVisited = 'page=Lottery', data = '".$GLOBALS['DATABASE']->escape("The player won ".$total_user_prize." credits with the lottery.")."', time = ".TIMESTAMP.", trackMode = 10;");
						if($USER['id'] == $user_array[$random]){
							$USER['darkmatter'] += $total_user_prize;
						}else{
							$GLOBALS['DATABASE']->query("UPDATE ".USERS." set `darkmatter` = `darkmatter` + ".$total_user_prize." where `id` = '".$user_array[$random]."' AND `universe` = '".$UNI."';");
						}
						
						$GLOBALS['DATABASE']->query("INSERT INTO ".TRACKING." SET userId = ".$GLOBALS['DATABASE']->escape($user_array[$random1]).", userName = '".$this->getUsername($user_array[$random1])."', pageVisited = 'page=Lottery', data = '".$GLOBALS['DATABASE']->escape("The player won ".$total_user_prize1." credits with the lottery.")."', time = ".TIMESTAMP.", trackMode = 10;");
						if($USER['id'] == $user_array[$random1]){
							$USER['darkmatter'] += $total_user_prize1;
						}else{
							$GLOBALS['DATABASE']->query("UPDATE ".USERS." set `darkmatter` = `darkmatter` + ".$total_user_prize1." where `id` = '".$user_array[$random1]."' AND `universe` = '".$UNI."';");
						}
						
						$GLOBALS['DATABASE']->query("INSERT INTO ".TRACKING." SET userId = ".$GLOBALS['DATABASE']->escape($user_array[$random2]).", userName = '".$this->getUsername($user_array[$random2])."', pageVisited = 'page=Lottery', data = '".$GLOBALS['DATABASE']->escape("The player won ".$total_user_prize2." credits with the lottery.")."', time = ".TIMESTAMP.", trackMode = 10;");
						if($USER['id'] == $user_array[$random2]){
							$USER['darkmatter'] += $total_user_prize2;
						}else{
							$GLOBALS['DATABASE']->query("UPDATE ".USERS." set `darkmatter` = `darkmatter` + ".$total_user_prize2." where `id` = '".$user_array[$random2]."' AND `universe` = '".$UNI."';");
						}
						
						$GLOBALS['DATABASE']->query("DELETE FROM ".LOTTERIELOG." WHERE universe = '".$UNI."';");
						$GLOBALS['DATABASE']->query("INSERT INTO ".LOTTERIELOG." VALUES('".$total_user['user']."','".TIMESTAMP."','".$total_user_prize."', '".$UNI."') ");
						$GLOBALS['DATABASE']->query("INSERT INTO ".LOTTERIELOG." VALUES('".$total_user1['user']."','".TIMESTAMP."','".$total_user_prize1."', '".$UNI."') ");
						$GLOBALS['DATABASE']->query("INSERT INTO ".LOTTERIELOG." VALUES('".$total_user2['user']."','".TIMESTAMP."','".$total_user_prize2."', '".$UNI."') ");
					
						$GLOBALS['DATABASE']->query("DELETE FROM ".LOTTERIE." WHERE universe = '".$UNI."';");
						
						$msg1 = sprintf($LNG['NOUVEAUTE_35'], $total_user['user'], $total_user_prize);
						$msg2 = sprintf($LNG['NOUVEAUTE_35'], $total_user1['user'], $total_user_prize1);
						$msg3 = sprintf($LNG['NOUVEAUTE_35'], $total_user2['user'], $total_user_prize2);
						
						SendSimpleMessage ( $user_array[$random], $user_array[$random], TIMESTAMP, 1, $LNG['NOUVEAUTE_29'], $LNG['NOUVEAUTE_34'], $msg1);
						SendSimpleMessage ( $user_array[$random1], $user_array[$random1], TIMESTAMP, 1, $LNG['NOUVEAUTE_29'], $LNG['NOUVEAUTE_34'], $msg2);
						SendSimpleMessage ( $user_array[$random2], $user_array[$random2], TIMESTAMP, 1, $LNG['NOUVEAUTE_29'], $LNG['NOUVEAUTE_34'], $msg3);
					
						$time = TIMESTAMP+24*60*60;

						$GLOBALS['DATABASE']->query("UPDATE ".CONFIG." SET `lottery_time` = ". $time ." where `uni` = ".$UNI.";");
						$lista = "<table>
						<tr>
						<th class='logo'></th>
						<th class='date_operation'>".$LNG['ti_userna']."</th>
						<th class='description'>".$LNG['lm_lotto_2']."</th>
						<th class='description'>".$LNG['lm_lotto_2']."</th>
						</tr>";
						$lista .= "<tr>
						<td class='description' colspan='4'><center><font color='red'>".$LNG['lm_lotto_4']."</font></center></td>
						</tr>";
						$lista .= "</table>";
						$lista_winners = "<table>
						<tr>
						<th class='logo'></th>
						<th class='date_operation'>".$LNG['ti_userna']."</th>
						<th class='description'>".$LNG['lm_lotto_5']."</th>
						<th class='description'>".$LNG['lm_lotto_6']."</th>
						</tr>";
						$lista_winners .= "<tr>
						<td class='description' colspan='4'><center><font color='red'>".$LNG['lm_lotto_7']."</font></center></td>
						</tr>";
						$lista_winners .= "</table>";
						$Message = "<span class='vert'>".$LNG['NOUVEAUTE_477']."</span>";
					}else{
						$lista = "<table>
						<tr>
						<th class='logo'></th>
						<th class='date_operation'>".$LNG['ti_userna']."</th>
						<th class='description'>".$LNG['lm_lotto_2']."</th>
						<th class='description'>".$LNG['lm_lotto_2']."</th>
						</tr>";
						$lista .= "<tr>
						<td class='description' colspan='4'><center><font color='red'>".$LNG['lm_lotto_4']."</font></center></td>
						</tr>";
						$lista .= "</table>";
						$lista_winners = "<table>
						<tr>
						<th class='logo'></th>
						<th class='date_operation'>".$LNG['ti_userna']."</th>
						<th class='description'>".$LNG['lm_lotto_5']."</th>
						<th class='description'>".$LNG['lm_lotto_6']."</th>
						</tr>";
						$lista_winners .= "<tr>
						<td class='description' colspan='4'><center><font color='red'>".$LNG['lm_lotto_7']."</font></center></td>
						</tr>";
						$lista_winners .= "</table>";
						$time = TIMESTAMP+24*60*60;
						$GLOBALS['DATABASE']->query("UPDATE ".CONFIG." SET `lottery_time` = ". $time ." WHERE uni = '".$UNI."' ;");
						$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_36']."</span>";
					}
				}
			}else{
				$secs = $CONF['lottery_time'] - TIMESTAMP;
				$diferent_users = $GLOBALS['DATABASE']->query("SELECT DISTINCT `id` from ".LOTTERIE." WHERE universe = '".$UNI."' ORDER BY RAND() LIMIT 3 ;");
				if($GLOBALS['DATABASE']->numRows($diferent_users) > 0){
					$lista = '  <table>
					<tr>
					<th class="logo"></th>
					<th class="date_operation">'.$LNG['ti_userna'].'</th>
					<th class="description">'.$LNG['lm_lotto_2'].'</th>
					<th class="description">'.$LNG['lm_lotto_3'].'</th>
					</tr>';
					while($s = $GLOBALS['DATABASE']->fetch_array($diferent_users)){
					$total_user = $GLOBALS['DATABASE']->query("SELECT user, timestamp from ".LOTTERIE." where `id` = '".$s['id']."' AND universe = '".$UNI."' ;");
					$total_user = $GLOBALS['DATABASE']->fetch_array($total_user);
					$lista .= '<tr>
					<td class="logo"></td>
					<td class="date_operation">'.$total_user['user'].'</td>
					<td class="description">'. gmdate('M d Y H:i:s',$total_user['timestamp']).'</td>
					<td class="description">1 <img src="media/image/ticket-icon.png" width="16px" height="16px"/></td>
					</tr>';	 
					}
					$lista .= '</table>';
				}else{
					$lista = "<table>
					<tr>
					<th class='logo'></th>
					<th class='date_operation'>".$LNG['ti_userna']."</th>
					<th class='description'>".$LNG['lm_lotto_2']."</th>
					<th class='description'>".$LNG['lm_lotto_2']."</th>
					</tr>";
					$lista .= "<tr>
					<td class='description' colspan='4'><center><font color='red'>".$LNG['lm_lotto_4']."</font></center></td>
					</tr>";
					$lista .= "</table>";
				}

				$castigatori = $GLOBALS['DATABASE']->query("SELECT *FROM ".LOTTERIELOG." WHERE universe = '".$UNI."' ORDER BY `time` DESC LIMIT 5");
				if($GLOBALS['DATABASE']->numRows($castigatori) >0){
					$lista_winners = "<table>
					<tr>
					<th class='logo'></th>
					<th class='date_operation'>".$LNG['ti_userna']."</th>
					<th class='description'>".$LNG['lm_lotto_2']."</th>
					<th class='description'>".$LNG['lm_lotto_2']."</th>
					</tr>";
					while($x = $GLOBALS['DATABASE']->fetch_array($castigatori)){
						$lista_winners .= " <tr>
						<td class='logo'></td>
						<td class='date_operation'>".$x['username']."</td>
						<td class='description'>". gmdate("M d Y H:i:s",$x['time'] )."</td>
						<td class='description'>".$x['prize']." <img src='/media/ingame/image/credit.png' width='16px' height='16px'/></td>
						</tr>";
					}
					$lista_winners .= "</table>";
				}else{
					$lista_winners = "<table>
					<tr>
					<th class='logo'></th>
					<th class='date_operation'>".$LNG['ti_userna']."</th>
					<th class='description'>".$LNG['lm_lotto_5']."</th>
					<th class='description'>".$LNG['lm_lotto_6']."</th>
					</tr>";
					$lista_winners .= "<tr>
					<td class='description' colspan='4'><center><font color='red'>".$LNG['lm_lotto_7']."</font></center></td>
					</tr>";
					$lista_winners .= "</table>";
				}
			}
			$this->tplObj->assign_vars(array(
				'user_lists' => $lista,
				'winners'	=> $lista_winners,
				'Message' 		=> $Message,
			));
			$this->display('page.lottery.default.tpl');
			
		}
	}
}
?>