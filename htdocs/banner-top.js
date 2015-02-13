(function() {
	var css = document.createElement('style');
	css.innerHTML = 
		"#hscp-banner { 'min-height': '90px'; 'text-align': 'center'; 'background': '#fff'; 'border': 'solid 10px #0f0' }" +
		"#hscp-banner-title { color: '#900'; padding: '20px' }";
	document.getElementsByTagName('head')[0].appendChild(css);

	if ( self === top ) {
		var banner = document.createElement('div');
		banner.id = "hscp-banner";
		var title = document.createElement('h1');
		title.id = 'hscp-banner-title';
		banner.appendChild(title);
		var body = document.getElementsByTagName('body')[0];
		body.insertBefore(banner, body.firstChild);
	}
})();