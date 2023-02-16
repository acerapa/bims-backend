
(function (window) {
	'use strict'
	function PluginAuth() {

        var Plugin_auth     = {};
		var env_api 		=  Plugin_config_file.projects()['env_api_multi_purpose'];

        Plugin_auth.authBasic = function (email, password, callback) {
            const device = window.navigator.userAgent;
            if(email == '') {
                Swal.fire('Required','Email is required','warning');
            }
            else if(password == '') {
                Swal.fire('Required','Password is required','warning');
            }
            else {
                $.get( env_api + "api/plugin_email_pass_auth_otp/authBasic?email="+ email +"&password="+ password +"&device=" + device + "&datetime=" + Plugin_datetime.getDateTime(), function (response) {
                    if(response.success) {
                        localStorage.setItem("user-data", JSON.stringify(response['user_data']));
                        localStorage.setItem("user-token", JSON.stringify(response['token']));
                        callback(response);
                    }
                    else {
                        Swal.fire('Incorrect', response['message'],'warning');
                    }
                });
            }
		};

        Plugin_auth.getLocalUser = function () {
            const local = localStorage.getItem("user-data");
            if(local) {
                return JSON.parse(local);
            }
            else {
                return null;
            }
        };

        Plugin_auth.getLocalUserToken = function () {
            const local = localStorage.getItem("user-token");
            if(local) {
                return local;
            }
            else {
                return null;
            }
        }

        Plugin_auth.logout = function (callback) {
            const token = localStorage.getItem("user-token");
            if(token) {
                $.get( env_api + "api/plugin_email_pass_auth_otp/authLogout/" + JSON.parse(token), function (response) {
                    callback(response);
                });
            }
            else {
                console.error("Access token is undefined");
            }
        };

        return Plugin_auth;
	};

	if(typeof(Plugin_auth) === 'undefined'){
		window.Plugin_auth = PluginAuth();
	}
}) (window);
