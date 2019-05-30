<?php

/**
 * option -> customize setting
 */

$thisprog='option.php';

include('./admin_global.inc.php');
if (!access("canadmin")){
	shownopermission();
}
init();
setTitle('Customize Options in Your Article System');

if ($_POST['submit']) {
	 //save changes
	$todo = array('hometitle', 'home_url', 'site_url', 'numofshowrate', 'articlesPP', 'timeformat', 'gzip_level', 'showruntime', 'using_cache', 'cookie_head', 'default_style');
	
	foreach ( $todo as $constant ){
	
		replaceconfig($constant, $_POST[$constant]);
	}

	saveChanges();

	require('../include/template.inc.php');
	$t= new template;
	$t->cache_dir="../cache";
	$t->clear_all_cache();

	showSuccess('You have updated your config info successfully', $thisprog);
}


$content.='<tr bgcolor=FFFFFF><td width=50%>your article system title: </td><td><input type=text name=hometitle value="'.hometitle.'"></td></tr>';

$content.='<tr bgcolor=FFFFFF><td width=50%>your article system url : </td><td><input type=text name=home_url value="'.home_url.'"></td></tr>';

$content.='<tr bgcolor=FFFFFF><td width=50%>your site url : </td><td><input type=text name=site_url value="'.site_url.'"></td></tr>';

$content.='<tr bgcolor=FFFFFF><td width=50%>how many votes the rating will display: </td><td><input type=text name=numofshowrate value="'.numofshowrate.'"> </td></tr>';

$content.='<tr bgcolor=FFFFFF><td width=50%>Default number of articles per page :</td><td><input type=text name=articlesPP value="'.articlesPP.'"></td></tr>';

$content.='<tr bgcolor=FFFFFF><td width=50%>Default timeformat of ur article system :</td><td><input type=text name=timeformat value="'.timeformat.'"></td></tr>';

$content.='<tr bgcolor=FFFFFF><td width=50%>gzip level when output the page :</td><td><input type=text name=gzip_level value="'.gzip_level.'"></td></tr>';

$content.='<tr bgcolor=FFFFFF><td width=50%>display the format of the process time and querys : </td><td><input type=text name=showruntime value="'.showruntime.'"></td></tr>';

$content.='<tr bgcolor=FFFFFF><td width=50%>cache the article : </td><td><input type=text name=using_cache value="'.using_cache.'"></td></tr>';


$content.='<tr bgcolor=FFFFFF><td width=50%>add this head when set cookie : </td><td><input type=text name=cookie_head value="'.cookie_head.'"></td></tr>';

$dropdown="<select name=default_style>";
$templatesets = $DB_site->query("SELECT * FROM $table_templateset");
while ($templateset=$DB_site->fetch_array($templatesets)){
	$dropdown.="<option value=$templateset[templatesetid] ";
	$dropdown.=(($templateset[templatesetid]==default_style)? "selected" : "");
	$dropdown.=">$templateset[title]</option>";
}
$dropdown.="</select>";
$content.="<tr bgcolor=FFFFFF><td width=50%>set this style as default : </td><td>$dropdown</td></tr>";
output();
?>
