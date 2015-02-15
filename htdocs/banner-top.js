(function() {
//	var link = document.createElement("link");
//	link.href = "http://www.hotspotsplashscreens.com/hotspot-splash/banner-top.css";
//	link.type = "text/css";
//	link.rel = "stylesheet";
//	document.getElementsByTagName("head")[0].appendChild(link);

//	if ( self === top ) {
//		var banner = document.createElement("div");
//		banner.id = "hscp-banner";
//		var title = document.createElement("h1");
//		title.id = "hscp-banner-title";
//		title.innerHTML = "my test banner";
//		banner.appendChild(title);
//		var body = document.getElementsByTagName("body")[0];
//		body.insertBefore(banner, body.firstChild);
//	}

//
function parseQueryString() {
	var str = window.location.search;

	str = str.trim().replace(/^(\?|#)/, '');

	if (!str) {
		return {};
	}

	return str.trim().split('&').reduce(function (ret, param) {
		var parts = param.replace(/\+/g, ' ').split('=');
		var key = parts[0];
		var val = parts[1];

		key = decodeURIComponent(key);
		// missing `=` should be `null`:
		// http://w3.org/TR/2012/WD-url-20120524/#collect-url-parameters
		val = val === undefined ? null : decodeURIComponent(val);

		if (!ret.hasOwnProperty(key)) {
			ret[key] = val;
		} else if (Array.isArray(ret[key])) {
			ret[key].push(val);
		} else {
			ret[key] = [ret[key], val];
		}

		return ret;
	}, {});
};

//
var qs = parseQueryString();
var url = "http://www.hotspotsplashscreens.com/hotspot-splash/action.php?a=trk&t=" + qs.t + "d_id=" + qs.d_id + "c_id" = qs.c_id;
xmlhttp.open("GET", url, true);
xmlhttp.send();

})();