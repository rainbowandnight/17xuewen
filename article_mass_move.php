<?php
$thisprog='article_mass_move.php';
define('getCache',1);
include('./admin_global.inc.php');
if (!access("canadmin")){
	shownopermission();
}
init();
setTitle('mass move topic');
$articleperpage=$articlesPP;


if ($action=="move"){
	$DB_site->query(sprintf("UPDATE $table_article SET cateid=$cateid WHERE (articleid IN ('%s'))",join("','", $articleId)));

	require('../include/template.inc.php');
	$t= new template;
	$t->cache_dir="../cache";
	$t->clear_all_cache();
	showSuccess('You have move articles successfully', $thisprog);
}

$jumpmenu=get_category_dropdown(0);
if(empty($keyword)) {
	
	$content.='<tr bgcolor="#FFFFFF"> 
            <td>请输入关键字:</td>
            <td> 
              <input type="text" name="keyword">
              <input type="hidden" name="action" value="result">
            </td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td>请选择搜索的范围:</td>
            <td> 
              在<INPUT type=checkbox name=searchTitle checked> 标题
	<INPUT type=checkbox name=searchInContent> 文章内容  中搜索 </td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td>请选择分类:</font></td>
            <td>'.$jumpmenu.'</td>
          </tr><tr bgcolor="#FFFFFF">
	<td>请选择搜索结果排序方式</td>
	<TD>
          <SELECT  name=orderby>
            <OPTION value=posttime>按照文章发表时间排序</OPTION>
            <OPTION value=clicktimes>按照文章点击数目排序</OPTION>
            <OPTION value=rating>按照文章的得分排序</OPTION>
            <OPTION value=poster>按照主题作者用户名排序</OPTION>
          </SELECT>
          </TD>
	</tr>';


	output();
	exit();
}

$page = (!($page && isint($page))) ? 1 : $page;

$key = addslashes($keyword);

$conditions = array();
if($keyword) {
	$keyword_conditions = array();
	if($searchTitle) {
		$keyword_conditions[0] = "$table_article.title like '%$key%'";
	}
	if($searchInSubtitle) {
		$keyword_conditions[1] = "$table_page.subtitle like '%$key%'";
		$searchPage = true;
	}
	if($searchInContent) {
		$keyword_conditions[2] = "$table_page.content like '%$key%'";
		$searchPage = true;
	}
	$conditions[0] = join(' OR ', $keyword_conditions);
	if($conditions[0]) $conditions[0] = '('.$conditions[0].')';
		else unset($conditions[0]);
}

if (isset($cateid)){
	$ids=get_all_cat($cateid);
	$ids[]=$cateid;
	
	$conditions[1] = $table_article.'.cateid IN ('.join(',', $ids). ') ';
	
}

$condition = 'WHERE '.join(' AND ', $conditions);

switch($orderby) {
		case 'posttime': $orderby = "posttime DESC"; break;
		case 'clicktimes': $orderby = 'clicktimes DESC'; break;
		case 'rating': $orderby = 'rating DESC'; break;
		default:       $orderby = "posttime DESC"; break;
}

$joinMode = $searchPage ? "$table_page LEFT JOIN $table_article USING(articleid)" : "$table_article";

$distinctMode = $searchPage ? "DISTINCT" : "";

$articleCount = $DB_site->query_first("SELECT count(*) FROM $joinMode $condition");

$totalPage = ceil($articleCount/$articlesPP);

$beginRow = ($page-1)*$articlesPP;

$articles = $DB_site->query(
		"SELECT $distinctMode $table_article.*,$table_cate.cateid,$table_cate.title AS catetitle FROM $joinMode
LEFT JOIN $table_cate using (cateid)
		$condition ORDER BY $orderby  limit $beginRow,$articlesPP");

$content.= "<tr bgcolor=\"#FFFFFF\">\n";
$content.= "<td ><b>title</b></td>\n<td align=\"center\"><b>catetitle</b></td>\n<td align=\"center\"><b>y/n</b></td></tr>\n";
//---- display ----//
while ($article=$DB_site->fetch_array($articles)){
	$content.= "<tr bgcolor=\"#FFFFFF\">\n";
	$content.= "<td ><b>$article[title]</b></td>\n<td align=\"center\"><b>$article[catetitle]</b></td>\n<td align=\"center\"><b><input type=radio name=articleId[$article[articleid]] value=$article[articleid] checked>y<input type=radio name=articleId[$article[articleid]] >n</b></td></tr>\n";
}

if($articleCount > $articleperpage) {
		$content .= '<tr bgcolor=#FFFFFF><td colspan=6>';
		$content .= "&nbsp; <a href=article_mass_del.php?page=1&keyword=$keyword&searchTitle=$searchTitle&searchInContent=$searchTitle&cat_id=$cat_id&orderby=$orderby>|&lt;&lt;</a>";
		for($i = max(1, $page - 5); $i <= max(ceil($articleCount / $articleperpage), $page+5); $i++) {
			$content .="<a href=article_mass_del.php?page=$i&keyword=$keyword&searchTitle=$searchTitle&searchInContent=$searchTitle&cat_id=$cat_id&orderby=$orderby>$i</a>";
		}
	
		$content .= "&nbsp; <a href=article_mass_del.php?page=".ceil($matchArticles / $articleperpage)."&keyword=$keyword&searchTitle=$searchTitle&searchInContent=$searchTitle&cat_id=$cat_id&orderby=$orderby>|&gt;&gt;</a>";
}

$content .= '</td></tr><input type=hidden name=action value=move>';
$content .=' <tr bgcolor="#FFFFFF"> 
            <td>请选择目的分类:</font></td>
            <td colspan=2>'.$jumpmenu.'</td>
          </tr>';




output();

?>