<?php

/**
 * style -> edit
 */


$thisprog='style_man_edit.php';

include('./admin_global.inc.php');

init();
setTitle('Edit A Templateset');
if (!access("canadmin")){
	shownopermission();
}

if($_POST['submit']) {

	if ($_POST['templatesetName']) {

		$templatesetName=$_POST['templatesetName'];
		//$folder = $_POST['folder'];

		$query = "UPDATE $table_templateset SET title='%s' WHERE templatesetid=$templatesetid";
					
		$DB_site->query(sprintf($query, $templatesetName));
		

		showsuccess('You have add the templateset successfully', 
				"style_man_list.php");
	}else{
		$content.='<tr bgcolor=FFFFFF><td colspan=2><font color=red>Please fill up the name and temlate!</font></td></tr>';
	}
}

if ($action=="del"){
	$content .= "
	<tr bgcolor='#ffffff'><td> do you wanna delete this style? </td>
	</tr>
	</tr><input type=hidden name=templatesetid value=$templatesetid>
		<input type=hidden name=action value=dodelete>
	";
	output();
	exit;
}

if ($action=="dodelete"){
	$DB_site->query("DELETE FROM $table_templateset WHERE templatesetid=$templatesetid");
	showsuccess('You have delete the templateset successfully', 
				"style_man_list.php");
}

if ($action=="removeset"){
	$content .= "
	<tr bgcolor='#ffffff'><td> do you wanna delete these templates? </td>
	</tr>
	</tr><input type=hidden name=templatesetid value=$templatesetid>
		<input type=hidden name=action value=doremoveset>
	";
	output();
	exit;
}

if ($action=="doremoveset"){
	$DB_site->query("DELETE FROM $table_template WHERE templatesetid=$templatesetid");
	$DB_site->query("DELETE FROM $table_templateset WHERE templatesetid=$templatesetid");
	showsuccess('You have delete the templates successfully', 
				"appearence_template_list.php");
}

if ($action=="setdefault"){
	$content .= "
	<tr bgcolor='#ffffff'><td> do you wanna set this style as default? </td>
	</tr>
	</tr><input type=hidden name=templatesetid value=$templatesetid>
		<input type=hidden name=action value=dosetdefault>
	";
	output();
	exit;
}

if ($action=="dosetdefault"){
	

	replaceconfig('default_style', $templatesetid);
	saveChanges();
	require('../include/template.inc.php');
	$t= new template;
	$t->cache_dir="../cache";
	$t->clear_all_cache();
	showsuccess('You haveet this style as default successfully', 
				"appearence_template_list.php");
}
$Templateset=$DB_site->query_first("SELECT * FROM $table_templateset WHERE templatesetid=$templatesetid");


$content .= <<< EOF
<tr bgcolor='#ffffff'><td> Templateset Name : </td>
<td><input type=text name=templatesetName value=$Templateset[title]></td></tr>
</tr><input type=hidden name=templatesetid value=$templatesetid>
EOF;

output();

?>