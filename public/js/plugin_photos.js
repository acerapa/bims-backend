
(function (window) {
	'use strict'
	function PluginPhotos() {

        var Plugin_photos   = {};
		var env_api 		=  Plugin_config_file.projects()['env_api_multi_purpose'];

		Plugin_photos.saveInfoVerify = function (photo_refid, filename, description, callback) {
            $.get( env_api + "plugin_photo/saveInfoVerify?reference_id="+ photo_refid +"&filename="+ filename +"&description=" + description, function (response) {
				callback(response);
			});
        }

		Plugin_photos.tagFixer = function (callback) {
            $.get( env_api + "plugin_photo/tagFixer", function (response) {
				callback(response);
			});
        }

		Plugin_photos.getPhotos = function (fetch_local, tag_refid, page, row_per_page, order_by_clm, order_by_sort, callback) {
            $.get( env_api + "plugin_photo/getPhotos?tagged="+ tag_refid +"&page="+ page +"&row_per_page="+ row_per_page +"&orderByColumn="+ order_by_clm +"&orderBySort=" + order_by_sort, function (response) {
				callback(response);
			});
        }

		Plugin_photos.photoTagging = function (photo_refid, tag_refid, user_refid, callback) {
            $.get( env_api + "plugin_photo/photoTagging/"+ photo_refid +"/"+ tag_refid +"/" + user_refid, function (response) {
				callback(response);
			});
        }

		Plugin_photos.removeTag = function (photo_refid, tag_refid, callback) {
            $.get( env_api + "plugin_photo/removeTag/"+ photo_refid + "/" + tag_refid, function (response) {
				callback(response);
			});
        }

		Plugin_photos.delete = function (photo_refid, callback) {
            $.get( env_api + "plugin_photo/delete/" + photo_refid, function (response) {
				callback(response);
			});
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
