<?php
/**
 * file -> upload
 */

$thisprog='file_upload.php';
//define('getCache',1);
include('./admin_global.inc.php');

if (!access("canadd")){
	shownopermission();
}
include_once "../include/fileupload.inc.php";


// some settings for the uploader class
$path = "../".UPLOAD_PATH; 
$upload_file_name = "userfile";
$acceptable_file_types = "";
$default_extension = "";
$mode = 2;

init();
setTitle('Files mannager');


$content.=<<< EOF
<script language="javaScript" type="text/javascript" SRC="popupmenu.js"></SCRIPT>
<script>
function popup(t, w, h) {
window.open('photo.php?img='+t+'&w='+w+'&h='+h+'&t='+t,'photo','width='+w+',height='+h); }
</script>

EOF;





$content.= <<< EOF
    <tr bgcolor='#ffffff'>
      <td colspan=5>Upload this file:
   <input name=" $upload_file_name" type="file"  class='input'> &nbsp;&nbsp;&nbsp;&nbsp;
      <input name="submit" type="submit"  class='button' value="Send File"></td>
    </tr>
EOF;
  

	// emulate $_REQUEST for older versions of PHP..
	if (!isset($_REQUEST)) {
		$_REQUEST=array_merge($_GET , $_POST, $_COOKIE , $_SESSION);

	}

	if ($_REQUEST['submit']) {
		// Create a new instance of the class
		$my_uploader = new uploader;
		
		// OPTIONAL: set the max filesize of uploadable files in bytes
		$my_uploader->max_filesize($global_pref['max_filesize']);
		
		// OPTIONAL: if you're uploading images, you can set the max pixel dimensions 
		//$my_uploader->max_image_size(800, 800); // max_image_size($width, $height)
		
		// UPLOAD the file
		if ($my_uploader->upload($upload_file_name, $acceptable_file_types, $default_extension)) {
			$success = $my_uploader->save_file($path."/", $mode);
		}
		
		if ($success) {
			// Successful upload!

			$content.="<tr  bgcolor='#ffffff'><td colspan=5><p class='extrapadding'9/1/2002>".$my_uploader->file['name'] . " was successfully uploaded! <br><br></td></tr>";
			
			// let the opening window know what file was uploaded.
			//$content.= "<script>\n";
			//$content.= "if (window.opener) { window.opener.form1.f_image.value='".$global_pref['upload_path'].$my_uploader->file['name']."'; } \n";
			//echo "window.opener.form1.f_width.value='".$upload->file['width']."'; \n";
			//echo "window.opener.form1.f_height.value='".$upload->file['height']."'; }\n";
			//$content.= "</script>\n";

			// Print all the array details...
			//print_r($my_uploader->file);
			
			// ...or print the file
			if(ereg("image", $my_uploader->file['type'])) {
				//$path="../".$global_pref['upload_path']; 
				$content.= "<tr  bgcolor='#ffffff'><td colspan=5><img src=\"" . $path ."/". $my_uploader->file['name'] . "\" border=\"0\" alt=\"\"></td></tr>";
			/*
			} else {
				$fp = fopen($path . $my_uploader->file['name'], "r");
				while(!feof($fp)) {
					$line = fgets($fp, 255);
					echo $line;
				}
				if ($fp) { fclose($fp); }
			*/
			}
	
		} else {
			// ERROR uploading...
 			if($my_uploader->errors) {
				while(list($key, $var) = each($my_uploader->errors)) {
					$content.= $var . "<br>";
				}
 			}
 		}
 	}



$content.= <<< EOF

  <Tr bgcolor='#ffffff'> 
    <TD><b><font >&nbsp;</font></b></TD>
    <TD align=left><b><font>filename&nbsp;&nbsp;&nbsp;&nbsp;</font></b></TD>
    <TD><b><font >date</font></b></a></td>
    <td><b><font >filesize</font></b></a></TD>
    <TD><b><font >width x height</font></b></TD>
  </TR>
  
EOF;

$d= dir($path);
while ($entry=$d->read()) {
	$ext=getextension($entry);
	if (($ext=="jpg")||($ext=="gif")||($ext=="png")) {
		$pathfile=$path."/".$entry;
		//$fullentry=$global_pref['log_url'].$global_pref['upload_path'].$entry;

		list($x, $y)=GetImageSize ($pathfile); 
		$filesize= round(filesize($pathfile)/1024);
		$filedate=filemtime($pathfile);
		$filedate=format_date(date("Y-m-d-H-i", $filedate),"%day%-%month%-%ye% %hour24%:%minute%");
		$content.= "<tr bgcolor='#ffffff' valign=top><td >\n";
		$content.="<a href='javascript:openfiledelete(\"$entry\");'><img src='images/ico_del.gif' width=16 height=16 border=0></a></td>\n";
		$content.="<td><a href=\"javascript:popup('$pathfile','$x','$y');\">$entry</a></td>\n";
		$content.= "<td>$filedate</td><td>$filesize kb</td><td>$x &middot; $y px.</td>\n";
		$content.= "</tr>\n";
	} else if ($ext!="") {
		$pathfile=$path."/".$entry;
		//$fullentry=$pathfile.$entry;

		//list($x, $y)=GetImageSize ("../$fullentry"); 
		$filesize= round(filesize($pathfile)/1024);
		$filedate=filemtime($pathfile);
		$filedate=format_date(date("Y-m-d-H-i", $filedate),"%day%-%month%-%ye% %hour24%:%minute%");
		$content.= "<tr bgcolor='#ffffff' valign=top><td>\n";
		$content.="<a href='javascript:openfiledelete(\"$entry\");'><img src='images/ico_del.gif' width=16 height=16 border=0></a></td>\n";
		$content.="<td><a href=\"$pathfile\" target=_blank>$entry</a></td>\n";
		$content.= "<td>$filedate</td><td>$filesize kb</td><td>&nbsp;</td>\n";
		$content.= "</tr>\n";

	}
}
$d->close();


output();

?>





