
(function (window) {
	'use strict'
	function PluginGeo() {
        var Plugin_geo   = {};

        Plugin_geo.allRegion = function () {
            
        };

        Plugin_geo.allProvince = function (region_code) {
            
        };

        Plugin_geo.allCity = function (province_code) {
            
        };

        Plugin_geo.allBarangay = function (city_code) {
            
        };

        Plugin_geo.allActiveRegion = function () {
            
        };

        Plugin_geo.allActiveProvince = function (region_code) {
            
        };

        Plugin_geo.allActiveCity = function (province_code) {
            
        };

        Plugin_geo.allActiveBarangay = function (city_code) {
            
        };

        Plugin_geo.allActiveCityWithProvice = function () {
            $.get( Plugin_config_file.projects()['env_api'] + "api/plugin_geography/allActiveCityWithProvice", function (response) {
                callback(response);
            });
        };

        return Plugin_geo;
	};

	if(typeof(Plugin_geo) === 'undefined'){
		window.Plugin_geo = PluginGeo();
	}
}) (window);
