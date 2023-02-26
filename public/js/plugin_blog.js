
(function (window) {
	'use strict'
	function PluginBlog() {

        var Plugin_blog     = {};
        var env_api 		=  Plugin_config_file.projects()['env_api_multi_purpose'];

		Plugin_blog.saveTemp = function (callback) {

		};

		Plugin_blog.create = function (callback) {

		};

		Plugin_blog.getSingle = function (fetch_local, blog_refid, callback) {
			var local = Plugin_storage.getItem('blog-detail-'+blog_refid);
			if((fetch_local) && (local)) {
				callback(local);
			}
			else {
				$.get( env_api + "api/plugin_blog/getSingle?blog_refid="+ blog_refid, function (response) {
					Plugin_storage.setItem('blog-detail-'+blog_refid, response, 'MIN_30');
					callback(response);
				});
			}
        }

        Plugin_blog.getPaginate = function (fetch_local, category_refid, page, callback) {
			var local = Plugin_storage.getItem('blogs-'+category_refid+"-"+page);
			if((fetch_local) && (local)) {
				callback(local);
			}
			else {
				$.get( env_api + "api/plugin_blog/getPaginate?category_refid="+ category_refid +"&page=" + page, function (response) {
					Plugin_storage.setItem('blogs-'+category_refid+"-"+page);
					callback(response);
				});
			}
        }
        return Plugin_blog;
	};

	if(typeof(Plugin_blog) === 'undefined'){
		window.Plugin_blog = PluginBlog();
	}
}) (window);
