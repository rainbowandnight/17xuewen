<?php
require '../include/config.inc.php';
require '../include/db_mysql.inc.php';


$DB_site= new db_mysql(db_name, db_host, db_user, db_pass);

// end init db

//set_magic_quotes_runtime(0);
$magic_quotes_gpc = get_magic_quotes_gpc();


if ($_POST['login_submit']) {
	$ad_username = (!$magic_quotes_gpc)? addslashes(trim($_POST['username'])) : trim($_POST['username']);
	$ad_password = md5($_POST['password']);
} else {
	$ad_username = getCookie('username');
	$ad_password = getCookie('password');
}

if ($ad_username){
	
	if (isset($cateid) and $cateid!=0){
		$userinfo=$DB_site->query_first(
		"SELECT ".get_user_table_field("u.","user_name")." as username, ".get_user_table_field("u.","user_id")." as userid, ".get_user_table_field("u.","user_password")." as password, IF(p.cateid=$cateid,p.canadd,g.canadd) AS canadd,IF(p.cateid=$cateid,p.canedit,g.canedit) AS canedit,IF(p.cateid=$cateid,p.canpublish,g.canpublish) AS canpublish,g.canadmin AS canadmin
		FROM $table_user u
		LEFT JOIN $table_usergroup g ON (g.usergroupid=".get_user_table_field("u.","user_groupid").") 
		LEFT JOIN $table_permissions p USING (usergroupid) 
		WHERE p.cateid=$cateid and ".get_user_table_field("u.","user_name")."='$ad_username' ");
	}else{
		$userinfo=$DB_site->query_first("SELECT ".get_user_table_field("u.","user_name")." as username, ".get_user_table_field("u.","user_id")." as userid, ".get_user_table_field("u.","user_password")." as password, g.*
		FROM $table_user u
		LEFT JOIN $table_usergroup g USING ($user_table_fields[user_groupid]) 
		WHERE ".get_user_table_field("u.","user_name")."='$ad_username' ");
	}
}

//if (!$ad_username ){//|| !verifyUser($userinfo[password], $ad_password)) {
	//showLoginPage();
//}

if (!$userinfo ){
	showLoginPage();
}

if ($_POST['login_submit']) {
	cookie('username', $ad_username);
	cookie('password', $ad_password);
}

$articlesPP=20;
function slashesencode($str, $force = false) {
	global $magic_quotes_gpc;
	return ($force || !$magic_quotes_gpc) ? addslashes($str) : $str;
}
function get_row_bg() {
  global $bgcounter;
  return ($bgcounter++ % 2 == 0) ? "#FFFFFF" : "#EEEEEE";
}
function show_admin_header() {
	global $content;
	$content = '<HTML>
	<head>
	<META content="text/html; charset='.language.'" http-equiv=Content-Type>
	<Title>Myarticle Admin Control Panel</title>
	<link rel=stylesheet href=cpstyle.css>
</head><body bgcolor=FFFFFF  text="#000000" leftmargin="10" topmargin="10" marginwidth="10" marginheight="10" link="#000000" vlink="#000000" alink="#000000">';
}

function show_table_header(){
	global $content;
	$content.= '<table width=90% cellpadding=0 align=center cellspacing=1>';
}

function show_table_footer() {
	global $content;
	$content.= "</table>\n</td>\n</tr>\n</table><br />\n";
}
function show_form_header($phpscript, $action = "", $name = "formular", $uploadform = 0) {
  
global $content;
	
  if ($uploadform) {
    $upload = " ENCTYPE=\"multipart/form-data\"";
  }
  else {
    $upload = "";
  }
  $content.="<form action=\"".$phpscript."\"".$upload." name=\"".$name."\" method=\"post\">\n";
  if ($action != "") {
   $content.="<input type=\"hidden\" name=\"action\" value=\"".$action."\">\n";
  }
  $content.= '<table width=98% cellpadding=0 align=center cellspacing=0 bgcolor=#ededed><tr><td><table width=100% cellpadding=0 align=center cellspacing=1>';
}


function show_form_footer($submitname = "Submit", $resetname = "Reset", $colspan = 2, $goback = "", $javascript = "") {
	global $content;
	$content.="<tr class=\"tablefooter\">\n<td colspan=\"".$colspan."\" align=\"center\">\n&nbsp;";
	if ($submitname != "") {
		$content.="<input type=\"submit\" name=\"Submit\" value=\"   ".$submitname."   \" class=\"button\"";
	if ($javascript != "") {
		$content.=" ".$javascript;
    }
    $content.=">\n";
	}
	if ($resetname != "") {
		$content.="<input type=\"reset\" value=\"   ".$resetname."   \" class=\"button\">\n";
	}
	if ($goback != "") {
		$content.="<input type=\"button\" value=\"   ".$goback."   \" onclick=\"history.go(-1)\" class=\"button\">\n";
	}
	$content.="\n</td>\n</tr></table>\n</td>\n</tr>\n</table>\n</form>\n";
}

function show_custom_row($title, $value) {
	global $content;
  $content.="<tr bgcolor=\"".get_row_bg()."\" valign=\"top\">\n<td><p class=\"rowtitle\">".$title."</p></td>\n<td><p>".$value."</p></td>\n</tr>\n";
}


function show_radio_row($title, $name, $value = 1) {
  global $_POST,$content;
  if (isset($_POST[$name])) {
    $value = $_POST[$name];
  }
 $content.="<tr bgcolor=\"".get_row_bg()."\">\n";
 $content.="<td><p class=\"rowtitle\">".$title."</p></td>\n<td><p>";
 $content.="<input type=\"radio\" name=\"$name\" value=\"1\"";
  if ($value == 1) {
    $content.=" checked=\"checked\"";
  }
 $content.=">yes&nbsp;&nbsp;&nbsp;\n";
  $content.="<input type=\"radio\" name=\"".$name."\" value=\"0\"";
  if ($value != 1) {
   $content.=" checked=\"checked\"";
  }
  $content.=">no";
  $content.="</p></td>\n</tr>";
}

function show_input_row($title, $name, $value = "", $size = "") {
  global $error, $_POST, $textinput_size,$content;
  $size = (empty($size)) ? $textinput_size : $size;
  if (isset($error[$name])) {
    $title = sprintf("<span class=\"marktext\">%s *</span>", $title);
  }
  if (isset($_POST[$name])/* && $value == ""*/) {
    $value = stripslashes($_POST[$name]);
  }
  $content.="<tr bgcolor=\"".get_row_bg()."\">\n<td><p class=\"rowtitle\">".$title."</p></td>\n<td><p><input type=\"text\" size=\"".$size."\" name=\"".$name."\" value=\"".$value."\"></p></td>\n</tr>\n";
}

function show_textarea_row($title, $name, $value = "", $cols = "", $rows = 10) {
  global $error, $_POST, $textarea_size,$content;
  $cols = (empty($cols)) ? $textarea_size : $cols;
  if (isset($error[$name])) {
    $title = sprintf("<span class=\"marktext\">%s *</span>", $title);
  }
  if (isset($_POST[$name])/* && $value == ""*/) {
    $value = stripslashes($_POST[$name]);
  }
  $content.="<tr bgcolor=\"".get_row_bg()."\" valign=\"top\">\n<td><p class=\"rowtitle\">".$title."</p></td>\n<td><p><textarea name=\"".$name."\" rows=\"".$rows."\" cols=\"".$cols."\">".$value."</textarea></p></td>\n</tr>\n";
}

function show_admin_footer(){
	global $content;
	print $content.'<br><br></Body></Html>';
	exit();
}


function verifyUser($upwd, $pwd) {
	global $userinfo;
	//$usrpwd = $DB_site->query_first("select $user_table_fields[user_id] as userid,$user_table_fields[user_password] as password FROM  $table_user where username = '$name'");

	return $pwd==md5($upwd);
}

function cookie($cookie_name, $value = '') {

	setCookie('Admin_Panel'.$cookie_name, $value );
}
function getCookie($cookie_name) {
	global $_COOKIE;
	return ($magic_quotes_gpc) ? stripslashes($_COOKIE['Admin_Panel'.$cookie_name]) : $_COOKIE['Admin_Panel'.$cookie_name];
	 
}

function showLoginPage()
{
?>
<html>
<head>
	<META content="text/html; charset=utf-8" http-equiv=Content-Type>
	<title>Myarticle Admin Login</title>
	<script language="JavaScript" type="text/javascript">
		<!-- 
		// break out of frames
		if (self.parent.frames.length != 0) {
			self.parent.location=document.location;
		}
		//-->
	</script>
</head>

<body bgcolor="#dedede" text="#000000" link="#0000ff" vlink="#800080" alink="#ff0000">

<form name="loginForm" method="post">
<input type="hidden" name="login" value="true">
<input type="hidden" name="login_submit" value="true">
<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
<td width="100%" align=center>

    
    
    <TABLE CELLPADDING="0" CELLSPACING="0" width="400"  height="245" BACKGROUND="images/bg_lock.gif"><TR><TD ALIGN="center" VALIGN="middle">
		<TABLE CELLPADDING="4" WIDTH="100%" HEIGHT="100%" BACKGROUND="">
		<TR><TD ALIGN="center" COLSPAN="2"><h1>MyArticle</h1></TD></TR>
		<TR><TD ALIGN="center" COLSPAN="2">
			<B><NOBR>welcome to myarticle admin contrl panel</NOBR></B>
		</TD></TR>
		<tr><TD VALIGN="bottom"><A HREF=../index.php>
			<IMG SRC="images/cancel.gif" ALIGN="left" WIDTH="22" HEIGHT="23" ALT="cancel" BORDER=0 hspace=10 vspace=4></A>
		</TD>
		<td ALIGN="right" VALIGN="bottom">
			<table cellpadding=4 cellspacing=1 BACKGROUND="">
			<tr><td><B><FONT FACE="Arial,Helvetica,sans-serif" SIZE="-1">username: </FONT></B></td>
			<td> <INPUT TYPE="text" NAME="username" STYLE="font-size: 9pt;" TABINDEX="1"></td></tr>
			<tr><td><B><FONT FACE="Arial,Helvetica,sans-serif" SIZE="-1">Password: </FONT></B></td>
			<td> <INPUT TYPE="password" NAME="password" STYLE="font-size: 9pt;" TABINDEX="1"></td></tr>
			</table>
			<INPUT TYPE=image name="login_submit" src="images/enter.gif" WIDTH="26" HEIGHT="23" border=0 hspace=7 vspace=4 alt="Enter  &gt;&gt;&gt;" TABINDEX="1">
		</td></tr></table>
</td>

</table>

</form>

<script language="JavaScript" type="text/javascript">
<!--
	document.loginForm.username.focus();
//-->
</script>

</body>
</html>
<?php
exit();
}
function get_navrow_bg() {
  global $navbgcounter;
  return ($navbgcounter++ % 2 == 0) ? "#E5E5E5" : "#F5F5F5";
}

function show_nav_option($title, $url)  {
  global $content;
  $bgcolor = get_navrow_bg();
  $content.= "<tr><td bgcolor=\"$bgcolor\" valign=top onmouseover=\"this.style.backgroundColor='#FFE673';this.style.cursor='hand';\"  onmouseout=\"this.style.backgroundColor='".$bgcolor."'\">\n";
  $content.= "<table border=\"0\" cellpadding=\"3\" cellspacing=\"0\"><tr><td>\n";
  $content.= "<a href=\"".$url."\" target=\"main\" class=\"navlink\">".$title."</a> $extra\n";
  $content.= "</td></tr></table>\n";
  $content.= "</td></tr>\n";
  
}

function show_nav_header($title)  {
  global $navbgcounter,$content;
  $content.= "<tr><td class=navheader>\n";
  $content.= "<table border=\"0\" cellpadding=\"3\" cellspacing=\"0\"><tr><td class=\"navheader\">\n";
  $content.= $title;
  $content.= "</td></tr></table>\n";
  $content.= "</td></tr>\n";
  
  $navbgcounter = 0;
}

function init() {
	global $content;
	$content = '<HTML><head><META content="text/html; charset='.language.'" http-equiv=Content-Type><Title>Admin Panel Component</title><link rel=stylesheet href=cpstyle.css>
	</head><body bgcolor=FFFFFF  text="#000000" leftmargin="10" topmargin="10" marginwidth="10" marginheight="10" link="#000000" vlink="#000000" alink="#000000">';
}
function setTitle($title) {
	global $content;
	$content.= '<table width=98% cellspacing=0 cellpadding=0 border=0>
					<tr>
						<td><p>&nbsp;</p></td>
					</tr>
				</table>
				<br><form method=post name=adminForm enctype=multipart/form-data>';
	$content.= '<table width=90% cellpadding=0 align=center cellspacing=1><tr><td bgcolor=666666><table width=100% cellpadding=4 cellspacing=1><tr><td bgcolor=CCCCCC colspan=20> <font size=2><b>'.$title.'</b></font> </td></tr>';

}

function output(){
	global $content;
	print $content.'<tr bgcolor=EEEEEE><td colspan=20><input type=submit name="submit"></td></tr></table></table><br><br></Form></Body></Html>';
	exit();
}

function showSuccess($msg, $url='main.php') {
?>
<html>
<head>
<title>Please stand by...</title>
<meta http-equiv="refresh" content="2; url=<?php echo $url?>">
<link type="text/css" href="../style.css" rel="stylesheet">
</head>
<body bgcolor='#FFFFFF'>

<table cellpadding='0' cellspacing='0' border='0' width="95%" align='center' height='85%' >
  <tr align='center' valign='middle'>
    <td>
    <table style="BORDER-COLLAPSE: collapse" borderColor=#111111 cellSpacing=0 
      cellPadding=0  border=1 width="80%" align='center' >
    <tr>
       <td valign='middle' align='center' bgcolor='#F1F1F1' id='redirect'>
	 <br><br>
        <?php echo  $msg ?>
        <br><br>
        Please wait while we transfer you...
        <br><br>
        (<a href='<?php echo $url ?>'>Or click here if you do not want to wait</a>)
	 <br><br>
       </td>
    </tr>
    </table>
    </td>
  </tr>
</table>
</body>
</html>
<?php exit();
}

function shownopermission($msg='you have no permission to access this page!') {
?>
<html>
<head>
<title>No Permission...</title>

<link type="text/css" href="../style.css" rel="stylesheet">
</head>
<body bgcolor='#FFFFFF'>

<table cellpadding='0' cellspacing='0' border='0' width="95%" align='center' height='85%' >
  <tr align='center' valign='middle'>
    <td>
    <table style="BORDER-COLLAPSE: collapse" borderColor=#111111 cellSpacing=0 
      cellPadding=0  border=1 width="80%" align='center' >
    <tr>
       <td valign='middle' align='center' bgcolor='#F1F1F1' id='redirect'>
	 <br><br>
        <?php echo $msg?>
        <br><br>
        Please click <a href=javascript:history.back();"> here </a>to go back 
        <br><br>
        
	 <br><br>
       </td>
    </tr>
    </table>
    </td>
  </tr>
</table>
</body>
</html>
<?php exit();
}
function replaceconfig($name, $value) {
	global $configStr;
	$value = str_replace("'", "\\'", $value);
	if (!$configStr) $configStr = readfromfile('../include/config.inc.php');
	$configStr = preg_replace("/define\(\s*\'$name\'\s*\,\s*\'(.*)\'\s*\)\;/", "define('$name','$value');", $configStr);
}
function saveChanges() {
	global $configStr;
	writetofile('../include/config.inc.php', $configStr);
}


function get_category_dropdown_bits($cat_id, $cid = 0, $depth = 1) {
  global $drop_down_cat_cache, $cat_cache;

  if (!isset($drop_down_cat_cache[$cid])) {
    return "";
  }
  $category_list = "";
  foreach ($drop_down_cat_cache[$cid] as $key => $category_id) {
      $category_list .= "<option value=\"".$category_id."\"";
      if ($cat_id == $category_id) {
        $category_list .= " selected=\"selected\"";
      }
      if ($cat_cache[$category_id]['parentid'] == -1) {
        $category_list .= " class=\"dropdownmarker\"";
      }

      if ($depth > 1) {
        $category_list .= ">".str_repeat("--", $depth - 1)." ".$cat_cache[$category_id]['title']."</option>\n";
      }
      else {
        $category_list .= ">".$cat_cache[$category_id]['title']."</option>\n";
      }
      $category_list .= get_category_dropdown_bits($cat_id, $category_id, $depth + 1);
    
  }
  unset($drop_down_cat_cache[$cid]);
  return $category_list;
}

function get_category_dropdown($cat_id, $jump = 0, $admin = 0, $i = 0) {
  global $drop_down_cat_cache, $cat_parent_cache;
  // $admin = 1  Main Cat (update/add cats)
  // $admin = 2  All Cats (find/validate images...)
  // $admin = 3  Select Cat (update/add image)
  // $admin = 4  No Cat (check new images)

  switch ($admin) {
  case 1:
    $category = "\n<select name=\"cat_parent_id\" class=\"categoryselect\">\n";
    $category .= "<option value=\"0\">main category</option>\n";
    $category .= "<option value=\"0\">--------------</option>\n";
    break;

  case 2:
    $category = "\n<select name=\"cat_id\" class=\"categoryselect\">\n";
    $category .= "<option value=\"0\">all categories</option>\n";
    $category .= "<option value=\"0\">-------------------------------</option>\n";
    break;

  case 3:
    $i = ($i) ? "_".$i : "";
    $category = "\n<select name=\"cat_id".$i."\" class=\"categoryselect\">\n";
    $category .= "<option value=\"0\">select category</option>\n";
    $category .= "<option value=\"0\">-------------------------------</option>\n";
    break;

  case 4:
    $category = "\n<select name=\"cat_id\" class=\"categoryselect\">\n";
    $category .= "<option value=\"0\">no category</option>\n";
    $category .= "<option value=\"0\">-------------------------------</option>\n";
    break;

  case 0:
  default:
    if ($jump) {
      $category = "\n<select name=\"cateid\" onchange=\"if (this.options[this.selectedIndex].value != 0){ forms['jumpbox'].submit() }\" class=\"categoryselect\">\n";
    }
    else {
      $category = "\n<select name=\"cateid\" class=\"categoryselect\">\n";
    }
    $category .= "<option value=\"0\">select category</option>\n";
    $category .= "<option value=\"0\">-------------------------------</option>\n";
  } // end switch

  $drop_down_cat_cache = array();
  $drop_down_cat_cache = $cat_parent_cache;
  $category .= get_category_dropdown_bits($cat_id);
  $category .= "</select>\n";
  return $category;
}

function show_category_rows($cid = 0, $depth = 1) {
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
    $rows.=show_text_link("edit", "cate_editcate.php?cat_id=".$cats['cateid']);
    $rows.=show_text_link("delete", "cate_man_cate.php?action=removecat&cat_id=".$cats['cateid']);
    $rows.=show_text_link("add_subcategory", "cate_addcate.php?cat_parent_id=".$cats['cateid']);
    $rows.= "\n</td>\n<td align=\"center\">";
   
    $rows.= "<input type=test name=displayorder[".$cats['cateid']."] value=".$cats['displayorder'].">";
    $rows.= "</td>\n</tr>\n";
    show_category_rows($cats['cateid'], $depth + 1);
  }

  unset($category_cache[$cid]);
  return $rows;
}

function show_text_link($text, $url, $newwin = 0) {
  global $site_sess;
  $target = ($newwin) ? " target=\"_blank\"" : "";
  return "<a href=\"".$url."\"".$target.">[".$text."]</a>&nbsp;&nbsp;";
}

function get_all_cat($cid = 0){
	global $category_cache,$allcatid;
	if (!isset($category_cache[$cid])) {
		return false;
	}
	foreach ($category_cache[$cid] as $key => $cats) {
		$allcatid[]=$cats['cateid'];
		get_all_cat($cats['cateid']);
	}
	unset($category_cache[$cid]);
	return $allcatid;

}
if (getCache){
	$sql = "SELECT cateid, title, description, parentid, displayorder  
          FROM $table_cate 
          ORDER BY displayorder, cateid ASC";
		// echo $sql;
	$result = $DB_site->query($sql);
	while ($row = $DB_site->fetch_array($result)) {
		$cat_cache[$row['cateid']] = $row;
		$cat_parent_cache[$row['parentid']][] = $row['cateid'];
		$category_cache[$row['parentid']][$row['cateid']] = $row;
	}
	$DB_site->free_result();
}


function un_badchars($chars) {
  global  $magic_quotes_gpc;
  $chars =(($magic_quotes_gpc)? $chars : addslashes($chars));
  $chars = preg_replace('/(javascript|about):/i', '\\1 :', $chars);
  return preg_replace('/(\\[:[a-z0-9_\\- ]+:\\])\\s*(\\1\s*){3,}/i', '\\1 \\1 \\1', $chars);
  
}



//----------read & write---------------------

function readfromfile($file_name) {
	$filenum=@fopen($file_name,"r");
	flock($filenum,LOCK_SH);
	$file_data=fread($filenum,filesize($file_name));
	fclose($filenum);
	return $file_data;
}
function writetofile($file_name,$data,$method="w") {
	$filenum=@fopen($file_name,$method);
	flock($filenum,LOCK_EX);
	$file_data=fwrite($filenum,$data);
	fclose($filenum);
	return $file_data;
}

function get_user_table_field($add, $user_field) {
  global $user_table_fields;
  return (!empty($user_table_fields[$user_field])) ? $add.$user_table_fields[$user_field] : "";
}

function formTosql($form) {
	if(is_array($form)) {
		foreach ( $form as $key => $value ) {
			$form[$key] = ($form[$key] ? 'y' : 'n');
		}
		return $form;
	}else{
		return ($form ? 'y' : 'n');
	}
}

function sqlToform($sql) {
	if(is_array($sql)) {
		foreach ( $sql as $key => $value ) {
			$sql[$key] = (($sql[$key]=='y') ? 'checked' : '');
		}

		return $sql;
	}else{
		return (($sql=='y') ? 'checked' : '');
	}
}

function get_usergroup_dropdown($groupid=null){
	global $DB_site,$table_usergroup;
	$groups = "\n<select name=\"group_id\">\n";

	$result = $DB_site->query("SELECT usergroupid,title FROM $table_usergroup");
	while ($row = $DB_site->fetch_array($result)) {
		$groups .= "<option value=\"$row[usergroupid]\"";

		if ($row[usergroupid]==$groupid){
			$groups .= "selected";
		}

		$groups .= ">$row[title]</option>\n";
	}

	return $groups .= "</select>\n";
}

function canAdmin($userName) {
	global $DB_site,$table_usergroup,$table_user,$user_table_fields;
	$sql="Select  ".$table_usergroup.".canadmin FROM  ".$table_user." LEFT JOIN  ".$table_usergroup." USING (".$user_table_fields[user_groupid].") WHERE  ".get_user_table_field($table_user.".","user_name")."='".$userName."'";
	return $DB_site->query_first($sql) == 'y';
}

function getextension($file) {
	$pos=strrpos($file, ".");
	if (is_string ($pos) && !$pos) {
	    // not found...
		return "";
	} else {
		$ext=substr($file, $pos+1);
		//echo "ext=$ext<br>\n";
		return $ext;
	}
}

function format_date( $date, $format) {
	global $global_pref, $current_date;
	
	if ($format=="") { $format=$global_pref['entrydate_format']; }
	if ($date=="") {$date= $current_date; }
	list($yr,$mo,$da,$ho,$mi)=split("-",$date);
	$mo_name=$global_pref['months'][-1+$mo];
	$da_name=$global_pref['weekdays'][date("w",mktime(0,0,0,$mo,$da,$yr))];
	$wk_num=floor(date("z",mktime(0,0,0,$mo,$da,$yr)) / 7)+1;
	$ye=substr($yr,2);
	$ho12=$ho;
	if ($ho12>11) { $ho12=$ho12-12; }
	$ampm= ($ho12==$ho) ? "am" : "pm";
	if ($ho12==0) { $ho12=12; }

	
	$format=str_replace("%minute%", $mi, $format);
	$format=str_replace("%hour12%", $ho12, $format);
	$format=str_replace("%ampm%", $ampm, $format);
	$format=str_replace("%hour24%", $ho, $format);
	$format=str_replace("%day%", $da, $format);
	$format=str_replace("%weekday%", $da_name, $format);
	$format=str_replace("%weeknum%", $wk_num, $format);
	$format=str_replace("%month%", $mo, $format);
	$format=str_replace("%monthname%", $mo_name, $format);
	$format=str_replace("%monname%", $mo_name, $format);
	$format=str_replace("%year%", $yr, $format);
	$format=str_replace("%ye%", $ye, $format);

	return $format;
}

function access($action){
	global $userinfo;

	if ($userinfo['canadmin']=='y'){
		return true;
	}

	if ($userinfo[$action]=='y'){
		return true;
	}else{
		return false;
	}
	
	
}

?>