<?php if(is_user_logged_in()): ?>
<?php get_header(); ?>
<style>
	  main{
    background-color: rgba(0,0,0,0.03);
  }
  .wp-user-info{
  	width: 400px;
  	height: 100%;
  	padding: 15px;
  }
  .user-info-show{
  	width: 300px;
  	margin-left: auto;
  	margin-right: auto;
  	height: 100%;
	display: flex;
	justify-content: space-around;
	align-items: center;
  }
  .user-info-logo{
  	width: 80px;
  	height: 80px;
  	border-radius: 50%;
  	overflow: hidden;
  }
  .user-info-name{
	margin-left: 20px;
  	height: 120px;
  	display: flex;
  	flex-direction: column;
  	justify-content: space-between;
  	align-items: flex-start;
  	color: rgba(255,255,255,0.8);
  }
  .user-info-name strong{
  	padding: 3px 15px;
  	background-color: rgba(255,255,255,0.4);
  	border-radius: 20px;
  }
  .new-con-panel{
  	border:none;
  	min-height: 40px;
  }
  .wp-user-benefit-main{
  	width:100%;
  }
  .wp-user-benefit-main-list{
    float:left;
  	width:10%;
    height:60px;
    margin:10px 0;
    display:flex;
    flex-direction:column;
    justify-content:space-between;
    align-items:center;
  }
  .wp-user-benefit-main a:nth-child(1) span{color:#ED5756}
  .wp-user-benefit-main a:nth-child(2) span{color:#02A9F5}
  .wp-user-benefit-main a:nth-child(3) span{color:#5560DE}
  .wp-user-benefit-main a:nth-child(4) span{color:#1375F4}
  .wp-user-benefit-main a:nth-child(5) span{color:#FFB600}
  .wp-user-benefit-main a:nth-child(6) span{color:#13C79E}
  .wp-user-benefit-main a:nth-child(7) span{color:#19CBE2}
  .wp-user-benefit-main a:nth-child(8) span{color:#14C69D}
  .wp-user-benefit-main-list span{
  		font-size:1.75em;
  }
  .wp-user-benefit-main-list p{
  	color:#4A4A4A;
  }
  .new-con-panel{
  	margin: 0 15px;
  }
  .grey-bg{
  display:none;
  position:fixed;
  width:100%;
  height:100%;
  left:0;
  top:0;
  background-color:rgba(0,0,0,0.5);
}
.bg-pic{
  width:280px;
  height:320px;
  border-radius:10px;
  position:fixed;
  top:50%;
  left:50%;
  transform:translate(-50%,-60%);
  background-color:white;
}
.bg-pic img{
  width:240px;
  height:240px;
  margin:20px;
}
.bg-pic p{
  text-align:center;
      font-size: 1.2em;
    font-weight: bold;
  color:rgba(0,0,0,0.6);
}
.open-rights{
	width:300px;
	margin: 30px auto 0 auto;
	height: 40px;
	border-radius: 30px;
	background-color: #7B72E9;
	box-shadow: 0 0 20px rgba(123, 114, 233, 0.8);
	color: white;
	text-align: center;
	line-height: 40px;
}
	.usr-benefit-list{
		float: left;
		margin:15px 15px 0 15px;
		width:calc(50% - 30px);
		border-radius:8px;
		display:flex;
		justify-content:space-between;
		align-items:center;
		padding:10px 20px;
	}
	.usr-benefit-list:nth-child(1){
		background-color:#4097de;
		color:#4097de;
	}
	.usr-benefit-list:nth-child(1) .benefit-main-content-text{
		border-top: 5px solid #4097de;
	}
	.usr-benefit-list:nth-child(2){
		background-color:#C33E51;
		color:#C33E51;
	}
	.usr-benefit-list:nth-child(2) .benefit-main-content-text{
		border-top: 5px solid #C33E51;
	}
	.usr-benefit-list:nth-child(3){
		background-color:#51B467;
		color:#51B467;
	}
	.usr-benefit-list:nth-child(3) .benefit-main-content-text{
		border-top: 5px solid #51B467;
	}
	.usr-benefit-list:nth-child(4){
		background-color:#50525E;
		color:#50525E;
	}
	.usr-benefit-list:nth-child(4) .benefit-main-content-text{
		border-top: 5px solid #50525E;
	}
	.benefit-list-icon{
		width:45px;
		height:45px;
		border-radius:50%;
		font-size:25px;
		background-color:rgba(255,255,255,0.5);
		text-align:center;
		line-height:48px;
	}
	.benefit-list-context{
		color:rgba(255,255,255,0.8);
	}
	.benefit-list-context{
		margin:0 10px;
		width: calc(100% - 150px);
	}
	.benefit-list-context span{
		font-size:1.4em;
		font-weight:bold;
	}
	.benefit-list-context p{
	margin-top:5px;
	}
	.benefit-list-status{
		background-color:rgba(255,255,255,0.7);
		border-radius:100px;
		padding:5px 10px 3px 10px;
	}
	.usr-benefit-list-last .benefit-list-icon,.usr-benefit-list-last .benefit-list-status{
		background-color:white;
	}
	.usr-benefit-list-last .benefit-list-context{
		color:white;
	}
	.benefit-main-content{
		position:fixed;
		display: none;
	}
	.grey-bg-pc{
		position:fixed;
		width:100%;
		height:100%;
		left:0;
		top:0;
		z-index: 9;
		background-color:rgba(0,0,0,0.5);
	}
	.benefit-main-content-text{
		position: fixed;
		background-color: white;
		border-radius: 10px;
		z-index: 12;
		width:35%;
		display: flex;
		top:50%;
		transform: translateY(-40%);
		flex-direction: column;
		justify-content: center;
		align-items: center;
		padding: 30px 15px;
		font-size: 1.2em;
		color: #40403c;
		text-align: center;
	}
	.benefit-storage-button{
		width: 100%;
		margin-top: 15px;
		display: flex;
		justify-content: space-around;
		align-items: center;
	}
	.benefit-storage-button a{
		padding: 8px 15px;
		background-color: #4285f4;
		border-radius: 50px;
		color: white;
	}
	.text-many{
		align-items: flex-start;
		text-align: left;
		word-break: break-all;
	}
	.text-many span{
		margin-top: 10px;
		display: inline-block;
		font-size: 0.9em;
		color: #51B467;
		-moz-user-select: text;
		-webkit-user-select: text;
		-ms-user-select: text;
		user-select: text;
	}
	.pc-new-con-txt p{
		margin-top: 10px;
	}
	.user-logout{
		margin: auto;
		margin-top: 10px;
		margin-right: 10px;
		padding: 8px 15px;
		background-color: rgba(0,0,0,0.8);
		color: rgba(255,255,255,0.8);
		border-radius: 5px;
	}
	.new-con-user-info h4{
		margin-bottom: 15px;
	}
	.new-con-user-info h3,.new-con-user-info .submit,.new-con-user-info .updated,.new-con-user-info .description,.new-con-user-info #wpua-thumbnail-existing,.new-con-user-info #wpua-remove-button-existing,.new-con-user-info #wpua-undo-button-existing{
	  display: none;
	}
	.new-con-user-info #wpua-upload-button-existing button{
		padding: 3px 15px;
		background-color: rgba(0, 0, 0, 0.8);
		color: rgba(255,255,255,0.8);
		border: none;
		border-radius: 3px;
		margin-top: 10px;
	}
	.new-con-user-info p{
		margin-bottom: 15px;
	}
	.new-con-user-info img{
		width: 150px;
	}
	.user-logout:hover{
		color: rgba(255,255,255,0.8);
	}
</style>
<?php if (have_posts()) : the_post(); update_post_caches($posts); ?>
<div class="container">
	<div class="pc-new-top-img">
		<div class="pc-new-top-img-bg" style="background-image: url(<?php echo get_post_meta($post->ID,'page_tab_head_img',true); ?>)"><div class="wp-user-info">
			  <div class="user-info-show">
				<div class="user-info-logo">
			      <?php global $current_user;get_currentuserinfo();echo get_avatar( $current_user->user_email, 80); ?>
				</div>
				<div class="user-info-name">
					<span><?php global $current_user;get_currentuserinfo();echo  $current_user->display_name;?></span>
					<p>ID : <strong><?php global $current_user;get_currentuserinfo();echo  $current_user->ID;?></strong></p>
			      <?php if( current_user_can( 'read' ) && !current_user_can( 'edit_posts' ) ) {
						echo "<p>等级 : <strong>Level 0</strong></p>";
					}else if( current_user_can( 'edit_posts' ) && !current_user_can( 'publish_pages' ) ) {
			  			echo "<p>等级 : <strong>Level 1</strong></p>";
				  }else if( current_user_can( 'publish_pages' ) && !current_user_can( 'manage_options' ) ) {
			            echo "<p>等级 : <strong>Level 2</strong></p>";
					}else if( current_user_can( 'manage_options' ) ) {
			            echo "<p>等级 : <strong>Level 3</strong></p>";
					};?>
			    </div>
			  </div>
			</div>
		</div>
	</div>

	<div class="pc-new-con">
		<div class="pc-new-con-nav">
			<div class="new-nav-list active">基本服务</div>
			<div class="new-nav-list">账户设置</div>
			<?php if( current_user_can( 'publish_pages' ) ) :?>
			<div class="new-nav-list">视频报错</div>
			<div class="new-nav-list">上架请求</div>
			<?php endif; ?>
			<div class="new-nav-list">
				退出登录
			</div>
			<?php if( current_user_can( 'manage_options' ) ) :?>
			<div class="new-nav-list">
				控制面板
			</div>
			<?php endif; ?>
		</div>
		<div class="pc-new-con-main">
			<div class="new-con-panel">
				<div class="wp-user-container">
				  	<div class="wp-user-benefit-main">
				      <a href="<?php bloginfo('url'); ?>/history"><div class="wp-user-benefit-main-list">
							<span><i class="fa fa-youtube-play" aria-hidden="true"></i></span>
							<p>播放记录</p>
					  </div></a>

				      <a href="<?php bloginfo('url'); ?>/info"><div class="wp-user-benefit-main-list">
							<span><i class="fa fa-user-secret" aria-hidden="true"></i></span>
							<p>关于我们</p>
					  </div></a>

				      <div style="clear:both"></div>
				    </div>
				</div>
			</div>
			</div>
			<div class="new-con-panel new-con-user-info">
				<h4>设置头像:</h4>
				<?php echo do_shortcode("[avatar_upload]"); ?>
			</div>
			<?php if( current_user_can( 'publish_pages' ) ) :?>
			<div class="new-con-panel">
				<div class="foot-comment-left-con" id="comments">
		          <div class="comments-con">
		              <?php
									$general_options = get_option('ashuwp_general');
									$error_id = $general_options["tab2_error_link"];
									$args = array(
										'post_id'=> $error_id,
										'parent'=>'0'
									);
									$comments = get_comments($args);
		                 foreach($comments as $key=>$child) :?>
		                      <div class="comments-pc-list">
		                          <div class="comments-pc-list-header">
		                            <div class="comments-header-logo">
		                                <?php echo get_avatar($child->comment_author_email,32); ?>
		                            </div>
		                            <div class="comments-header-username">
		                              <?php echo $child->comment_author; ?>
		                            </div>
		                            <div class="comments-header-time">
		                              <?php echo $child->comment_date; ?>
		                            </div>
		                          </div>
		                          <div class="comments-pc-list-text">
		                            <?php echo convert_smilies($child->comment_content); ?>
		                          </div>
		                          <?php  if ( current_user_can('level_10') ) {
		                                  $url = home_url();
		                              echo '<a id="delete-'. $child->comment_ID .'" data-url="' . wp_nonce_url("$url/wp-admin/comment.php?action=deletecomment&amp;p=" . $child->comment_post_ID . '&amp;c=' . $child->comment_ID, 'delete-comment_' . $child->comment_ID) . '" style="position:absolute;right:0;bottom:3px;color:black;font-size:0.9em;cursor: pointer;">删除</a>';}?>
		                      </div>
		                 <?php endforeach;?>
		          </div>
		        </div>
			</div>
			<div class="new-con-panel">
				<div class="foot-comment-left-con" id="comments">
		          <div class="comments-con">
		              <?php
									$general_options = get_option('ashuwp_general');
									$upload_id = $general_options["tab2_upload_link"];
									$args = array(
										'post_id'=> $upload_id,
										'parent'=>'0'
									);
									$comments = get_comments($args);
		                 foreach($comments as $key=>$child) :?>
		                      <div class="comments-pc-list">
		                          <div class="comments-pc-list-header">
		                            <div class="comments-header-logo">
		                                <?php echo get_avatar($child->comment_author_email,32); ?>
		                            </div>
		                            <div class="comments-header-username">
		                              <?php echo $child->comment_author; ?>
		                            </div>
		                            <div class="comments-header-time">
		                              <?php echo $child->comment_date; ?>
		                            </div>
		                          </div>
		                          <div class="comments-pc-list-text">
		                            <?php echo convert_smilies($child->comment_content); ?>
		                          </div>
		                          <?php  if ( current_user_can('level_10') ) {
		                                  $url = home_url();
		                              echo '<a id="delete-'. $child->comment_ID .'" data-url="' . wp_nonce_url("$url/wp-admin/comment.php?action=deletecomment&amp;p=" . $child->comment_post_ID . '&amp;c=' . $child->comment_ID, 'delete-comment_' . $child->comment_ID) . '" style="position:absolute;right:0;bottom:3px;color:black;font-size:0.9em;cursor: pointer;">删除</a>';}?>
		                      </div>
		                 <?php endforeach;?>
		          </div>
		        </div>
			</div>
			<?php endif; ?>

			<div class="new-con-panel">
				<?php if ( $user_ID )  { ?>
				<a href="<?php echo wp_logout_url( home_url() ); ?>" title="Logout" class="user-logout">登出</a>
				<?php } ?>

			</div>
			<?php if( current_user_can( 'manage_options' ) ) :?>
			<div class="new-con-panel">
				<a href="/wp-admin" title="Logout" class="user-logout">控制面板</a>
			</div>
			<?php endif; ?>
		</div>
	</div>
</div>

<div class="grey-bg grey-bg-aliyun">
 <div class="bg-pic">
    <image src="<?php bloginfo('template_url'); ?>/images/alipay.jpg" />
    <p>支付宝扫码即可</p>
  </div>
</div>

<div class="grey-bg grey-bg-weixin">
 <div class="bg-pic">
    <image src="<?php bloginfo('template_url'); ?>/images/weixin.jpg" />
    <p>现已开通赞赏功能</p>
  </div>
</div>

<script>
$(function(){
    $(".wp-user-donation").click(function(){
      $(".grey-bg-aliyun").show();
      });
    $(".wp-user-weixin").click(function(){
      $(".grey-bg-weixin").show();
      });
  	$(".grey-bg").click(function(){
      $(".grey-bg").hide();
      });
});
$(function(){
		$(".benefit-list-status").click(function(){
			$(this).next().show();
		});
		$(".grey-bg-pc").click(function(){
			$(this).parent().hide();
		});
})
</script>
<?php else : ?>
  <?php endif; ?>
<?php get_footer(); ?>
<?php else:
    wp_redirect( "/login" );
   endif; ?>
