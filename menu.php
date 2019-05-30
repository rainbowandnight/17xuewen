<?php

$thisprog='menu.php';

include('./admin_global.inc.php');



if (access("canadmin")){

	show_nav_header('global Settings');
	show_nav_option('option settings', 'option.php');
	show_nav_option('phpinfo', 'phpinfo.php');

	show_nav_header('Category Settings');
	show_nav_option('Add a Category', 'cate_addcate.php');
	show_nav_option('Modify  a Category', 'cate_man_cate.php');
}

if (access("canadd") || access("canpublish")){

	show_nav_header('Article Management Settings');
	show_nav_option('Add An article', 'article_man_add.php');
	show_nav_option('Manage An article', 'article_man_list.php');
	
}
if (access("canadmin")){
	show_nav_option('Mass delete articles', 'article_mass_del.php');
	show_nav_option('Mass move articles', 'article_mass_move.php');


	show_nav_header('User Management Settings');
	show_nav_option('Add A user', 'user_adduser.php');
	show_nav_option('Edit A user', 'user_userlist.php');
	show_nav_option('Add a usergroup', 'user_addgroup.php');
	show_nav_option('Edit a usergroup', 'user_mangroup.php');
	
	show_nav_header('Wechat menu Settings');
	show_nav_option('Add A menu', 'menu_create.php');
	show_nav_option('query A menu', 'menu_query.php');
	show_nav_option('delte menu', 'menu_delete.php');


}

if (access("canadd") || access("canpublish")){
	show_nav_header('File Management Settings');
	show_nav_option('File Manage', 'file_upload.php');
	
	show_nav_header('Manage joke');
	show_nav_option('Joke List', 'joke_jokelist.php');
	
}

if (access("canadmin")){

	show_nav_header('Comment Management Settings');
	show_nav_option('Edit comments', 'comment_man_list.php');

	show_nav_header('Templates Settings');
	show_nav_option('Templates Editor', 'template_list.php');
	show_nav_option('Add A Template', 'template_add.php');

	show_nav_header('Stlye Settings');
	show_nav_option('Stlye Editor', 'style_man_list.php');
	show_nav_option('Add A Stlye', 'style_man_add.php');
}
	

?>

<html>
<head>
<title>Myarticle Admin Menu</title>
<link rel=stylesheet href=cpstyle.css>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<body background="images/sidebar_back.gif" text="#000000" leftmargin="10" topmargin="10" marginwidth="10" marginheight="10" link="#000000" vlink="#000000" alink="#000000">

<img src="images/blank.gif" width="50" height="5" border="0"><br>

    <table cellpadding="2" cellspacing="4" border="0" width="100%">
	<?php echo  $content?>
    </table>

<br>

</body>
</html>
