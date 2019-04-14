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
  .pc-commments-list{
    margin-top: 0;
    border-radius: 0;
    border-bottom: solid 1px rgba(0,0,0,0.08);
}
.pc-discuss-con-main .comments-foot{
    padding-left: 45px;
    height: 20px;
    margin-top: 10px;
  }
  .pc-discuss-con-main .comments-foot.comments-child-foot{
    padding-left: 10px;
  }
  .pc-discuss-con-main .comments-foot-list{
    height: 20px;
  }
  .pc-discuss-con-main .comments-children {
    margin: 10px 30px;
    width: auto;
  }
  .foot-comment-con{
    min-height: 150px;
  }
  .comments-con{
    margin-top: 15px;
  }
  .foot-comment-left{
    padding:15px;
  }
  .comments-pc-list-text{
    padding-left: 45px;
  }
  .pc-commments-list{
    margin-top: 0;
    border-radius: 0;
    border-bottom: solid 1px rgba(0,0,0,0.08);
    padding:10px  0;
  }
  .pc-discuss-con-main .comments-content{
    padding-left: 45px;
  }
</style>

<div class="container">
	<div class="pc-new-top-img">
		<div class="pc-new-top-img-bg" style="background-image: url(<?php $general_options = get_option('ashuwp_general');echo $general_options['qinmei_base_post_img']; ?>)">
			<div class="pc-new-top-head">
				<?php $category = get_the_category();echo $category[0]->cat_name;?>
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
		
			<div class="pc-discuss-con-nav" style="margin-top: 15px;">
  				<div class="pc-discuss-nav-head">
  					<div class="discuss-nav-list">评论区</div>
  					<?php if(is_user_logged_in()): ?>
  					<div class="pc-discuss-writting">发布评论</div>
  					<?php else : ?>
  					<a href="/login"><div class="pc-discuss-login">登录注册</div></a>
  					<?php endif; ?>
  				</div>
  				<div class="pc-discuss-nav-main">
  					<?php comment_form(
  					  array(
  					    'title_reply'=>'',
  					    'label_submit' => __( '发布评论' ),
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
  					          <textarea id="comment" class="form-control-page" name="comment" rows="4" maxlength="65525"  placeholder="评论" aria-required="true" required="required"></textarea>
  					        </div>')
  					  ); ?>
  				</div>
  			</div>
  			<div class="pc-discuss-con-main">
  				<div class="discuss-con-panel">
  						<?php
  						$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
  						$number =100;
  						$offset = ( $paged - 1 ) * $number;
  						$args = array(
  						    'status' => 'approve',
  						    'post_id' => get_the_ID(),
  						    'parent'  => '0',
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
                          <?php if(!empty($comment->comment_author)){echo $comment->comment_author;}else{echo "游客";}; ?>

  												<span><?php echo $comment ->comment_date; ?></span>

  											</div>
  										</div>
  						        	</div>
  						        	<div class="comments-content">
                          <?php
                          $child_maintext = explode(':',$comment->comment_content);
                          if(!empty($child_maintext[1])){
                            echo convert_smilies($child_maintext[1]);
                          }else{
                            echo convert_smilies($child_maintext[0]);
                          }?>
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
                <?php }} else {echo '<div style="padding-left:15px">暂无评论</div>';}?>
  				</div>
  				<div class="pagination" style="display:none">
  					<?php $tot_returned_comments = count($comments);
  							$num = $paged + 1;
  							if ($number == $tot_returned_comments) {
  							    echo '<a href="/'.(the_slug()).'/page/' . $num . '">Next</a>';
  							}?>
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
<script>
$(function () {
	$(".pc-discuss-writting").click(function(){
		$(this).hide();
		$(".pc-discuss-nav-main").show();
	});
	$(document).on("click",".comments-children-switch", function() {
		console.log("hello");
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
</script>
<?php get_footer();?>