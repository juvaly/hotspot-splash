(function() {
	var link = document.createElement("link");
	link.href = "http://www.hotspotsplashscreens.com/hotspot-splash/banner-top.css";
	link.type = "text/css";
	link.rel = "stylesheet";
	document.getElementsByTagName("head")[0].appendChild(link)
;
	if ( self === top ) {
		var banner = document.createElement('div');
		banner.id = "hscp-banner";
		var title = document.createElement('h1');
		title.id = "hscp-banner-title";
		title.innerHTML = "my test banner";
		banner.appendChild(title);
		var body = document.getElementsByTagName('body')[0];
		body.insertBefore(banner, body.firstChild);
	}
})();