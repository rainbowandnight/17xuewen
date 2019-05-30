<?php

/**
 * article -> add
 */

$MY_PARA= array_merge($_GET , $_POST, $_GET, $_POST);

$thisprog='comment_man_list.php';

include('./admin_global.inc.php');


if (!access("canadmin")){
	shownopermission();
}

init();

setTitle('Comment list');
if (!$commentppage) $commentppage=20;
if(!$page) $page = 1;

$orderby=trim($MY_PARA['orderby']);
if($orderby) $orderby = ' ORDER BY ' . $orderby;

$whereCondition=array();

$articleid    = trim($MY_PARA['articleid']);
//$articletitle=trim($MY_PARA['articletitle']);
$username     = trim($MY_PARA['username']);
$comment_txt  = trim($MY_PARA['comment_txt']);
$dateafter    = trim($MY_PARA['dateafter']);
$datebefore   = trim($MY_PARA['datebefore']);
$commentppage = trim($MY_PARA['commentppage']);

if (!$commentppage) $commentppage=20;

if ($articleid){
	$whereCondition[]="INSTR(LCASE(c.articleid),'".strtolower($articleid)."')>0";
}
/*
if ($articletitle){
	$whereCondition[]="INSTR(LCASE(i.image_name),'".strtolower($articletitle)."')>0";
}*/

if ($username){
	$whereCondition[]="INSTR(LCASE(c.name),'".strtolower($username)."')>0";
}

if ($comment_txt){
	$whereCondition[]="INSTR(LCASE(c.content),'".strtolower($comment_txt)."')>0";
}

if ($dateafter){
	$whereCondition[]= "c.dateline > UNIX_TIMESTAMP('$dateafter')";
}

if ($datebefore){
	$whereCondition[]= "c.dateline < UNIX_TIMESTAMP('$datebefore')";
}

if($whereCondition) $wherecondition = join(' AND ', $whereCondition);
if($wherecondition) $wherecondition = ' WHERE ' . $wherecondition;

$comments = $DB_site->query("select c.articleid,c.subject,c.commentid from $table_comment c $wherecondition $orderby  limit ".(($page - 1) * $commentppage).','. $commentppage);

while($comment=$DB_site->fetch_array($comments)) {
	$content .= "<tr bgcolor=#ffffff><td>$comment[subject]</td><td><a href='comment_man_edit.php?commentid=$comment[commentid]'>Edit</a></td><td><a href='comment_man_edit.php?commentid=$comment[commentid]&articleid=$comment[articleid]&action=delete'>Delete</a></td></tr>";
}

$matchComments = $DB_site->query_first('select count(*) FROM '.$table_comment .' c'. $wherecondition);

$content .="<tr bgcolor='#ffffff'><td colspan=5>".getPage($matchComments,"comment_man_list.php?username=$username&articleid=$articleid&comment_txt=$comment_txt&dateafter=$dateafter&datebefore=$datebefore&page=")."</td></tr>";

$content .= <<< CEOF
<tr bgcolor=666666><td colspan=3></td></tr>

<tr bgcolor='#ffffff'><td>Article ID contains</td><td colspan=3><input type=text name=articleid value=$articleid></td></tr>

<tr bgcolor='#ffffff'><td>Username contains</td><td colspan=3><input type=text name=username value=$username></td></tr>

<tr bgcolor='#ffffff'><td>Comment contains</td><td colspan=3><input type=text name=comment_txt value=$comment_txt></td></tr>

<tr bgcolor='#ffffff'><td>Date before <br>(Format of date: yyyy-mm-dd hh:mm:ss)
</td><td colspan=3><input type=text name=datebefore value=$datebefore></td></tr>

<tr bgcolor='#ffffff'><td>Date after <br>(Format of date: yyyy-mm-dd hh:mm:ss)
</td><td colspan=3><input type=text name=dateafter value=$dateafter></td></tr>

<tr bgcolor='#ffffff'><td>Results order by</td><td colspan=5>
<select name=orderby>
  <option value=commentid>Commentid
  <option value=articleid>Articleid
  <option value=username>Username
  <option value=dateline>Date
</select>
</td></tr>

<tr bgcolor='#ffffff'><td>perpage
</td><td colspan=3><input type=text name=commentppage value=$commentppage></td></tr>

CEOF;



function getPage($results,$address){
	global $commentppage,$page;
	if ($results > $commentppage){
		$i=1;
		$navs = "&nbsp; <a href=".$address.$i.">|&lt;&lt;</a>";
	}

	for($i = max(1, $page - 5); $i <= min(ceil($results / $commentppage), $page+5); $i++) {

		$navs .= " <a href=".$address.$i."><b>".$i."</b></a> ";

	}
	$i=ceil($results / $commentppage);
	$navs .= "&nbsp; <a href=".$address.$i.">&gt;&gt;|</a>";
	return $navs;
}

output();

?>