<HTML>
<head>
<META content="text/html; charset=utf-8" http-equiv=Content-Type>
<Title>MyArticle Install Script</title>
<link rel=stylesheet href=cpstyle.css>
</head>
<body bgcolor=FFFFFF  text="#000000" leftmargin="10" topmargin="10" marginwidth="10" marginheight="10" link="#000000" vlink="#000000" alink="#000000">
<table cellpadding="0" cellspacing="0" border="0" width="500" align="center">
<tr>
  <td ><img src="images/logo.gif"><br />
    <table cellpadding="3" cellspacing="1" border="0" width="100%">
    <tr class="tablerow">
      <td colspan="2" align="right"></td>
    </tr>
    <tr class="tablerow2">
      <td colspan="2"><?php
$footer='
 </td>
 </tr>
        </table>
      </td>
    </tr>
  </table>
<p align="center"> Powered by <b>MyArticle</b> 0.01<br />
  Copyright &copy; 2017 <a href="http://209.151.93.92" target="_blank">www.myaritlce.pw</a>
</p>
</body>
</html>';

$db_servertype   = (isset($_POST['db_servertype'])) ? trim($_POST['db_servertype']) : "mysql";
$db_host         = (isset($_POST['db_host'])) ? trim($_POST['db_host']) : "";
$db_name         = (isset($_POST['db_name'])) ? trim($_POST['db_name']) : "";
$db_user         = (isset($_POST['db_user'])) ? trim($_POST['db_user']) : "";
$db_password     = (isset($_POST['db_password'])) ? trim($_POST['db_password']) : "";
$table_prefix    = (isset($_POST['table_prefix'])) ? trim($_POST['table_prefix']) : "my_";

$admin_user      = (isset($_POST['admin_user'])) ? trim($_POST['admin_user']) : "";
$admin_password  = (isset($_POST['admin_password'])) ? trim($_POST['admin_password']) : "";
$admin_password2 = (isset($_POST['admin_password2'])) ? trim($_POST['admin_password2']) : "";


echo $db_servertype."<br>" ;
echo $db_host."<br>"  ;
echo $db_user."<br>"  ;
echo $db_password."<br>"  ;
echo $db_name."<br>"  ;



$con = @mysql_connect($db_host, $db_user, $db_password);
mysql_query("SET NAMES 'utf8'");
 if ($con){

if (@mysql_select_db($db_name, $con)) {
	echo "<p>Congratulations.</p>";
	echo "<p>Your database configuration is correct.</p>";
} else {
	echo "<p>Unable to connect to database.</p>";
	echo "<p><a href='javascript:history.back()'>Click here back to resetup the database configuration.</a></p>";
	//////////////////////////////
	echo "<p>We're creating  the database ... Finished.</p>";
			


$sql = 'CREATE DATABASE '.$db_name.'  DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci';
//create database yourdb DEFAULT CHARACTER SET gbk COLLATE gbk_chinese_ci;

	//@mysql_create_db($dbname)		

           if (@mysql_query($sql, $con)) {
               echo "<p>Database creation success </p>";
             
           } else {
               echo "<p>数据库创建失败</p>";
               echo "<p><a href='javascript:history.back()'>返回上一步</a></p>";
           }
	
	
	
	
}}
else{
	
	  
	  echo "<p>数据库服务器连接失败</p>";
	  echo "<p>Unable to connect to database server.</p>";
	  echo "<p><a href='javascript:history.back()'>Click here back to resetup the database configuration.</a></p>";
	 
	echo $footer;
	exit();
	}



if (!$admin_user || !$admin_password || $admin_password!=$admin_password2) {
	echo "error:the admin account's information is not correct";

	echo "<p>Please specify admin account's information.";
	echo "<p><a href='javascript:history.back()'>Click here back to resetup the admin account.</a></p>";
	echo $footer;
	exit();
}
else 
{

	echo "We're now rewriting the config files, ";

	// config
	replaceconfig('db_type', $db_servertype);
	replaceconfig('db_user', $db_user);
	replaceconfig('db_pass', $db_password);
	replaceconfig('db_host', $db_host);
	replaceconfig('db_name', $db_name);
	replaceconfig('tablepre', $table_prefix);
	
	// config end
	saveChanges();
	echo "FINISHED.<br>";
	echo "The database configuration has been saved.<p>";
	echo "<p> We're creating tables and insert template<p>.<br>".date("Y-m-d H:i:s");
	require '../include/db_mysql.inc.php';
	
	$site_db = new db_mysql($db_name, $db_host, $db_user, $db_password);

	$db_file = "table.sql";
	$tp_file="template.sql";
    $cont = readfromfile($db_file);
	$cont.=readfromfile($tp_file);
    if (empty($cont)) {
      echo "Could not load: ".$db_file."and".$tp_file;
    }
    if (empty($error_log)) {
      $cont = preg_replace('/my_/', $table_prefix, $cont);
      $pieces = split_sql_file(remove_remarks($cont));
      for ($i = 0; $i < sizeof($pieces); $i++) {
        $sql = trim($pieces[$i]);
        if (!empty($sql) and $sql[0] != "#") {
          if (!$site_db->query($sql)) {
            echo $sql;
          }
        }
      }
	}
	$sql="INSERT INTO ".$table_prefix."user (username,password,usergroupid) VALUES ('$admin_user','$admin_password',4)";
	$site_db->query($sql);
	echo "<p>Congratulations.</p>";
	echo "<p>complete the install, you can got <a href=index.php>admin control panel</a>.</p>";
	echo "<p>plz delete the install.php</p>";

	echo $footer;
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

	/**
     * Splits up large sql files INTO fb_individual queries
     *
     * Last revision: 22 August 2001 - loic1
     *
     * @param   string   the sql commands
     * @param   string   the end of command line delimiter 
     *
     * @return  array    the splitted sql commands
     */
    function split_sql_file($sql, $delimiter = ';') {
        $sql               = trim($sql);
        $char              = '';
        $last_char         = '';
        $ret               = array();
        $string_start      = '';
        $in_string         = FALSE;
        $escaped_backslash = FALSE;

        for ($i = 0; $i < strlen($sql); ++$i) {
            $char = $sql[$i];

            // if delimiter found, add the parsed part to the returned array
            if ($char == $delimiter && !$in_string) {
                $ret[]     = substr($sql, 0, $i);
                $sql       = substr($sql, $i + 1);
                $i         = 0;
                $last_char = '';
            }

            if ($in_string) {
                // We are in a string, first check for escaped backslashes
                if ($char == '\\') {
                    if ($last_char != '\\') {
                        $escaped_backslash = FALSE;
                    } else {
                        $escaped_backslash = !$escaped_backslash;
                    }
                }
                // then check for not escaped end of strings except for
                // backquotes than cannot be escaped
                if (($char == $string_start)
                    && ($char == '`' || !(($last_char == '\\') && !$escaped_backslash))) {
                    $in_string    = FALSE;
                    $string_start = '';
                }
            } else {
                // we are not in a string, check for start of strings
                if (($char == '"') || ($char == '\'') || ($char == '`')) {
                    $in_string    = TRUE;
                    $string_start = $char;
                }
            }
            $last_char = $char;
        } // end for

        // add any rest to the returned array
        if (!empty($sql)) {
            $ret[] = $sql;
        }
        return $ret;
    } // end of the 'split_sql_file()' function


    /**
     * Removes # type remarks FROM fb_large sql files
     *
     * Version 3 20th May 2001 - Last Modified By Pete Kelly
     *
     * @param   string   the sql commands
     *
     * @return  string   the cleaned sql commands
     */
    function remove_remarks($sql)
    {
        $i = 0;

        while ($i < strlen($sql)) {
            // Patch FROM Chee Wai
            // (otherwise, if $i == 0 and $sql[$i] == "#", the original order
            // in the second part of the AND bit will fail with illegal index)
            if ($sql[$i] == '#' && ($i == 0 || $sql[$i-1] == "\n")) {
                $j = 1;
                while ($sql[$i+$j] != "\n") {
                    $j++;
                    if ($j+$i > strlen($sql)) {
                        break;
                    }
                } // end while
                $sql = substr($sql, 0, $i) . substr($sql, $i+$j);
            } // end if
            $i++;
        } // end while

        return $sql;
    } // end of the 'remove_remarks()' function


?>
