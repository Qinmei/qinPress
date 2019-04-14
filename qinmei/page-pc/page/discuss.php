<?php get_header(); ?>
<link href="<?php bloginfo('template_url'); ?>/extents/DPlayer/DPlayer.min.css" rel="stylesheet">
<script src="<?php bloginfo('template_url'); ?>//extents/DPlayer/DPlayer.min.js"></script>
<?php if (have_posts()) : the_post(); update_post_caches($posts); ?>
<style>
	main{
    background-color: rgba(0,0,0,0.03);
  }
  .new-con-panel{
  	border:none;
  	margin: 0 15px;
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
  .comments-content-img{
  	width: 100%;
  	margin-top: 15px;
  }
  div#zz-img-show img {
    height: 60px;
    margin: 0 10px 0 0;
     background-color: rgba(0,0,0,0.2);
}
.zz-add-img {
    width: 100%;
    min-height: 60px;
    display: flex;
}

input#zz-img-file {
    width: 120px;
    min-height: 100%;
    float: left;
    position: relative;
    opacity: 0;
}
#zz-img-con{
	width: calc(100% -140px);
}
div#zz-img-show {
    min-width:100%; 
    min-height: 60px;
}

div#zz-img-add {
    width: 120px;
    height: 58px;
    float: left;
    margin: 0 15px 0 -120px;
    text-align: center;
    line-height: 60px;
    border: 1px solid rgba(0,0,0,0.2);
    border-radius: 5px;
    color: #666;
    font-size: 16px;
    background-color: rgba(0,0,0,0.05);
}
.pc-discuss-con-main .comments-content {
    padding-right: 45px;
}
.pc-discuss-con-main .comments-foot{
	margin-top: 0;
}
.comments-content-img img{
	margin-right: 15px;
}
.comments-content-img{
	position: relative;
}
.comments-content-img img{
	width:100%;
	height:auto;
	margin-bottom:15px;
	background-color:#f5f5f5;
	float:left;
	position: relative;
}

.comments-content-img-left,.comments-content-img-right{
  width: calc((100% - 15px)/2);
  float: left;
}
.comments-content-img-left,.comments-content-img-3-left,.comments-content-img-3-mid{
  margin-right: 15px;
}
.comments-content-img-3-left,.comments-content-img-3-mid,.comments-content-img-3-right{
  width: calc((100% - 30px)/3);
  float: left;
}
.comments-foot.comments-child-foot{
	padding-left: 5px;
}
.comment-video-container{
	width: 100%;
	height: auto;
	margin: 10px 0;
}
.zoomify{cursor:pointer;cursor:-webkit-zoom-in;cursor:zoom-in}.zoomify.zoomed{cursor:-webkit-zoom-out;cursor:zoom-out;padding:0;margin:0;border:none;border-radius:0;box-shadow:none;position:relative;z-index:1501}.zoomify-shadow{position:fixed;top:0;left:0;right:0;bottom:0;width:100%;height:100%;display:block;z-index:1500;background:rgba(0,0,0 ,.3);opacity:0}.zoomify-shadow.zoomed{opacity:1;cursor:pointer;cursor:-webkit-zoom-out;cursor:zoom-out}
</style>

<div class="container">
	<div class="pc-new-top-img">
		<div class="pc-new-top-img-bg" style="background-image: url(<?php echo get_post_meta($post->ID,'page_tab_head_img',true); ?>)">
			<div class="pc-new-top-head">
				动态讨论
			</div>
		</div>
	</div>

	<div class="pc-discuss-con">
		<div class="pc-discuss-con-left">
			<div class="pc-discuss-con-nav">
				<div class="pc-discuss-nav-head">
					<div class="discuss-nav-list">用户动态</div>
					<?php if(is_user_logged_in()): ?>
					<div class="pc-discuss-writting">发布动态</div>
					<?php else : ?>
					<a href="/login"><div class="pc-discuss-login">登录注册</div></a>
					<?php endif; ?>
				</div>
				<div class="pc-discuss-nav-main">
					<?php comment_form(
					  array(
					    'title_reply'=>'',
					    'label_submit' => __( '发布动态' ),
					    'fields' => array(
					    'author' => '
					      <div class="page-comments-author">
					        <input id="author" name="author" type="text" value="" size="30" placeholder="昵称" aria-required="true" required="required" autocomplete="off" >
					      </div>',
					    ),
					    'class_form'=> 'comment-form form-horizontal ',
					    'class_submit' => 'page-input-textarea',
					    'comment_field' => '
					        <div class="page-comments-text">
					          <textarea id="comment" class="form-control-page" name="comment" rows="4" maxlength="65525"  placeholder="评论" ></textarea>
					          <textarea id="commentimg" class="form-control-page" name="commentimg" style="display:none"></textarea>
					        </div>')
					  ); ?>

					<div class="zz-add-img">
						<input id="zz-img-file" type="file" accept="image/*">
						<div id="zz-img-add">上传图片</div>
						<div id="zz-img-con">
							<div id="zz-img-show">
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="pc-discuss-con-main">
				<div class="discuss-con-panel">
						<?php
						$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
						$number = 10;
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
					                        	$imgshow = preg_replace(array('#(http://([^\s]*)\.(jpg|gif|png|JPG|GIF|PNG))#','#(https://([^\s]*)\.(jpg|gif|png|JPG|GIF|PNG))#'),'<img class="zoomify" src="$1" alt="评论" style="width:50%"/>', $imgitem);
					                        	echo $imgshow;
					                        	}
					                        }else if(count($imgarr) < 5){
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
					                        }else{
					                            $left = '<div class="comments-content-img-3-left">';
					                            $middle = '<div class="comments-content-img-3-mid">';
					                            $right  = '<div class="comments-content-img-3-right">';
					                            $lefth = 0;
					                            $midh = 0;
					                            $righth = 0;
					                            foreach($imgarr  as $imgitem){
					                              if(!empty($imgitem)){
					                                $imageinfo = getimagesize($imgitem);
					                                $imgshow = preg_replace(array('#(http://([^\s]*)\.(jpg|gif|png|JPG|GIF|PNG))#','#(https://([^\s]*)\.(jpg|gif|png|JPG|GIF|PNG))#'),'<img class="zoomify" src="$1" alt="评论" />', $imgitem);
					                                if($lefth <= $midh && $lefth <= $righth){
					                                	$lefth +=  $imageinfo[1];
					                                	$left = $left.$imgshow;

					                                }else if($midh <= $lefth && $midh <= $righth){
					                                	$midh +=  $imageinfo[1];
					                                	$middle = $middle.$imgshow;
					                                }else if($righth <= $midh && $righth <= $lefth){
					                                	$righth +=  $imageinfo[1];
					                                	$right = $right.$imgshow;
					                                }
					                              }
					                            }
					                            $left = $left.'</div>';
					                            $middle = $middle.'</div>';
					                            $right = $right.'</div>';
					                            echo $left;
					                            echo $middle;
					                            echo $right;
					                         }
					                        ?>

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
		<div class="pc-discuss-con-right">
			<div class="pc-discuss-user">
				<div class="pc-discuss-user-logo"><?php global $current_user;get_currentuserinfo();echo get_avatar( $current_user->user_email, 60); ?></div>
				<div class="pc-discuss-user-name"><?php echo  $current_user->display_name;?></div>
				<div class="pc-discuss-user-action">
					<span><b>文章</b><?php echo count_user_posts( $user_ID , page ); ?></span>
					<span><b>评论</b><?php global $user_ID ;echo get_comments('count=true&user_id='.$user_ID); ?></span>
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
<script>
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
			        	$('#zz-img-add').text('上传中...');
			        },
					success:function(res){
						count++;
						$("#zz-img-add").text('上传图片');
						$('#zz-img-show').append('<div style="position:relative;display: inline-block;margin-bottom:10px;"><span class="img-close-btn" style=" position: absolute;top: -10px;right: 0;width: 20px;height: 20px;text-align: center; line-height: 20px;cursor:pointer"><i class="fa fa-times" aria-hidden="true"></i></span><img src="'+res.data.url+'" /></div>');
						$('textarea[name="commentimg"]').val($('textarea[name="commentimg"]').val()+res.data.url+'[img]').focus();
					}
			  	});
		  	}else{
				$("#zz-img-add").text('无法上传更多');
			}
		});
});


$(function(){
	$(document).on("click",".img-close-btn", function(){
		var num = $(this).next().attr('src') +'[img]';
		var imgurl = $("#commentimg").val();
		var urlarr = imgurl.split(num);
		var newurl = urlarr[0] + urlarr[1];
		$("#commentimg").val(newurl);
		$(this).parent().empty();

	})
})


/*! Zoomify - v0.2.4 - https://github.com/indrimuska/zoomify - (c) 2015 Indri Muska - MIT */
!function(a){Zoomify=function(b,c){var d=this;this._zooming=!1,this._zoomed=!1,this._timeout=null,this.$shadow=null,this.$image=a(b).addClass("zoomify"),this.options=a.extend({},Zoomify.DEFAULTS,this.$image.data(),c),this.$image.on("click",function(){d.zoom()}),a(window).on("resize",function(){d.reposition()}),a(document).on("scroll",function(){d.reposition()})},Zoomify.DEFAULTS={duration:200,easing:"linear",scale:.88},Zoomify.prototype.transition=function(a,b){a.css({"-webkit-transition":b,"-moz-transition":b,"-ms-transition":b,"-o-transition":b,transition:b})},Zoomify.prototype.addTransition=function(a){this.transition(a,"all "+this.options.duration+"ms "+this.options.easing)},Zoomify.prototype.removeTransition=function(b,c){var d=this;clearTimeout(this._timeout),this._timeout=setTimeout(function(){d.transition(b,""),a.isFunction(c)&&c.call(d)},this.options.duration)},Zoomify.prototype.transform=function(a){this.$image.css({"-webkit-transform":a,"-moz-transform":a,"-ms-transform":a,"-o-transform":a,transform:a})},Zoomify.prototype.transformScaleAndTranslate=function(a,b,c,d){this.addTransition(this.$image),this.transform("scale("+a+") translate("+b+"px, "+c+"px)"),this.removeTransition(this.$image,d)},Zoomify.prototype.zoom=function(){this._zooming||(this._zoomed?this.zoomOut():this.zoomIn())},Zoomify.prototype.zoomIn=function(){var b=this,c=this.$image.css("transform");this.transition(this.$image,"none"),this.transform("none");var d=this.$image.offset(),e=this.$image.outerWidth(),f=this.$image.outerHeight(),g=this.$image[0].naturalWidth||+(1/0),h=this.$image[0].naturalHeight||+(1/0),i=a(window).width(),j=a(window).height(),k=Math.min(g,i*this.options.scale)/e,l=Math.min(h,j*this.options.scale)/f,m=Math.min(k,l),n=(-d.left+(i-e)/2)/m,o=(-d.top+(j-f)/2+a(document).scrollTop())/m;this.transform(c),this._zooming=!0,this.$image.addClass("zoomed").trigger("zoom-in.zoomify"),setTimeout(function(){b.addShadow(),b.transformScaleAndTranslate(m,n,o,function(){b._zooming=!1,b.$image.trigger("zoom-in-complete.zoomify")}),b._zoomed=!0})},Zoomify.prototype.zoomOut=function(){var a=this;this._zooming=!0,this.$image.trigger("zoom-out.zoomify"),this.transformScaleAndTranslate(1,0,0,function(){a._zooming=!1,a.$image.removeClass("zoomed").trigger("zoom-out-complete.zoomify")}),this.removeShadow(),this._zoomed=!1},Zoomify.prototype.reposition=function(){this._zoomed&&(this.transition(this.$image,"none"),this.zoomIn())},Zoomify.prototype.addShadow=function(){var b=this;this._zoomed||(b.$shadow&&b.$shadow.remove(),this.$shadow=a('<div class="zoomify-shadow"></div>'),a("body").append(this.$shadow),this.addTransition(this.$shadow),this.$shadow.on("click",function(){b.zoomOut()}),setTimeout(function(){b.$shadow.addClass("zoomed")},10))},Zoomify.prototype.removeShadow=function(){var a=this;this.$shadow&&(this.addTransition(this.$shadow),this.$shadow.removeClass("zoomed"),this.$image.one("zoom-out-complete.zoomify",function(){a.$shadow&&a.$shadow.remove(),a.$shadow=null}))},a.fn.zoomify=function(b){return this.each(function(){var c=a(this),d=c.data("zoomify");d||c.data("zoomify",d=new Zoomify(this,"object"==typeof b&&b)),"string"==typeof b&&["zoom","zoomIn","zoomOut","reposition"].indexOf(b)>=0&&d[b]()})}}(jQuery);

$(document).on("click",".zoomify", function(){
$('.zoomify').zoomify();
});
</script>
<?php get_footer();?>
