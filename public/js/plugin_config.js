
(function (window) {
	'use strict'
	function PluginConfigFile() {

        var Plugin_config_file  = {};
		var env_api 		    = window.location.origin + '/partition-api/v1/public/';

        Plugin_config_file.assetsJS = function () {
            //Automatically add the js file to project mete data
        };

        Plugin_config_file.projects = function () {
            const hostname = window.location.hostname;
            if((hostname == 'localhost') || (hostname == '127.0.0.1')) {
                return {
                    'env': 'local',
                    'domain': 'localhost/',
                    'env_api': 'http://127.0.0.1:8000/',
                    'env_api_multi_purpose': 'http://127.0.0.1:8000/',
                    'fileserver':'localhost/'
                };
            }
            else if(hostname == 'mcrichtravel.com') {
                return {
                    'env': 'live',
                    'domain': 'https://mcrichtravel.com/',
                    'env_api': 'https://mcrichtravel.com/partition-api/v2/public/',
                    'env_api_multi_purpose': 'https://mcrichtravel.com/partition-api-multi-purpose/version-3/public/',
                    'fileserver':'https://mcrichtravel.com/partition-file/'
                };
            }
            else if(hostname == 'deanleifproperties.com') {
                return {
                    'env': 'live',
                    'domain': 'https://deanleifproperties.com/',
                    'env_api': 'https://deanleifproperties.com/partition-api-multi-purpose/version-2/public/',
                    'env_api_multi_purpose': 'https://deanleifproperties.com/partition-api-multi-purpose/version-2/public/',
                    'fileserver':'https://deanleifproperties.com/partition-file'
                };
            }
            else if(hostname == 'foxcityph.tech') {
                return {
                    'env': 'live',
                    'domain': 'https://foxcityph.tech/',
                    'env_api': 'https://foxcityph.tech/dataserver/version-46/public/',
                    'env_api_multi_purpose': 'https://foxcityph.tech/dataserver-multi-purpose/version-1/public/',
                    'fileserver':'https://foxcityph.tech/fileserver/'
                };
            }
            else if(hostname == 'flipcard.fun') {
                return {
                    'env': 'live',
                    'domain': 'https://flipcard.fun/',
                    'env_api': 'https://flipcard.fun/',
                    'env_api_multi_purpose': 'https://flipcard.fun/partition-api-multi-purpose/version-1/public/',
                    'fileserver':'https://flipcard.fun/fileserver/'
                };
            }
            else {
                return {
                    'env': 'local',
                    'domain': 'localhost/',
                    'env_api': 'http://127.0.0.1:8000/',
                    'env_api_multi_purpose': 'http://127.0.0.1:8000/',
                    'fileserver':'localhost/'
                };
            }
        };

        Plugin_config_file.file = function (filepath, fetch_local, callback) {
            var local = localStorage.getItem("config-file-" + filepath);
            if((local) && (fetch_local)) {
                callback(JSON.parse(local));
            }
            else {
                $.get( Plugin_config_file.projects()['env_api'] + "api/plugin_config/file/" + filepath, function (response) {
                    localStorage.setItem("config-file-" + filepath, JSON.stringify(response));
                    callback(response);
                });
            }
		};

        return Plugin_config_file;
	};

	if(typeof(Plugin_config_file) === 'undefined'){
		window.Plugin_config_file = PluginConfigFile();
	}
}) (window);
