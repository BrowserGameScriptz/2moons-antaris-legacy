<?php

/**
 *  2Moons 
 *   by Jan-Otto Kröpke 2009-2016
 *
 * For the full copyright and license information, please view the LICENSE
 *
 * @package 2Moons
 * @author Jan-Otto Kröpke <slaver7@gmail.com>
 * @copyright 2009 Lucky
 * @copyright 2016 Jan-Otto Kröpke <slaver7@gmail.com>
 * @licence MIT
 * @version 1.8.0
 * @link https://github.com/jkroepke/2Moons
 */

class PlayerUtil
{
	static public function cryptPassword($password)
	{
		$salt = NULL;
		// @see: http://www.phpgangsta.de/schoener-hashen-mit-bcrypt
		require 'includes/config.php';
		
		return md5($password);
		
	}

	static public function isNameValid($name)
	{
		if(UTF8_SUPPORT) {
			return preg_match('/^[\p{L}\p{N}_\-. ]*$/u', $name);
		} else {
			return preg_match('/^[A-z0-9_\-. ]*$/', $name);
		}
	}

	static public function isMailValid($address) {
		
		if(function_exists('filter_var')) {
			return filter_var($address, FILTER_VALIDATE_EMAIL) !== FALSE;
		} else {
			return preg_match('^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$', $address);
		}
	}

	static public function createPlayer($universe, $userName, $userPassword, $userMail, $userLanguage = NULL, $name = NULL, $authlevel = 0, $userIpAddress = NULL)
	{
		$config	= Config::get($universe);
		$params			= array(
			':username'				=> $userName,
			':email'				=> $userMail,
			':email2'				=> $userMail,
			':authlevel'			=> $authlevel,
			':universe'				=> $universe,
			':language'				=> $userLanguage,
			':registerAddress'		=> !empty($userIpAddress) ? $userIpAddress : Session::getClientIp(),
			':onlinetime'			=> TIMESTAMP,
			':registerTimestamp'	=> TIMESTAMP,
			':password'				=> $userPassword,
			':dpath'				=> DEFAULT_THEME,
			':homeplanet'			=> $name,
			':timezone'				=> $config->timezone,
			':nameLastChanged'		=> 0,
		);

		$sql = 'INSERT INTO %%USERS%% SET
		username		= :username,
		email			= :email, 
		email_2			= :email2,
		authlevel		= :authlevel,
		universe		= :universe,
		lang			= :language,
		ip_at_reg		= :registerAddress,
		onlinetime		= :onlinetime,
		homeplanet		= :homeplanet,
		register_time	= :registerTimestamp,
		password		= :password,
		dpath			= :dpath,
		timezone		= :timezone,
		uctime			= :nameLastChanged;';

		$db = Database::get();

		$db->insert($sql, $params);
		
		$userId		= $db->lastInsertId();
		
		$currentUserAmount		= $config->users_amount + 1;
		$config->users_amount	= $currentUserAmount;
		
		$config->save();

		return array($userId);
	}
	
	static public function deletePlayer($userId)
	{
		if(ROOT_USER == $userId)
		{
			// superuser can not be deleted.
			throw new Exception("Superuser #".ROOT_USER." can't be deleted!");
		}

		$db			= Database::get();
		$sql		= 'SELECT universe, ally_id FROM %%USERS%% WHERE id = :userId;';
		$userData	= $db->selectSingle($sql, array(
			':userId'	=> $userId
		));

		if (empty($userData))
		{
			return false;
		}

		if (!empty($userData['ally_id']))
		{
			$sql			= 'SELECT ally_members FROM %%ALLIANCE%% WHERE id = :allianceId;';
			$memberCount	= $db->selectSingle($sql, array(
				':allianceId'	=> $userData['ally_id']
			), 'ally_members');
			
			if ($memberCount > 1)
			{
				$sql	= 'UPDATE %%ALLIANCE%% SET ally_members = ally_members - 1 WHERE id = :allianceId;';
				$db->update($sql, array(
					':allianceId'	=> $userData['ally_id']
				));
			}
			else
			{
				$sql	= 'DELETE FROM %%ALLIANCE%% WHERE id = :allianceId;';
				$db->delete($sql, array(
					':allianceId'	=> $userData['ally_id']
				));

				$sql	= 'DELETE FROM %%STATPOINTS%% WHERE stat_type = :type AND id_owner = :allianceId;';
				$db->delete($sql, array(
					':allianceId'	=> $userData['ally_id'],
					':type'			=> 2
				));

				$sql	= 'UPDATE %%STATPOINTS%% SET id_ally = :resetId WHERE id_ally = :allianceId;';
				$db->update($sql, array(
				  	':allianceId'	=> $userData['ally_id'],
				  	':resetId'		=> 0
			 	));
			}
		}

		$sql	= 'DELETE FROM %%ALLIANCE_REQUEST%% WHERE userID = :userId;';
		$db->delete($sql, array(
			':userId'	=> $userId
	 	));

		$sql	= 'DELETE FROM %%BUDDY%% WHERE owner = :userId OR sender = :userId;';
		$db->delete($sql, array(
			':userId'	=> $userId
		));

		$sql	= 'DELETE %%FLEETS%%, %%FLEETS_EVENT%%
		FROM %%FLEETS%% LEFT JOIN %%FLEETS_EVENT%% on fleet_id = fleetId
		WHERE fleet_owner = :userId;';
		$db->delete($sql, array(
			':userId'	=> $userId
		));

		$sql	= 'DELETE FROM %%MESSAGES%% WHERE message_owner = :userId;';
		$db->delete($sql, array(
			':userId'	=> $userId
		));

		$sql	= 'DELETE FROM %%NOTES%% WHERE owner = :userId;';
		$db->delete($sql, array(
			':userId'	=> $userId
		));

		$sql	= 'DELETE FROM %%PLANETS%% WHERE id_owner = :userId;';
		$db->delete($sql, array(
		   	':userId'	=> $userId
	  	));

		$sql	= 'DELETE FROM %%USERS%% WHERE id = :userId;';
		$db->delete($sql, array(
			':userId'	=> $userId
		));

		$sql	= 'DELETE FROM %%STATPOINTS%% WHERE stat_type = :type AND id_owner = :userId;';
		$db->delete($sql, array(
			':userId'	=> $userId,
			':type'		=> 1
		));
		
		$fleetIds	= $db->select('SELECT fleet_id FROM %%FLEETS%% WHERE fleet_target_owner = :userId;', array(
			':userId'	=> $userId
		));

		foreach($fleetIds as $fleetId)
		{
			FleetFunctions::SendFleetBack(array('id' => $userId), $fleetId['fleet_id']);
		}

        /*
		$sql	= 'UPDATE %%UNIVERSE%% SET userAmount = userAmount - 1 WHERE universe = :universe;';
		$db->update($sql, array(
			':universe' => $userData['universe']
		));
		
		Cache::get()->flush('universe');
        */

		return true;
	}
	
	static public function sendMessage($userId, $senderId, $senderName, $messageType, $subject, $text, $time, $parentID = NULL, $unread = 1, $universe = NULL)
	{
		if(is_null($universe))
		{
			$universe = Universe::current();
		}

		$db = Database::get();

		$sql = "INSERT INTO %%MESSAGES%% SET
		message_owner		= :userId,
		message_sender		= :sender,
		message_time		= :time,
		message_type		= :type,
		message_from		= :from,
		message_subject 	= :subject,
		message_text		= :text,
		message_unread		= :unread,
		message_universe 	= :universe;";

		$db->insert($sql, array(
			':userId'	=> $userId,
			':sender'	=> $senderId,
			':time'		=> $time,
			':type'		=> $messageType,
			':from'		=> $senderName,
			':subject'	=> $subject,
			':text'		=> $text,
			':unread'	=> $unread,
			':universe'	=> $universe,
		));
	}
}
