<?php

/**
 * cate -> cate add
 */

$thisprog='cate_addcate.php';
define('getCache',1);
include('./admin_global.inc.php');

if (!access("canadmin")){
	shownopermission();
}
init();
setTitle('Add a new cate');
//if (!isset($cat_parent_id)){
//	$cat_parent_id=0;
//}


if (!isset($_GET["cat_parent_id"])){
	$cat_parent_id=0;
}else{
    $cat_parent_id=$_GET["cat_parent_id"];
}
//echo $cat_parent_id;
if ($_POST['submit']) {
	if ($_POST['cateTitle']) {
		$DB_site->query("INSERT INTO $table_cate
		SET
		cateid ='',
		title  ='".slashesencode($_POST['cateTitle'])."',
		description = '".slashesencode($_POST['description'])."',
		parentid = '$_POST[cateid]' ");
		
		$cateid=$DB_site->insert_id();
		$addpermission     =$_POST['addpermission'];
		$editpermission    =$_POST['editpermission'];
		$publishpermission =$_POST['publishpermission'];
		$tempap=array();
		$tempesp=array();
		$temppp=array();
		for($i=0;$i<count($addpermission);$i++)      $tempap[$addpermission[$i]]="y";
		for($i=0;$i<count($editpermission);$i++)     $tempep[$editpermission[$i]]="y";
		for($i=0;$i<count($publishpermission);$i++)  $temppp[$publishpermission[$i]]="y";
  
		$result = $DB_site->query("SELECT usergroupid FROM $table_usergroup ");
		while($row=$DB_site->fetch_array($result)) {
			$sql="INSERT INTO $table_permissions VALUES('','$row[usergroupid]','$cateid','".$tempap[$row[usergroupid]]."','".$tempep[$row[usergroupid]]."','y','".$temppp[$row[usergroupid]]."')";
			$DB_site->query("$sql");
		}

		require('../include/template.inc.php');
		$t= new template;
		$t->cache_dir="../cache";
		$t->clear_all_cache();
		showSuccess('You have added a new cate successfully', 'cate_man_cate.php');
	}else{

		$content.='<tr bgcolor=FFFFFF><td colspan=2><font color=red>Please fill up the Title</font></td></tr>';
	}

}
$content.='<tr bgcolor="#ffffff"><td> Category name: </td><td><input type=text name=cateTitle></td></tr>';
$content.='<tr bgcolor="#ffffff"><td> Description<br>HTML allowed.</td><td><textarea name="description" rows="10" cols="50"></textarea></td></tr>';
$dropdown=get_category_dropdown($cat_parent_id);
$content.="<tr bgcolor='#ffffff'><td> Subcategory under:</td><td>$dropdown</td></tr>";



$result = $DB_site->query("SELECT * FROM $table_usergroup ORDER BY usergroupid ASC");
 
while($row = $DB_site->fetch_array($result)) {
	$canadd_options     .= makeoption($row['usergroupid'],$row['title'],$row['canadd']);
	$canedit_options    .= makeoption($row['usergroupid'],$row['title'],$row['canedit']);
	$canpublish_options .= makeoption($row['usergroupid'],$row['title'],$row['canpublish']);
}
//$db->free_result($result);

function makeoption($value,$text,$selected_value) {

	$option_selected=($selected_value=='y')? "selected":"";
	return "<option value=\"$value\" $option_selected>$text</option>";
}

$content.="<tr bgcolor='#ffffff'><td> which usergroup can add in this cate:</td><td>
	<select name=\"addpermission[]\" size=5 multiple>
     $canadd_options
    </select><br></td></tr>";
$content.="<tr bgcolor='#ffffff'><td> which usergroup can edit in this cate:</td><td>
	<select name=\"editpermission[]\" size=5 multiple>
     $canedit_options
    </select><br></td></tr>";
$content.="<tr bgcolor='#ffffff'><td> which usergroup can publish in this cate:</td><td>
	<select name=\"publishpermission[]\" size=5 multiple>
     $canpublish_options
    </select><br></td></tr>";
output();





?>