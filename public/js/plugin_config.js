
(function (window) {
	'use strict'
	function PluginConfigFile() {

        var Plugin_config_file  = {};
        var env 			    = 'local';
		var env_api 		    = '';
		var env_local 		    = 'http://127.0.0.1:8000/';
		var env_live 		    = window.location.origin + '/partition-api/v1/public/';

        if(env == 'live') {
			env_api = env_live;
		}
		else {
			env_api = env_local;
		}

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
