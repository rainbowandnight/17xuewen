<?php

/**
 * template -> edit
 */


$thisprog='template_edit.php';

include('./admin_global.inc.php');
if (!access("canadmin")){
	shownopermission();
}
init();
setTitle('Templates List');




// if !isset($templateid)
if(!$templateName) header('Location : template_list.php');


if($action == 'delete') {

	$content .= "
	<tr bgcolor='#ffffff'><td> do you wanna delete this template? </td>
	</tr>
	</tr><input type=hidden name=templatesetid value=$templatesetid>
		<input type=hidden name=templateId value=$templateId>
		<input type=hidden name=groupName value=$group>
		<input type=hidden name=action value=dodelete>
	";
	output();
	exit;

} elseif($action == 'dodelete') {

	$DB_site->query("delete from $table_template where templateid='$templateId' and templatesetid=$templatesetid");
	
	require('../include/template.inc.php');
	$t= new template;
	$t->cache_dir="../cache";
	$t->clear_all_cache();
	showsuccess('The template selected has been deleted/replace successfully', 
				"template_list.php?expandset=$templatesetid&group=$group#$group");

}elseif($_POST['submit']) {

		$query = "update $table_template set title='%s',template='%s',templatesetid=%s where templateid='$templateId'";

	$DB_site->query(sprintf($query, $title, $templateContent, $templatesetid));
	require('../include/template.inc.php');
	$t= new template;
	$t->cache_dir="../cache";
	$t->clear_all_cache();
	showsuccess('You have edited the template successfully', 
				'template_list.php');
}




$templateContent = $DB_site->query_first("select templateid,title,template from $table_template where templateid='$templateId' and templatesetid=$templatesetid");

$templateContent[template] = htmlspecialchars($templateContent[template]);

$dropdown="<select name=templatesetid>";
$dropdown.="<option value=-1>global template</option>";
$templatesets = $DB_site->query("SELECT * FROM $table_templateset");
while ($templateset=$DB_site->fetch_array($templatesets)){
	$dropdown.="<option value=$templateset[templatesetid] ";
	$dropdown.=(($templatesetid==$templateset[templatesetid])? "selected" : "");
	$dropdown.=">$templateset[title]</option>";
}
$dropdown.="</select>";

// display the content of a template
$content .= <<< EOF
<input type=hidden name=templateId value='$templateId'>
<tr bgcolor='#ffffff'><td> Template Name : </td>
<td><input type=text name=title value=$templateContent[title]></tr>
<tr bgcolor='#ffffff'><td> Template Set : </td>
<td>$dropdown</tr>
<tr bgcolor='#ffffff'><td>Content : </td>
<td><textarea name="templateContent" rows="20" cols="70">$templateContent[template]</textarea></td></tr>
EOF;


output();
?>