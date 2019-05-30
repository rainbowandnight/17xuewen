<?php

/**
 * user -> add user
 */

$thisprog='user_adduser.php';
define('getCache',1);
include('./admin_global.inc.php');

if (!access("canadmin")){
	shownopermission();
}

init();
setTitle('Add a new group');

if ($_POST['submit']) {
	if ($_POST['groupTitle']) {
		$permissions=formTosql($_POST['permissions']);
		$DB_site->query("INSERT INTO $table_usergroup
		SET
		usergroupid ='',
		title      ='".slashesencode($_POST['groupTitle'])."',
		canadd     = '$permissions[canadd]',
		canedit    = '$permissions[canedit]',
		cancomment = '$permissions[cancomment]',
		canpublish = '$permissions[canpublish]',
		canadmin   = '$permissions[canadmin]'");

		
		showSuccess('You have added a new group successfully', 'user_mangroup.php');
	}else{

		$content.='<tr bgcolor=FFFFFF><td colspan=2><font color=red>Please fill up the content</font></td></tr>';
	}

}
	
	
$content.='<tr bgcolor="#ffffff"><td> grouptitle: </td><td><input type=text name=groupTitle></td></tr>';
$content.='<tr bgcolor="#ffffff"><td colspan=2><input type=checkbox name=permissions[canadd]> user can post articles</td></tr>';
$content.='<tr bgcolor="#ffffff"><td colspan=2><input type=checkbox name=permissions[canedit]> user can edit articles</td></tr>';
$content.='<tr bgcolor="#ffffff"><td colspan=2><input type=checkbox name=permissions[cancomment]> user can comment articles</td></tr>';
$content.='<tr bgcolor="#ffffff"><td colspan=2><input type=checkbox name=permissions[canpublish]> user can publish articles</td></tr>';
$content.='<tr bgcolor="#ffffff"><td colspan=2><input type=checkbox name=permissions[canadmin]> user can admin sys</td></tr>';

output();
