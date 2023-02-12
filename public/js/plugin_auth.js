
(function (window) {
	'use strict'
	function PluginAuth() {

        var Plugin_auth = {};
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

        return Plugin_auth;
	};

	if(typeof(Plugin_auth) === 'undefined'){
		window.Plugin_auth = PluginAuth();
	}
}) (window);
