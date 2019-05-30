<?php

/**
 * style -> add
 */

$thisprog='style_man_add.php';
include('./admin_global.inc.php');
if (!access("canadmin")){
	shownopermission();
}
init();
setTitle('add a Templateset');

if($_POST['submit']) {
	if ($_POST['templatesetName']) {
		$templatesetName=$_POST['templatesetName'];
		//$folder = $_POST['folder'];
		$query = "insert into $table_templateset (templatesetid, title, imgfolder)
					values ('', '%s')";
		$DB_site->query(sprintf($query, $templatesetName));
		//$templatesetid=$DB_site->insert_id();
		//addPicFolder($templatesetid,$folder);

		showsuccess('You have add the templateset successfully', 
				"style_man_list.php");
	}else{
		$content.='<tr bgcolor=FFFFFF><td colspan=2><font color=red>Please fill up the name and temlate!</font></td></tr>';
	}
}
$content .= <<< EOF
<tr bgcolor='#ffffff'><td> Templateset Name : </td>
<td><input type=text name=templatesetName></td></tr>
</tr>
EOF;
/*
<tr bgcolor='#ffffff'><td> Templateset Pic folder : </td>
<td><input type=text name=folder></td></tr>
</tr>
EOF;
*/
output();


?>


