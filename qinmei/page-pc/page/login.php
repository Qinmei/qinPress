<?php get_header(); ?>
<?php wp_head();?>

<style>
	html{
		background-color: rgba(0,0,0,0.1);
	}
	main{
		background-color: rgba(0,0,0,0.1);
	}
	.form-group{
		width: 100%;
		margin-bottom: 20px !important;
	}
	.form-control-pc{
		width: 100%;
		padding: 7px 10px;
    	border-radius: 4px;
    	border: solid 1px rgba(0,0,0,0.3);
	}
	.form-control{
		width: 100%;
		padding: 7px 10px;
    	border-radius: 4px;
    	border: solid 1px rgba(0,0,0,0.3);
	}
	.form-control:focus{
		border: solid 1px rgba(0,0,0,0.3);
		box-shadow: none;
	}
	.form-group input:focus{

	}
	#rememberme{
		width: 20px !important;
	}
	#wp-submit,#btn-register{
		background-color: rgba(0,0,0,0.8);
		border: none;
	}
	#btn-resetpassword{
		width: 100%;
		background-color: rgba(0,0,0,0.8);
		border: none;
	}
	.xh-regbox .xh-form-group{
		margin-bottom: 20px;
	}
	.alert {
	    padding: 5px 10px;
	    margin-bottom: 10px;
	    border: 1px solid transparent;
	    border-radius: 4px;
	}
	.login-show,.register-show,.reset-show{
		cursor: pointer;
	}
	.login-right-page-con{
		height: 100%;
	    padding: 0 30px;
	    display: flex;
	    flex-direction: column;
	    justify-content: center;
	    align-items: center;
	}
	.xh-regbox{
		border:none;
		width: 100%;
	}

	.xh-regbox .xh-title {
	    margin-bottom: 60px;
	    font-weight: bold;
	    font-size: 2em;
	}
	.xh-regbox .xh-btn-primary {
	    margin-top: 30px;
	}
</style>

<?php if (have_posts()) : the_post(); update_post_caches($posts); ?>
<div class="container">
<div class="row">
<div class="col-md-12" style="padding: 0 30px;">
	<div class="login-panel" style="background-image: url(<?php bloginfo('template_url'); ?>/images/login.jpg)">
		<div class="login-right-con">
			<div class="login-right">
				<div class="login-right-img"></div>
				<div class="login-right-page">
					<div class="login-right-page-con">
						<?php the_content();?>
						<div class="text-link">
						    <a class="login-show" href="/register">注册</a>｜<a class="register-show" href="/reset">忘记密码</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>



<?php else : ?>
  <?php endif; ?>
<?php wp_footer();?>
<?php get_footer(); ?>
