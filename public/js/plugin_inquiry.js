
(function (window) {
	'use strict'
	function PluginInquiry() {

        var Plugin_inquiry   = {};
        var env 			= 'local';
		var env_api 		= '';
		var env_local 		= 'http://127.0.0.1:8000/';
		var env_live 		= Plugin_config_file.projects()['env_api_multi_purpose'];

        if(env == 'live') {
			env_api = env_live;
		}
		else {
			env_api = env_local;
		}

        Plugin_inquiry.send = function (photo_refid) {
            $.get( env_api + "", function (response) {
				callback(response);
			});
        }
        return Plugin_inquiry;
	};

	if(typeof(Plugin_inquiry) === 'undefined'){
		window.Plugin_inquiry = PluginInquiry();
	}
}) (window);
