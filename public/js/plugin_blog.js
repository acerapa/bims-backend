
(function (window) {
	'use strict'
	function PluginBlog() {

        var Plugin_blog     = {};
        var env_api 		=  Plugin_config_file.projects()['env_api_multi_purpose'];

		Plugin_blog.saveTemp = function (reference_id, title, subject, cover, content) {
			Plugin_storage.setItem("blog-form-data-temp", { reference_id: reference_id, title: title, subject: subject, cover: cover, content: content}, 28800000);
		};

		Plugin_blog.getTemp = function () {
			const temp = Plugin_storage.getItem("blog-form-data-temp");
			if(temp) {
				return temp;
			}
			else {
				return { reference_id: '', title: '', subject: '', cover: [], content: '' };
			}
		};

		Plugin_blog.create = function (reference_id, title, subject, cover, content, callback) {

			if(reference_id == '') {
				callback({
					success: false,
					message: 'Reference Number is required'
				});
			}
			else if(title == '') {
				callback({
					success: false,
					message: 'Blog title is required'
				});
			}
			else if(subject == '') {
				callback({
					success: false,
					message: 'Blog subject is required.'
				});
			}
			else if(content == '') {
				callback({
					success: false,
					message: 'Blog content is required.'
				});
			}
			else if(cover == false) {
				callback({
					success: false,
					message: 'Blog cover is required.'
				});
			}
			else {

				var creator = Plugin_auth.getLocalUser()['reference_id'];
				var uri 	= env_api + "api/plugin_blog/create?reference_id="+ reference_id +"&title=" + title + "&subject=" + subject + "&cover=" + cover + "&content=" + content + "&created_by=" + creator;

				if(Plugin_config_file.projects()['env'] == 'local') {
					console.log("Request to:");
					console.log(uri);
				}

				$.get( uri, function (response) {
					callback(response);
				});

			}
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
