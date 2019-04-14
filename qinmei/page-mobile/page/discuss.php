
<?php get_header(); ?>
<link href="<?php bloginfo('template_url'); ?>/extents/DPlayer/DPlayer.min.css" rel="stylesheet">
<script src="<?php bloginfo('template_url'); ?>//extents/DPlayer/DPlayer.min.js"></script>
<style>
  body{
  background-color:#ebebeb;
  }
#reply-title,.comment-notes{
  display:none;
}
.comments-top{
  	width:100%;
    background-color:white;
  }
.comments-top-container{
	width: 100%;
	height: 80px;
	display: flex;
	justify-content: flex-start;
	align-items: center;
}
.comments-top-container p{color:black;margin-top:5px;font-size:0.9em}
.comments-top-container a:nth-child(1) span{color:#f44236;}
.comments-top-container a:nth-child(2) span{color:#2196f3;}
.comments-top-container a:nth-child(3) span{color:#ff9700;}
.comments-top-container a:nth-child(4) span{color:#a671ff;}
.comments-top-container a:nth-child(5) span{color:#00bcd5;}
.comments-top-list{  
  display: flex;
  flex-direction:column;
  justify-content: space-around;
  align-items: center;
  width: 20vw;
}
.comments-top-list span{  
  font-size:1.7em;
}
.comments-top-ding{
  height: 0;
  padding-bottom: 25%;
  position:relative;
  border-radius:5px;
  overflow:hidden;
  background-color:rgba(0,0,0,0.2);
  margin:0 10px 0 10px;
}
.comments-top-ding-container{
  position:absolute;
  top:0;
  left:0;
  height:100%;
  width:5000px;
}
.comments-top-ding-list{
  float:left;
  height:100%;
}  
.comments-top-ding-dot{
	position: absolute;
  	right:5px;
	bottom: 5px;
	font-size: 0;
}
.comments-top-ding-dot ul li{
	width: 8px;
	height: 8px;
	border-radius: 50%;
	background-color: grey;
	display: inline-block;
	cursor: pointer;
	margin: 0 3px;
}
.comments-top-ding-dot .active{
	background-color: orange;
}
.mobile-info-list img{
  	width:100%;
    background-size: contain;
}
.comments-container-con{
  margin:5px;
}
.comments-title p{
	font-size:1em;
}
.comments-img{
  position:absolute;
  left:3px;
  top:3px;
}
.comments-main{
  min-height:56px;
  margin-bottom:4px;
  border: solid 1px grey;
  border-radius:5px;
  display: flex;
  justify-content: flex-start;
  align-items: center;
  word-wrap: break-word;
  padding-left:50px;
  position:relative;
}
.comments-form{
  position:fixed;
  z-index:39;
  display:none;
  top:0;
  left:0;
  width:100vw;
  height:100vh;
  background-color:white;
}
.comments-list{
  margin-left:10px;
  padding-top:2px;
}
	.user-comment-logo{
		width: 48px;
		height: 48px;
		border-radius: 50%;
      	overflow:hidden;
	}
	.user-comment-name{
		width: auto;
      	max-width:80%;
      	padding:0 30px;
		height: 30px;
      	color:white;
		border-top: 1px solid white;
		border-bottom: 1px solid white;
		display: flex;
		flex-direction: column;
		justify-content: center;
		align-items: center;
	}
  .user-comment-name-noline{
  	width:50%;
    text-align:center;
  }
	.user-comment-line{
		width: 100%;
		height: 15px;
	}
	.user-comment-line-list{
		width: 50%;
		height: 100%;
		border-right: 1px solid white;
	}
  .user-comment-input{
    width:100%;
  }
  .user-comment-input textarea{
    width: 100%;
    padding: 15px;
    border: none;
    outline: none;
    appearance: none;
  }
  .user-comment-input textarea:focus {
     border: 0px solid green;
     outline: none; 
  }
  .user-comment-input textarea::-webkit-input-placeholder {
    color: black;
    }

    .user-comment-input textarea:-moz-placeholder { /* Firefox 18- */
    color: black;  
    }

    .user-comment-input textarea::-moz-placeholder {  /* Firefox 19+ */
    color: black;  
    }

    .user-comment-input textarea:-ms-input-placeholder {
    color: black;  
    }
  .comments-input-submit{
  	background-color:#4285f4;
  }
  	.mobile-comments{
		margin:0 5px;
      border-radius:5px;
		background-color: white;
      	margin-bottom:5px;
      box-shadow:0 0 5px #cccbcb;
	}
	.user-header{
		height: 40px;
		width: 100%;
		padding:10px 10px 0 10px;
		display: flex;
		justify-content: space-between;
		align-items: center;
	}
	.user-info-logo{
		width: 32px;
		height: 32px;
		border-radius: 50%;
		float: left;
      	overflow:hidden;
	}
	.user-info-name{
		height: 32px;
		display: flex;
		flex-direction: column;
		justify-content: space-between;
		align-items: flex-start;
	}
	.user-info-name a{
		color: black;
      font-size:1.2em;
	}
	.user-info-name span{
		font-size: 0.7em;
		color: grey;
	}
	.user-comments-main{
		padding:10px 15px 10px 15px;
	}
	.user-comments-main p{
		margin: 0;
      font-size:1.1em;
		text-align:justify;
		word-break: break-all;
	}
  .user-header-action span{
    width:30px;
    height:30px;
    display:inline-block;
    text-align:center;
    line-height:30px;
    font-size:1.2em;
    color:grey;
  }
  .user-footer-reply{
  	position:relative;
  }
  .user-footer-reply,.user-footer-reply ul{
		width: 100%;
		padding: 0;
		margin: 0;
	}
	.user-footer-reply li{
		list-style: none;
		min-height: 30px;
		padding: 5px 15px;
		border-top: 1px solid #f6f4f4;
	}
  .user-footer-reply-bottom{
    display:none;
  	position:absolute;
    bottom:0;
    height:30px;
    text-align:center;
    color:green;
    line-height:30px;
    width:100%;
    background-color:rgba(255,255,255,0.9);
    border-radius:5px;
  }

 .foot-comment-con{
    margin: 0 -5px;
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
  .page-input-textarea {
    padding: 5px 15px;
    border-radius: 5px;
    background-color: rgba(0,0,0,0.8);
    color: rgba(255,255,255,0.8);
    cursor: pointer;
    border: none;
    width: 85px;
}
  .form-control-page {
    display: block;
    width: 100%;
    border-radius: 5px;
    padding: 6px 12px;
    font-size: 14px;
    line-height: 1.42857143;
    color: #555;
    background-image: none;
    border: 1px solid #ccc;
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
  .pc-commments-list{
  	width: 100%;
  	margin-top: 5px;
  	min-height: 80px;
  	padding: 10px 20px 5px 20px;
  	border-radius: 5px;
  	background-color: white;
  }
  .pc-commments-list:nth-child(1){
  	margin-top: 0;
  }
  .pc-discuss-con-main .comments-head{
  	width: 100%;
  	height: 40px;
  	display: flex;
  	justify-content: space-between;
  	align-items: center;
  }
  .pc-discuss-con-main .user-info{
  	width: 300px;
  	display: flex;
  	justify-content: flex-start;
  	align-items: center;
  }
  .pc-discuss-con-main .user-info-logo{
  	width: 32px;
  	height: 32px;
  	border-radius: 50%;
  	overflow: hidden;
  }
  .pc-discuss-con-main .user-info-name{
  	margin-left: 15px;
  	color: rgba(0,0,0,0.8);
  	display: flex;
  	flex-direction: column;
  	justify-content: space-between;
  	align-items: flex-start;
  	color: rgba(0,0,0,0.6);
  	font-weight: bold;
  }
  .pc-discuss-con-main .user-info-name span{
  	font-size: 0.8em;
  	font-weight: normal;
  	color: rgba(0,0,0,0.4);
  }
  .pc-discuss-con-main .comments-content{
  	padding: 5px 0;
  	color: #1a1a1a;
  	line-height: 1.6;
  }
  .pc-discuss-con-main .comments-foot{
  	height: 30px;
  	width: 100%;
  	display: flex;
  	justify-content: flex-start;
  	align-items: center;
  }
  .pc-discuss-con-main .comments-foot-list{
  	min-width: 40px;
  	height: 30px;
  	color: rgba(0,0,0,0.5);
  	display: flex;
  	justify-content: flex-start;
  	align-items: center;
  	cursor: pointer;
  	margin-right: 30px;
  }
  .pc-discuss-con-main .comments-foot-list:hover{
  	color: rgba(0,0,0,0.8);
  }
  .pc-discuss-con-main .comments-foot-list i{
  	margin-right: 8px;
  }
  .pc-discuss-con-main .comments-children{
  	width: 100%;
  	padding: 0 10px;
  	border:1px solid #ebebeb;
  	border-radius: 5px;
  	margin-bottom: 10px;
  	margin-top: 10px;
  	display: none;
  }
  .pc-discuss-con-main .pc-comments-child-list{
  	border-top: solid 1px rgba(0,0,0,0.03);
  	padding: 10px 0 0 0;
  }
  .pc-discuss-con-main .pc-comments-child-list:nth-child(1){
  	border: none;
  }
  .pc-discuss-con-main .comments-child-head{
  	width: 100%;
  	height: 34px;
  	display: flex;
  	justify-content: flex-start;
  	align-items: center;
  	color: rgba(0,0,0,0.8);
  }
  .pc-discuss-con-main .comments-child-info{
  	height: 34px;
  	display: flex;
  	justify-content: flex-start;
  	align-items: center;
  }
  .pc-discuss-con-main .comments-child-logo{
  	width: 28px;
  	height: 28px;
  	border-radius: 3px;
  	overflow: hidden;
  }
  .pc-discuss-con-main .comments-child-name{
  	margin-left: 10px;
  	font-weight: bold;
  	color: rgba(0,0,0,0.6);
  }
  .pc-discuss-con-main .comments-child-parent{
  	margin-left: 10px;
      width: 35px;
      height: 20px;
      background-color: rgba(0,0,0,0.6);
      color: rgba(255,255,255,0.8);
      font-size: 0.8em;
      text-align: center;
      line-height: 20px;
      border-radius: 5px;
  }
  .pc-discuss-con-main .pc-comments-child-content{
  	padding: 10px 0 5px 0;
  	color: rgba(0,0,0,0.8);
  }
  .pc-discuss-con-main .comments-child-foot .comments-foot-list{
  	color: rgba(0,0,0,0.5);
  }
  .pc-discuss-con-main .comments-child-foot .comments-foot-list:hover{
  	color: rgba(0,0,0,0.7);
  }
  .pc-discuss-con-main .comments-children-header{
  	height: 40px;
  	line-height: 40px;
  }
  .pc-discuss-con-main .comments-children-header strong{
  	margin-right: 5px;
  }
  .pc-discuss-con-main .comments-child-foot .comments-child-foot-reply{
  	display: none;
  }
  .pc-discuss-con-main .pc-comments-child-list:hover .comments-child-foot-reply{
  	display: inherit;
  }
  .pc-discuss-con-main .comments-children-footer{
  	width: 100%;
  	display: flex;
  	align-items: center;
  	border-top: solid 1px rgba(0,0,0,0.03);
  }
  .pc-discuss-con-main .comment-respond{
  	width: 100%;
  	margin: 8px 0 8px 0;
  }
  .pc-discuss-con-main .pc-small-button{
  	line-height: 1.7em;
  }
  .pc-discuss-con-main .comment-form{
      display: flex;
      justify-content: space-between;
      align-items: center;
  }
  .pc-discuss-login{
    color: #029588;
    text-align: center;
    margin: 10px auto;
    padding: 8px;
    width:200px;
    border-radius: 20px;
    border: solid 1px #029588;
    background-color: white;
  }
  .pc-discuss-nav-head{
    margin-top:10px;
  }
  .page-comments-text{
  	width: calc(100% - 100px);
  	display: inline-block;
  }
  .form-submit{
  	float: right;
  }
  .ias-noneleft{
  margin: 5px 0;
    background-color: white;
    padding: 8px;
    border-radius: 5px;
    text-align: center;
}
.comments-content-img{
  position: relative;
  margin-top: 10px;
}
.comments-content-img img{
  width:100%;
  height:auto;
  margin-bottom:15px;
  background-color:#f5f5f5;
  float:left;
}
.discuss-form-top{
  width: 100%;
  padding-right:15px;
  height: 40px;
  border-bottom: solid 1px rgba(0,0,0,0.05);
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.discuss-top-close{
  height: 40px;
  text-align: center;
  line-height: 40px;
  display: flex;
  justify-content: space-between;
  align-items: center;
}
.discuss-top-close i{
  font-size: 1.35em;
  width: 40px;
  margin-right: 10px;
}
.discuss-top-close span{
  font-size: 1.2em;
}
.discuss-submit-btn{
  width: 70px;
  height: 30px;
  border-radius: 3px;
  text-align: center;
  line-height: 30px;
  color: rgba(0,0,0,0.4);
  border: solid 1px rgba(0,0,0,0.4);
}
.zz-add-img{
  width: 100%;
  padding-left: 15px;
}
input#zz-img-file {
    width: calc((100vw - 60px)/3);
    height: calc((100vw - 60px)/3);
    opacity: 0;
}
#zz-img-add {
  display: inline-block;
    width: calc((100vw - 60px)/3);
    height: calc((100vw - 60px)/3);
    float: left;
    margin-right: 15px;
    margin-bottom: 15px;
    text-align: center;
    line-height: 60px;
    color: #666;
    font-size: 16px;
    background-color: rgba(0,0,0,0.05);
    position: relative;
}
#zz-img-add i{
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%,-50%);
}

.zz-img-list {
  display: inline-block;
    width: calc((100vw - 60px)/3);
    height: calc((100vw - 60px)/3);
    float: left;
    margin-right: 15px;
    margin-bottom: 15px;
    text-align: center;
    line-height: 60px;
    color: #666;
    font-size: 16px;
    background-color: rgba(0,0,0,0.05);
    position: relative;
    background-size: cover;
    background-position-x: center;
    background-position-y: center;
}
.img-close-btn{
  position: absolute;
    top: 0;
    right: 0;
    width: 25px;
    height: 25px;
    cursor: pointer;
    background-color: rgba(0,0,0,0.6);
    color: white;
    text-align: center;
    line-height: 25px;
}
.comments-content-img-left,.comments-content-img-right{
  width: calc((100% - 15px)/2);
  float: left;
}
.comments-content-img-left{
  margin-right: 15px;
}
.discuss-submit-bottom{
  height: 35px;
  background-color: white;
  border-top: solid 1px rgba(0,0,0,0.04);
  position: fixed;
  bottom: 0;
  left: 0;
  width: 100%;
  padding: 0 10px;
}
.discuss-submit-bottom  i{
  font-size: 1.5em;
}
.discuss-submit-bottom span{
    width: 35px;
    height: 35px;
    display: inline-block;
    text-align: center;
    line-height: 35px;
}
.discuss-submit-item.item-link{
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%,-50%);
  width: 85vw;
  height: 220px;
  border-radius: 3px;
  background-color: white;
  box-shadow: 0 0 5px rgba(0,0,0,0.4);
  padding: 20px;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  align-items: center;
}
.grey-bg{
  position: fixed;
  width: 100vw;
  height: 100vh;
  top: 0;
  left: 0;
  background-color: rgba(0,0,0,0.6);
}
.item-input-link:focus{
  border: solid 1px rgba(0,0,0,0.7);
}
.comment-video-container{
    height: auto;
    margin: 5px -20px 0 -20px;
}
</style>
<?php if (have_posts()) : the_post(); update_post_caches($posts); ?>

<?php if(is_user_logged_in()): ?>

<div style="position:fixed;bottom:15px;right:15px;font-size:2em;color:white ;z-index:9;background-color:rgba(66,133,244,0.9);width:1.8em;height:1.8em;display:flex; justify-content: center;
    align-items: center;;border-radius:50%;" id="plus-icon">
  <i class="fa fa-pencil" aria-hidden="true"></i>
</div> 

<div class="comments-form comments-discuss-sec">
  <div class="discuss-form-top">
    <div class="discuss-top-close">
      <i class="fa fa-times" aria-hidden="true"></i>
      <span>发布动态</span>
    </div>
    <div class="discuss-submit-btn">发布</div>
  </div>
  <form action="/wp-comments-post.php" method="post" id="commentform" class="comment-form form-horizontal ">
    <div class="user-comment-container">
  		<div class="user-comment-input">
  			<textarea id="comment" name="comment" rows="4" maxlength="65525" placeholder="请输入内容" aria-required="true" required="required"></textarea>
        <textarea id="commentimg" class="form-control-page" name="commentimg" style="display:none"></textarea>
        <textarea id="commentvideo" class="form-control-page" name="commentvideo" style="display:none"></textarea>
  		</div>
      <div class="user-comment-submit">
            <input name="submit" type="hidden" id="submit" class="comments-input-submit" value="发表评论">
        		<input type="hidden" name="comment_post_ID" value="<?php the_ID();?>" id="comment_post_ID">
        		<input type="hidden" name="comment_parent" id="comment_parent" value="0">	
      </div>
  	</div>
  </form>

  <div class="zz-add-img">
    <a href="javascript:;" id="zz-img-add">
    <i class="fa fa-plus" aria-hidden="true" style="font-size: 2em"></i>
    <input id="zz-img-file" type="file" accept="image/*">
    </a>
  </div>

</div>
<?php else: ?>

<?php endif; ?>
<div class="mobile-nav" style="border-bottom: solid 1px rgba(0,0,0,0.05);background-color:white;">
                      <a href="<?php bloginfo('url'); ?>/"><div class="mobile-nav-list">
                        <div class="mobile-nav-list-main">首页</div>
                      </div></a>
                      <a href="<?php bloginfo('url'); ?>/new"><div class="mobile-nav-list">
                        <div class="mobile-nav-list-main">新番</div>
                      </div></a>
                      <a href="<?php bloginfo('url'); ?>/topic"><div class="mobile-nav-list">
                        <div class="mobile-nav-list-main">分类</div>
                      </div></a>
                    <a href="<?php bloginfo('url'); ?>/discuss"><div class="mobile-nav-list">
                        <div class="mobile-nav-list-main active">动态</div>
                      </div></a>
                    
                      <a href="<?php bloginfo('url'); ?>/user"><div class="mobile-nav-list">
                        <div class="mobile-nav-list-main ">用户</div>
                      </div></a>
                </div>

<div class="comments-container-con">
<div class="pc-discuss-con-main">
				<div class="discuss-con-panel">
						<?php
						$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
						$number = 20;
						$offset = ( $paged - 1 ) * $number;
						$args = array(
						    'status' => 'approve',
						    'post_id' => get_the_ID(),
						    'parent'       => '0',
						    'number' => $number,
						    'offset' => $offset,
						    'paged' => $paged
						);

						$comments_query = new WP_Comment_Query;
						$comments = $comments_query->query( $args );

						if ( $comments ) {
						    foreach ( $comments as $comment ) {?>
						        <div class="pc-commments-list">
						        	<div class="comments-head">
						        		<div class="user-info">
											<div class="user-info-logo">
												<?php echo get_avatar($comment ->comment_author_email,32); ?>
											</div>
											<div class="user-info-name">
												<?php echo $comment ->comment_author; ?>
												<span><?php echo $comment ->comment_date; ?></span>

											</div>
										</div>
						        	</div>
						        	<div class="comments-content">
                        <?php echo ($comment->comment_content);?>
                        
                        <?php  $img = get_comment_meta( $comment->comment_ID, 'commentimg', true );
                          if(!empty($img)){ ?>
                            <div class="comments-content-img">    
                              <?php   
                              $imgarr = explode("[img]",$img);
                              if(count($imgarr) < 3){
                                foreach($imgarr  as $imgitem){
                                  $imgshow = preg_replace(array('#(http://([^\s]*)\.(jpg|gif|png|JPG|GIF|PNG))#','#(https://([^\s]*)\.(jpg|gif|png|JPG|GIF|PNG))#'),'<img class="zoomify" src="$1" alt="评论" />', $imgitem);
                                   echo $imgshow;
                                }
                              }else{
                                  $left = '<div class="comments-content-img-left">';
                                  $right  = '<div class="comments-content-img-right">';
                                  $leftheight = 0;
                                  $rightheight = 0;
                                  $itemnum = 0;
                                  foreach($imgarr  as $imgitem){
                                    if(!empty($imgitem)){


                                      $imageinfo = getimagesize($imgitem);
                                      $imgshow = preg_replace(array('#(http://([^\s]*)\.(jpg|gif|png|JPG|GIF|PNG))#','#(https://([^\s]*)\.(jpg|gif|png|JPG|GIF|PNG))#'),'<img class="zoomify" src="$1" alt="评论" />', $imgitem);
                                      if($leftheight > $rightheight){
                                        $right = $right.$imgshow;
                                        $rightheight =  $rightheight + $imageinfo[1];
                                      }else{
                                        $left = $left.$imgshow;
                                        $leftheight = $leftheight + $imageinfo[1];
                                      }
                                    }
                                  }
                                  $left = $left.'</div>';
                                  $right = $right.'</div>';
                                  echo $left;
                                  echo $right;
                              } ?>

                            </div>
                        <?php }?>

                        <?php  $video = get_comment_meta( $comment->comment_ID, 'commentvideo', true );
                          if(!empty($video)){ ?>
                            <div class="comment-video-container">
                                <div id="dplayer-<?php echo $comment->comment_ID;?>"></div>
                                <script>
                                  const dp = new DPlayer({
                                    container: document.getElementById('dplayer-<?php echo $comment->comment_ID;?>'),
                                    screenshot: false,
                                    video: {
                                        url: '<?php echo $video;?>',
                                    },
                                    danmaku: {
                                        id: 'qinmei-comment-<?php echo $comment->comment_ID;?>',
                                        api: 'https://api.prprpr.me/dplayer/'
                                    }
                                  });
                                </script>
                            </div>
                        <?php } ?>
                      </div>

						        	<div class="comments-foot">
										<?php
											$args = array(
											    'status' => 'approve',
											    'post_id' => get_the_ID(),
											    'parent'  => $comment->comment_ID,
											    'orderby'=>'time',
											    'order'=>'ASC'
											);

											$children_query = new WP_Comment_Query;
											$children = $children_query->query( $args );?>

						        		<div class="comments-foot-list">
						        			<a href="javascript:;" data-action="ding" data-id="<?php comment_ID(); ?>" class="pinglunZan <?php
												if (isset($_COOKIE['pinglun_zan_' . $comment->comment_ID]))echo 'done';
												?>" style="color: rgba(0,0,0,0.5)"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i><span class="count">
												        <?php
												$comment_id = $comment->comment_ID;
												if (get_comment_meta($comment_id, 'pinglun_zan', true)){echo get_comment_meta($comment_id, 'pinglun_zan', true);
												}else {echo '0';
												}?></span></a>
						        		</div>

						        		<div class="comments-foot-list comments-children-switch" nowid="<?php echo ($comment->comment_ID);?>">
						        			<i class="fa fa-comment" aria-hidden="true"></i>
						        			<span><?php echo count($children)?></span>
						        		</div>

										<div class="comments-foot-list">
						        			<?php if ( current_user_can('level_10') ) {
											$url = home_url();
											echo '<span id="delete-'. $comment->comment_ID .'" data-url="' . wp_nonce_url("$url/wp-admin/comment.php?action=deletecomment&amp;p=" . $comment->comment_post_ID . '&amp;c=' . $comment->comment_ID, 'delete-comment_' . $comment->comment_ID) . '" style="margin-right:5px;">&nbsp;删除</span>';
											} ?>
						        		</div>
						        	</div>


									<div class="comments-children" id="<?php echo $comment->comment_ID;?>">
										<div id="comments-children-<?php echo $comment->comment_ID;?>">
										<div class="comments-children-header">
											<strong><?php echo count($children)?></strong>条评论
										</div>
										<?php	foreach ( $children as $child) { ?>
											<div class="pc-comments-child-list">
												<div class="comments-child-head">
									        		<div class="comments-child-info">
														<div class="comments-child-logo">
															<?php echo get_avatar($child ->comment_author_email,28); ?>
														</div>
														<div class="comments-child-name">
															<?php echo $child ->comment_author; ?>
														</div>
														<?php if(($comment->user_id) === ($child->user_id)){
																echo '<div class="comments-child-parent">楼主</div>';
														}?>
													</div>
												</div>
												<div class="pc-comments-child-content">
													<?php echo convert_smilies($child->comment_content); ?>
												</div>
												<div class="comments-foot comments-child-foot">
									        		<div class="comments-foot-list">
									        			<a href="javascript:;" data-action="ding" data-id="<?php comment_ID(); ?>" class="pinglunZan <?php
														if (isset($_COOKIE['pinglun_zan_' . $child->comment_ID]))echo 'done';
														?>" style="color: rgba(0,0,0,0.5)"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i><span class="count">
														        <?php
														$comment_id = $child->comment_ID;
														if (get_comment_meta($comment_id, 'pinglun_zan', true)){echo get_comment_meta($comment_id, 'pinglun_zan', true);
														}else {echo '0';
														}?></span></a>
									        		</div>

									        		<div class="comments-foot-list comments-child-foot-reply">
									        			<i class="fa fa-reply" aria-hidden="true"></i>回复
									        		</div>

									        		<div class="comments-foot-list">
									        			<?php if ( current_user_can('level_10') ) {
														$url = home_url();
														echo '<span id="child-delete-'. $child->comment_ID .'" data-url="' . wp_nonce_url("$url/wp-admin/comment.php?action=deletecomment&amp;p=" . $child->comment_post_ID . '&amp;c=' . $child->comment_ID, 'delete-comment_' . $child->comment_ID) . '" style="margin-right:5px;">&nbsp;删除</span>';
														} ?>
									        		</div>



									        	</div>
											</div>
										<?php };?>
										<?php if(is_user_logged_in()): ?>

										<div class="comments-children-footer">
						        		<?php comment_form(
											  array(
											    'title_reply'=>'',
											    'label_submit' => __( '回复' ),
											    'fields' => array(
											    ),
											    'class_form'=> 'comment-form form-horizontal pc-discuss-comment-form',
											    'class_submit' => 'page-input-textarea pc-small-button',
											    'comment_field' => '
											        <div class="page-comments-text pc-discuss-location">
											          <textarea id="comment" class="form-control-page" name="comment" rows="1" maxlength="65525"  placeholder="评论" aria-required="true" required="required"></textarea>
											        </div>')
										); ?>
						        		</div>
										<?php endif; ?>
									</div>
									</div>
									<?php wp_reset_postdata(); ?>
								</div>
						   <?php }} else {echo '暂无动态';}?>
				</div>
				<div class="pagination">
					<?php $tot_returned_comments = count($comments);
							$num = $paged + 1;
							if ($number == $tot_returned_comments) {
							    echo '<a href="/discuss/page/' . $num . '">Next</a>';
							}?>
				</div>
			</div>
 </div>
<?php else : ?>
	<?php endif; ?>

<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery-ias.min.js"></script>
<script src="https://cdn.bootcss.com/jquery.touchswipe/1.6.18/jquery.touchSwipe.min.js"></script>
<script>
$(function () {
  var reply =$(".user-footer-reply");
  var replyBottom = $('.user-footer-reply-bottom');
  var replyNum = $(".user-footer-reply ul");
  for(var i = 0; i< reply.length;i++){
    if(reply.eq(i).height() > 120){
      reply.eq(i).css({
          "height":"120px",
          "overflow":"hidden"
      });
     replyBottom.eq(i).children().children().html(replyNum.eq(i).children().length);
     replyBottom.eq(i).show();
  	};
  }
  replyBottom.click(function(){
    $(this).hide();
  	 $(this).parent().css({
    	"height":"auto",
      	"overflow":"auto"
    });
  })
});

$(function(){

		var i = 0;
		var pic = $(".comments-top-ding-list");
		var size = pic.size();
		var slideWide = $(".comments-top-ding").width();
		pic.css("width",slideWide);
  		var clone = pic.first().clone();
		$(".comments-top-ding-container").append(clone);
  		var dot = '<li class="active"></li>';
		for(var j=1;j<size;j++){
			dot += "<li></li>";
		}
  		$(".comments-top-ding-dot ul").append(dot);

		
		$(window).resize(function() {
          slideWide = $(".comments-top-ding").width();
		  pic.css("width",slideWide);
		});

		function move(){
			if(i == size+1){
				$(".comments-top-ding-container").css({left:0});
				i = 1;
			}else if(i == -1){
				$(".comments-top-ding-container").css({left:- size*slideWide});
				i  = size-1;
			};
			$(".comments-top-ding-container").stop().animate({left:-i*slideWide},slideWide);
			if( i == size){
				index = 0;
			}else{
				index = i;
			}
			$(".comments-top-ding-dot ul li").eq(index).addClass("active").siblings().removeClass("active");

		}
  $(".comments-top-ding").swipe({
  	allowPageScroll: 'vertical',
    swipe:function(event, direction, distance, duration, fingerCount, fingerData) {
     if(direction == "left"){
     	i++;
		move();
     }else if (direction =="right"){
     	i--;
		move();
     }
    }
});

		$(".comments-top-ding-dot ul li").hover(function(){
			$(this).addClass("active").siblings().removeClass("active");
			var index = $(this).index();
			i = index;
			move();
		});

		var t=setInterval(function(){
			i++;
			move()
			},5000);

		$(".comments-top-ding").hover(function(){
			clearInterval(t);
		},function(){
			t=setInterval(function(){
			i++;
			move()
			},5000)
		});


});

$(function () {
	$(".pc-discuss-writting").click(function(){
		$(this).hide();
		$(".pc-discuss-nav-main").show();
	});
	$(document).on("click",".comments-children-switch", function() {
		if($(this).parent().next(".comments-children").is(":hidden")){
			var id = $(this).attr("nowid");
			$(this).parent().next(".comments-children").find("#comment_parent").val(id);
			$(this).parent().next(".comments-children").fadeIn();
			$(this).children('span').html("收起评论");
		}else{
			var text = $(this).parent().next(".comments-children").find(".comments-children-header strong").html();
			$(this).children('span').html(text);
			$(this).parent().next(".comments-children").fadeOut();
		}
	});
	$(document).on("click",".comments-child-foot-reply", function() {
		var author = $(this).parents(".pc-comments-child-list").find(".comments-child-name").html();
		author = "回复@" + author.trim() + " : ";
		var num = $(this).parents(".pc-comments-child-list");
		$('.form-control-page').each(function(){this.value=''});
		if( num.next().hasClass("comments-children-footer")){
			$(".children-reply-bar").remove();
			num.next().find("#comment").val(author);
			num.next().find("#comment").focus();
		}else{
			$(".children-reply-bar").remove();
			var reply = $(this).parents(".comments-children").find(".comments-children-footer").clone(true);
			reply.addClass("children-reply-bar");
			reply.find("#comment").val(author);
			$(this).parents('.pc-comments-child-list').after(reply);
			reply.find("#comment").focus();
		}
	});

	$(document).on("click","span[id^='child-delete-']", function() {
	    var link = $(this).data('url');
	    var thatlist = $(this).parents(".pc-comments-child-list");
	     $.ajax({
	            type:"GET",
	            cache:false,
	            url:link,
	            success: function(data){
	                thatlist.remove();
	            }
	        });
	  });
	$(document).on("click","span[id^='delete-']", function() {
	    var link = $(this).data('url');
	    var thatlist2 = $(this).parents(".pc-commments-list");
	    console.log(thatlist2);
	     $.ajax({
	            type:"GET",
	            cache:false,
	            url:link,
	            success: function(data){
	                thatlist2.remove();
	            }
	        });
	});
});
$(function() {
     var ias = jQuery.ias({
     container: '.discuss-con-panel',
     item: '.pc-commments-list',
     pagination: '.pagination',
     next: '.pagination a'
 	});
    ias.extension(new IASSpinnerExtension());

 	ias.extension(new IASNoneLeftExtension({text: "暂时没有更多了"}));

});


$(document).on("click",".comments-content-img img", function(){
    window.open($(this).attr("src"));
});

$(document).on("click","#plus-icon", function(){
    if($(".comments-discuss-sec").is(":hidden")){
      history.pushState({username: "serch"}, "search");
      $('.comments-discuss-sec').slideDown();
      $("#comment").focus();
    }else{

    }
  });

$(document).on("click",".discuss-top-close i", function(){
  $('.comments-discuss-sec').slideUp();
});

$(document).on("click",".discuss-submit-btn", function(){
  $("#commentform").submit();
});


var count = 0;
$(function() {
    $('#zz-img-file').change(function() {
      if(count < 9){
        var f=this.files[0];
        var formData=new FormData();
        formData.append('smfile',f);
        $.ajax({
          url:'https://sm.ms/api/upload',
          type : 'POST',
          processData : false,
          contentType : false,
          data:formData,
          beforeSend: function (xhr) {
          },
          error:function(){
            alert("图片不符合标准");
          },
          success:function(res){
            var url = res.data.url;
            url1 = '<div class="zz-img-list" style="background-image:url('
            url2 = ')"><span class="img-close-btn" data="';
            url3 = '"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
            url = url1 + url + url2 + url + url3;
            $('.zz-add-img').prepend(url);
            $('textarea[name="commentimg"]').val($('textarea[name="commentimg"]').val()+res.data.url+'[img]').focus();
            count++;
            if(count === 9){
              $("#zz-img-add").hide();
            }
          }
          });
        }else{
        $("#zz-img-add").hide();
      }
    });
});


$(document).on("click",".img-close-btn", function(){
    var num = $(this).attr('data') +'[img]';
    console.log(num);
    var imgurl = $("#commentimg").val();
    var urlarr = imgurl.split(num);
    var newurl = urlarr[0] + urlarr[1];
    console.log(newurl);
    $("#commentimg").val(newurl);
    $(this).parent().remove();
    count--;
    if(count === 8){
      $("#zz-img-add").show();
    }
});

$(document).on("click",".item-link-cancel", function(){
  $(".discuss-submit-item-co").hide();
});

$(document).on("click",".discuss-bottom-link", function(){
  $(".discuss-submit-item-co").show();
  $("#item-input-link").focus();
});

$(document).on("click",".item-link-add", function(){
  if($("#item-input-link").val().length == 0){

  }else{
    $("#commentvideo").val($("#item-input-link").val());
    $("#item-input-link").val('');
    $(".discuss-submit-item-co").hide();
  }
});


</script>  
<?php get_footer(); ?>