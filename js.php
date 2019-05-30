<?php
$content.=<<< EOF
<SCRIPT language=JavaScript>

  var viewMode = 1; // WYSIWYG

  function Init(){
           iView.document.designMode = 'On';
  }

  function selOn(ctrl){
           ctrl.style.borderColor = '#000000';
           ctrl.style.backgroundColor = '#B5BED6';
           ctrl.style.cursor = 'hand';
  }

  function selOff(ctrl){
           ctrl.style.borderColor = '#DEE3E7';
           ctrl.style.backgroundColor = '#FFFFFF';
  }

  function selDown(ctrl){
           ctrl.style.backgroundColor = '#8492B5';
  }

  function selUp(ctrl){
           ctrl.style.backgroundColor = '#DEE3E7';
  }

  function doCut(){
           iView.document.execCommand('cut');
  }

  function doCopy(){
           iView.document.execCommand('copy');
  }

  function doPaste(){
           iView.document.execCommand('paste');
  }

  function doBold(){
           iView.document.execCommand('bold', false, null);
  }

  function doItalic(){
           iView.document.execCommand('italic', false, null);
  }

  function doUnderline(){
           iView.document.execCommand('underline', false, null);
  }

  function doStrikeThrough(){
           iView.document.execCommand('strikethrough', false, null);
  }

  function doSuperscript(){
           iView.document.execCommand('superscript', false, null);
  }

  function doSubscript(){
           iView.document.execCommand('subscript', false, null);
  }

  function doRemoveFormat(){
           iView.document.execCommand('removeformat', false, null);
  }

  function doInsertMarquee(){
           iView.document.execCommand('insertmarquee', false, null);
  }

  function doLeft(){
           iView.document.execCommand('justifyleft', false, null);
  }

  function doCenter(){
           iView.document.execCommand('justifycenter', false, null);
  }

  function doRight(){
           iView.document.execCommand('justifyright', false, null);
  }

  function doOrdList(){
           iView.document.execCommand('insertorderedlist', false, null);
  }

  function doBulList(){
           iView.document.execCommand('insertunorderedlist', false, null);
  }

function doForeCol()
{
		    var left = (screen.availWidth/2) - (293/2);
			var top = (screen.availHeight/2) - (100/2);

			document.article.__data.value = 'foreColor';
			var colorWin = window.open("colors.php?controlId=1", 'colors', 'scrollbars=0, toolbar=0, statusbar=0, width=293, height=200, left='+left+', top='+top);
}

function doBackCol()
{
			 var left = (screen.availWidth/2) - (293/2);
			 var top = (screen.availHeight/2) - (100/2);

			 document.article.__data.value = 'backColor';
			 var colorWin = window.open('colors.php?controlId=1', 'colors', 'scrollbars=0, toolbar=0, statusbar=0, width=293, height=200, left='+left+', top='+top);
}

  function doLink(){
           iView.document.execCommand('createlink');
  }

  function doImage()
  {
	  //var left = (screen.availWidth/2) - (293/2);
	  //var top = (screen.availHeight/2) - (100/2);
   var imgSrc = prompt('Enter image location', '');
    
   if(imgSrc != null)    
    iView.document.execCommand('insertimage', false, imgSrc);
	//window.open('uploadpic.php', 'images', 'scrollbars=0, toolbar=0, statusbar=0, width=293, height=200, left='+left+', top='+top);
  }

  function doRule(){
           iView.document.execCommand('inserthorizontalrule', false, null);
  }

  function doFont(fName){
           if(fName != '')
              iView.document.execCommand('fontname', false, fName);
  }

  function doSize(fSize){
           if(fSize != '')
              iView.document.execCommand('fontsize', false, fSize);
  }

  function doHead(hType){
           if(hType != ''){
              iView.document.execCommand('formatblock', false, hType);
             // doFont(this.options[selFont.selectedIndex].value);
           }
  }

  function doTable(){
			var left = (screen.availWidth/2) - (450/2);
			var top = (screen.availHeight/2) - (210/2);

			var imageWin = window.open('table.php', 'table', 'scrollbars=1, toolbar=0, statusbar=0, width=450, height=210, left='+left+', top='+top);
  }
  function doCode(){
			var left = (screen.availWidth/2) - (450/2);
			var top = (screen.availHeight/2) - (210/2);

			var imageWin = window.open('highlight.php', 'table', 'scrollbars=1, toolbar=0, statusbar=0, width=450, height=210, left='+left+', top='+top);
  }

  function doToggleView(){
           if(viewMode == 1){
              iHTML = iView.document.body.innerHTML;
              iView.document.body.innerText = iHTML;

              // Hide all controls
              tblCtrls.style.display = 'none';
              tb2Ctrls.style.display = 'none';

              iView.focus();

              viewMode = 2; // Code

           }else{
              iText = iView.document.body.innerText;
              iView.document.body.innerHTML = iText;

              // Show all controls
              tblCtrls.style.display = 'inline';
              tb2Ctrls.style.display = 'inline';

              iView.focus();

              viewMode = 1; // WYSIWYG
           }
  }


  function ProcessArticle(){
           // Assign the HTML code to a hidden form variable
           var htmlCode = iView.document.body.innerHTML;
           document.article.articleContent.value = htmlCode;

           // Make sure that all fields are completed

           if(document.article.title.value == ''){
              alert('请输入标题.');
              document.article.articleTitle.focus();
              return false;
           }

           if(document.article.articledes.value == ''){
              alert('请输入文章的描述.');
              document.article.articleDescription.focus();
              return false;
           }

           if(document.article.author.value == ''){
              alert('请输入作者.');
              document.article.articleAuthor.focus();
              return false;
           }

           if(document.article.cateid.value == '0'){
              alert('请选择分类.');
              document.article.cateid.focus();
              return false;
           }

           if(document.article.subhead.value == ''){
              alert('请输入小标题.');
              document.article.articleSubtitle.focus();
              return false;
           }

           if(document.article.articleContent.value == ''){
              alert('请输入内容.');
              iView.focus();
              return false;
           }

           return true;
  }

  function ProcessNextArticle(){
           // Assign the HTML code to a hidden form variable
           var htmlCode = iView.document.body.innerHTML;
           document.article.articleContent.value = htmlCode;

           // Make sure that all fields are completed
           if(document.article.subhead.value == ''){
              alert('请输入小标题.');
              document.article.articleSubtitle.focus();
              return false;
           }

           if(document.article.articleContent.value == ''){
              alert('请输入内容.');
              iView.focus();
              return false;
           }

           return true;
  }
</SCRIPT>
EOF;

?>