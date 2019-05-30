<?php

/**
 * article -> edit
 */

 $thisprog='article_man_edit.php';
define('getCache',1);
include('./admin_global.inc.php');

if (!access("canedit")){
	shownopermission();
}

if (!isset($_GET["cat_parent_id"])){
	$cat_parent_id=0;
}else{
	$cat_parent_id=$_GET["cat_parent_id"];}

if (!isset( $_GET["aid"])){
	showerror();
}else{
	$aid=$_GET["aid"];}

$content = '<HTML>
<head>
<META content="text/html; charset='.language.'" http-equiv=Content-Type>
<Title>Admin 	Panel Component</title><link rel=stylesheet href=cpstyle.css>
<script src="//cdn.ckeditor.com/4.11.3/standard/ckeditor.js">
</script>
</head>
<body bgcolor=FFFFFF  text="#000000" leftmargin="10" topmargin="10" marginwidth="10" marginheight="10" link="#000000" vlink="#000000" alink="#000000" onLoad="Init()">';

//include('./js.php');
$content.= '<table width=98% cellspacing=0 cellpadding=0 border=0>
					<tr>
						<td><p>&nbsp;</p></td>
					</tr>
				</table>
				<br>
				<form method=post name=info onsubmit="return ProcessArticle()" enctype=multipart/form-data action=article_man_edit.php?aid='.$aid.'>';
$content.= '<table width=90% cellpadding=0 align=center cellspacing=1>
<tr>
<td bgcolor=666666><table width=100% 	cellpadding=4 cellspacing=1><tr><td bgcolor=CCCCCC colspan=20> <font size=2><b>edit an article</b></font> 	
</td></tr>';


	

	
	
if ($_POST['submit']) {
	if ($_POST['articleTitle'] && $_POST['articleAuthor'] && $_POST['articleDescription']) {
		
echo $aid;
		$DB_site->query("UPDATE $table_article SET cateid='".slashesencode(htmlspecialchars($_POST['cateid']))."', author='".slashesencode(trim($_POST['articleAuthor']))."', title='".slashesencode(trim($_POST['articleTitle']))."', description='".slashesencode($_POST['articleDescription'])."' WHERE articleid=$aid");

		require('../include/template.inc.php');
		$t= new template;
		$t->cache_dir="../cache";
		$pages=$DB_site->query("select pagenum FROM $table_page WHERE articleid=$aid");

		while ($onepage=$DB_site->fetch_array($pages)){
		
			$t->clear_cache("showArticle",$aid."|".$onepage[pagenum]);
		}
		
		showSuccess('You have edited a new article successfully', 'article_man_list.php');
	}else{

		$content.='<tr bgcolor=FFFFFF><td colspan=2><font color=red>Please fill up the content</font></td></tr>';
	}

}

if ($_POST['action']=='delpage'){
	$DB_site->query(sprintf("DELETE FROM $table_page WHERE (pagenum IN ('%s')) AND articleid=%s",join("','", $pagenums),$aid));

	require('../include/template.inc.php');
	$t= new template;
	$pages=$DB_site->query("select pagenum FROM $table_page WHERE articleid=$articleid");

	while ($onepage=$DB_site->fetch_array($pages)){
		$t->clear_cache("showArticle",$articleid."|".$onepage);
	}
	showSuccess('You have delete articles successfully', 'article_man_edit.php?aid='.$aid);



}
$article=$DB_site->query_first("select * from $table_article where articleid=$aid");
$content.="<tr bgcolor=#ffffff><td> Article title: </td><td><input type=text name=articleTitle value=\"$article[title]\"></td></tr>";
$content.="<tr bgcolor=#ffffff><td> Article author: </td><td><input type=text name=articleAuthor value=\"$article[author]\"></td></tr>";

$content.="<tr bgcolor=#ffffff><td>Article description:</td><td><textarea name='articleDescription' rows='5' cols='50'>$article[description]</textarea></td></tr>";
$dropdown=get_category_dropdown($article[cateid]);
$content.="<tr bgcolor='#ffffff'><td> category under:</td><td>$dropdown</td></tr>";


$content.='<tr bgcolor=EEEEEE><td colspan=20><input type=submit name="submit"></td></tr></table></table><br><br></Form>';


$allpages=$DB_site->query("select pagenum,subtitle from $table_page where articleid=$aid");

$content.= '<form method=post name=page enctype=multipart/form-data action="article_man_edit.php?aid='.$aid.'"><table width=90% cellpadding=0 align=center cellspacing=1><tr><td bgcolor=666666><table width=100% cellpadding=4 cellspacing=1><tr><td bgcolor=CCCCCC colspan=20> <font size=2><b>edit a page</b></font> </td></tr>';

$content.="<tr bgcolor=#ffffff><td>subtitle:</td><td>edit</td><td>del</td></tr>";
while ($everypage=$DB_site->fetch_array($allpages)){
	$content.="<tr bgcolor=#ffffff><td>$everypage[subtitle]</td><td><a href=article_edit_page.php?page=$everypage[pagenum]&articleid=$aid>edit</td><td><input type=checkbox name=pagenums[$everypage[pagenum]] value=$everypage[pagenum]></td></tr>";
	$toltalpage++;
}
$content.='<input type=hidden name=action value=delpage>';


$content.='<tr bgcolor=EEEEEE><td colspan=20><input type=submit name="submit"></td></tr></table></table><br><br></Form>';



$content.= '<form method=post name=article onsubmit="return ProcessArticle()" enctype=multipart/form-data 		action="article_add_next.php"><table width=90% cellpadding=0 align=center cellspacing=1><tr><td 			bgcolor=666666><table width=100% cellpadding=4 cellspacing=1><tr><td bgcolor=CCCCCC colspan=20> <font 		size=2><b>add a new page</b></font> </td></tr>';

$content.='<tr bgcolor="#ffffff"><td>subtitle: </td><td><input type=text name=articleSubtitle></td></tr>';
$content.='<tr bgcolor="#ffffff"><td>content: </td><td> <textarea name="articleContent"></textarea>
                <script>
                        CKEDITOR.replace( "articleContent" );
                </script></td></tr>';
//$content.='<INPUT type=hidden name=articleContent>';
$content.='<input type="hidden" name="__data">';
$content.='<input type="hidden" name="page" value='.++$toltalpage.'>';
$content.='<input type="hidden" name="articleid" value='.$aid.'>';

//include('./bar.php');


print $content.'<tr bgcolor=EEEEEE><td colspan=20><input type=submit name="submit">&nbsp;&nbsp;<INPUT 			accessKey=r type=reset value=reset name="reset"> <INPUT accessKey=n type=submit value=nextpage 				name="nextpage"></td></tr></table></table><br><br></Form></Body></Html>';
?>