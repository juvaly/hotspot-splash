(function() {
	if(!window.jQuery)
	{
	   var script = document.createElement('script');
	   script.type = "text/javascript";
	   script.src = "https://code.jquery.com/jquery-2.1.3.min.js";
	   document.getElementsByTagName('head')[0].appendChild(script);
	}

	if ( self === top ) {
		var banner = $('<div id="hscp-banner"><h1 id="hscp-banner-title">my test banner</h1></div>');
		$('body').prepend(banner);
		$('#hscp-banner').css({ 'min-height': '90px', 'text-align': 'center', 'background': '#fff', 'border': 'solid 10px #0f0' });
		$('#hscp-banner-title').css({ color: '#900', padding: '20px' });
	}
})();