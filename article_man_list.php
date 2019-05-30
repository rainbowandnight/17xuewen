<?php
/**
 * article -> list 
 */

$thisprog='article_man_list.php';
$articleperpage = 20;
define('getCache',1);
include('./admin_global.inc.php');

if (!access("canedit")){
	shownopermission();
}
init();
//if (!isset($cat_parent_id)){
//	$cat_parent_id=0;
//}
 //echo $_GET["action"];
  //echo $_POST["action"];
  
  
if (!isset($_POST["action"])){
	
	
	if (!isset($_GET["action"])){
		$action="modify";
		
	}else{
		$action=$_GET["action"];}
	
}else{
	$action=$_POST["action"];
}
  
  
  
if (!isset($_GET["cat_id"])){
	
}else{
	$cat_id=$_GET["cat_id"];
	
}



if(!isset($_GET["page"])) {
	$page = 1;
} else{
	$page = $_GET["page"];
}

$articleId = $_POST['articleId'];



//echo $action;
if ($action=="publisharticle"){
	setTitle('publish articles');
	$beginrow=($page - 1)* $articleperpage;
	$content.= "<tr bgcolor=\"#FFFFFF\">\n";
	$content.= "<td ><b>title</b></td>\n<td align=\"center\"><b>publish</b></td></tr>\n";
	$allarticles=$DB_site->query("SELECT * FROM $table_article WHERE cateid=$cat_id AND published!='y' limit $beginrow, $articleperpage ");
	while ($article=$DB_site->fetch_array($allarticles)){
		$content.= "<tr bgcolor=\"#FFFFFF\">\n";
		$content.= "<td ><a href=../article.php?aid=$article[articleid]><b>$article[title]</b></a></td>\n<td align=\"center\"><b><input type=checkbox name=articleId[$article[articleid]] value='$article[articleid]'></b></td></tr>\n";

	}
	$matchArticles = $DB_site->query_first("select count(*) FROM $table_article WHERE cateid=$cat_id AND published!='y'");

	if($matchArticles > $articleperpage) {
		$content .= '<tr bgcolor=#FFFFFF><td colspan=6>';
		$content .= "&nbsp; <a href=article_man_list.php?page=1&action=publisharticle&cat_id=$cat_id>|&lt;&lt;</a>";
		for($i = max(1, $page - 5); $i <= max(ceil($matchArticles / $articleperpage), $page+5); $i++) {
			$content .="<a href=article_man_list.php?page=$i&action=listarticle&cat_id=$cat_id>$i</a>";
		}
	
		$content .= "&nbsp; <a href=article_man_list.php?page=".ceil($matchArticles / $articleperpage)."&action=publisharticle&cat_id=$cat_id>|&gt;&gt;</a>";
	}
	$content .= '</td></tr>';
	$content .= '<input type=hidden name=action value=dopublish>';
}

if ($action=="dopublish"){
	
	$DB_site->query(sprintf("UPDATE $table_article SET published='y' WHERE (articleid IN ('%s'))",join("','", $_POST[articleId])));
	//$DB_site->query(sprintf("DELETE FROM $table_page WHERE (articleid IN ('%s'))",join("','", $articleId)));
	showSuccess('You have published articles successfully', $thisprog);
}

if ($action=="listarticle"){
	setTitle('Show articles');
	$beginrow=($page - 1)* $articleperpage;
	$content.= "<tr bgcolor=\"#FFFFFF\">\n";
	$content.= "<td ><b>title</b></td>\n<td align=\"center\"><b>clicktimes</b></td>\n<td align=\"center\"><b>ratings(votes)</b></td><td align=\"center\"><b>delete</b></td></tr>\n";
	$allarticles=$DB_site->query("SELECT * FROM $table_article WHERE cateid=$cat_id limit $beginrow, $articleperpage");
	while ($article=$DB_site->fetch_array($allarticles)){
		$content.= "<tr bgcolor=\"#FFFFFF\">\n";
		$content.= "<td ><a href=article_man_edit.php?aid=$article[articleid]><b>$article[title]</b></a></td>\n<td align=\"center\"><b>$article[clicktimes]</b></td>\n<td align=\"center\"><b>$article[rating] ($article[votes])</b></td><td align=\"center\"><b><input type=checkbox name=articleId[$article[articleid]] value=$article[articleid]></b></td></tr>\n";

	}
	$matchArticles = $DB_site->query_first("select count(*) FROM $table_article WHERE cateid=$cat_id");

	if($matchArticles > $articleperpage) {
		$content .= '<tr bgcolor=#FFFFFF><td colspan=6>';
		$content .= "&nbsp; <a href=article_man_list.php?page=1&action=listarticle&cat_id=$cat_id>|&lt;&lt;</a>";
		for($i = max(1, $page - 5); $i <= max(ceil($matchArticles / $articleperpage), $page+5); $i++) {
			$content .="<a href=article_man_list.php?page=$i&action=listarticle&cat_id=$cat_id>$i</a>";
		}
	
		$content .= "&nbsp; <a href=article_man_list.php?page=".ceil($matchArticles / $articleperpage)."&action=listarticle&cat_id=$cat_id>|&gt;&gt;</a>";
	}
	$content .= '</td></tr>';
	$content .= '<input type=hidden name=action value=delarticle>';
	
	
}
//echo $action;
if ($action=="delarticle"){
	$DB_site->query(sprintf("DELETE FROM $table_article WHERE (articleid IN ('%s'))",join("','", $articleId)));
	$DB_site->query(sprintf("DELETE FROM $table_page WHERE (articleid IN ('%s'))",join("','", $articleId)));
	showSuccess('You have delete articles successfully', $thisprog);
}

if ($action=="modify"){
	setTitle('Show cats');
	$getcache=1;
	
	$content.= "<tr bgcolor=\"#FFFFFF\">\n";
	$content.="<td ><b>nav categories edit</b></td>\n</tr>\n";
	if (sizeof($category_cache) == 0) {
		$content.="<tr class=\"".get_row_bg()."\">\n<td colspan=\"2\">no categories</td></tr>";
	}else {
		$content.=show_category_list();
	}
	$content.= "<input type=hidden name=action value=ordercat>";
	
}

output();


function show_category_list($cid = 0, $depth = 1) {
  global $category_cache,$rows;

  if (!isset($category_cache[$cid])) {
    return false;
  }
  foreach ($category_cache[$cid] as $key => $cats) {
    $class = "#FFFFFF";
    if ($cats['parentid'] == 0) {
      $class = "#ededed";
    }
    $rows.="<tr bgcolor=\"$class\">\n<td>\n";
    if ($depth > 1) {
      $rows.= str_repeat("&nbsp;&nbsp;&nbsp;&nbsp;", $depth - 1)."<img src=\"images/folder_path.gif\" alt=\"\">\n";
    }
    $rows.= "<img src=\"images/folder.gif\" alt=\"\"><b><a href=\"categories.php?cat_id=".$cats['cateid']."\" target=\"_blank\">".$cats['title']."</a>\n</b>&nbsp;&nbsp;&nbsp;&nbsp;";
    $rows.=show_text_link("edit", "article_man_list.php?action=listarticle&cat_id=".$cats['cateid']);
	$rows.=show_text_link("publish", "article_man_list.php?action=publisharticle&cat_id=".$cats['cateid']);
    $rows.= "\n</td>\n</tr>\n";
    show_category_list($cats['cateid'], $depth + 1);
  }

  unset($category_cache[$cid]);
  return $rows;
}
?>