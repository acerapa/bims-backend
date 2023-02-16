
(function (window) {
	'use strict'
	function PluginPhotos() {

        var Plugin_photos   = {};
		var env_api 		=  Plugin_config_file.projects()['env_api_multi_purpose'];

        if(env == 'live') {
			env_api = env_live;
		}
		else {
			env_api = env_local;
		}

        Plugin_photos.saveInfoTemp = function (photo_refid, filepath, tagged, user_refid, callback) {
            $.get( env_api + "api/plugin_photo/saveInfoTemp?reference_id="+ photo_refid +"&filepath="+ filepath +"&tagged="+ tagged +"&user_refid=" + user_refid, function (response) {
				callback(response);
			});
        }
        return Plugin_photos;
	};

	if(typeof(Plugin_photos) === 'undefined'){
		window.Plugin_photos = PluginPhotos();
	}
}) (window);
