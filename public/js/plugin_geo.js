
(function (window) {
	'use strict'
	function PluginGeo() {
        var Plugin_geo   = {};

        Plugin_geo.allRegion = function (fetch_local) {
            
        };

        Plugin_geo.allProvince = function (fetch_local, region_code, callback) {
            const local = localStorage.getItem("allProvince-" + region_code);
            if(local && fetch_local) {
                callback(JSON.parse(local));
            }
            else {
                $.get( Plugin_config_file.projects()['env_api'] + "api/plugin_geography/allProvince/" + region_code, function (response) {
                    localStorage.setItem("allProvince-" + region_code, JSON.stringify(response));
                    callback(response);
                });
            }
        };

        Plugin_geo.allCity = function (fetch_local, province_code, callback) {
            const local = localStorage.getItem("allCity-" + province_code);
            if(local && fetch_local) {
                callback(JSON.parse(local));
            }
            else {
                $.get( Plugin_config_file.projects()['env_api'] + "api/plugin_geography/allCity/" + province_code, function (response) {
                    localStorage.setItem("allCity-" + province_code, JSON.stringify(response));
                    callback(response);
                });
            }
        };

        Plugin_geo.allBarangay = function (fetch_local, city_code, callback) {
            
        };

        Plugin_geo.allActiveRegion = function (fetch_local, callback) {
            
        };

        Plugin_geo.allActiveProvince = function (fetch_local, region_code, callback) {
            
        };

        Plugin_geo.allActiveCity = function (fetch_local, province_code, callback) {
            
        };

        Plugin_geo.allActiveBarangay = function (fetch_local, city_code, callback) {
            
        };

        Plugin_geo.allActiveCityWithProvice = function (fetch_local, callback) {
            const local = localStorage.getItem("allActiveCityWithProvice");
            if(local && fetch_local) {
                callback(JSON.parse(local));
            }
            else {
                $.get( Plugin_config_file.projects()['env_api'] + "api/plugin_geography/allActiveCityWithProvice", function (response) {
                    localStorage.setItem("allActiveCityWithProvice", JSON.stringify(response));
                    callback(response);
                });
            }
        };

        return Plugin_geo;
	};

	if(typeof(Plugin_geo) === 'undefined'){
		window.Plugin_geo = PluginGeo();
	}
}) (window);
