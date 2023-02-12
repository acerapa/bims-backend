/*

Requirements:

<script type="text/javascript" src="js/query.js"></script>
<script type="text/javascript" src="js/sweetalert2@11.js"></script>

*/

function authVerify(token, otp) {
	

	var args = {
		token: token,
		otp: otp
	};

	showLoading();
	$.get( gv.api + "api/plugin_email_pass_auth_otp/verifyOTP?" + $.param(args) , function (response) {
		hideLoading();

		if(response.success) {
			localStorage.setItem("mc-admin-user-data", JSON.stringify(response.credential));
			localStorage.setItem("mc-admin-token", response.reference_id);
			window.location.href = "./home.php";
		}
		else {
			Swal.fire({
			  title: 'Warning!',
			  text: 'Incorrect or expired OTP Code',
			  icon: 'warning',
			  confirmButtonText: 'OK'
			});
		}

	});

}

function authOnReopen(token, user_refid, callback) {

	var args = {
		token: token,
		user_refid: user_refid,
		device: window.navigator.userAgent
	};

	showLoading();
	$.get( gv.api + "api/plugin_email_pass_auth_otp/authOnReopen?" + $.param(args), function (response) {
		hideLoading();
		callback(response);
	});
}

function auth(param, callback) {
	showLoading();
	param = param + "&device=" + window.navigator.userAgent;
	$.get( gv.api + "api/plugin_email_pass_auth_otp/authenticate?" + param, function (response) {
		hideLoading();
		if(response.success) {
			callback(response);
		}
		else {
			Swal.fire({
			  title: 'Warning!',
			  text: 'Incorrect email or password',
			  icon: 'warning',
			  confirmButtonText: 'OK'
			});
		}
	});
}