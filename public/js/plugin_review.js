
(function (window) {
	'use strict'
	function PluginReview() {

        var Plugin_review   = {};
        var env 			= 'local';
		var env_api 		= '';
		var env_local 		= 'http://127.0.0.1:8000/';
		var env_live 		= 'https://mcrichtravel.com/partition-api-multi-purpose/version-1/public/';

        if(env == 'live') {
			env_api = env_live;
		}
		else {
			env_api = env_local;
		}

        Plugin_review.create = function (reference_id, tag_primary, name, photo, score, hightlight, comment, other, taglist, callback) {
            $.get( env_api + "api/plugin_review/create?reference_id="+ reference_id +"&tag_primary="+ tag_primary +"&name="+ name +"&photo="+ photo +"&score="+ score +"&hightlight="+ hightlight +"&comment=" + comment + "&other="+ other +"&taglist=" + taglist, function (response) {
				callback(response);
			});
        }

		Plugin_review.getScore = function (tag_primary, callback) {
			$.get( env_api + "api/plugin_review/getScore/" + tag_primary, function (response) {
				callback(response);
			});
		};

        return Plugin_review;
	};

	if(typeof(Plugin_review) === 'undefined'){
		window.Plugin_review = PluginReview();
	}
}) (window);
