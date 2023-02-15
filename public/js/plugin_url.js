
(function (window) {
	'use strict'
	function PluginURL() {

        var Plugin_URL = {};

        Plugin_URL.getParam = function (param) {
            const queryString 	= window.location.search;
	        const urlParams     = new URLSearchParams(queryString);
            const value         = urlParams.get(param);
	        return value;
		};

        return Plugin_URL;
	};

	if(typeof(Plugin_URL) === 'undefined') {
		window.Plugin_URL = PluginURL();
	}
}) (window);
