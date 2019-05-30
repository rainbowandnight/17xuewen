<?php

/**
 * template -> list
 */


$thisprog='template_list.php';

include('./admin_global.inc.php');
if (!access("canadmin")){
	shownopermission();
}
init();
setTitle('Templates List');


/**********************************************************************
 * Template List Define
 */
$templateList = array();


//------------------------------------------------------//
// Global Templates
//------------------------------------------------------//
$templateList['Global Templates'][] = 'header';
$templateList['Global Templates'][] = 'headinclude';
$templateList['Global Templates'][] = 'footer';
$templateList['Global Templates'][] = 'copyright';
$templateList['Global Templates'][] = 'error';
$templateList['Global Templates'][] = 'success';

//------------------------------------------------------//
// Article Home Templates
//------------------------------------------------------//
$templateList['Article Home Templates'][] = 'articlehome';

//------------------------------------------------------//
// Category Display Templates
//------------------------------------------------------//
$templateList['Category Dispaly Templates'][] = 'cate_display';

//------------------------------------------------------//
// Article  Templates
//------------------------------------------------------//
$templateList['Article Templates'][] = 'showarticle';

//------------------------------------------------------//
// Search  Templates
//------------------------------------------------------//
$templateList['Search Templates'][] = 'search';
$templateList['Search Templates'][] = 'searchresult';

//------------------------------------------------------//
// Vote Templates
//------------------------------------------------------//
$templateList['Vote Templates'][] = 'votesuccess';

//------------------------------------------------------//
// Print Article Templates
//------------------------------------------------------//
$templateList['Print Article Templates'][] = 'printarticle';

//------------------------------------------------------//
// Comment Templates
//------------------------------------------------------//
$templateList['Comment Templates'][] = 'showcomment';

//------------------------------------------------------//
// Error Message Templates
//------------------------------------------------------//
$templateList['Error Message Templates'][] = 'error_articleid';
$templateList['Error Message Templates'][] = 'error_cateid';
$templateList['Error Message Templates'][] = 'error_multirate';
$templateList['Error Message Templates'][] = 'error_norating';

//------------------------------------------------------//
// success Message Templates
//------------------------------------------------------//
$templateList['success Message Templates'][] ='success_addcomment';


//get sorted Templates
$sorted=array();
foreach ( $templateList as $filename => $filenameTp ){
	foreach ($filenameTp as $key => $tps){
		$sorted[]=$tps;
	}
}



$content .= "</td><tr bgcolor=#ffffff><td><p><span class=\"gc\">这个颜色</span> 的模板是初始的模板，可以被用来添加自定义模板.<br>\n <span class=\"cc\">这个颜色</span> 的模板是自定义的模板或者修改过的模板，可以被转换为初始模板.</p><ul>";
//$debug=1;
if ($debug) {
		
		$content .= "<li><b>Global templates</b> ".show_text_link("add custom template","template_add.php?action=add&templatesetid=-1").
		show_text_link("show all","template.php?action=modify&expandset=-1&group=all").
		show_text_link("collapse groups","template_edit.php?action=modify&expandset=-1").
		"<ul>\n";

		$templates=$DB_site->query("SELECT templateid,title FROM $table_template WHERE templatesetid=-1  ORDER BY title");
		while ($template=$DB_site->fetch_array($templates)) {

			$content .= "<li>$template[title]".
				show_text_link("编辑","template_edit.php?templateId=$template[templateid]&templatesetid=-1&group=$group").
				show_text_link("删除","template_edit.php?action=delete&templateId=$template[templateid]&templatesetid=-1&group=$group").
				"</li>\n";

		}
		$content .= "</ul></li>\n";
}
//get all Templateset
$templatesets=$DB_site->query("SELECT templatesetid,title FROM $table_templateset");
while ($templateset=$DB_site->fetch_array($templatesets)) {
	$donecustom=0;
	$donedefault=0;
	$content .= "<li><b>$templateset[title]</b>".
	show_text_link("编辑","style_man_edit.php?templatesetid=$templateset[templatesetid]&group=$group").
	show_text_link("删除","style_man_edit.php?action=removeset&templatesetid=$templateset[templatesetid]").
	show_text_link("添加模板","template_add.php?templatesetid=$templateset[templatesetid]&group=$group").
	show_text_link("显示全部","template_list.php?action=modify&expandset=$templateset[templatesetid]&group=all").
	show_text_link("按组显示","template_list.php?action=modify&expandset=$templateset[templatesetid]").
      "<ul>\n";
	if (!$expandset or $expandset!=$templateset['templatesetid']) {
		$content .= "<li><b>".
			show_text_link("扩展列表","template_list.php?expandset=$templateset[templatesetid]")."</b></li>\n";
      $content .= "</ul></li>\n";
      continue;
    }

	$templates=$DB_site->query("SELECT t1.* FROM $table_template AS t1 LEFT JOIN $table_template AS t2 ON (t1.title=t2.title AND t2.templatesetid=-1) WHERE t1.templatesetid=$templateset[templatesetid] $sqlinsert  AND ISNULL(t2.templateid) ORDER BY t1.title");
    while ($template=$DB_site->fetch_array($templates)) {
		if (!$donecustom) {
			$donecustom=1;
			$content .= "<b>自定义模板</b>";
		}

		$content .= "<li><span class='cc'>$template[title]</span>".
		show_text_link("编辑","template_edit.php?templateId=$template[templateid]&templatesetid=$templateset[templatesetid]&group=$group").
		show_text_link("删除","template_edit.php?action=delete&templateId=$template[templateid]&templatesetid=$templateset[templatesetid]&group=$group").
				"</li>\n";

    }
	// get all Templates and mark which has been edited
	$templates=$DB_site->query("SELECT t1.title AS title,t2.templateid, NOT ISNULL(t2.templateid) AS found 
	FROM $table_template AS t1
    LEFT JOIN $table_template AS t2 ON (t1.title=t2.title AND t2.templatesetid=$templateset[templatesetid])
    WHERE t1.templatesetid=-1
    ORDER BY t1.title");
	//cache all Templates
	while ($row = $DB_site->fetch_array($templates)) {
		$temp_cache[$row['title']] = $row;
		$temp_cache_title[]=$row['title'];
	}
   
    if (!$donedefault and $donecustom) {
		$donedefault=1;
        $content .= "<br><b>默认模板</b>";
    }
	
    //start display sorted Templates
    reset($templateList);
	foreach ( $templateList as $filename => $filenameTp ) {
		$groupname=$filename;
		$content .= "<li><a name=\"".urlencode($filename)."\"><b></a>$filename <a href=\"template_list.php?expandset=$templateset[templatesetid]&group=".urlencode($filename)."#".urlencode($filename)."\">[扩展列表]</a></b>\n<ul>";
		if ($group==$groupname or $group=="all"){
			foreach ($filenameTp as $key => $tps){
				$templateId=$temp_cache[$tps]['templateid'];
				if ($temp_cache[$tps][found]){
					$content .= "<li><span class='cc'>$tps</span>".
          			show_text_link("编辑","template_edit.php?templateId=$templateId				&templatesetid=$templateset[templatesetid]&group=$group").
          			show_text_link("转换为默认","template_edit.php?templateId=$templateId&templatesetid=$templateset[templatesetid]&action=delete&group=$group").
					show_text_link("查看初始模板","template_list.php?action=view&title=".urlencode($tps),1).
					"</li>\n";
				}else{
					$content .= "<li><span class='gc'>$tps</span>".
					show_text_link("改变初始","template_add.php?templateName=$tps&templatesetid=$templateset[templatesetid]&group=$group").
					"</li>";
				}
			}
		}//end display sorted Templates
		$content .=  "</ul></li>\n";
	}
	//start display unsorted Templates
	$content .= '<li><b>Other Templates</b><ul>';
	$result = array_diff ($temp_cache_title, $sorted);
	foreach ($result as $key => $tps){

			if ($temp_cache[$tps][found]){
					$templateId=$temp_cache[$tps]['templateid'];
					$content .= "<li><span class='cc'>$tps</span>".
          			show_text_link("编辑","template_edit.php?templateId=$templateId&templatesetid=$templateset[templatesetid]&group=$group").
          			show_text_link("转换为默认","template_edit.php?templateId=$templateId&templatesetid=$templateset[templatesetid]&action=delete&group=$group").
					show_text_link("查看初始模板","template_list.php?action=view&title=".urlencode($tps),1).
					"</li>\n";
			}else{
					$content .= "<li><span class='gc'>$tps</span>".
					show_text_link("改变初始","template_add.php?templateName=$tps&templatesetid=$templateset[templatesetid]&group=$group").
					"</li>";
			}
			
	}//end display unsorted Templates
	$content .=  "</ul></li>\n";
	$content .=  "</ul></li>\n";
}//end display all Templatesets while
$content .= "</ul><p>以上是所有记录</p>";	  

$content .= '</ul></li></ul></td></tr>';

output();

?>