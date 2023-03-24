
(function (window) {
	'use strict'
	function PluginUser() {

        var Plugin_user     = {};
        var env_api 		= Plugin_config_file.projects()['env_api_multi_purpose'];

        Plugin_user.getProfile = function (user_refid, callback) {
            $.get( env_api + "api/plugin_user/getProfile/" + user_refid, function (response) {
                callback(response);
            });
        };

        Plugin_user.changePassword = function (user_refid, current_pass, new_pass, confirm_pass, callback) {
            if(current_pass == '') {
                callback({ success: false, message: 'Please provide the current password to continue.' });
            }
            else if(new_pass == '') {
                callback({ success: false, message: 'Please provide your new password' });
            }
            else if(confirm_pass == '') {
                callback({ success: false, message: 'Please confirm your new password' });
            }
            else if(new_pass !== confirm_pass) {
                callback({ success: false, message: "New password and confirmation password doesn't match." });
            }
            else {
                var uri = env_api + "api/plugin_user/changePassword?user_refid="+ user_refid +"&current_pass=" + current_pass + "&new_pass=" + new_pass + "&confirm_pass=" + confirm_pass
                $.get( uri, function (response) {
                    callback(response);
                });
            }
        };

        Plugin_user.updateBasic = function (user_refid, firstname, lastname, address, mobile, email, callback) {

            if(firstname == '') {
                callback({ success: false, message: 'First name is required' });
            }
            else if(lastname == '') {
                callback({ success: false, message: 'Last name is required' });
            }
            else if(address == '') {
                callback({ success: false, message: 'Address is required' });
            }
            else if(mobile == '') {
                callback({ success: false, message: 'Mobile number is required' });
            }
            else if(email == '') {
                callback({ success: false, message: 'Email is required' });
            }
            else {
                const args = {
                    table: 'plugin_user',
                    where: [
                        ['reference_id','=', user_refid]
                    ],
                    update: [
                        {"firstname": firstname},
                        {"lastname": lastname},
                        {"address": address},
                        {"mobile": mobile},
                        {"email": email},
                    ]
                };
                var uri 	= env_api + "api/plugin_query/editMultiple?" + $.param(args);
                $.get( uri, function (response) {
                    callback(response);
                });
            }
		};

        return Plugin_user;
	};

	if(typeof(Plugin_user) === 'undefined') {
		window.Plugin_user = PluginUser();
	}
}) (window);
