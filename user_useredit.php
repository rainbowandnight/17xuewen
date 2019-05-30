<?php

/**
 * user -> edit user
 */

$thisprog='user_useredit.php';
//define('getCache',1);
include('./admin_global.inc.php');

if (!access("canadmin")){
	shownopermission();
}

init();
setTitle('Edit a user');

if(!isset($_Get['action'])){

}else{
    $action=$_GET['action'];
}
if(!isset($_GET['userid'])){

}else{
    $userid=$_GET['userid'];
}
//echo $userid;
if ($action=="delete"){
	$content.='<tr bgcolor="#ffffff"><td>Do you want to delete this user  </td></tr>';
	$content.='<input type=hidden name=action value=dodel>';
	$content.="<input type=hidden name=userid value=$userid>";
	output();
}

if ($action=="dodel"){

	$DB_site->query("DELETE FROM ".$table_user." WHERE ". $user_table_fields[user_id] ." = ".$userid);
	showSuccess('You have deleted a  user successfully', 'user_userlist.php');

}


if ($_POST['submit']) {
	if ($_POST['userName'] && $_POST['passWord'] && $_POST['email'] && $_POST[group_id]) {
		
		$DB_site->query("UPDATE $table_user
		SET
		$user_table_fields[user_name] ='".slashesencode($_POST['userName'])."',
		$user_table_fields[user_password] ='".slashesencode($_POST['passWord'])."',
		$user_table_fields[user_email]  ='".slashesencode($_POST['email'])."',
		$user_table_fields[user_groupid] = '$_POST[group_id]' 
		WHERE $user_table_fields[user_id]=$userid");
		showSuccess('You have edited a  user successfully', 'user_userlist.php');
	}else{

		$content.='<tr bgcolor=FFFFFF><td colspan=2><font color=red>Please fill up the content</font></td></tr>';
	}

}

$user=$DB_site->query_first("SELECT $user_table_fields[user_name] as username,$user_table_fields[user_password] as password,$user_table_fields[user_email] as email,$user_table_fields[user_groupid] as usergroupid FROM $table_user WHERE $user_table_fields[user_id]=$userid");	

$content.='<tr bgcolor="#ffffff"><td> User name: </td><td><input type=text name=userName value='.$user[username].'></td></tr>';
$content.='<tr bgcolor="#ffffff"><td> password</td><td><input type=text name=passWord value='.$user[password].'></td></tr>';
$content.='<tr bgcolor="#ffffff"><td> email</td><td><input type=text name=email value='.$user[email].'></td></tr>';

$dropdown=get_usergroup_dropdown($user[usergroupid]);

$content.="<tr bgcolor='#ffffff'><td> usergroup:</td><td>$dropdown</td></tr>";
	
output();
?>