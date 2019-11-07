<?php

	add_action( 'rest_api_init', function () {
	  register_rest_route( 'wp/v2', 'users/register', array(
	    'methods' => 'post',
	    'callback' => 'register_user',
	  ) );
	});

	add_action( 'rest_api_init', function () {
		register_rest_route('wp/v2', 'users/lostpassword', array(
			'methods' => 'post',
			'callback' => 'lost_password',
		));
	});

	add_action( 'rest_api_init', function () {
		register_rest_route('wp/v2', 'users/validate_key', array(
			'methods' => 'post',
			'callback' => 'validate_key',
		));
	});


	function register_user($request = null) {

		$response = array();
		$parameters = $request->get_json_params();
		$username = sanitize_text_field($parameters['username']);
		$email = sanitize_text_field($parameters['email']);
		$password = sanitize_text_field($parameters['password']);
		$role = sanitize_text_field($parameters['role']);
		$error = new WP_Error();

		if (empty($username)) {
			$error->add(400, __("Username field 'username' is required.", 'wp-rest-user'), array('status' => 400));
			return $error;
		}
		if (empty($email)) {
			$error->add(401, __("Email field 'email' is required.", 'wp-rest-user'), array('status' => 400));
			return $error;
		}
		if (empty($password)) {
			$error->add(404, __("Password field 'password' is required.", 'wp-rest-user'), array('status' => 400));
			return $error;
		}
		if (empty($role)) {
			// WooCommerce specific code
			if (class_exists('WooCommerce')) {
				$role = 'customer';
			} else {
				$role = 'subscriber';
			}
		} else {
			if ($GLOBALS['wp_roles']->is_role($role)) {
				if ($role == 'administrator' || $role == 'Editor' || $role == 'Author') {
					$error->add(406, __("Role field 'role' is not a permitted. Only 'contributor', 'subscriber' and your custom roles are allowed.", 'wp_rest_user'), array('status' => 400));
					return $error;
				} else {
					// Silence is gold
				}
			} else {
				$error->add(405, __("Role field 'role' is not a valid. Check your User Roles from Dashboard.", 'wp_rest_user'), array('status' => 400));
				return $error;
			}
		}

		$user_id = username_exists($username);
		if (!$user_id && email_exists($email) == false) {
			$user_id = wp_create_user($username, $password, $email);
			if (!is_wp_error($user_id)) {
				// Ger User Meta Data (Sensitive, Password included. DO NOT pass to front end.)
				$user = get_user_by('id', $user_id);
				$user->set_role($role);
				// $user->set_role('subscriber');

				// Ger User Data (Non-Sensitive, Pass to front end.)
				$response['code'] = 200;
				$response['message'] = __("User '" . $username . "' Registration was Successful", "wp-rest-user");
			} else {
				return $user_id;
			}
		} else if ($user_id) {
			$error->add(406, __("Username already exists, please enter another username", 'wp-rest-user'), array('status' => 400));
			return $error;
		} else {
			$error->add(406, __("Email already exists, please try 'Reset Password'", 'wp-rest-user'), array('status' => 400));
			return $error;
		}

		return new WP_REST_Response($response, 200);
	}

	function lost_password($request = null) {

		$response = array();
		$parameters = $request->get_json_params();
		$user_login = sanitize_text_field($parameters['user_login']);
		$error = new WP_Error();

		if (empty($user_login)) {
			$error->add(400, __("The field 'user_login' is required.", 'wp-rest-user'), array('status' => 400));
			return $error;
		} else {
			$user_id = username_exists($user_login);
			if ($user_id == false) {
				$user_id = email_exists($user_login);
				if ($user_id == false) {
					$error->add(401, __("User '" . $user_login . "' not found.", 'wp-rest-user'), array('status' => 400));
					return $error;
				}
			}
		}
		
      	$pattern = "/\.com$/";
        if(preg_match($pattern, $user_login)){
          $userID = get_user_by("email",$user_login);
        }else{
          $userID = get_user_by("login",$user_login);
        }

        $username = $userID->user_login;
      	$emailuser = $userID->user_email;
      
        $key = get_password_reset_key( $userID );

      	$link = home_url( "auth/validate?username=" . rawurlencode( $username ), 'login' );
		$message = '你好,<br />有人为你的账户请求重置密码,您的验证码为：<br /><h3>'.$key.'</h3><br />若不是本人操作请忽略此邮件,若是本人操作请点击下方链接进行重置:<br/><a href="'.$link.'"a>'.$link."</a>";

		$general_options = get_option('ashuwp_general');
		$qinmei_name =  $general_options['qinmei_name'];
      
      	wp_mail($emailuser, '['.$qinmei_name."]密码重置", $message );
      

		$response['code'] = 200;
		$response['message'] = __("Reset Password link had been send to your email.", "wp-rest-user");

		return new WP_REST_Response($response, 200);
	}


	function validate_key($request = null) {
		 global $wpdb;
		$response = array();
		$parameters = $request->get_json_params();
		$key = sanitize_text_field($parameters['key']);
		$user_login = sanitize_text_field($parameters['user_login']);
		$user_password = sanitize_text_field($parameters['user_password']);

		if ( empty( $key ) || !is_string( $key ) ){
			$response['code'] = 402;
			$response['message'] = __("密钥为空", "wp-rest-user"); 

			return new WP_REST_Response($response, 200);
		}

	    if ( empty($user_login) || !is_string($user_login) ){
	    		        $response['code'] = 401;
			$response['message'] = __("用户名为空", "wp-rest-user");
		return new WP_REST_Response($response, 200);
	    }

		if ( empty($user_password) || !is_string($user_password) ){
				        $response['code'] = 403;
			$response['message'] = __("密码为空", "wp-rest-user");	
		return new WP_REST_Response($response, 200);
		}


		$user_data = check_password_reset_key($key, $user_login);
    	if ( !empty($key) && !empty($user_data->ID) ){

    		$pattern = "/\.com$/";

	        if(preg_match($pattern, $user_login)){
	          $userID = get_user_by("email",$user_login);
	        }else{
	          $userID = get_user_by("login",$user_login);
	        }

	        wp_set_password( $user_password, $username = $userID->ID );

	    	$response['code'] = 200;
			$response['message'] = __("重置成功", "wp-rest-user");
			return new WP_REST_Response($response, 200);
    	}else{
    		$response['code'] = 400;
			$response['message'] = __("登录失败", "wp-rest-user");
			return new WP_REST_Response($response, 400);

    	}
	
	}
