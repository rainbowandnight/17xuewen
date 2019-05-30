<?php
/**
 * file -> upload
 */

$thisprog='file_delete.php';
//define('getCache',1);
include('./admin_global.inc.php');
if (!access("canadd")){
	shownopermission();
}
$path = "../upload/"; 

if (!isset($_REQUEST)) {
		$_REQUEST=array_merge($_GET , $_POST, $_COOKIE , $_SESSION);

	}
if (unlink($path.$_REQUEST['name'])){

	showsuccess('You have delete this file successfully', 
				"file_upload.php");
}
?>
