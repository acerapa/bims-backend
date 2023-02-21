
(function (window) {
	'use strict'
	function PluginBlog() {

        var Plugin_blog     = {};
        var env_api 		=  Plugin_config_file.projects()['env_api_multi_purpose'];

		Plugin_blog.getSingle = function (blog_refid, callback) {
            $.get( env_api + "api/plugin_blog/getSingle?blog_refid="+ blog_refid, function (response) {
				callback(response);
			});
        }

        Plugin_blog.getPaginate = function (category_refid, page, callback) {
            $.get( env_api + "api/plugin_blog/getPaginate?category_refid="+ category_refid +"&page=" + page, function (response) {
				callback(response);
			});
        }
        return Plugin_blog;
	};

	if(typeof(Plugin_blog) === 'undefined'){
		window.Plugin_blog = PluginBlog();
	}
}) (window);
