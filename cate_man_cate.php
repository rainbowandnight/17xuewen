<?php

/**
 * cate -> cate man
 */

 $thisprog='cate_man_cate.php';
define('getCache',1);
include('./admin_global.inc.php');
if (!access("canadmin")){
	shownopermission();
}
init();


if (!isset($_POST['action'])){
	
	if (!isset($_GET['action'])){
	
	
	
	$action="modify";
} else{
	$action=$_GET['action'];
}
	
	
} else{
	$action=$_POST['action'];
}
echo $action;

if (!isset($_GET['cat_id'])){
	//$action="modify";
} else{
	$cat_id=$_GET['cat_id'];
}

if ($action=="ordercat"){
	$displayorder=$_POST['displayorder'];
	foreach ($displayorder as $key => $order){

		$DB_site->query("UPDATE $table_cate SET displayorder='$order' WHERE cateid='$key'");

	}//resort cate order
	showSuccess('You have re order cate successfully', $thisprog);


}

if ($action=="removecat" && $cat_id){
	setTitle('Remove a new cat');
	$content.= "<tr bgcolor=\"#FFFFFF\">\n";
	$content.="<td ><b>Do you want to delete this category?<br>
		All subcategories as well as articles and comments will be deleted!</b></td>\n</tr>\n";
	$content.= "<input type=hidden name=action value=del>";
	$content.= "<input type=hidden name=cat_id value=$cat_id>";

}
if ($action=="del" && $cat_id){
	$getcache=1;
	$sql="DELETE FROM $table_permissions WHERE cateid='$cat_id'";
	echo $sql;
	$DB_site->query($sql);
	$ids=get_all_cat($cat_id);
	$ids[]=$cat_id;

	$DB_site->query(sprintf("DELETE FROM $table_cate WHERE (cateid IN ('%s'))",join("','", $ids)));
	$articleIds=$DB_site->query(sprintf("SELECT articleid FROM $table_article WHERE (cateid IN ('%s'))",join("','", $ids)));
	while ($articleids=$DB_site->fetch_array($articleIds)){
		$articleId[]=$articleids[articleid];
	}
	$DB_site->query(sprintf("DELETE FROM $table_page WHERE (articleid IN ('%s'))",join("','", $articleId)));
	$DB_site->query(sprintf("DELETE FROM $table_article WHERE (cateid IN ('%s'))",join("','", $ids)));

	require('../include/template.inc.php');
	$t= new template;
	$t->cache_dir="../cache";
	$t->clear_all_cache();
	
	showSuccess('You have delete cate successfully', $thisprog);
}

if ($action=="modify"){
	setTitle('Modify cats');
	$getcache=1;
	
	$content.= "<tr bgcolor=\"#FFFFFF\">\n";
	$content.="<td ><b>nav categories edit</b></td>\n<td align=\"center\"><b>categories order</b></td>\n</tr>\n";
	if (sizeof($category_cache) == 0) {
		$content.="<tr class=\"".get_row_bg()."\">\n<td colspan=\"2\">no categories</td></tr>";
	}else {
		$content.=show_category_rows();
	}
	$content.= "<input type=hidden name=action value=ordercat>";
	
}

output();

?>