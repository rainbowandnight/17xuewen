<?php
$content.=<<< EOF
<TR bgcolor=#FFFFFF nowrap>
          <TD vAlign=top width="25%">content:<BR><BR></TD>
	<TD width="75%">
            <TABLE id=tblCtrls height=30 cellSpacing=0 cellPadding=0 width=415 
            border=0>
              <TBODY>
              <TR>
                <TD class=tdClass><IMG onmouseup=selUp(this) class=butClass 
                  onmousedown=selDown(this) onmouseover=selOn(this) 
                  onclick=doCut() onmouseout=selOff(this) alt=Cut 
                  src="images/cut.gif"> 
                  <IMG onmouseup=selUp(this) class=butClass 
                  onmousedown=selDown(this) onmouseover=selOn(this) 
                  onclick=doCopy() onmouseout=selOff(this) alt=Copy 
                  src="images/copy.gif"> 
                  <IMG onmouseup=selUp(this) class=butClass 
                  onmousedown=selDown(this) onmouseover=selOn(this) 
                  onclick=doPaste() onmouseout=selOff(this) alt=Paste 
                  src="images/paste.gif"> 
                  <IMG onmouseup=selUp(this) class=butClass 
                  onmousedown=selDown(this) onmouseover=selOn(this) 
                  onclick=doBold() onmouseout=selOff(this) alt=Bold 
                  src="images/bold.gif"> 
                  <IMG onmouseup=selUp(this) class=butClass 
                  onmousedown=selDown(this) onmouseover=selOn(this) 
                  onclick=doItalic() onmouseout=selOff(this) alt=Italic 
                  src="images/italic.gif"> 
                  <IMG onmouseup=selUp(this) class=butClass 
                  onmousedown=selDown(this) onmouseover=selOn(this) 
                  onclick=doUnderline() onmouseout=selOff(this) alt=Underline 
                  src="images/underline.gif"> 
                  <IMG onmouseup=selUp(this) class=butClass 
                  onmousedown=selDown(this) onmouseover=selOn(this) 
                  onclick=doStrikeThrough() onmouseout=selOff(this) 
                  alt=StrikeThrough 
                  src="images/strikethrough.gif"> 
                  <IMG onmouseup=selUp(this) class=butClass 
                  onmousedown=selDown(this) onmouseover=selOn(this) 
                  onclick=doSuperscript() onmouseout=selOff(this) 
                  alt=Superscript 
                  src="images/superscript.gif"> 
                  <IMG onmouseup=selUp(this) class=butClass 
                  onmousedown=selDown(this) onmouseover=selOn(this) 
                  onclick=doSubscript() onmouseout=selOff(this) alt=Subscript 
                  src="images/subscript.gif"> 
                  <IMG onmouseup=selUp(this) class=butClass 
                  onmousedown=selDown(this) onmouseover=selOn(this) 
                  onclick=doLeft() onmouseout=selOff(this) alt=Left 
                  src="images/left.gif"> 
                  <IMG onmouseup=selUp(this) class=butClass 
                  onmousedown=selDown(this) onmouseover=selOn(this) 
                  onclick=doCenter() onmouseout=selOff(this) alt=Center 
                  src="images/center.gif"> 
                  <IMG onmouseup=selUp(this) class=butClass 
                  onmousedown=selDown(this) onmouseover=selOn(this) 
                  onclick=doRight() onmouseout=selOff(this) alt=Right 
                  src="images/right.gif"> 
                  <IMG onmouseup=selUp(this) class=butClass 
                  onmousedown=selDown(this) onmouseover=selOn(this) 
                  onclick=doOrdList() onmouseout=selOff(this) alt="Ordered List" 
                  src="images/ordlist.gif"> 
                  <IMG onmouseup=selUp(this) class=butClass 
                  onmousedown=selDown(this) onmouseover=selOn(this) 
                  onclick=doBulList() onmouseout=selOff(this) 
                  alt="Bulleted List" 
                  src="images/bullist.gif"> 
                  <IMG onmouseup=selUp(this) class=butClass 
                  onmousedown=selDown(this) onmouseover=selOn(this) 
                  onclick="doForeCol()" 
                  onmouseout=selOff(this) alt="Text Color" 
                  src="images/forecol.gif"> 
                  <IMG onmouseup=selUp(this) class=butClass 
                  onmousedown=selDown(this) onmouseover=selOn(this) 
                  onclick="doBackCol()" 
                  onmouseout=selOff(this) alt="Background Color" 
                  src="images/bgcol.gif"> 
                  <IMG onmouseup=selUp(this) class=butClass 
                  onmousedown=selDown(this) onmouseover=selOn(this) 
                  onclick=doLink() onmouseout=selOff(this) alt=Hyperlink 
                  src="images/link.gif"> 
                  <IMG onmouseup=selUp(this) class=butClass 
                  onmousedown=selDown(this) onmouseover=selOn(this) 
                  onclick=doImage(400,400) onmouseout=selOff(this) alt=Image 
                  src="images/image.gif"> 
                  <IMG onmouseup=selUp(this) class=butClass 
                  onmousedown=selDown(this) onmouseover=selOn(this) 
                  onclick=doRule() onmouseout=selOff(this) alt="Horizontal Rule" 
                  src="images/rule.gif"> 
                  <IMG onmouseup=selUp(this) class=butClass 
                  onmousedown=selDown(this) onmouseover=selOn(this) 
                  onclick=doInsertMarquee() onmouseout=selOff(this) 
                  alt=InsertMarquee 
                  src="images/marquee.gif"> 
                  <IMG onmouseup=selUp(this) class=butClass 
                  onmousedown=selDown(this) onmouseover=selOn(this) 
                  onclick=doRemoveFormat() onmouseout=selOff(this) 
                  alt="Remove Format" 
                  src="images/plain.gif"> 
				  <IMG onmouseup=selUp(this) class=butClass 
                  onmousedown=selDown(this) onmouseover=selOn(this) 
                  onclick=doTable() onmouseout=selOff(this) 
                  alt="Add Table" 
                  src="images/table.gif">
				  
				  <IMG onmouseup=selUp(this) class=butClass 
                  onmousedown=selDown(this) onmouseover=selOn(this) 
                  onclick=doCode() onmouseout=selOff(this) 
                  alt="Add code" 
                  src="images/php.gif"> 
                </TD></TR></TBODY></TABLE><IFRAME id=iView src="./articlesrc.php?aid=$articleid&page=$page"
            style="WIDTH: 415px; HEIGHT: 250px" marginWidth=5 marginHeight=5 
            src="about:blank" topmargin="5" leftmargin="5" ></IFRAME>
            <TABLE height=30 cellSpacing=0 cellPadding=0 width=415 border=0>
              <TBODY>
              <TR>
                <TD class=tdClass width="80%">
                  <DIV id=tb2Ctrls><SELECT 
                  onchange=doFont(this.options[this.selectedIndex].value) 
                  name=selFont> <OPTION value="" selected>-- Font --</OPTION> 
                    <OPTION value=Arial>Arial</OPTION> <OPTION 
                    value=Courier>Courier</OPTION> <OPTION 
                    value="Sans Serif">Sans Serif</OPTION> <OPTION 
                    value=Tahoma>Tahoma</OPTION> <OPTION 
                    value=Verdana>Verdana</OPTION> <OPTION 
                    value=Wingdings>Wingdings</OPTION> <OPTION value=宋体>宋 
                    体</OPTION> <OPTION value=楷体>楷 体</OPTION> <OPTION value=黑体>黑 
                    体</OPTION></SELECT> 
		    <SELECT 
                  onchange=doSize(this.options[this.selectedIndex].value) 
                  name=selSize> <OPTION value="" selected>-- Size --</OPTION> 
                    <OPTION value=1>Very Small</OPTION> <OPTION 
                    value=2>Small</OPTION> <OPTION value=3>Medium</OPTION> 
                    <OPTION value=4>Large</OPTION> <OPTION 
                    value=5>Larger</OPTION> <OPTION value=6>Very 
                  Large</OPTION></SELECT> 
		   <select name="selHeading" onChange="doHead(this.options[this.selectedIndex].value)">
		    <option value="">-- Heading --</option>
		    <option value="Heading 1">H1</option>
		    <option value="Heading 2">H2</option>
		    <option value="Heading 3">H3</option>
		    <option value="Heading 4">H4</option>
		    <option value="Heading 5">H5</option>
		    <option value="Heading 6">H6</option>
		  </select>
		  </DIV></TD>
                <TD class=tdClass align=right width="20%"><IMG 
                  onmouseup=selUp(this) class=butClass onmousedown=selDown(this) 
                  onmouseover=selOn(this) onclick=doToggleView() 
                  onmouseout=selOff(this) alt="Toggle Mode" 
                  src="images/mode.gif"> 
                </TD></TR></TBODY></TABLE></TD></TR>
EOF;
?>