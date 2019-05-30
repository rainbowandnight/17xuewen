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
setTitle('Add a new user');

if ($_POST['submit']) {
	if ($_POST['userName'] && $_POST['passWord'] && $_POST['email'] && $_POST[group_id]) {
		$DB_site->query("INSERT INTO $table_user
		SET
		$user_table_fields[user_id] ='',
		$user_table_fields[user_name] ='".slashesencode($_POST['userName'])."',
		$user_table_fields[user_password] ='".slashesencode($_POST['passWord'])."',
		$user_table_fields[user_email]  ='".slashesencode($_POST['email'])."',
		$user_table_fields[user_groupid] = '".$_POST[group_id]."',
		$user_table_fields[user_joindate] = '".time()."'
		");

		
		showSuccess('You have added a new user successfully', 'user_userlist.php');
	}else{

		$content.='<tr bgcolor=FFFFFF><td colspan=2><font color=red>Please fill up the content</font></td></tr>';
	}

}

	
$content.='<tr bgcolor="#ffffff"><td> User name: </td><td><input type=text name=userName></td></tr>';
$content.='<tr bgcolor="#ffffff"><td> password</td><td><input type=text name=passWord></td></tr>';
$content.='<tr bgcolor="#ffffff"><td> email</td><td><input type=text name=email></td></tr>';

$dropdown=get_usergroup_dropdown();

$content.="<tr bgcolor='#ffffff'><td> usergroup:</td><td>$dropdown</td></tr>";
	
output();
?>
