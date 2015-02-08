if(!window.jQuery)
{
   var script = document.createElement('script');
   script.type = "text/javascript";
   script.src = "https://code.jquery.com/jquery-2.1.3.min.js";
   document.getElementsByTagName('head')[0].appendChild(script);
}

$(function() {
	var banner = $('<div><h1>my test banner</h1></div>');
	banner.css('{ position: fixed; top: 0; right: 50%; background: #fff; border: solid 10px #0f0; }');
	$('body').prepend(banner);
}();