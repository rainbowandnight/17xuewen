<?php

/**
 * user -> edit user
 */

$thisprog='comment_man_edit.php';

include('./admin_global.inc.php');

if (!access("canadmin")){
	shownopermission();
}

init();
setTitle('Edit a comment');


if ($action=="delete"){
	$content.='<tr bgcolor="#ffffff"><td>Do you want to delete this comment</td></tr>';
	$content.='<input type=hidden name=action value=dodel>';
	$content.="<input type=hidden name=commentid value=$commentid>";
	$content.="<input type=hidden name=articleid value=$articleid>";
	output();
}


if ($action=="dodel"){

	$DB_site->query("DELETE FROM ".$table_comment." WHERE commentid = ".$commentid);

	$DB_site->query("UPDATE $table_article SET commentnum =commentnum -1 WHERE articleid=$articleid");
	require('../include/template.inc.php');
	$t= new template;
	$t->cache_dir="../cache";
	$pages=$DB_site->query("select pagenum FROM $table_page WHERE articleid=$articleid");
	
	while ($onepage=$DB_site->fetch_array($pages)){
		
		$t->clear_cache("showArticle",$articleid."|".$onepage[pagenum]);
	}


	showSuccess('You have deleted a  comment successfully', 'comment_man_list.php');

}


if ($_POST['submit']) {
	if ($_POST['subject'] && $_POST['content']){
		
		$articleid=$_POST[articleid];
		$name=un_badchars($_POST[name]);
		$content=un_badchars($_POST[content]);
		$subject=un_badchars($_POST[subject]);
		$email=un_badchars($_POST[email]);



		$DB_site->query("UPDATE $table_comment
		SET
		name = '$name',
		content = '$content',
		subject  ='$subject',
		email = '$email' 
		WHERE commentid = ".$commentid);
		showSuccess('You have edited a comment successfully', 'comment_man_list.php');
	}else{

		$content.='<tr bgcolor=FFFFFF><td colspan=2><font color=red>Please fill up the content</font></td></tr>';
	}

}

$comment=$DB_site->query_first("SELECT * FROM $table_comment WHERE commentid = ".$commentid);	

$content.='<tr bgcolor="#ffffff"><td> User name: </td><td><input type=text name=userName value='.$comment[name].'></td></tr>';
$content.='<tr bgcolor="#ffffff"><td> subject:</td><td><input type=text name=passWord value='.$comment[subject].'></td></tr>';
$content.='<tr bgcolor="#ffffff"><td> email</td><td><input type=text name=email value='.$comment[email].'></td></tr>';
$content.='<tr bgcolor="#ffffff"><td>content</td><td><textarea rows=10 cols=70 name=content>'.$comment[content].'</textarea></td></tr>';

	
output();
?>