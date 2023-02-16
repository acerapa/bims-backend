
(function (window) {
	'use strict'
	function PluginReview() {

        var Plugin_review   = {};
        var env 			= 'local';
		var env_api 		= '';
		var env_local 		= 'http://127.0.0.1:8000/';
		var env_live 		=  window.location.origin + '/partition-api/v1/public/';

        if(env == 'live') {
			env_api = env_live;
		}
		else {
			env_api = env_local;
		}

        Plugin_review.create = function (reference_id, name, photo, score, hightlight, comment, taglist, callback) {
            $.get( env_api + "api/plugin_review/create?reference_id="+ reference_id +"&name="+ name +"&photo="+ photo +"&score="+ score +"&hightlight="+ hightlight +"&comment=" + comment + "&taglist=" + taglist, function (response) {
				callback(response);
			});
        }
        return Plugin_review;
	};

	if(typeof(Plugin_review) === 'undefined'){
		window.Plugin_review = PluginReview();
	}
}) (window);
