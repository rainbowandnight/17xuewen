<?php
/*******************************************************************
 * File: index.php
 * Version: 1.0.0
 * Date: 2002/07/25
 *
 * Copyright (C) 2002  Myluntan Team. All rights reserved.
 *
 * This software is the proprietary information of  Myluntan Team.
 * Use is subject to license terms.
 */
require('admin_global.inc.php');

if ($logout=='true') {
	cookie('userid');
	cookie('password');
	header('Location:index.php');
}

?>

<html>
<head>
<title>Myarticle Admin Panel</title>
</head>
<frameset rows="90,*" bordercolor="#0099cc" border="0" frameborder="0" framespacing="0" style="background-color:#0099cc">
	<frame src="header.php" name="header" scrolling="no" marginheight="0" marginwidth="0" noresize>
	<frameset cols="175,*" bordercolor="#0099cc" border="0" frameborder="0" style="background-color:#0099cc">
		<frame src="menu.php" name="sidebar" scrolling="auto" marginheight="0" marginwidth="0" noresize>	   
		<frame src="main.php" name="main" scrolling="auto" noresize>
</frameset><noframes></noframes>
</html>