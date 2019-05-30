<?php
/**
 * file -> upload
 */

$thisprog='file_upload.php';
//define('getCache',1);
include('./admin_global.inc.php');


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
<script>
function insert()
{
	var code = document.all.code.value;
			
			
			opener.iView.focus();
			var sel = opener.iView.document.selection;
			var theFrame = sel.createRange();
			theFrame.pasteHTML(code);
			window.close();
			opener.iView.focus();
}
</script>
EOF;

$content.= <<< EOF
	<tr>
	<td></td>
	<td width=60>Upload pic</td>
	<td><input name=" $upload_file_name" type="file" size="14">
	<button onclick=submit()>上传</button></td>
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

			$content.="<tr  bgcolor='#ffffff'><td colspan=5><p>".$my_uploader->file['name'] . " was successfully uploaded! </p><br><br></td></tr>";
			
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
				$src = $path ."/". $my_uploader->file['name'];
				$content.= "<tr  bgcolor='#ffffff'><td colspan=5><img src=\"" . $src . "\" border=\"0\" alt=\"\"></td></tr>";
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
<tr >
	<td></td>
	<td>pic URL</td>
	<td><input type="text" name="picurl" size="26" value="$src" id="code">
	<button onclick=insert()>insert</button></td>
</tr>
EOF;

output();
?>