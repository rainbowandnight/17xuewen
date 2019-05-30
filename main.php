<?php

/**
 * main page
 */

$thisprog='main.php';

include('./admin_global.inc.php');


show_admin_header();
$content.='<table width=98% cellspacing=0 cellpadding=0 border=0>
					<tr>
						<td><font size=2><b>Welcome to Myarticle Admin Control Panel</b></font></td>
					</tr>
				</table>
				<hr><br>Welcome to the Myarticle  Administration tool. ';


$content.='<br><br>
  Myarticle  Version: 2019.3<br><br>

  Please choose options from left menu column.<br><br>
  <font size=2>stats<font><br><br>';


$content.='<table width=90% cellpadding=0 align=center cellspacing=1><tr><td bgcolor=666666><table width=100% cellpadding=4 cellspacing=1><tr><td bgcolor=CCCCCC colspan=2> General : </td></tr>';

$catenum=$DB_site->query_first("SELECT count(*) FROM $table_cate");
$content.="<tr bgcolor=EEEEEE><td>Categoey Numbers: </td><td>$catenum</td></tr>";

$articles=$DB_site->query_first("SELECT count(*) FROM $table_article");
$content.="<tr bgcolor=EEEEEE><td>Articles: </td><td>$articles</td></tr>";

$mysqlversion = $DB_site->query_first("SELECT VERSION() AS version");
echo $mysqlversion;
$datasize=0;
if ($mysqlversion>= '3.23') {
	$DB_site->reporterror = 0;
	$tables = $DB_site->query_first("SHOW TABLE STATUS");
	$errno = $DB_site->errno;
	$DB_site->reporterror = 1;
	if (!$errno) {
		while ($table = $DB_site->fetch_array($tables)) {
			$datasize += $table['Data_length'];
			$indexsize += $table['Index_length'];
		}
		if (!$indexsize) {
			$indexsize = 'N/A';
		}
		if (!$datasize) {
			$datasize = 'N/A';
		}
	} else {
		$datasize = 'N/A';
		$indexsize = 'N/A';
	}
}
$content.="<tr bgcolor=EEEEEE><td>Database: </td><td>total:".kbtomb($datasize)."</td></tr>";

$serverinfo = PHP_OS . ' / PHP v' . phpversion();

if (phpversion() >= '4.0.3') {
	$serverinfo .= (ini_get('safe_mode')? ' Safe Mode': '');
	$serverinfo .= (ini_get('file_uploads')? '': '<br />FILE_UPLOADS disabled');
}
$content.="<tr bgcolor=EEEEEE><td>Serverinfo: </td><td>$serverinfo</td></tr>";

$content.="<tr bgcolor=EEEEEE><td>Mysql Version: </td><td>$mysqlversion</td></tr>";


$content.="</table></table>
<br><br>
<table width=90% cellpadding=0 align=center cellspacing=1><tr><td bgcolor=666666><table width=100% cellpadding=4 cellspacing=1><tr><td bgcolor=CCCCCC colspan=2>
  Software Development:</td></tr>
<tr bgcolor=EEEEEE><td>myluntan team skyee</td></tr>
</table></table><br><br>
<hr>
";

show_admin_footer();
function kbtomb($value) {
	if ($value == 'N/A') {
		return $value;
	} elseif (!$value) {
		return '0.0 MB';
	} else {
		return sprintf('%.2f', $value / 1024000) . ' MB';
	}
}
?>
