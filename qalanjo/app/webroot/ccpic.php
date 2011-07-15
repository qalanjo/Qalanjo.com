<?php


// ####################### SET PHP ENVIRONMENT ###########################
error_reporting(E_ALL & ~E_NOTICE);

// #################### DEFINE IMPORTANT CONSTANTS #######################
define('NOSHUTDOWNFUNC', 1);
define('NOCOOKIES', 1);
define('THIS_SCRIPT', 'ccpic');
define('CSRF_PROTECTION', true);
define('VB_AREA', 'Forum');
define('NOPMPOPUP', 1);
define('LOCATION_BYPASS', 1);

if ((!empty($_SERVER['HTTP_IF_MODIFIED_SINCE']) OR !empty($_SERVER['HTTP_IF_NONE_MATCH'])))
{
	$sapi_name = php_sapi_name();
	if ($sapi_name == 'cgi' OR $sapi_name == 'cgi-fcgi')
	{
		header('Status: 304 Not Modified');
	}
	else
	{
		header('HTTP/1.1 304 Not Modified');
	}
	exit;
}

require_once('./global.php');

getimage($_GET['userid']);

function resolve_cp_image_url($image_path)
{
	if ($image_path[0] == '/' OR preg_match('#^https?://#i', $image_path))
	{
		return $image_path;
	}
	else
	{
		return "$image_path";
	}
}

function getimage($userid) {

	global $vbulletin;
	
	$user = $vbulletin->db->query_first("
			SELECT user.*, avatar.avatarpath, customavatar.dateline AS avatardateline, customavatar.width AS avatarwidth, customavatar.height AS avatarheight,
			NOT ISNULL(customavatar.userid) AS hascustomavatar, usertextfield.signature,
			customprofilepic.width AS profilepicwidth, customprofilepic.height AS profilepicheight,
			customprofilepic.dateline AS profilepicdateline, usergroup.adminpermissions,
			NOT ISNULL(customprofilepic.userid) AS hasprofilepic,
			NOT ISNULL(sigpic.userid) AS hassigpic,
			sigpic.width AS sigpicwidth, sigpic.height AS sigpicheight,
			sigpic.userid AS profilepic, sigpic.dateline AS sigpicdateline,
			usercsscache.cachedcss
			FROM " . TABLE_PREFIX . "user AS user
			LEFT JOIN " . TABLE_PREFIX . "avatar AS avatar ON(avatar.avatarid = user.avatarid)
			LEFT JOIN " . TABLE_PREFIX . "customavatar AS customavatar ON(customavatar.userid = user.userid)
			LEFT JOIN " . TABLE_PREFIX . "customprofilepic AS customprofilepic ON(customprofilepic.userid = user.userid)
			LEFT JOIN " . TABLE_PREFIX . "sigpic AS sigpic ON(sigpic.userid = user.userid)
			LEFT JOIN " . TABLE_PREFIX . "usertextfield AS usertextfield ON(usertextfield.userid = user.userid)
			LEFT JOIN " . TABLE_PREFIX . "usergroup AS usergroup ON(usergroup.usergroupid = user.usergroupid)
			LEFT JOIN " . TABLE_PREFIX . "usercsscache AS usercsscache ON (user.userid = usercsscache.userid)
			WHERE user.userid = '" . mysql_real_escape_string($userid) . "'"
		);

	$getoptions = convert_bits_to_array($user['options'], $vbulletin->bf_misc_useroptions);
	$user = array_merge($user, $getoptions);
		
	$url = '';

		if ($user['avatarid']) {
			$url = resolve_cp_image_url($user['avatarpath']);
		} else {
			if ($user['hascustomavatar']) {
				if ($vbulletin->options['usefileavatar']) {
					$url = resolve_cp_image_url($vbulletin->options['avatarurl'] . "/avatar$user[userid]_$user[avatarrevision].gif");
				} else {
					$url = "image.php?" . $vbulletin->session->vars['sessionurl'] . "u=$user[userid]&dateline=$user[avatardateline]";
					header("Location: $url");
					exit;
				}	
			}
		}

		if ($user['hasprofilepic']) {
			if ($vbulletin->options['usefileavatar']) {
				$url = resolve_cp_image_url($vbulletin->options['profilepicurl'] . "/profilepic$user[userid]_$user[profilepicrevision].gif");
			} else {
				$url = "image.php?" . $vbulletin->session->vars['sessionurl'] . "u=$user[userid]&type=profile&dateline=$user[profilepicdateline]";
				header("Location: $url");
				exit;
			}
		}

		if (empty($url)) {
			$url = "http://www.gravatar.com/avatar/".md5($user['email'])."?d=identicon";
			header("Location: $url");
			exit;
		}

		header('Content-type: image/gif');
		readfile(DIR . '/' . $url);
}



?>