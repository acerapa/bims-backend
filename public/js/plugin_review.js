
(function (window) {
	'use strict'
	function PluginReview() {

        var Plugin_review   = {};
		var env_api 		= Plugin_config_file.projects()['env_api_multi_purpose'];

        Plugin_review.create = function (reference_id, tag_primary, name, photo, score, hightlight, comment, attachment, other, taglist, callback) {
            $.get( env_api + "api/plugin_review/create?reference_id="+ reference_id +"&tag_primary="+ tag_primary +"&name="+ name +"&photo="+ photo +"&score="+ score +"&hightlight="+ hightlight +"&comment=" + comment + "&attachment="+ attachment +"&other="+ other +"&taglist=" + taglist, function (response) {
				callback(response);
			});
        }

		Plugin_review.getScore = function (tag_primary, callback) {
			$.get( env_api + "api/plugin_review/getScore/" + tag_primary, function (response) {
				callback(response);
			});
		};

		Plugin_review.getScoreRecalculate = function (tag_refid, tag_table, tag_whereClm, tag_whereVal, callback) {
			$.get( env_api + "api/plugin_review/calculate?tag_refid="+ tag_refid +"&table="+ tag_table +"&whereClm="+ tag_whereClm +"&whereVal="+tag_whereVal, function (response) {
				callback(response);
			});
		};

		Plugin_review.sortByDropdown = function (elem) {
			const sort = [
				{ code: 'recomended', label: 'Recomended'},
				{ code: 'most_recent', label: 'Most recent'},
				{ code: 'oldest', label: 'Oldest'},
				{ code: 'highest_rated', label: 'Highest rated'},
				{ code: 'lowest_rated', label: 'Lowest rated'}
			];
			
			$(elem).html('');
			for(let i = 0; i < sort.length; i++) {
				$(elem).append(`<option value='` + sort[i]['code'] + `'>` + sort[i]['label'] + `</option>`);
			}
		};

		Plugin_review.getFilteredReview = function (tag_primary, sort_by, page, callback) {
			$.get( env_api + "api/plugin_review/getFilteredReview?tag_primary="+ tag_primary +"&sort_by="+ sort_by +"&page=" + page, function (response) {
				callback(response);
			});
		};

        return Plugin_review;
	};

	if(typeof(Plugin_review) === 'undefined'){
		window.Plugin_review = PluginReview();
	}
}) (window);
