<?php 

$content = '
<html>
<head>
<title> Table </title>
	<script language="JavaScript">

		function insertCode()
		{
			// Add the code to the iFrame
			var code = document.all.code.value;
			var html = "";
			html = html + code +"\r\n";
			
			opener.iView.focus();
			var sel = opener.iView.document.selection;
			var theFrame = sel.createRange();
			theFrame.pasteHTML(html);
			window.close();
			opener.iView.focus();
		}
		</script>
</head>
';

if ($_POST['submit']){
	$code = phphighlite($_POST[code]);
	
	$content .= '
		<body bgcolor="#DEDFDE">
	<font size="4">Insert code</font><br><br>
	
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td width="30%">
				<i>code:</i>
			</td>
			<td width="20%">
				<textarea  rows="5" cols="50" id="code">'.$code.'</textarea>
			</td>
		</tr>
		<tr>
			<td width="30%">
				&nbsp;
			</td>
			<td width="70%" colspan="3">
				<br>
				<input type="button" value="Insert Table" onClick="insertCode()">
				<input type="button" value="Cancel" onClick="window.close(); opener.iView.focus();">
			</td>
		</tr>
		</table>
	</body>
	</html>';

}else{

$content .='
<body bgcolor="#DEDFDE">
	<font size="4">highlite code</font><br><br>
	<form method="post" action="highlight.php">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td width="30%">
				<i>code:</i>
			</td>
			<td width="20%">
				<textarea  rows="5" cols="50" name="code"></textarea>
			</td>
		</tr>
		<tr>
			<td width="30%">
				&nbsp;
			</td>
			<td width="70%" colspan="3">
				<br>
				<input type=submit name="submit">
			</td>
		</tr>
		</table></form>
</body>
</html>';

}
print $content;

function phphighlite($code) {
  //PHP 4 only

  if (floor(phpversion())<4) {
    $buffer=$code;
  } else {

		$code = str_replace("&gt;", ">", $code);
		$code = str_replace("&lt;", "<", $code);
		$code = str_replace("<br>", "", $code);
		$code = str_replace("<br />", "", $code);
		
		$code = str_replace("&amp;", "&", $code);
		$code = str_replace('$', '\$', $code);
		$code = str_replace('\n', '\\\\n', $code);
		$code = str_replace('\r', '\\\\r', $code);
		$code = str_replace('\t', '\\\\t', $code);

		$code = stripslashes($code);

		if (!strpos($code,"<?php") and substr($code,0,2)!="<?php") {
			$code="<?php\n".trim($code)."\n?>";
			$addedtags=1;
		}
		ob_start();
		$oldlevel=error_reporting(0);
		highlight_string($code);
		error_reporting($oldlevel);
		$buffer = ob_get_contents();
		ob_end_clean();
		if ($addedtags) {
		  $openingpos = strpos($buffer,'&lt;?');
		  $closingpos = strrpos($buffer, '?');
		  $buffer=substr($buffer, 0, $openingpos).substr($buffer, $openingpos+5, $closingpos-($openingpos+5)).substr($buffer, $closingpos+5);
		}
		$buffer = str_replace("&quot;", "\"", $buffer);

  }

  return "<table border=\"0\" align=\"center\" width=\"90%\" cellpadding=\"3\" cellspacing=\"1\"><tr><td><b>PHP:</b></td></tr><tr><td style=\"BORDER: #000000 1px solid;\ background: #FFFFFF; border: 1px inset #000080; font-family: \"Courier New\",Courier,monospace; font-size-adjust: .58; padding: 6px 6px 6px 6px; white-space:nowrap;\">" . $buffer . "</td></tr></table>";
}
?>