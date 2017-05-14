/*******************************************************************************
* KindEditor - WYSIWYG HTML Editor for Internet
* Copyright (C) 2006-2011 kindsoft.net
*
* @author iger
* @site http://www.verybeaut.com/
* @licence null
*******************************************************************************/

KindEditor.plugin('myview', function(K) {
	var self = this, name = 'myview';
	self.clickToolbar(name, function() {
		var html = '<style type="text/css">* { padding:0; margin:0; } body { background:#ddd; } .myview{width:1000px; padding:10px; margin:0 auto; background:#fff; font-size:14px; line-height:2; font-family:microsoft Yahei; overflow:hidden;} .myview img{max-width:1000px;} .myview img[align=left]{margin-right:10px;} .myview img[align=right]{margin-left:10px;} </style><div class="myview">'+self.fullHtml()+'</div>',
			oWin = window.open('about:blank', '_blank');
		oWin.document.write(html);
		oWin.document.close();
	});
});
