<?php

/**
 * style -> list
 */


$thisprog='style_man_edit.php';

include('./admin_global.inc.php');
if (!access("canadmin")){
	shownopermission();
}
init();
setTitle('Edit A Templateset');


$Templatesets=$DB_site->query("SELECT * FROM $table_templateset");

while ($Templateset=$DB_site->fetch_array($Templatesets)){
	$content .="<tr bgcolor='#ffffff'><td> $Templateset[title] : </td>
	<td><a href=style_man_edit.php?templatesetid=$Templateset[templatesetid]>edit</a>&nbsp;&nbsp;&nbsp;<a href=style_man_edit.php?action=del&templatesetid=$Templateset[templatesetid]>delete</a>&nbsp;&nbsp;&nbsp;<a href=style_man_edit.php?action=setdefault&templatesetid=$Templateset[templatesetid]>set this style as default</a></td></tr>
	</tr>";
}

output();
?>