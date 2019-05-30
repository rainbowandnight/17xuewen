<?php

/**
 * article -> add
 */

 $thisprog='article_man_add.php';
define('getCache',1);
include('./admin_global.inc.php');
if (!access("canadd")){
	shownopermission();
}

$content = '<HTML><head><META content="text/html; charset='.language.'" http-equiv=Content-Type><Title>Admin Panel Component</title><link rel=stylesheet href=cpstyle.css>
<script src="//cdn.ckeditor.com/4.11.3/standard/ckeditor.js"></script>
	</head><body bgcolor=FFFFFF  text="#000000" leftmargin="10" topmargin="10" marginwidth="10" marginheight="10" link="#000000" vlink="#000000" alink="#000000" onLoad="Init()">';

//include('./js.php');
$content.= '<table width=98% cellspacing=0 cellpadding=0 border=0>
					<tr>
						<td><p>&nbsp;</p></td>
					</tr>
				</table>
				<br><form method=post name=article onsubmit="return ProcessNextArticle()" enctype=multipart/form-data action="article_add_next.php">';
$content.= '<table width=90% cellpadding=0 align=center cellspacing=1><tr><td bgcolor=666666><table width=100% cellpadding=4 cellspacing=1><tr><td bgcolor=CCCCCC colspan=20> <font size=2><b>Add a new article</b></font> </td></tr>';

if (!isset($_GET["cat_parent_id"])){
	$cat_parent_id=0;
}else{
	$cat_parent_id=$_GET["cat_parent_id"];}

if (!isset( $_GET["articleid"])){
	//showerror();
}else{
	$articleid=$_GET["articleid"];}

if ($_POST['submit'] || $_POST['nextpage']){
	if ($_POST['articleSubtitle'] && $_POST['articleContent']) {
		
		$content = trim($_POST['articleContent']);
		$content =un_badchars($content);
		$page=$_POST['page']+1;
		$articleid=$_POST['articleid'];
		
		$DB_site->query("INSERT INTO $table_page (pageid, articleid, pagenum, subtitle, content, dateline) VALUES ('','$articleid','".addslashes(htmlspecialchars($_POST['page']))."','".addslashes(htmlspecialchars($_POST['articleSubtitle']))."','$content', '".time()."')");


		require('../include/template.inc.php');
		$t= new template;
		$t->cache_dir="../cache";
		$pages=$DB_site->query("select pagenum FROM $table_page WHERE articleid=$articleid");

		while ($onepage=$DB_site->fetch_array($pages)){
		
			$t->clear_cache("showArticle",$articleid."|".$onepage[pagenum]);
		}
		
		showsuccess(
		'You have added a new article successfully',
		$_POST['nextpage'] ? 'article_add_next.php?page='.$page.'&articleid='.$articleid : 'article_man_list.php');

	}else{

		$content.='<tr bgcolor=FFFFFF><td colspan=2><font color=red>Please fill up the content</font></td></tr>';
	}
}



$content.='<tr bgcolor="#ffffff"><td>subtitle: </td><td><input type=text name=articleSubtitle></td></tr>';
//$content.='<INPUT type=hidden name=articleContent>';
$content.='<input type="hidden" name="__data">';
$content.='<input type="hidden" name="page" value='.$page.'>';
$content.='<input type="hidden" name="articleid" value='.$articleid.'>';
$content.='<tr bgcolor="#ffffff"><td>content: </td><td> <textarea name="articleContent"></textarea>
                <script>
                        CKEDITOR.replace( "articleContent" );
                </script></td></tr>';
//include('./bar.php');
print $content.'<tr bgcolor=EEEEEE><td colspan=20><input type=submit name="submit">&nbsp;&nbsp;<INPUT accessKey=r type=reset value=reset name="reset"> <INPUT accessKey=n type=submit value=nextpage name="nextpage"></td></tr></table></table><br><br></Form></Body></Html>';