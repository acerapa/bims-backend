
(function (window) {
	'use strict'
	function PluginConfigFile() {

        var Plugin_config_file  = {};
        var env 			    = 'local';
		var env_api 		    = '';
		var env_local 		    = 'http://127.0.0.1:8000/';
		var env_live 		    = 'https://mcrichtravel.com/partition-api-multi-purpose/version-1/public/';

        if(env == 'live') {
			env_api = env_live;
		}
		else {
			env_api = env_local;
		}

        Plugin_config_file.projects = function () {
            const hostname = window.location.hostname;
            if((hostname == 'localhost') || (hostname == '127.0.0.1')) {
                return {
                    'domain': 'localhost/',
                    'env_api': 'http://127.0.0.1:8000/',
                    'env_api_multi_purpose': 'http://127.0.0.1:8000/',
                    'fileserver':'localhost/'
                };
            }
            else if(hostname == 'mcrichtravel.com') {
                return {
                    'domain': 'https://mcrichtravel.com/',
                    'env_api': 'https://mcrichtravel.com/partition-api/v2/public/',
                    'env_api_multi_purpose': 'https://mcrichtravel.com/partition-api-multi-purpose/version-1/public/',
                    'fileserver':'https://mcrichtravel.com/partition-file/'
                };
            }
            else if(hostname == 'deanleifproperties.com') {
                return {
                    'domain': 'https://deanleifproperties.com/',
                    'env_api': 'https://deanleifproperties.com/partition-api/v2/public/',
                    'env_api_multi_purpose': 'https://deanleifproperties.com/partition-api-multi-purpose/version-1/public/',
                    'fileserver':'https://deanleifproperties.com/partition-file'
                };
            }
            else if(hostname == 'foxcityph.tech') {
                return {
                    'domain': 'https://foxcityph.tech/',
                    'env_api': 'https://foxcityph.tech/dataserver/version-46/public/',
                    'env_api_multi_purpose': 'https://foxcityph.tech/dataserver-multi-purpose/version-1/public/',
                    'fileserver':'https://foxcityph.tech/fileserver/'
                };
            }
            else {
                return {
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
                return JSON.parse(local);
            }
            else {
                $.get( env_api + "api/plugin_config/file/" + filepath, function (response) {
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
