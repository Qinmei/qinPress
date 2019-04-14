<?php get_header(); ?>
<?php if (have_posts()) : the_post(); update_post_caches($posts); ?>
<style>
	main{
    background-color: rgba(0,0,0,0.03);
  }
  .discuss-nav-list{
  	width: auto;
  }
  .pc-discuss-con-right{
  	padding:0; 
  }
  .pc-discuss-user {
   height: auto;
    padding: 0 15px 15px 15px;
  }
  .pc-discuss-con-right{
  	height: auto;
  }
  .pc-discuss-user-info {
    width: 100%;
    min-height: 80px;
    margin-top: 0;
    border-radius: 5px;
    padding: 15px;
    background-color: rgba(0,0,0,0.05);
}
.discuss-con-panel{
	border-radius: 5px;
	background-color: white;
	padding:15px;
}
.discuss-con-panel{
	line-height: 1.8;
}
.discuss-con-panel p{
	margin: 15px 0;
}
.discuss-con-panel h1,.discuss-con-panel h2,.discuss-con-panel h3,.discuss-con-panel h4,.discuss-con-panel h5{
	margin: 15px 0;
	display: flex;
    justify-content: flex-start;
    align-items: center;
    background-color: rgba(0,0,0,0.04);
}
.discuss-con-panel img{
	max-width: 100%;
	border-radius: 3px;
	padding:3px;
	border: solid 1px rgba(0,0,0,0.1); 
	margin: 0 auto;
	display: inherit;
}
.discuss-con-panel h3::before{
	content: "";
    display: inline-block;
    width: 8px;
    height: 1.3em;
    background-color: rgba(0,0,0,0.5);
    margin-right: 15px;
}
.comments-zone{
	margin-top: 15px;
}
.comments-children .form-submit{
  	display: flex;
  }
  .pc-discuss-location{
  	position: relative;
  }
  .pc-discuss-commentload{
  	display: none;
	position: absolute;
    right: 0;
    line-height: 33px;
    height: 33px;
    top: 0;
    padding: 0 15px;
    background-color: rgba(0,0,0,0.2);
    border-radius: 5px;

  }
  .pc-discuss-commenterror{
  	display: none;
	position: absolute;
    right: 0;
    line-height: 33px;
    height: 33px;
    top: 0;
    padding: 0 15px;
    background-color: rgba(0,0,0,0.2);
    border-radius: 5px;
  }
  .ias-noneleft{
  	font-weight: bold;
    width: 100%;
    margin: 15px 0 0;
    background-color: white;
    border-radius: 5px;
    text-align: center;
    padding: 10px;
    color: rgba(0,0,0,0.4);
  }
  .pc-discuss-login{
  	float: right;
    margin-top: 10px;
    margin-right: 10px;
    padding: 8px 15px;
    background-color: rgba(0,0,0,0.8);
    color: rgba(255,255,255,0.8);
    border-radius: 5px
  }
  .pc-discuss-nav-head a{
  	color: white;
  }
  .comment-reply-title{
  	display: none !important;
  }
  .user-info-logo img{
  	max-width: 100%;
	border-radius:0;
	padding:0;
	border: none; 
	margin: 0 auto;
	display: inherit;
  }
</style>

<div class="container">
	<div class="pc-new-top-img">
		<div class="pc-new-top-img-bg" style="background-image: url(<?php echo get_post_meta($post->ID,'page_tab_head_img',true); ?>)">
			<div class="pc-new-top-head">
				简介
			</div>
		</div>
	</div>


	<div class="pc-discuss-con">
		<div class="pc-discuss-con-left">
			<div class="pc-discuss-con-nav">
				<div class="pc-discuss-nav-head">
					<div class="discuss-nav-list"><?php the_title();?></div>
				</div>
			</div>
			<div class="pc-discuss-con-main">
				<div class="discuss-con-panel">
					<?php the_content();?>
				</div>
			</div>

		</div>
		<div class="pc-discuss-con-right">
			<div class="pc-discuss-con-nav">
				<div class="pc-discuss-nav-head">
					<div class="discuss-nav-list">作者</div>
				</div>
			</div>
			<div class="pc-discuss-user">
				<div class="pc-discuss-user-logo"><?php echo get_avatar( get_the_author_meta( 'email'), 60); ?></div>
				<div class="pc-discuss-user-name"><?php echo  get_the_author_meta( 'nickname');?></div>
				<div class="pc-discuss-user-action">
					<span><b>文章</b><?php the_author_posts(); ?></span>
					<span><b>评论</b><?php echo get_comments('count=true&user_id='.get_the_author_id()); ?></span>
					<span><b>点赞</b>111</span>
				</div>
				<div class="pc-discuss-user-info">
					一位热爱二次元的吃瓜群众
				</div>
			</div>
		</div>
	</div>
</div>
<?php else : ?>
<?php endif; ?>
<?php get_footer();?>