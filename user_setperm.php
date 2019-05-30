<?php

/**
 * user -> set user group permissiion
 */

$thisprog='user_setperm.php';

include('./admin_global.inc.php');
if (!access("canadmin")){
	shownopermission();
}
init();
setTitle('set the permission of a usergroup');

if(!isset($_POST['action'])){
    if(!isset($_GET['action'])){
       // $action="modify";
    }else{
        $action=$_GET['action'];
    }
}else{
    $action=$_POST['action'];
}
if(!isset($_GET['usergroupid'])){

}else{
    $usergroupid=$_GET['usergroupid'];
}



if ($_POST['submit']) {
	$DB_site->query("DELETE FROM $table_permissions WHERE usergroupid='$_POST[usergroupid]'");
	foreach ($_POST[perm] as $key => $val){
		if ($val[usedefault]){
			$val=formTosql($val);
			$DB_site->query("INSERT INTO $table_permissions VALUES('','$usergroupid','$key','".$val[canadd]."','".$val[canedit]."','".$val[cancomment]."','".$val[canpublish]."')");
		}
	}
}


$result = $DB_site->query("SELECT g.usergroupid,g.title AS grouptitle,IF(p.canadd,p.canadd,g.canadd) AS canadd,IF(p.canedit,p.canedit,g.canedit) AS canedit,IF(p.cancomment,p.cancomment,g.cancomment) AS cancomment,IF(p.canpublish,p.canpublish,g.canpublish) AS canpublish,c.title AS catetitle,c.cateid,NOT ISNULL(p.cateid) as usedefault
FROM my_permissions p
LEFT JOIN my_cate c USING (cateid)
LEFT JOIN my_usergroup g ON(g.usergroupid=p.usergroupid) 
WHERE p.usergroupid=$usergroupid ORDER BY c.cateid");

$content.='<tr bgcolor="#ffffff"><td>catetitle:</td><td>usedefault</td><td>canadd</td><td>canedit</td><td>cancomment</td><td>canpublish</td></tr>';
while ($row=$DB_site->fetch_array($result)){
	if ($row[cateid]){
	$catetitle=$row[catetitle];
	$cateid=$row[cateid];
	$row=sqlToform($row);
	$content.='<tr bgcolor="#ffffff"><td>'.$catetitle.':</td>';
	$content.='<td><input type=checkbox name=perm['.$cateid.'][usedefault] '.$row[usedefault].'></td>';
	$content.='<td><input type=checkbox name=perm['.$cateid.'][canadd] '.$row[canadd].'></td>';
	$content.='<td><input type=checkbox name=perm['.$cateid.'][canedit] '.$row[canedit].'></td>';
	$content.='<td><input type=checkbox name=perm['.$cateid.'][cancomment] '.$row[cancomment].'></td>';
	$content.='<td><input type=checkbox name=perm['.$cateid.'][canpublish] '.$row[canpublish].'></td>';
	$content.='</tr>';
	$content.= "<input type=hidden name=usergroupid value='$usergroupid'>";
	}


}

output();
