
(function (window) {
	'use strict'
	function PluginUser() {

        var Plugin_user = {};

        Plugin_user.updateBasic = function (user_refid, firstname, lastname, address, mobile, email, callback) {
            if(user_refid == '') {
                callback({ success: false, message: 'User reference number is undefined' });
            }
            else if(firstname == '') {
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
