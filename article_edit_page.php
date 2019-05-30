<?php

/**
 * article -> add
 */

 $thisprog='article_man_add.php';
define('getCache',1);
include('./admin_global.inc.php');

if (!access("canedit")){
	shownopermission();
}
$content = '<HTML><head><META content="text/html; charset='.language.'" http-equiv=Content-Type><Title>Admin Panel Component</title><link rel=stylesheet href=cpstyle.css>
<script src="//cdn.ckeditor.com/4.11.3/standard/ckeditor.js">
	</head><body bgcolor=FFFFFF  text="#000000" leftmargin="10" topmargin="10" marginwidth="10" marginheight="10" link="#000000" vlink="#000000" alink="#000000" onLoad="Init()">';

include('./js.php');
$content.= '<table width=98% cellspacing=0 cellpadding=0 border=0>
					<tr>
						<td><p>&nbsp;</p></td>
					</tr>
				</table>
				<br><form method=post name=article onsubmit="return ProcessArticle()" enctype=multipart/form-data action="article_edit_page.php">';
$content.= '<table width=90% cellpadding=0 align=center cellspacing=1><tr><td bgcolor=666666><table width=100% cellpadding=4 cellspacing=1><tr><td bgcolor=CCCCCC colspan=20> <font size=2><b>Add a new article</b></font> </td></tr>';


if (!isset( $_GET["articleid"])){
	//showerror();
}else{
	$articleid=$_GET["articleid"];}
	if (!isset( $_GET["page"])){
	//showerror();
}else{
	$page=$_GET["page"];}

if ($_POST['submit']){
	if ($_POST['articleSubtitle'] && $_POST['articleContent']) {
		
		$content = trim($_POST['articleContent']);
		$content =un_badchars($content);
		$page=$_POST['page'];
		$articleid=$_POST['articleid'];
		
		$DB_site->query("UPDATE $table_page SET subtitle='".slashesencode(htmlspecialchars($_POST['articleSubtitle']))."', content='$content'  WHERE articleid='$_POST[articleid]' AND pagenum='$_POST[page]'");

		require('../include/template.inc.php');
		$t= new template;
		$t->cache_dir="../cache";
		$pages=$DB_site->query("select pagenum FROM $table_page WHERE articleid=$articleid");

		while ($onepage=$DB_site->fetch_array($pages)){
		
			$t->clear_cache("showArticle",$articleid."|".$onepage[pagenum]);
		}
		
		showsuccess(
		'You have edited a new article successfully',
		'article_man_edit.php?&aid='.$articleid);

	}else{

		$content.='<tr bgcolor=FFFFFF><td colspan=2><font color=red>Please fill up the content</font></td></tr>';
	}
}


$pageinfo=$DB_site->query_first("SELECT * FROM $table_page WHERE articleid=$articleid AND pagenum=$page");
$content.='<tr bgcolor="#ffffff"><td>subtitle: </td><td><input type=text name=articleSubtitle value="'.$pageinfo[subtitle].'"></td></tr>';
$content.='<tr bgcolor="#ffffff"><td>content: </td><td> <textarea name="articleContent">"'.$pageinfo[content].'"</textarea>
                <script>
                        CKEDITOR.replace( "articleContent" );
                </script></td></tr>';
//$content.='<INPUT type=hidden name=articleContent>';
$content.='<input type="hidden" name="__data">';
$content.='<input type="hidden" name="page" value='.$page.'>';
$content.='<input type="hidden" name="articleid" value='.$articleid.'>';

//include('./bar.php');
print $content.'<tr bgcolor=EEEEEE><td colspan=20><input type=submit name="submit">&nbsp;&nbsp;<INPUT accessKey=r type=reset value=reset name="reset"> </td></tr></table></table><br><br></Form></Body></Html>';