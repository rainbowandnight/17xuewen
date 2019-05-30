<html>
<head>
<title> Table </title>
	<script language="JavaScript">

		function insertTable()
		{
			// Add the table to the iFrame
			var width = document.all.width.value;
			var border = document.all.border.value;
			var rows = document.all.rows.value;
			var cols = document.all.cols.value;
			var cellspacing = document.all.cellspacing.value;
			var cellpadding = document.all.cellpadding.value;
			var align = document.all.align.options[document.all.align.selectedIndex].value;
			
			if(isNaN(border))
			{
				alert('Border must be a valid number');
				document.all.border.select();
				document.all.border.focus();
				return false;
			}
			
			if(isNaN(rows))
			{
				alert('Rows must be a valid number');
				document.all.rows.select();
				document.all.rows.focus();
				return false;
			}
			
			if(isNaN(cols))
			{
				alert('Cols must be a valid number');
				document.all.cols.select();
				document.all.cols.focus();
				return false;
			}
			
			if(isNaN(cellspacing))
			{
				alert('Cell Spacing must be a valid number');
				document.all.cellspacing.select();
				document.all.cellspacing.focus();
				return false;
			}

			if(isNaN(cellpadding))
			{
				alert('Cell Padding must be a valid number');
				document.all.cellpadding.select();
				document.all.cellpadding.focus();
				return false;
			}
			
			// Build the code for the table
			var html = "";
			html = html + "<table width='"+width+"' border='"+border+"' cellspacing='"+cellspacing+"' cellpadding='"+cellpadding+"' align='"+align+"'>\r\n";
			
			for(i = 0; i < rows; i++)
			{
				html = html + "<tr>\r\n";

				for(j = 0; j < cols; j++)
					html = html + "  <td></td>\r\n";
				
				html = html + "</tr>\r\n";
			}
			
			html = html + "</table>";
			
			opener.iView.focus();
			var sel = opener.iView.document.selection;
			var theFrame = sel.createRange();
			theFrame.pasteHTML(html);
			window.close();
			opener.iView.focus();
		}

	</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body bgcolor="#DEDFDE">
	<font size="4">Insert Table</font><br><br>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td width="30%">
				<i>Width:</i>
			</td>
			<td width="20%">
				<input type="text" size="3" value="100%" id="width">
			</td>
			<td width="30%">
				<i>Border:</i>
			</td>
			<td width="20%">
				<input type="text" size="3" value="1" id="border">
			</td>
		</tr>
		<tr>
			<td width="30%">
				<i>Rows:</i>
			</td>
			<td width="20%">
				<input type="text" size="3" value="2" id="rows">
			</td>
			<td width="30%">
				<i>Cols:</i>
			</td>
			<td width="20%">
				<input type="text" size="3" value="2" id="cols">
			</td>
		</tr>
		<tr>
			<td width="30%">
				<i>Cell Spacing:</i>
			</td>
			<td width="20%">
				<input type="text" size="3" value="0" id="cellspacing">
			</td>
			<td width="30%">
				<i>Cell Padding:</i>
			</td>
			<td width="20%">
				<input type="text" size="3" value="0" id="cellpadding">
			</td>
		</tr>
		<tr>
			<td width="30%">
				<i>Align:</i>
			</td>
			<td width="70%" colspan="3">
				<select id="align">
					<option value="default">Default</option>
					<option value="left">Left</option>
					<option value="center">Center</option>
					<option value="right">Right</option>
				</select>
			</td>
		</tr>
		<tr>
			<td width="30%">&nbsp;
				
			</td>
			<td width="70%" colspan="3">
				<br>
				<input type="button" value="Insert Table" onClick="insertTable()">
				<input type="button" value="Cancel" onClick="window.close(); opener.iView.focus();">
			</td>
		</tr>
	</table>
</body>
</html>