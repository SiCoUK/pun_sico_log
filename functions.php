<?php

/**
 * sico_user_log functions: logic, database and output
 *
 * @copyright Copyright (C) 2009 Simon Corless
 * @package sico_user_log
 */

if (!defined('FORUM'))
	die();

// FUNCTIONS

// Return the most recent log message
function sico_user_log_recent()
{
	global $forum_db, $forum_user;
	
	$query = array(
		'SELECT'	=> '*',
		'FROM'		=> 'sico_user_log',
		'WHERE'		=> 'log_user = '.$forum_user['id'],
		'ORDER BY'	=> 'log_created',
		'LIMIT'		=> 1,
	);

	$result = $forum_db->query_build($query) or error(__FILE__, __LINE__);

	// We have to deliver some messages
	if ($forum_db->num_rows($result))
	{
		
		return $forum_db->fetch_assoc($result);
		/*$message = array();
		while ($row = $forum_db->fetch_assoc($result))
		{
			
		}
		
		return $message;*/
	}

		/*// How many messages does user have in the Inbox?
		$inbox_count = pun_pm_inbox_count($forum_user['id']);

		if ($inbox_count < $forum_config['o_pun_pm_inbox_size'])
		{
			// What messages will we deliver?
			$query = array(
				'SELECT'	=> 'id',
				'FROM'		=> 'pun_pm_messages',
				'WHERE'		=> 'receiver_id = '.$forum_user['id'].' AND status = \'sent\'',
				'ORDER BY'	=> 'lastedited_at',
				'LIMIT'		=> (string)($forum_config['o_pun_pm_inbox_size'] - $inbox_count),
			);

			$result = $forum_db->query_build($query) or error(__FILE__, __LINE__);

			// We have to deliver some messages
			if ($forum_db->num_rows($result))
			{
				$ids = '';
				while ($row = $forum_db->fetch_assoc($result))
					$ids .= $row['id'].', ';
 
				// There is some free space in the Inbox
				// Deliver some messages that were sent
				$query = array(
					'UPDATE'	=> 'pun_pm_messages',
					'SET'		=> 'status = \'delivered\'',
					'WHERE'		=> 'id IN ('.substr($ids, 0, -2).')',
				);

				$forum_db->query_build($query) or error(__FILE__, __LINE__);

				// Clear cached inbox count
				$pun_pm_inbox_count = false;
			}
		}
		else
			$pun_pm_inbox_full = true;
	}
	define('PUN_PM_DELIVERED_MESSAGES', 1);*/
}

?>