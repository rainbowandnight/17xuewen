<?php

$thisprog = 'user_userlist.php';
$userperpage = 20;

include('./admin_global.inc.php');
if (!access("canadmin")){
	shownopermission();
}
init();
setTitle('User list');

if(!$page) $page = 1;
if($orderby) $orderby = ' ORDER BY ' . $orderby;

$whereCondition=array();

if ($username){
	if ($usernameAs=="equal"){
		$whereCondition[]= "$user_table_fields[user_name]= '$username'";
	}
	elseif ($usernameAs=="contain"){
		$whereCondition[]= "$user_table_fields[user_name] LIKE '%".$username."%'";
	}
}

if ($email){
	if ($emailAs=="equal"){
		$whereCondition[]= "$user_table_fields[user_email]= $email";
	}
	elseif ($emailAs=="contain"){
		$whereCondition[]= "$user_table_fields[user_email] LIKE '%".$email."%'";
	}
}

if ($usergroupid){
	$whereCondition[]= "$user_table_fields[user_groupid]= $usergroupid";
}

if($whereCondition) $wherecondition = join(' AND ', $whereCondition);
if($wherecondition) $wherecondition = ' WHERE ' . $wherecondition;

$users = $DB_site->query('select ' .$user_table_fields[user_id].' as userid, '.$user_table_fields[user_name] .' as username FROM '. $table_user . $wherecondition . $orderby .' limit '.
						(($page - 1) * $userperpage).','. $userperpage);

while($user=$DB_site->fetch_array($users)) {
	$content .= "<tr bgcolor=#ffffff><td>$user[username]</td><td><a href='user_useredit.php?userid=$user[userid]'>Edit</a></td><td><a href='user_useredit.php?userid=$user[userid]&action=delete'>Delete</a></td></tr>";
}

$matchUsers = $DB_site->query_first('select count(*) FROM '.$table_user . $wherecondition);



$content .="<tr bgcolor='#ffffff'><td colspan=5>".getPage($matchUsers,"user_userlist.php?username=$username&usernameAs=$usernameAs&email=$email&emailAs=$emailAs&usergroupid=$usergroupid&page=")."</td></tr>";


$content .= <<< CEOF
<tr bgcolor=666666>

<tr bgcolor='#ffffff'><td>Username</td><td ><input type=radio name=usernameAs value=equal checked>equal<input type=radio name=usernameAs value=contain>contain</td><td ><input type=text name=username value=$username></td></tr>

<tr bgcolor='#ffffff'><td>Email</td><td ><input type=radio name=emailAs value=equal checked>equal<input type=radio name=emailAs value=contain>contain</td><td ><input type=text name=email value=$email></td></tr>


CEOF;

$content .= "<tr bgcolor=#FFFFFF><td>User Group:</td><td colspan=5><select name=usergroupid><option value=0> Any";

$result = $DB_site->query("SELECT usergroupid, title FROM $table_usergroup ORDER BY usergroupid ASC");
while ($row = $DB_site->fetch_array($result)) {
		$content .= "<option value=\"$row[usergroupid]\"";

		if ($row[usergroupid]==$groupid){
			$content .= "selected";
		}

		$content .= ">$row[title]</option>\n";
	}
$content .= '</select></td></tr>';

$content.=<<<CEOF
<tr bgcolor='#ffffff'><td>Results order by</td><td colspan=5>
<select name=orderby>
  <option value=username>Username
  <option value=joindate>Register Date
</select>
</td></tr>
CEOF;



function getPage($results,$address){
	global $userperpage,$page;
	if ($results > $userperpage){
		$i=1;
		$navs = "&nbsp; <a href=".$address.$i.">|&lt;&lt;</a>";
	}

	for($i = max(1, $page - 5); $i <= min(ceil($results / $userperpage), $page+5); $i++) {

		$navs .= " <a href=".$address.$i."><b>".$i."</b></a> ";

	}
	$i=ceil($results / $userperpage);
	$navs .= "&nbsp; <a href=".$address.$i.">&gt;&gt;|</a>";
	return $navs;
}


	
output();

?>
