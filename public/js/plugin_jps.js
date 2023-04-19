
(function (window) {
	'use strict'
	function PluginGPS() {

        var Plugin_gps      = {};
        var env_api 		= Plugin_config_file.projects()['env_api_multi_purpose'];

        Plugin_gps.getCoordinate = function () {
            if (navigator.geolocation) {
                const position = navigator.geolocation.getCurrentPosition();
                //position.coords.latitude
                //position.coords.longitude;
                console.log(position);
              } else { 
                console.error("Geolocation is not supported by this browser.");
              }
        };

        Plugin_gps.log = function (obj_type, obj_refid, latitude, longitude, accuracy, callback) {
			$.get( env_api + "api/plugin_gps/log_position?obj_type="+ obj_type +"&obj_refid="+ obj_refid +"&latitude="+ latitude +"&longitude="+ longitude +"&accuracy="+ accuracy +"&speed=" + speed, function (response) {
                callback(response);
            });
		};

        Plugin_gps.getPosition = function (obj_refid, limit, callback) {
            $.get( env_api + "api/plugin_gps/get_last_position?obj_refid="+ obj_refid +"&limit=" + limit, function (response) {
                callback(response);
            });
        };

        return Plugin_gps;
	};

	if(typeof(Plugin_gps) === 'undefined'){
		window.Plugin_gps = PluginGPS();
	}
}) (window);
