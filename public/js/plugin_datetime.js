
(function (window) {
	'use strict'
	function PluginDateTime() {

        var Plugin_datetime = {};

        Plugin_datetime.time24To12Format = function (time) {
            var datetime = "2023-02-07 " + time;
            var newdates = new Date(datetime);
            return newdates.toLocaleTimeString();
		};

        return Plugin_datetime;
	};

	if(typeof(Plugin_datetime) === 'undefined'){
		window.Plugin_datetime = PluginDateTime();
	}
}) (window);
