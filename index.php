<?php   
global $wpdb,$user_ID;   
  
if (!$user_ID) { //判断用户是否登录   
    if($_POST){ //数据提交   
	    //We shall SQL escape all inputs   
	    $username = $wpdb->escape($_REQUEST['username']);   
	    $password = $wpdb->escape($_REQUEST['password']);   
	    $remember = $wpdb->escape($_REQUEST['rememberme']);   
	       
	    if($remember){   
	        $remember = "true";   
	    } else {   
	        $remember = "false";   
	    }   
	    $login_data = array();   
	    $login_data['user_login'] = $username;   
	    $login_data['user_password'] = $password;   
	    $login_data['remember'] = $remember;   
	    $user = wp_signon( $login_data, false );    

	           
	    if ( is_wp_error($user) ) {    
	        echo "<span class='error'>用户名或密码错误，请重试!</span>";
	        exit();   
	    } else { 
	    	 wp_clear_auth_cookie(); 
		     do_action('wp_login', $user->ID); 
		     wp_set_current_user($user->ID); 
		     wp_set_auth_cookie($user->ID, true); 
	    	if( current_user_can( 'delete_pages' ) ){
	    		echo "<span>登录成功<span><script type='text/javascript'>window.location='". site_url('/wp-admin') ."'</script>";   
	        	exit();  
	    	}else{
	    		echo "<span>即将跳转<span><script type='text/javascript'>window.location='". get_bloginfo('url') ."'</script>";  
	        }
	    }   
	} else {   
  
	?>   
	<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Qinmei</title>
		<link rel="stylesheet" href="//at.alicdn.com/t/font_726734_euokevd6tze.css">
		<style>
			*{
				margin:0;
				padding: 0;
			}
			html{
				width: 100vw;
				height: 100vh;
				background-image: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
			}
			#container{
				width: 90%;
				max-width: 25rem;
				height: 25rem;
				background-color: white;
				border-radius: 0.5rem;
				margin: 5rem auto;
				padding: 2rem;
				box-sizing: border-box;
			}
			#content{
				width: 100%;
				height: 100%;
				display: flex;
				flex-direction: column;
				justify-content: flex-start;
				align-items: center;
			}
			#content h3 i{
				font-size: 1.2rem;
				color:#17233d;
			}
			#result{
				height: 5rem;
				width: 20rem;
				display: flex;
				justify-content: center;
				align-items: center;
			}
			#result div{
				padding: 0.5rem 1rem;
				background-color: #ff9900;
				color: white;
				border-radius: 5px;
				width: 100%;
				text-align: center;
			}
			#wp_login_form{
				width: 20rem;
			}
			#wp_login_form .text{
				height: 2.5rem;
				width: 100%;
				border: none;
				margin-bottom: 1rem;
				padding: 0 1rem;
				box-sizing: border-box;
				border: 1px solid #DCDEE0;
				border-radius: 5px;

			}
			#wp_login_form .text:focus{
				outline: none;
				border: 1px solid #2b85e4;
			}
			#wp_login_form #rememberme{
				margin-bottom: 1rem;
			}
			#wp_login_form #submitbtn{
				background-color: #1e88e5;
				border: none;
				color: white;
			}
		</style>
	</head>
	<body>
		<div id="container">   
			<div id="content">   
				<h3><i class="iconfont icon-qinmei"></i></h3>   
				<div id="result"></div>
				<form id="wp_login_form" action="" method="post">   

					<input type="text" name="username" class="text" value="" placeholder="用户名" /><br />   

					<input type="password" name="password" class="text" value="" placeholder="密码" /> <br />   
					<label>   
					<input name="rememberme" id="rememberme" type="checkbox" value="forever" />记住我</label>   

					<input type="submit" id="submitbtn" name="submit" class="text" value="登 录" />   
				</form>   
				<script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.min.js"></script>
				<script type="text/javascript">                   
				$("#submitbtn").click(function() {   
					
					var input_data = $('#wp_login_form').serialize();   
					$.ajax({   
						type: "POST",   
						url:  "<?php echo  $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>",   
						data: input_data,   
						success: function(msg){   
							$('#result').empty();
							$('<div>').html(msg).appendTo('div#result').hide().fadeIn('slow');   
						}   
					});   
					 
				  return false;  
				});   
				</script>   
			  
			</div>   
		</div>
	</body>
	</html>   
	<?php   
	       
	}   
  
}else { //跳转到首页  
	if( current_user_can( 'delete_pages' ) ){
	    echo "<script type='text/javascript'>window.location='". site_url('/wp-admin/') ."'</script>"; 
	    exit();  
	}else{
    	echo "<script type='text/javascript'>window.location='". get_bloginfo('url') ."'</script>";  		
	} 
 
}   
?>  
