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
$page=$page? $page : 1;


$content = '<HTML><head><META content="text/html; charset='.language.'" http-equiv=Content-Type><Title>Admin Panel Component</title><link rel=stylesheet href=cpstyle.css>
<script src="//cdn.ckeditor.com/4.11.3/standard/ckeditor.js"></script>
	</head><body bgcolor=FFFFFF  text="#000000" leftmargin="10" topmargin="10" marginwidth="10" marginheight="10" link="#000000" vlink="#000000" alink="#000000" onLoad="Init()">';

///include('./js.php');
$content.= '<table width=98% cellspacing=0 cellpadding=0 border=0>
					<tr>
						<td><p>&nbsp;</p></td>
					</tr>
				</table>
				<br><form method=post name=article onsubmit="return ProcessArticle()" enctype=multipart/form-data action="article_man_add.php">';
$content.= '<table width=90% cellpadding=0 align=center cellspacing=1><tr><td bgcolor=666666><table width=100% cellpadding=4 cellspacing=1><tr><td bgcolor=CCCCCC colspan=20> <font size=2><b>Add a new article</b></font> </td></tr>';

if (!isset($cat_parent_id)){
	$cat_parent_id=0;
}

if ($_POST['submit'] || $_POST['nextpage']){
	if ($_POST['articleSubtitle'] && $_POST['articleContent'] && $_POST['articleTitle'] && $_POST['articleAuthor'] && $_POST['articleContent'] && $_POST['cateid']) {
		
		$content = trim($_POST['articleContent']);
		$content =un_badchars($content);
		
		$DB_site->query("INSERT INTO $table_article (articleid, cateid, posttime, author, title, description) VALUES (null,'".addslashes(htmlspecialchars($_POST['cateid']))."','".time()."','".addslashes(htmlspecialchars($_POST['articleAuthor']))."', '".addslashes(htmlspecialchars($_POST['articleTitle']))."','".addslashes($_POST['articleDescription'])."')");
		$articleid=$DB_site->insert_id();
		
		
		$DB_site->query("INSERT INTO $table_page (pageid, articleid, pagenum, subtitle, content, dateline) VALUES ('','$articleid','1','".addslashes(htmlspecialchars($_POST['articleSubtitle']))."','$content', '".time()."')");
		
		showsuccess(
		'You have added a new article successfully',
		$_POST['nextpage'] ? 'article_add_next.php?page=2&articleid='.$articleid : 'article_man_list.php');

	}else{

		$content.='<tr bgcolor=FFFFFF><td colspan=2><font color=red>Please fill up the content</font></td></tr>';
	}
}



$content.='<tr bgcolor="#ffffff"><td> Article title: </td><td><input type=text name=articleTitle></td></tr>';

$content.='<tr bgcolor="#ffffff"><td> Article author: </td><td><input type=text name=articleAuthor></td></tr>';
$content.="<tr bgcolor=#ffffff><td> description:</td><td>
<textarea name='articleDescription' rows='5' cols='50'></textarea></td></tr>";
$dropdown=get_category_dropdown($cat_parent_id);
$content.="<tr bgcolor='#ffffff'><td> category under:</td><td>$dropdown</td></tr>";

$content.='<tr bgcolor="#ffffff"><td>subtitle: </td><td><input type=text name=articleSubtitle></td></tr>';

$content.='<input type="hidden" name="__data">';
//$content.='<input type="hidden" name="page" value='.$page.'>';
//$content.='<input type="hidden" name="articleid" value='.$articleid.'>';


$content.='<tr bgcolor="#ffffff"><td>content: </td><td> <textarea name="articleContent"></textarea>
                <script>
                        CKEDITOR.replace( "articleContent" );
                </script></td></tr>';
print $content.'<tr bgcolor=EEEEEE><td colspan=20><input type=submit name="submit">&nbsp;&nbsp;<INPUT accessKey=r type=reset value=reset name="reset"> <INPUT accessKey=n type=submit value=nextpage name="nextpage"></td></tr></table></table><br><br></Form></Body></Html>';


?>