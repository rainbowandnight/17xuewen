#- ----------------------------
#- Records of my_template
#- ----------------------------
INSERT INTO `my_template` VALUES ('1', 'cate_menu', '<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n<!-- BEGIN menucate -->\r\n<tr id={IDclass}>\r\n<td class=\"{cateclass}\">\r\n{depth}{pathimg}<a href=category.php?cid={cateid}>{catetitle}</a>\r\n\r\n</td>\r\n</tr>\r\n<!-- END menucate -->\r\n</table>', '-1');
INSERT INTO `my_template` VALUES ('2', 'header', '<TABLE cellSpacing=0 cellPadding=0 width=\"100%\" border=0>\r\n  <TBODY>\r\n  <TR>\r\n    <TD vAlign=top><A title=\"少达文章管理系统 power by shaoda 0.01\" \r\n      href=\"{article_url}\"><IMG \r\n      src=\"images/logo.gif\" \r\n      border=0></A> </TD>\r\n    <TD vAlign=center noWrap align=right></TD></TR></TBODY></TABLE>\r\n<TABLE cellSpacing=0 cellPadding=3 width=\"100%\" border=0>\r\n<TBODY>\r\n  <TR>\r\n    <TD align=right bgColor=#eeeeee><FONT class=normalfont>\r\n      <A href=\"search.php\">高级搜索</A> <A \r\n      href=\"index.php\">返回首页</A> \r\n  </FONT>&nbsp;</TD></TR></TBODY></TABLE>', '-1');
INSERT INTO `my_template` VALUES ('4', 'footer', '<TABLE cellSpacing=0 cellPadding=4 width=\"100%\" bgColor=#eeeeee border=0>\r\n  <TBODY>\r\n  <TR>\r\n    <TD width=\"50%\">\r\n      <P><FONT class=smallfont>Copyright &copy; 2002 <A \r\n      href=\"(home_url)\">myluntan.com</A><BR>All rights reserved. \r\n      </FONT></P></TD>\r\n    <TD width=\"50%\">\r\n      <DIV align=right><FONT class=smallfont>Powered by: <A \r\n      href=\"{home_url}\">MyArticle</A> Version {script_version} \r\n  </FONT></DIV></TD></TR></TBODY></TABLE>', '-1');
INSERT INTO `my_template` VALUES ('5', 'cate_display', '<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">\r\n<HTML>\r\n<HEAD><TITLE>{hometitle}</TITLE>\r\n<META http-equiv=content-type content=\"text/html; charset=utf-8\">\r\n<META http-equiv=pragma content=no-cache>\r\n<META http-equiv=no-cache>\r\n<META http-equiv=expires content=-1>\r\n<META http-equiv=cache-control content=no-cache>\r\n\r\n<META http-equiv=msthemecompatible content=yes>\r\n{headinclude}\r\n\r\n</HEAD>\r\n<BODY text=#666666 bgColor=#ffffff leftMargin=0 topMargin=0 marginheight=\"0\" \r\nmarginwidth=\"0\">\r\n<CENTER>\r\n{header}\r\n<TABLE cellSpacing=10 cellPadding=0 width=\"100%\" bgColor=#ffffff border=0>\r\n  <TBODY>\r\n  <TR>\r\n    <TD>\r\n      <TABLE cellSpacing=0 cellPadding=4 width=\"100%\" border=0>\r\n        <TBODY>\r\n        <TR>\r\n            <TD vAlign=top width=\"20%\"> {displayMenu}\r\n            </TD>\r\n          <TD vAlign=top align=middle>\r\n            <TABLE cellSpacing=0 cellPadding=0 width=\"95%\" border=0>\r\n              <TBODY>\r\n              <TR>\r\n                  <TD><FONT class=normalfont><IMG \r\n                  src=\"images/phparticle.gif\" \r\n                  align=absMiddle border=0>{catenav} </FONT></TD>\r\n                </TR></TBODY></TABLE>\r\n            <TABLE cellSpacing=0 cellPadding=0 width=\"95%\" align=center \r\nborder=0>\r\n              <TBODY><!-- BEGIN undercate -->\r\n              <TR>\r\n                <TD rowSpan=3><IMG height=30 \r\n                  src=\"images/subhead_1.gif\" \r\n                  width=31></TD>\r\n                <TD width=\"49%\" height=25>&nbsp;<B><FONT class=normalfont> \r\n                  分类列表</FONT></B></TD>\r\n                <TD class=standard align=right width=\"49%\">&nbsp;</TD></TR>\r\n              <TR>\r\n                <TD bgColor=#6699cc><IMG height=2 \r\n                  src=\"images/blank(1).gif\" \r\n                  width=8></TD>\r\n                <TD bgColor=#6699cc><IMG height=2 \r\n                  src=\"images/blank(1).gif\" \r\n                  width=8></TD></TR>\r\n              <TR>\r\n                <TD height=5><IMG height=5 \r\n                  src=\"images/blank(1).gif\" \r\n                  width=8></TD>\r\n                <TD><IMG height=5 \r\n                  src=\"images/blank(1).gif\" \r\n                  width=8></TD></TR></TBODY></TABLE>\r\n            <TABLE cellSpacing=0 cellPadding=5 width=\"95%\" align=center \r\nborder=0>\r\n              <TBODY>\r\n              <TR vAlign=top>\r\n                <!-- BEGIN cateList -->\r\n<TD>{cateclist}</TD>{cateclistspc}\r\n<!-- END cateList --><!-- END undercate -->\r\n                </TR>\r\n              <TR vAlign=top></TR></TBODY></TABLE><BR>\r\n            <TABLE cellSpacing=0 cellPadding=0 width=\"95%\" border=0>\r\n              <TBODY>\r\n              <TR>\r\n                <TD rowSpan=3><IMG height=30 \r\n                  src=\"images/subhead_1.gif\" \r\n                  width=31></TD>\r\n                <TD width=\"49%\" height=25>&nbsp;<B><FONT class=normalfont> \r\n                  最后更新</FONT></B></TD>\r\n                <TD class=standard align=right width=\"49%\">&nbsp;</TD></TR>\r\n              <TR>\r\n                <TD bgColor=#6699cc><IMG height=2 \r\n                  src=\"images/blank(1).gif\" \r\n                  width=8></TD>\r\n                <TD bgColor=#6699cc><IMG height=2 \r\n                  src=\"images/blank(1).gif\" \r\n                  width=8></TD></TR>\r\n              <TR>\r\n                <TD height=5><IMG height=5 \r\n                  src=\"images/blank(1).gif\" \r\n                  width=8></TD>\r\n                <TD><IMG height=5 \r\n                  src=\"images/blank(1).gif\" \r\n                  width=8></TD></TR></TBODY></TABLE>\r\n              <TABLE cellSpacing=0 cellPadding=3 width=\"95%\" align=center \r\nborder=0>\r\n                <TBODY> \r\n                 <!-- BEGIN article -->\r\n<tr>\r\n    <td>\r\n    <table width=\"100%\" border=\"0\" cellpadding=\"3\" cellspacing=\"0\">\r\n      <tr> \r\n        <td valign=\"top\"><a class=\"normalfont\" href=\"article.php?aid={articleid}\"><b>{articletitle}</b></a> \r\n          <font class=normalfont><br>\r\n          <font class=smallfont color=\"#ff9900\">{time}</font><br>\r\n          By {author}</font><br>\r\n          <font class=smallfont>Rating:{articlerating}</font></td>\r\n      </tr>\r\n      <tr> \r\n        <td colspan=\"2\"> <font class=middlefont>　{description}\r\n          <br><font class=normalfont>分类:<a href=category.php?cid={undercateid}>{undercatetitle}</a></font> \r\n        </td>\r\n      </tr>\r\n      <tr> \r\n        <td background=\"images/dot.gif\" colspan=\"2\" height=10></td>\r\n      </tr>\r\n    </table>\r\n</td>\r\n  </tr> \r\n  <!-- END article -->\r\n\r\n                </TBODY>\r\n              </TABLE>\r\n              <BR>\r\n            <TABLE cellPadding=10 width=\"95%\" border=0>\r\n              <TBODY>\r\n              <TR>\r\n                <TD><FONT class=normalfont>???{totalarticle} ???每页显示 {ppage}  {totalpage}  当前显示 {beginaticle} ???{endaticle} \r\n                 </FONT></TD>\r\n                <TD align=right width=\"10%\">\r\n                  <TABLE width=\"100%\" border=0>\r\n                    <TBODY>\r\n                    <TR>\r\n                      \r\n                      <TD noWrap>{pageStatus}</FONT></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE><BR></TD></TR></TBODY></TABLE>\r\n{footer}\r\n</CENTER></BODY></HTML>', '-1');
INSERT INTO `my_template` VALUES ('6', 'articlehome', '<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">\r\n<HTML>\r\n<HEAD><TITLE>{hometitle}</TITLE>\r\n<META http-equiv=content-type content=\"text/html; charset=utf-8\">\r\n<META http-equiv=pragma content=no-cache>\r\n<META http-equiv=no-cache>\r\n<META http-equiv=expires content=-1>\r\n<META http-equiv=cache-control content=no-cache>\r\n\r\n<META http-equiv=msthemecompatible content=yes>\r\n{headinclude}\r\n\r\n</HEAD>\r\n<BODY text=#666666 bgColor=#ffffff leftMargin=0 topMargin=0 marginheight=\"0\" \r\nmarginwidth=\"0\">\r\n<CENTER>\r\n{header}  \r\n<TABLE cellSpacing=10 cellPadding=0 width=\"100%\" bgColor=#ffffff border=0>\r\n  <TBODY>\r\n  <TR>\r\n    <TD>\r\n      <TABLE cellSpacing=0 cellPadding=3 width=\"100%\" border=0>\r\n        <TBODY>\r\n        <TR>\r\n            <TD vAlign=top width=\"15%\">{displayMenu}</TD>\r\n          <TD vAlign=top align=middle width=\"60%\">\r\n            <TABLE cellSpacing=0 cellPadding=0 width=\"100%\" \r\n            background=\"images/back.gif\" \r\n            border=0>\r\n              <TBODY>\r\n              <TR>\r\n                <TD vAlign=top>\r\n                  <DIV align=center>\r\n                  <TABLE cellSpacing=0 cellPadding=0 width=\"95%\" border=0>\r\n                    <TBODY>\r\n                    <TR>\r\n                      <TD rowSpan=3><IMG height=30 \r\n                        src=\"images/subhead_1.gif\" \r\n                        width=31></TD>\r\n                      <TD width=\"49%\" height=25>&nbsp;<B><FONT \r\n                        class=normalfont> 最后更新</FONT></B></TD>\r\n                      <TD class=standard align=right width=\"49%\">&nbsp;</TD></TR>\r\n                    <TR>\r\n                      <TD bgColor=#6699cc><IMG height=2 \r\n                        src=\"images/blank(1).gif\" \r\n                        width=8></TD>\r\n                      <TD bgColor=#6699cc><IMG height=2 \r\n                        src=\"images/blank(1).gif\" \r\n                        width=8></TD></TR>\r\n                    <TR>\r\n                      <TD height=5><IMG height=5 \r\n                        src=\"images/blank(1).gif\" \r\n                        width=8></TD>\r\n                      <TD><IMG height=5 \r\n                        src=\"images/blank(1).gif\" \r\n                        width=8></TD></TR></TBODY></TABLE>\r\n                  <TABLE cellSpacing=0 cellPadding=3 width=\"95%\" align=center \r\n                  border=0>\r\n                    <TBODY>\r\n                    <!-- BEGIN article -->\r\n<tr>\r\n    <td>\r\n    <table width=\"100%\" border=\"0\" cellpadding=\"3\" cellspacing=\"0\">\r\n      <tr> \r\n        <td valign=\"top\"><a class=\"normalfont\" href=\"article.php?aid={articleid}\"><b>{articletitle}</b></a> \r\n          <font class=normalfont><br>\r\n          <font class=smallfont color=\"#ff9900\">{time}</font><br>\r\n          By {author}</font><br>\r\n          <font class=smallfont>Rating:{articlerating} </font></td>\r\n      </tr>\r\n      <tr> \r\n        <td colspan=\"2\"> <font class=middlefont>　{description}</font> \r\n          <br><font class=normalfont>分类:<a href=category.php?cid={undercateid}>{undercatetitle}</a></font> \r\n        </td>\r\n      </tr>\r\n      <tr> \r\n        <td background=\"images/dot.gif\" colspan=\"2\" height=10></td>\r\n      </tr>\r\n    </table>\r\n</td>\r\n  </tr> \r\n  <!-- END article -->\r\n</TBODY></TABLE></DIV></TD>\r\n                <TD vAlign=top width=\"25%\" bgColor=#eeeeee rowSpan=2>\r\n                    <div align=\"center\">\r\n              <table width=\"100%\" border=0 cellspacing=0 cellpadding=3>\r\n<tr>\r\n<td ><font class=normalfont><b>&raquo;  hotest</b></font>\r\n</td>                \r\n</tr>\r\n<tr>\r\n<td>                \r\n<!-- BEGIN hot10 -->\r\n<li>\r\n<font class=middlefont><a href=\"article.php?aid={hotid}\">{hottitle}</a></font><font class=smallfont>[<font class=smallfont color=#0080FF>{hotclicktimes}</font>]</font>\r\n</li>\r\n <!-- END hot10 -->\r\n</td>\r\n</tr>\r\n</table>\r\n<br>\r\n              <table width=\"100%\" border=0 cellspacing=0 cellpadding=3>\r\n<tr>\r\n        <td ><font class=normalfont><b>&raquo;  Top Rated</b></font>      </td>                \r\n</tr>\r\n<tr>\r\n<td>  \r\n<!-- BEGIN toprate10 -->\r\n<li>\r\n<font class=middlefont><a href=\"article.php?aid={toprateid}\">{topratetitle}</a></font><font class=smallfont>[<font class=smallfont color=#0080FF>{topraterating}</font>]</font>\r\n</li>\r\n <!-- END toprate10 -->\r\n</td>\r\n</tr>\r\n</table></div>\r\n                  </TD></TR>\r\n              <TR vAlign=top>\r\n                <TD>\r\n                  <DIV align=center>\r\n                  <TABLE cellSpacing=0 cellPadding=0 width=\"95%\" align=center \r\n                  border=0>\r\n                    <TBODY>\r\n                    <TR>\r\n                      <TD rowSpan=3><IMG height=30 \r\n                        src=\"images/subhead_1.gif\" \r\n                        width=31></TD>\r\n                      <TD width=\"49%\" height=25>&nbsp;<B><FONT \r\n                        class=normalfont> 分类列表</FONT></B></TD>\r\n                      <TD class=standard align=right width=\"49%\">&nbsp;</TD></TR>\r\n                    <TR>\r\n                      <TD bgColor=#6699cc><IMG height=2 \r\n                        src=\"images/blank(1).gif\" \r\n                        width=8></TD>\r\n                      <TD bgColor=#6699cc><IMG height=2 \r\n                        src=\"images/blank(1).gif\" \r\n                        width=8></TD></TR>\r\n                    <TR>\r\n                      <TD height=5><IMG height=5 \r\n                        src=\"images/blank(1).gif\" \r\n                        width=8></TD>\r\n                      <TD><IMG height=5 \r\n                        src=\"images/blank(1).gif\" \r\n                        width=8></TD></TR><table><TR vAlign=top>\r\n                <!-- BEGIN list -->\r\n<TD>{catelist}</TD>{cateclistspc}\r\n<!-- END list -->\r\n                </TR></TABLE></TBODY></TABLE>\r\n                    </DIV>\r\n                  </TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE>\r\n{footer}</CENTER>\r\n</BODY></HTML>\r\n', '-1');
INSERT INTO `my_template` VALUES ('10', 'search', '<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">\r\n<HTML>\r\n<HEAD><TITLE>{hometitle}</TITLE>\r\n<META http-equiv=content-type content=\"text/html; charset=utf-8\">\r\n<META http-equiv=pragma content=no-cache>\r\n<META http-equiv=no-cache>\r\n<META http-equiv=expires content=-1>\r\n<META http-equiv=cache-control content=no-cache>\r\n\r\n<META http-equiv=msthemecompatible content=yes>\r\n{headinclude}\r\n\r\n</HEAD>\r\n<body bgcolor=\"#FFFFFF\" text=\"#000000\" leftmargin=\"0\" topmargin=\"0\" marginwidth=\"0\" marginheight=\"0\">\r\n<CENTER>  \r\n{header}\r\n<TABLE cellSpacing=10 cellPadding=0 width=\"100%\" bgColor=#ffffff border=0>\r\n  <TBODY>\r\n  <TR>\r\n    <TD>\r\n      <TABLE cellSpacing=0 cellPadding=4 width=\"100%\" border=0>\r\n        <TBODY>\r\n        <TR>\r\n            <TD vAlign=top width=\"20%\">{displayMenu}</TD>\r\n	    <td width=\"80%\" valign=\"top\" align=\"center\"> \r\n      <table width=\"95%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n        <tr>\r\n          <td><font class=normalfont><img src=\"images/phparticle.gif\" border=\"0\" align=\"absmiddle\"><a href=\"{homr_url}\">{hometitle}</a><img src=\"images/next.gif\" border=\"0\" align=\"absmiddle\"><font class=normalfont>高级搜索</font> </font></td>\r\n        </tr>\r\n      </table>\r\n<br>\r\n <table width=\"95%\" border=\"0\" cellspacing=\"1\" cellpadding=\"0\" bgcolor=\"#004184\">\r\n  <tr> \r\n    <td  bgcolor=\"#004184\"> \r\n      <table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"0\">\r\n        <tr>\r\n          <td height=\"20\"><b><font class=normalfont color=\"#FFFFFF\">&raquo; {homrtitle}\r\n            高级搜索引擎</font></b></td>\r\n        </tr>\r\n      </table>\r\n      </td>\r\n  </tr>\r\n  <tr>\r\n    <td>\r\n      <table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"5\" bgcolor=\"#FFFFFF\">\r\n        <form method=\"post\" action=\"search.php\">\r\n          <tr class=firstalt> \r\n            <td><font class=normalfont>请输入关键字:</font></td>\r\n            <td> \r\n              <input type=\"text\" name=\"keyword\">\r\n              <input type=\"hidden\" name=\"action\" value=\"result\">\r\n            </td>\r\n          </tr>\r\n          <tr> \r\n            <td><font class=normalfont>请选择搜索的范???</font></td>\r\n            <td> <font class=normalfont> \r\n              ???INPUT type=checkbox name=searchTitle checked> 标题<INPUT type=checkbox name=searchInSubtitle>副标题\r\n<INPUT type=checkbox name=searchInContent> 文章内容&nbsp;&nbsp;中搜???/font> </td>\r\n          </tr>\r\n          <tr class=firstalt> \r\n            <td><font class=normalfont>请选择分类:</font></td>\r\n            <td>{forumselect}</td>\r\n          </tr><tr>\r\n<td><font class=normalfont>请选择搜索结果排序方式</font></td>\r\n<TD>\r\n          <SELECT  name=orderby>\r\n            <OPTION value=posttime>按照文章发表时间</OPTION>\r\n            <OPTION value=clicktimes>按照文章点击数目</OPTION>\r\n            <OPTION value=rating>按照文章的得???/OPTION>\r\n            <OPTION value=poster>按照主题作者用户名</OPTION>\r\n          </SELECT><font class=normalfont><input type=radio name=\"sortorder\" value=\"asc\">升序\r\n<input type=\"radio\" name=\"sortorder\" value=\"desc\" checked>降序 排列</font>\r\n          </TD>\r\n</tr>\r\n          <tr class=firstalt> \r\n            <td colspan=\"2\"> \r\n              <div align=\"center\"> \r\n                <input type=\"submit\" value=\"提交\">\r\n                <input type=\"reset\" value=\"重置\">\r\n              </div>\r\n            </td>\r\n          </tr>\r\n        </form>\r\n      </table>\r\n    </td>\r\n  </tr>\r\n</table>\r\n\r\n</td>\r\n  </tr>\r\n</table>\r\n<br>\r\n             </TD>\r\n            </TR>\r\n          </TABLE> \r\n	  {footer}\r\n	  </CENTER>\r\n</body>\r\n</html>', '-1');
INSERT INTO `my_template` VALUES ('8', 'votesuccess', '<html>\r\n<head>\r\n<title>评分结果</title>\r\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\r\n{headinclude}\r\n</head>\r\n<body bgcolor=\"#FFFFFF\" text=\"#666666\" leftmargin=\"0\" topmargin=\"0\" marginwidth=\"0\" marginheight=\"0\">\r\n<table width=\"100%\" border=\"0\" cellspacing=\"5\" cellpadding=\"10\">\r\n  <tr>\r\n    <td><center><img src=\"images/information.gif\" border=\"0\">\r\n<br><font class=normalfont>\r\n<b>谢谢你的评分!</b>\r\n<br>\r\n<p align=\"center\">[<a href=\"javascript:self.close()\">关闭当前窗口</a>]</p></font></center></td>\r\n  </tr>\r\n</table>\r\n</body>\r\n</html>', '-1');
INSERT INTO `my_template` VALUES ('11', 'searchresult', '<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">\r\n<HTML>\r\n<HEAD><TITLE>{hometitle}</TITLE>\r\n<META http-equiv=content-type content=\"text/html; charset=utf-8\">\r\n<META http-equiv=pragma content=no-cache>\r\n<META http-equiv=no-cache>\r\n<META http-equiv=expires content=-1>\r\n<META http-equiv=cache-control content=no-cache>\r\n\r\n<META http-equiv=msthemecompatible content=yes>\r\n{headinclude}\r\n\r\n</HEAD>\r\n<BODY text=#666666 bgColor=#ffffff leftMargin=0 topMargin=0 marginheight=\"0\" \r\nmarginwidth=\"0\">\r\n<CENTER>\r\n{header}\r\n<TABLE cellSpacing=10 cellPadding=0 width=\"100%\" bgColor=#ffffff border=0>\r\n  <TBODY>\r\n  <TR>\r\n    <TD>\r\n      <TABLE cellSpacing=0 cellPadding=4 width=\"100%\" border=0>\r\n        <TBODY>\r\n        <TR>\r\n            <TD vAlign=top width=\"20%\"> {displayMenu}\r\n            </TD>\r\n          <TD vAlign=top align=middle>\r\n            <TABLE cellSpacing=0 cellPadding=0 width=\"95%\" border=0>\r\n              <TBODY>\r\n              <TR>\r\n                  <TD><FONT class=normalfont><IMG \r\n                  src=\"images/phparticle.gif\" \r\n                  align=absMiddle border=0><a href=\"{homr_url}\">{hometitle}</a><img src=\"images/next.gif\" border=\"0\" align=\"absmiddle\"><font class=normalfont>搜索结果</font> </FONT></TD>\r\n                </TR></TBODY></TABLE>\r\n            \r\n            <TABLE cellSpacing=0 cellPadding=0 width=\"95%\" border=0>\r\n              <TBODY>\r\n              <TR>\r\n                <TD rowSpan=3><IMG height=30 \r\n                  src=\"images/subhead_1.gif\" \r\n                  width=31></TD>\r\n                <TD width=\"49%\" height=25>&nbsp;<B><FONT class=normalfont> \r\n                  最后更???/FONT></B></TD>\r\n                <TD class=standard align=right width=\"49%\">&nbsp;</TD></TR>\r\n              <TR>\r\n                <TD bgColor=#6699cc><IMG height=2 \r\n                  src=\"images/blank(1).gif\" \r\n                  width=8></TD>\r\n                <TD bgColor=#6699cc><IMG height=2 \r\n                  src=\"images/blank(1).gif\" \r\n                  width=8></TD></TR>\r\n              <TR>\r\n                <TD height=5><IMG height=5 \r\n                  src=\"images/blank(1).gif\" \r\n                  width=8></TD>\r\n                <TD><IMG height=5 \r\n                  src=\"images/blank(1).gif\" \r\n                  width=8></TD></TR></TBODY></TABLE>\r\n              <TABLE cellSpacing=0 cellPadding=3 width=\"95%\" align=center \r\nborder=0>\r\n                <TBODY> \r\n                 <!-- BEGIN article -->\r\n<tr>\r\n    <td>\r\n    <table width=\"100%\" border=\"0\" cellpadding=\"3\" cellspacing=\"0\">\r\n      <tr> \r\n        <td valign=\"top\"><a class=\"normalfont\" href=\"article.php?aid={articleid}\"><b>{articletitle}</b></a> \r\n          <font class=normalfont><br>\r\n          <font class=smallfont color=\"#ff9900\">{time}</font><br>\r\n          By {author}</font><br>\r\n          <font class=smallfont>Rating:{articlerating}</font></td>\r\n      </tr>\r\n      <tr> \r\n        <td colspan=\"2\"> <font class=middlefont>　{description}\r\n          <br><font class=normalfont>分类:<a href=category.php?cid={undercateid}>{undercatetitle}</a></font> \r\n        </td>\r\n      </tr>\r\n      <tr> \r\n        <td background=\"images/dot.gif\" colspan=\"2\" height=10></td>\r\n      </tr>\r\n    </table>\r\n</td>\r\n  </tr> \r\n  <!-- END article -->\r\n\r\n                </TBODY>\r\n              </TABLE>\r\n              <BR>\r\n            <TABLE cellPadding=10 width=\"95%\" border=0>\r\n              <TBODY>\r\n              <TR>\r\n                <TD><FONT class=normalfont>???{totalarticle} ???每页显示 {ppage} ??????{totalpage} ???当前显示???{beginaticle} ???{endaticle} \r\n                  ???/FONT></TD>\r\n                <TD align=right width=\"10%\">\r\n                  <TABLE width=\"100%\" border=0>\r\n                    <TBODY>\r\n                    <TR>\r\n                      \r\n                      <TD noWrap>{pageStatus}</FONT></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE><BR></TD></TR></TBODY></TABLE>\r\n{footer}\r\n</CENTER></BODY></HTML>\r\n', '-1');
INSERT INTO `my_template` VALUES ('32', 'error', '<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">\r\n<HTML>\r\n<HEAD><TITLE>{hometitle}</TITLE>\r\n<META http-equiv=content-type content=\"text/html; charset=utf-8\">\r\n<META http-equiv=pragma content=no-cache>\r\n<META http-equiv=no-cache>\r\n<META http-equiv=expires content=-1>\r\n<META http-equiv=cache-control content=no-cache>\r\n\r\n<META http-equiv=msthemecompatible content=yes>\r\n{headinclude}\r\n\r\n</HEAD>\r\n<BODY text=#666666 bgColor=#ffffff leftMargin=0 topMargin=0 marginheight=\"0\" \r\nmarginwidth=\"0\">\r\n<CENTER>\r\n{header}\r\n<br><br><br><br>\r\n<table width=\"100%\" height=\"50%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" bgcolor=\"#FFFFFF\" align=\"center\">\r\n<tr>\r\n	<td>\r\n\r\n<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" bgcolor=\"#000000\"  width=\"70%\" align=\"center\"><tr><td>\r\n<table cellpadding=\"4\" cellspacing=\"1\" border=\"0\"  width=\"100%\">\r\n<tr>\r\n	<td bgcolor=\"#dedede\" width=\"100%\"><font class=normalfont><img src=\"./images/phparticle.gif\" align=\"absmiddle\" alt=\"{hometitle}\" border=\"0\">\r\n	系统信息</font></td>\r\n</tr>\r\n<tr>\r\n	<td bgcolor=\"#FFFFFF\" width=\"100%\"><font class=normalfont >{error_msg}<br><a href=\"javascript:history.back();\">Click here to go back</a></font></td>\r\n</tr>\r\n</table>\r\n</td></tr></table>\r\n\r\n<p align=\"center\"><table cellpadding=\"0\" cellspacing=\"0\" border=\"0\">\r\n<form method=\"post\" name=\"jumpbox\" action=\"{home_url}category.php\"><tr><td>\r\n	<font class=normalfont >\r\n	{jumpmenu}\r\n<input type=\"submit\" value=\"Go\" class=\"button\" />\r\n	</font>\r\n</td></tr></form>\r\n</table></p>\r\n\r\n	</td>\r\n</tr>\r\n</table>\r\n\r\n\r\n{footer}\r\n</CENTER></BODY></HTML>', '-1');
INSERT INTO `my_template` VALUES ('33', 'error_articleid', '没有指定的文章', '-1');
INSERT INTO `my_template` VALUES ('34', 'error_cateid', '没有指定的分类', '-1');
INSERT INTO `my_template` VALUES ('35', 'error_norating', '没有评分分数.', '-1');
INSERT INTO `my_template` VALUES ('36', 'error_multirate', '不能够重复投票', '-1');
INSERT INTO `my_template` VALUES ('28', 'printarticle', '<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">\r\n<HTML>\r\n<HEAD><TITLE>{hometitle}</TITLE>\r\n<META http-equiv=content-type content=\"text/html; charset=utf-8\">\r\n<META http-equiv=pragma content=no-cache>\r\n<META http-equiv=no-cache>\r\n<META http-equiv=expires content=-1>\r\n<META http-equiv=cache-control content=no-cache>\r\n\r\n<META http-equiv=msthemecompatible content=yes>\r\n{headinclude}\r\n\r\n</HEAD>\r\n<body bgcolor=\"#FFFFFF\" text=\"#000000\">\r\n<span class=articleTitle valign=\"top\">{articletitle}</span> <br><font class=normalfont>{articletime}</font><br> \r\n<font class=normalfont>by <b><a href=\"#\">{articleauthor}</a></b></font>\r\n<br><br>\r\n<font class=normalfont>打印??? <br>\r\n{articlenav}\r\n</font>\r\n<hr size=\"1\" noshade>\r\n<span class=content>\r\n<!-- BEGIN page -->\r\n<b>{articlesubtitle}</b>\r\n<br>\r\n{articlecontent}<br>\r\n<!-- END page -->\r\n</span>  \r\n<br>\r\n             </TD>\r\n            </TR>\r\n          </TABLE> \r\n{footer}\r\n</CENTER>\r\n<SCRIPT language=JavaScript>\r\n               window.print();\r\n</SCRIPT>\r\n</body>\r\n</html>', '-1');
INSERT INTO `my_template` VALUES ('27', 'headinclude', '<LINK href={home_url}/article.css rel=stylesheet type=text/css>', '-1');
INSERT INTO `my_template` VALUES ('26', 'showarticle', '<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">\r\n<HTML>\r\n<HEAD><TITLE>{hometitle}</TITLE>\r\n<META http-equiv=content-type content=\"text/html; charset=utf-8\">\r\n<META http-equiv=pragma content=no-cache>\r\n<META http-equiv=no-cache>\r\n<META http-equiv=expires content=-1>\r\n<META http-equiv=cache-control content=no-cache>\r\n\r\n<META http-equiv=msthemecompatible content=yes>\r\n{headinclude}\r\n\r\n</HEAD>\r\n<script language=javascript type=text/javascript>\r\n<!--\r\nfunction openfeedbackwindow(thepage)\r\n{feedbackwin=window.open(thepage,\'feedback\',\'width=250,height=160,scrollbars\')\r\n}\r\n\r\nfunction openwindow(url,w,h){var winame=\'popup\';popupwin=window.open(url,winame,\'scrollbars,menubar,resizeable,width=\'+w+\',height=\'+h);}\r\n\r\nfunction goFB(rating)\r\n{\r\n        openfeedbackwindow(\'./rating.php?aid={articleid}&rating=\' + rating);\r\n}\r\n// --> </script>\r\n\r\n<script>\r\n\r\nif (parent.frames.length > 0) {\r\n\r\n    parent.location.href = self.document.location\r\n\r\n}\r\n\r\n</script>\r\n<BODY text=#666666 bgColor=#ffffff leftMargin=0 topMargin=0 marginheight=\"0\" \r\nmarginwidth=\"0\">\r\n<CENTER>\r\n{header}\r\n<TABLE cellSpacing=10 cellPadding=0 width=\"100%\" bgColor=#ffffff border=0>\r\n  <TBODY>\r\n  <TR>\r\n    <TD>\r\n      <TABLE cellSpacing=0 cellPadding=4 width=\"100%\" border=0>\r\n        <TBODY>\r\n        <TR>\r\n            <TD vAlign=top width=\"20%\">{displayMenu}</TD>\r\n          <TD vAlign=top align=middle>\r\n            <TABLE cellSpacing=0 cellPadding=0 width=\"95%\" border=0>\r\n              <TBODY>\r\n              <TR>\r\n                <TD><FONT class=normalfont><IMG \r\n                  src=\"images/phparticle.gif\" \r\n                  align=absMiddle border=0>{articlenav}</FONT></TD></TR></TBODY></TABLE>\r\n            <TABLE cellPadding=10 width=\"100%\" border=0>\r\n              <TBODY>\r\n              <TR>\r\n                <TD>\r\n                  <TABLE cellSpacing=1 cellPadding=3 width=\"100%\" border=0>\r\n                    <TBODY>\r\n                    <TR>\r\n                        <TD vAlign=top><span class=articleTitle>{articletitle}</span><BR>\r\n                          <FONT \r\n                        class=normalfont>{articletime}</FONT><BR><FONT \r\n                        class=normalfont>by <B>{articleauthor}</B></FONT>&nbsp;&nbsp;<FONT \r\n                        class=normalfont></FONT><BR><FONT \r\n                        class=normalfont>Rating: {articlerating} </FONT><BR><!-- BEGIN ratingform -->\r\n\r\n                        <TABLE class=tiny cellSpacing=1 cellPadding=1 \r\n                        bgColor=#eeeeee border=0 brder=\"0\">\r\n                          <TBODY>\r\n                          <TR class=smallfont vAlign=center>\r\n                            <TD align=middle bgColor=#bbd1f2><INPUT \r\n                              onclick=goFB(this.value); type=radio value=1 \r\n                              name=rating> 1 </TD>\r\n                            <TD align=middle bgColor=#ccdcf5><INPUT \r\n                              onclick=goFB(this.value); type=radio value=2 \r\n                              name=rating> 2 </TD>\r\n                            <TD align=middle bgColor=#dde8f8><INPUT \r\n                              onclick=goFB(this.value); type=radio value=3 \r\n                              name=rating> 3 </TD>\r\n                            <TD align=middle bgColor=#eef4fc><INPUT \r\n                              onclick=goFB(this.value); type=radio value=4 \r\n                              name=rating> 4 </TD>\r\n                            <TD align=middle bgColor=#ffffff><INPUT \r\n                              onclick=goFB(this.value); type=radio value=5 \r\n                              name=rating> 5 </TD>\r\n                            <TD align=middle bgColor=#fef5f4><INPUT \r\n                              onclick=goFB(this.value); type=radio value=6 \r\n                              name=rating> 6 </TD>\r\n                            <TD align=middle bgColor=#feebea><INPUT \r\n                              onclick=goFB(this.value); type=radio value=7 \r\n                              name=rating> 7 </TD>\r\n                            <TD align=middle bgColor=#fee1e0><INPUT \r\n                              onclick=goFB(this.value); type=radio value=8 \r\n                              name=rating> 8 </TD>\r\n                            <TD align=middle bgColor=#fdd7d5><INPUT \r\n                              onclick=goFB(this.value); type=radio value=9 \r\n                              name=rating> 9 </TD>\r\n                            <TD align=middle bgColor=#fdd1d1><INPUT \r\n                              onclick=goFB(this.value); type=radio value=10 \r\n                              name=rating> 10 \r\n                  </TD></TR></TBODY></TABLE><!-- END ratingform -->\r\n</TD></TR></TBODY></TABLE>\r\n                  <TABLE cellSpacing=1 cellPadding=3 width=\"100%\" border=0>\r\n                    <TBODY>\r\n                    <TR>\r\n                      <TD vAlign=top>\r\n                        <P><SPAN class=subhead>{articlesubtitle}</SPAN></P>\r\n                        <P><SPAN \r\n                        class=content>{articlecontent} </SPAN>\r\n                        </P>\r\n                        </TD>\r\n                      </TR></TBODY></TABLE><P align=right><form method=\"post\" name=\"jumpbox\" action=\"{home_url}category.php\">{jumpmenu}<input type=\"submit\" value=\"Go\" class=\"button\" /></form></p>\r\n                  <P align=right><A \r\n                  href=\"javascript:openEmailWindow(\'./email.php?aid={articleid}\');\"><IMG \r\n                  alt=推荐给好???\r\n                  src=\"images/mail.gif\" \r\n                  align=absMiddle border=0></A> <A \r\n                  href=\"download.php?aid={articleid}\"><IMG \r\n                  alt=打包下载这篇文章 \r\n                  src=\"images/download.gif\" \r\n                  align=absMiddle border=0></A> <A \r\n                  href=\"print.php?aid={articleid}\" \r\n                  target=_blank><IMG alt=打印这篇文章 \r\n                  src=\"images/print.gif\" \r\n                  align=absMiddle \r\n        border=0></A></P></TD></TR></TBODY></TABLE>\r\n<table cellpadding=10 width=\"100%\" border=0>\r\n  <tr> \r\n    <td><table cellpadding=\"0\" cellspacing=\"0\" border=\"0\">\r\n     \r\n<form action=\"article.php\" method=\"post\"><tr>\r\n            <td>  \r\n        <!-- BEGIN pagejump -->\r\n              <select name=\"pagenum\"\r\n        onchange=\"window.location=(\'article.php?aid={articleid}&page=\'+this.options[this.selectedIndex].value)\">\r\n                <option value=\"0\" >article content:</option>\r\n                <option value=\"0\">--------------------</option> \r\n		<!-- BEGIN pageoption -->\r\n                <option value=\"{pagenum}\">???{pagenum} ???{subtitle}</option>\r\n		 <!-- END pageoption -->\r\n	</select>\r\n        <!-- END pagejump -->\r\n</td></tr></form>\r\n</table></td>\r\n    <td align=\"right\" width=\"10%\">\r\n<table width=\"100%\" border=\"0\">\r\n        <tr>\r\n          <td nowrap>{pageStatus}</td>\r\n        </tr>\r\n      </table>\r\n    </td>\r\n  </tr>\r\n  <tr>\r\n  \r\n <TABLE cellSpacing=0 cellPadding=0 width=\"95%\" align=center \r\nborder=0>\r\n              <TBODY>\r\n              <TR>\r\n                <TD rowSpan=3><IMG height=30 \r\n                  src=\"images/subhead_1.gif\" \r\n                  width=31></TD>\r\n                <TD width=\"49%\" height=25>&nbsp;<B><FONT class=normalfont> \r\n                  <a href=showcomment.php?aid={articleid}>showcomment</a>&nbsp;</FONT></B></TD>\r\n                <TD class=standard align=right width=\"49%\">&nbsp;there are {commnetnum} comment</TD></TR>\r\n              <TR>\r\n                <TD bgColor=#6699cc><IMG height=2 \r\n                  src=\"images/blank(1).gif\" \r\n                  width=8></TD>\r\n                <TD bgColor=#6699cc><IMG height=2 \r\n                  src=\"images/blank(1).gif\" \r\n                  width=8></TD></TR>\r\n              <TR>\r\n                <TD height=5><IMG height=5 \r\n                  src=\"images/blank(1).gif\" \r\n                  width=8></TD>\r\n                <TD><IMG height=5 \r\n                  src=\"images/blank(1).gif\" \r\n                  width=8></TD></TR></TBODY></TABLE>\r\n <TABLE cellSpacing=0 cellPadding=0 width=\"95%\" align=center \r\nborder=0>\r\n<TBODY>\r\n              <TR><form action=addcomment.php method=post>\r\n                <TD rowSpan=3>\r\n				subject:<input type=text name=subject value=\"re: {articlesubtitle}\"><br>\r\n				name:<input type=text name=name>E-mail<input type=text name=email><br>\r\n				<textarea name=\"content\" rows=\"5\" cols=\"70\"></textarea><input type=hidden name=articleid value={articleid}><br>\r\n				<input type=submit name=submit>\r\n				</td></form>\r\n\r\n  </tr>\r\n</table>\r\n</TD></TR></TBODY></TABLE><BR></TD></TR></TBODY></TABLE>\r\n{footer}</CENTER></BODY></HTML>', '-1');
INSERT INTO `my_template` VALUES ('38', 'showcomment', '<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">\r\n<HTML>\r\n<HEAD><TITLE>{hometitle}</TITLE>\r\n<META http-equiv=content-type content=\"text/html; charset=utf-8\">\r\n<META http-equiv=pragma content=no-cache>\r\n<META http-equiv=no-cache>\r\n<META http-equiv=expires content=-1>\r\n<META http-equiv=cache-control content=no-cache>\r\n\r\n<META http-equiv=msthemecompatible content=yes>\r\n{headinclude}\r\n\r\n</HEAD>\r\n<BODY text=#666666 bgColor=#ffffff leftMargin=0 topMargin=0 marginheight=\"0\" \r\nmarginwidth=\"0\">\r\n<CENTER>\r\n{header}\r\n<TABLE cellSpacing=10 cellPadding=0 width=\"100%\" bgColor=#ffffff border=0>\r\n  <TBODY>\r\n  <TR>\r\n    <TD>\r\n      <TABLE cellSpacing=0 cellPadding=4 width=\"100%\" border=0>\r\n        <TBODY>\r\n        <TR>\r\n            <TD vAlign=top width=\"20%\"> {displayMenu}\r\n            </TD>\r\n          <TD vAlign=top align=middle>\r\n              <TABLE cellSpacing=0 cellPadding=3 width=\"95%\" align=center \r\nborder=0>\r\n                <TBODY> \r\n                 <!-- BEGIN comment -->\r\n<tr>\r\n    <td>\r\n    <table width=\"100%\" border=\"0\" cellpadding=\"3\" cellspacing=\"0\">\r\n      <tr> \r\n	   \r\n\r\n        <td valign=\"top\"> \r\n		<font class=normalfont>\r\n		- ???b>&nbsp;{commentauthor}&nbsp;</b>评论???nbsp;{commenttime}\r\n		<br>\r\n		{commentsubject}\r\n         </font></td>\r\n      </tr>\r\n      <tr> \r\n        <td colspan=\"2\"> \r\n			<font class=normalfont>　{commentcontent}\r\n			</font> \r\n        </td>\r\n      </tr>\r\n      <tr> \r\n        <td background=\"images/dot.gif\" colspan=\"2\" height=10></td>\r\n      </tr>\r\n    </table>\r\n</td>\r\n  </tr> \r\n  <!-- END comment -->\r\n <tr>\r\n  \r\n <TABLE cellSpacing=0 cellPadding=0 width=\"95%\" align=center \r\nborder=0>\r\n              <TBODY>\r\n              <TR>\r\n                <TD rowSpan=3><IMG height=30 \r\n                  src=\"images/subhead_1.gif\" \r\n                  width=31></TD>\r\n                <TD width=\"49%\" height=25>&nbsp;<B><FONT class=normalfont> \r\n                  <a href=article.php?aid={articleid}>showarticle</a></FONT></B></TD>\r\n                <TD class=standard align=right width=\"49%\">&nbsp;</TD></TR>\r\n              <TR>\r\n                <TD bgColor=#6699cc><IMG height=2 \r\n                  src=\"images/blank(1).gif\" \r\n                  width=8></TD>\r\n                <TD bgColor=#6699cc><IMG height=2 \r\n                  src=\"images/blank(1).gif\" \r\n                  width=8></TD></TR>\r\n              <TR>\r\n                <TD height=5><IMG height=5 \r\n                  src=\"images/blank(1).gif\" \r\n                  width=8></TD>\r\n                <TD><IMG height=5 \r\n                  src=\"images/blank(1).gif\" \r\n                  width=8></TD></TR></TBODY></TABLE>\r\n <TABLE cellSpacing=0 cellPadding=0 width=\"95%\" align=center \r\nborder=0>\r\n<TBODY>\r\n              <TR><form action=addcomment.php method=post>\r\n                <TD rowSpan=3>\r\n				subject:<input type=text name=subject><br>\r\n				name:<input type=text name=name>E-mail<input type=text name=email><br>\r\n				<textarea name=\"content\" rows=\"5\" cols=\"70\"></textarea><input type=hidden name=articleid value={articleid}><br>\r\n				<input type=submit name=submit>\r\n				</td></form>\r\n\r\n  </tr>\r\n                </TBODY>\r\n              </TABLE>\r\n              <BR>\r\n         \r\n				\r\n				</TD></TR></TBODY></TABLE><BR></TD></TR></TBODY></TABLE>\r\n{footer}\r\n</CENTER></BODY></HTML>', '-1');
INSERT INTO `my_template` VALUES ('39', 'success', '<html>\r\n<head>\r\n<title>Please stand by...</title>\r\n<meta http-equiv=\"refresh\" content=\"2; url={url}\">\r\n<link type=\"text/css\" href=\"{home_url}/style.css\" rel=\"stylesheet\">\r\n</head>\r\n<body bgcolor=\'#FFFFFF\'>\r\n\r\n<table cellpadding=\'0\' cellspacing=\'0\' border=\'0\' width=\"95%\" align=\'center\' height=\'85%\' >\r\n  <tr align=\'center\' valign=\'middle\'>\r\n    <td>\r\n    <table style=\"BORDER-COLLAPSE: collapse\" borderColor=#111111 cellSpacing=0 \r\n      cellPadding=0  border=1 width=\"80%\" align=\'center\' >\r\n    <tr>\r\n       <td valign=\'middle\' align=\'center\' bgcolor=\'#F1F1F1\' id=\'redirect\'>\r\n	 <br><br>\r\n        {successTemplate}\r\n        <br><br>\r\n        Please wait while we transfer you...\r\n        <br><br>\r\n        (<a href=\'{url}\'>Or click here if you do not want to wait</a>)\r\n	 <br><br>\r\n       </td>\r\n    </tr>\r\n    </table>\r\n    </td>\r\n  </tr>\r\n</table>\r\n</body>\r\n</html>', '-1');
INSERT INTO `my_template` VALUES ('40', 'success_addcomment', 'you have add the comment successfully', '-1');
