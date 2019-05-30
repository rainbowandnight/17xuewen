<?php

/**
 * template -> add
 */

$thisprog='template_add.php';
include('./admin_global.inc.php');
if (!access("canadmin")){
	shownopermission();
}
init();
setTitle('Templates add');



if($_POST['submit']) {
	if ($_POST['templateName'] && $_POST['templateContent']) {
		
		$query = "insert into $table_template (templateid, title, template, templatesetid)
					values ('', '%s', '%s', %s)";
		$DB_site->query(sprintf($query, $templateName, $templateContent, $templateSetid));

		showsuccess('You have add the template successfully', 
				"template_list.php?expandset=templatesetid&group=$group#$group");
	}else{
		$content.='<tr bgcolor=FFFFFF><td colspan=2><font color=red>Please fill up the name and temlate!</font></td></tr>';
	}
}
$templatesets = $DB_site->query("SELECT * FROM $table_templateset");
while ($templateset=$DB_site->fetch_array($templatesets)){
	$dropdown.="<option value=$templateset[templatesetid] ";
	$dropdown.=(($templatesetid==$templateset[templatesetid])? "selected" : "");
	$dropdown.=">$templateset[title]</option>";
}

if (isset($templateName)) {
    $templateName=urldecode($templateName);
    $templateinfo=$DB_site->query_first("SELECT template FROM $table_template WHERE templatesetid=-1 AND title='".addslashes($templateName)."'");
    
  }
$templateinfo = htmlspecialchars($templateinfo);
// start to add a template
$content .= <<< EOF
<tr bgcolor='#ffffff'><td> Template Name : </td>
<td><input type=text name=templateName value=$templateName></td></tr>
<tr bgcolor='#ffffff'><td> Template Set : </td>
<td><select name='templateSetid'><option value=-1>global template</option>$dropdown</select></td></tr>
<tr bgcolor='#ffffff'><td>Content : </td>
<td><textarea name="templateContent" rows="20" cols="70">$templateinfo</textarea></td></tr>
EOF;

output();
?>