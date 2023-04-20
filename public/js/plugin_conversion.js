
(function (window) {
	'use strict'
	function PluginConversion() {

        var Plugin_convert      = {};
        var env_api 		    = Plugin_config_file.projects()['env_api_multi_purpose'];

        Plugin_convert.hashAlgos = function (callback) {
            $.get( env_api + "api/plugin_conversion/hash_algos", function (response) {
                callback(response);
            });
        };

        Plugin_convert.hashAlgos = function (algo, string, callback) {
            $.get( env_api + "api/plugin_conversion/hash_convert/" + algo + "/" + string, function (response) {
                callback(response);
            });
        };

        Plugin_convert.stringToBase64Encode = function (string, callback) {
            $.get( env_api + "api/plugin_conversion/string_to_base64_decode/" + string, function (response) {
                callback(response);
            });
        };

        Plugin_convert.stringToBase64Encode = function (string, callback) {
            $.get( env_api + "api/plugin_conversion/string_to_base64_encode/" + string, function (response) {
                callback(response);
            });
        };

        return Plugin_convert;
	};

	if(typeof(Plugin_convert) === 'undefined'){
		window.Plugin_convert = PluginConversion();
	}
}) (window);
