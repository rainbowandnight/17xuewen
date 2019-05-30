<?php

include('./admin_global.inc.php');

if ($aid && $page){
$pagecontent=$DB_site->query_first("SELECT content FROM $table_page WHERE articleid=$aid AND pagenum=$page");
}


echo $pagecontent;


?>