
(function (window) {
	'use strict'
	function PluginPhotos() {

        var Plugin_photos   = {};
        var env 			= 'local';
		var env_api 		= '';
		var env_local 		= 'http://127.0.0.1:8000/';
		var env_live 		= 'https://mcrichtravel.com/partition-api/v2/public/';

        if(env == 'live') {
			env_api = env_live;
		}
		else {
			env_api = env_local;
		}

        Plugin_photos.convert = function (photo_refid) {
            $.get( env_api + "api/plugin_photo/saveInfoTemp?reference_id="+ photo_refid +"&filepath=filepath&tagged=tagged&user_refid=", function (response) {
				callback(response);
			});
        }
        return Plugin_photos;
	};

	if(typeof(Plugin_photos) === 'undefined'){
		window.Plugin_photos = PluginPhotos();
	}
}) (window);
